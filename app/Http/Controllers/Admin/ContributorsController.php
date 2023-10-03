<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\User;
use App\Enums\BlogStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\AccountApproved;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContributorsController extends Controller
{
    // contributorsList
    public function contributorsList(Request $request)
    {
        $users = User::where('first_name', 'LIKE', "%{$request->search}%")
            ->where('user_type', 'contributor')
            ->when($request->status == 'active', function ($query) {
                return $query->where('status', 2);
            })
            ->when($request->status == 'inactive', function ($query) {
                return $query->where('status', 1);
            })
            ->when(!empty($request->request_status), function ($query) use ($request) {
                return $query->where('request_status', $request->request_status);
            })
            ->select('id', 'first_name', 'last_name', 'email', 'status', 'description', 'avatar', 'request_status', 'linkedin_url', 'created_at')
            ->paginate(10)->through(function ($user) {
                $user->avatar = url($user->avatar);
                $user->status = $user->status == 1 ? ['value' => $user->status, 'label' => 'Inactive'] : ['value' => $user->status, 'label' => 'Active'];
                $user->request_status = ucfirst($user->request_status);
                $user->request_date = $user->created_at->format('d M, Y');

                return $user;
            });

        return response()->json($users, 200);
    }


    // contributorDetails
    public function contributorDetails($id)
    {
        $user = User::where('id', $id)
            ->where('user_type', 'contributor')
            ->select('id', 'first_name', 'last_name', 'email', 'status', 'description', 'avatar', 'description', 'linkedin_url')
            ->first();

        if (!$user)
            return response()->json(['msg' => 'Contributor not found.'], 404);
        $user->avatar = url($user->avatar);

        $blogs = $user->blogs()->groupBy('status')->selectRaw('count(*) as total, status')->get()->map(function ($item) {
            if ($item->status == BlogStatus::DRAFT)
                return;
            return [
                'value' => $item->total,
                'label' => BlogStatus::getStatusName($item->status)
            ];
        });

        $blogs = array_filter($blogs->toArray());
        $user->blogs = $blogs;
        $user->status = $user->status == 1 ? ['value' => $user->status, 'label' => 'Inactive'] : ['value' => $user->status, 'label' => 'Active'];

        return response()->json($user, 200);
    }

    // contributorBlogs
    public function contributorBlogs(Request $request, $id)
    {
        $user = User::where('id', $id)
            ->where('user_type', 'contributor')
            ->first();

        if (!$user)
            return response()->json(['msg' => 'Contributor not found.'], 404);

        $blogs = Blog::where('title', 'LIKE', "%{$request->search}%")
            ->orderBy('id', 'desc')
            ->with('category')
            ->where('status', '!=', BlogStatus::DRAFT)
            ->when($request->status, function ($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->paginate(10)->through(function ($blog) {
                $blog->image = url($blog->image);
                $category = $blog->category->title ?? null;
                $blog->created_date = $blog->updated_at->format('d M, Y');
                $blog->status_text = BlogStatus::getStatusName($blog->status);

                unset($blog->category);
                $blog->category = $category;
                $blog->category_slug = Str::slug($category);

                return $blog;
            });

        return response()->json($blogs, 200);
    }

    // contributorChangeStatus
    public function contributorChangeStatus(Request $request, $id)
    {
        $user = User::where('id', $id)
            ->where('user_type', 'contributor')
            ->first();

        if (!$user)
            return response()->json(['msg' => 'Contributor not found.'], 404);

        $user->status = $user->status == 1 ? 2 : 1;
        $user->save();

        return response()->json(['msg' => 'Contributor status updated successfully.'], 200);
    }

    // contributorApproveRejectAccount
    public function contributorApproveRejectAccount(Request $request, $id)
    {
        $user = User::where('id', $id)
            ->where('user_type', 'contributor')
            ->first();

        if (!$user)
            return response()->json(['msg' => 'Contributor not found.'], 404);


        // change request_status
        if ($user->request_status == 'pending' && $request->status == 'approved') {
            $user->request_status = 'approved';

            // password is minimum 8 characters, including at least 1 uppercase letter, 1 lowercase letter, and 1 number.
            $password = generatePassword();
            $user->password = bcrypt($password);
            $user->status = 2;
            $user->save();

            Mail::to($user->email)
                ->send(new AccountApproved($user, $password));

            $user->send_notification('Account Approved', 'Your account has been approved by admin.', 'account_approved');
        } else if ($user->request_status == 'pending' && $request->status == 'rejected') {
            $user->request_status = 'rejected';
            $user->status = 1;
            $user->save();
        } else {
            return response()->json(['msg' => 'Invalid request.'], 400);
        }

        return response()->json(['msg' => 'Contributor status updated successfully.'], 200);
    }

    // contributorDeleteRequest
    public function contributorDeleteRequest(Request $request, $id)
    {
        $user = User::where('id', $id)
            ->where('user_type', 'contributor')
            ->first();

        if (!$user)
            return response()->json(['msg' => 'Contributor not found.'], 404);

        $user->delete();

        return response()->json(['msg' => 'Contributor delete request sent successfully.'], 200);
    }
}
