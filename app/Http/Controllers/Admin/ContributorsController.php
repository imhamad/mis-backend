<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Enums\BlogStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContributorsController extends Controller
{
    // contributorsList
    public function contributorsList(Request $request)
    {
        $users = User::where('first_name', 'LIKE', "%{$request->search}%")
            ->orWhere('last_name', 'LIKE', "%{$request->search}%")
            ->where('user_type', 'contributor')
            ->when($request->status == 'active', function ($query) {
                return $query->where('status', 2);
            })
            ->when($request->status == 'inactive', function ($query) {
                return $query->where('status', 1);
            })
            ->select('id', 'first_name', 'last_name', 'email', 'status', 'description', 'avatar')
            ->paginate(10)->through(function ($user) {
                $user->avatar = url($user->avatar);
                $user->status = $user->status == 1 ? ['value' => $user->status, 'label' => 'Inactive'] : ['value' => $user->status, 'label' => 'Active'];

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

    // contributorChangeStatus
    public function contributorChangeStatus($id)
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
}
