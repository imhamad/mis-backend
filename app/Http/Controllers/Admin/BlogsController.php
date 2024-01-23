<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\User;
use App\Enums\BlogStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $blogs = Blog::where('title', 'LIKE', "%{$request->search}%")
                ->orderBy('id', 'desc')
                ->with('category')
                ->where('status', '!=', BlogStatus::DRAFT)
                ->when($request->status, function ($query) use ($request) {
                    return $query->where('status', $request->status);
                })
                ->paginate(10)->through(function ($blog) {
                    $blog->image = baseURL($blog->image);
                    $blog->powered_by_logo = baseURL($blog->powered_by_logo);
                    $category = $blog->category->title ?? null;
                    $blog->created_date = $blog->updated_at->format('d M, Y');
                    $blog->status_text = BlogStatus::getStatusName($blog->status);

                    unset($blog->category);
                    $blog->category = $category;
                    $blog->category_slug = Str::slug($category);

                    if ($blog->status == BlogStatus::PENDING) {
                        $blog->review = $blog->fetchLastReview() ? true : false;
                    } else {
                        $blog->review = false;
                    }

                    return $blog;
                });

            return response()->json($blogs, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function show($slug)
    {
        try {
            $blog = Blog::where('slug', $slug)->first();

            if (!$blog) {
                return response()->json([
                    'msgErr' => 'Blog not found.',
                ], 404);
            }

            $blog->image = baseURL($blog->image);
            $blog->powered_by_logo = baseURL($blog->powered_by_logo);
            $category = $blog->category->title ?? null;
            $blog->created_date = $blog->updated_at->format('d M, Y');
            $blog->status_text = BlogStatus::getStatusName($blog->status);

            unset($blog->category);
            $blog->category = $category;
            $blog->category_slug = Str::slug($category);

            if ($blog->status == BlogStatus::PENDING) {
                $blog->review = $blog->reviews()->get() ?? false;
            } else {
                $blog->review = false;
            }

            $blog->author = $blog->user?->first_name ?? '' . ' ' . $blog->user?->last_name ?? null;
            unset($blog->user);

            return response()->json($blog, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $blog = Blog::where('slug', $slug)->first();

            if (!$blog) {
                return response()->json([
                    'msgErr' => 'Blog not found.',
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'status' => 'required', // pending = 1, published = 2, cancelled = 3
                'review' => 'required_if:status,3,1',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            if ($request->status == BlogStatus::REJECTED || $request->status == BlogStatus::PENDING) {
                $blog->reviews()->create([
                    'user_id' => auth()->user()->id,
                    'review' => $request->review,
                    'blog_status' => $request->status,
                ]);
            }

            $blog->status = $request->status;
            $blog->save();

            return response()->json([
                'msg' => 'Blog updated successfully.',
            ], 201);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function dashboard_statistics()
    {
        try {
            $all_blogs = Blog::count();
            $request_blogs = Blog::withStatus(BlogStatus::PENDING)->count();
            $published_blogs = Blog::withStatus(BlogStatus::PUBLISHED)->count();
            // Rejected Blogs
            $cancel_blogs = Blog::withStatus(BlogStatus::REJECTED)->count();

            $total_contributors = User::where('user_type', 'contributor')->count();
            $waiting_contributors = User::where('user_type', 'contributor')->where('request_status', 'pending')->count();
            $approved_contributors = User::where('user_type', 'contributor')->where('request_status', 'approved')->count();

            return response()->json([
                'all_blogs' => $all_blogs,
                'published_blogs' => $published_blogs,
                'cancel_blogs' => $cancel_blogs,
                'request_blogs' => $request_blogs,
                'total_contributors' => $total_contributors,
                'waiting_contributors' => $waiting_contributors,
                'approved_contributors' => $approved_contributors,
            ], 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    // dashboard_recent_blogs
    public function dashboard_recent_blogs()
    {
        try {
            $blogs = Blog::withStatus(BlogStatus::PUBLISHED)
                ->with('category')->orderBy('id', 'desc')->limit(6)->get()
                ->map(function ($blog) {
                    $blog->image = baseURL($blog->image);
                    $category = $blog->category->title ?? null;
                    $blog->created_date = $blog->updated_at->format('d/m/Y');
                    $blog->status_text = BlogStatus::getStatusName($blog->status);
                    $blog->powered_by_logo = baseURL($blog->powered_by_logo);

                    unset($blog->category, $blog->created_at, $blog->updated_at);
                    $blog->category = $category;
                    $blog->category_slug = Str::slug($category);

                    return $blog;
                });

            return response()->json($blogs, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }
}
