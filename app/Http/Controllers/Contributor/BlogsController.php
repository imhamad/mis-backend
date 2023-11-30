<?php

namespace App\Http\Controllers\Contributor;

use App\Models\Blog;
use App\Enums\BlogStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogsController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::where('title', 'LIKE', "%{$request->search}%")
            ->when($request->status == 'draft', function ($query) {
                return $query->where('status', 4);
            })
            ->where('user_id', auth()->user()->id)
            ->with('category')
            ->paginate(10)->through(function ($blog) {
                $blog->image = url($blog->image);
                $category = $blog->category->title ?? null;
                $blog->created_date = $blog->updated_at->format('d M, Y');
                $blog->status_text = BlogStatus::getStatusName($blog->status);

                unset($blog->category);
                $blog->category = $category;
                $blog->category_slug = Str::slug($category);
                $blog->powered_by_logo = url($blog->powered_by_logo);

                if ($blog->status == BlogStatus::PENDING) {
                    $blog->review = $blog->fetchLastReview() ? true : false;
                } else {
                    $blog->review = false;
                }

                return $blog;
            });

        return response()->json($blogs, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => $request->status == 'draft' ? '' : 'required',
            'category_id' => 'required',
            'image' => $request->status == 'draft' ? '' : 'required',
            'summary' => $request->status == 'draft' ? '' : 'required',
            'read_time' => $request->status == 'draft' ? '' : 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $image = '';
        if ($request->image)
            $image = imageUploader($request->image, 'blogs');

        $powered_by_logo = '';
        if ($request->powered_by_logo)
            $powered_by_logo = imageUploader($request->powered_by_logo, 'powered_logo');

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
            'status' => trim($request->status) === 'draft' ? 4 : 1,
            'image' => $image,
            'summary' => $request->summary,
            'read_time' => $request->read_time,
            'powered_by_logo' => $powered_by_logo,
        ]);

        return response()->json([
            'msg' => 'Blog is in pending status and will be published after review.',
            'data' => $blog,
        ], 201);
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->with('category')->first();

        if (!$blog) {
            return response()->json([
                'msgErr' => 'Blog not found.',
            ], 404);
        }

        $category = [
            'value' => $blog->category->id ?? null,
            'label' => $blog->category->title ?? null,
        ];
        unset($blog->category);
        $blog->category = $category;
        $blog->reviews = $blog->fetchLastReview();
        $blog->image = url($blog->image);
        $blog->powered_by_logo = url($blog->powered_by_logo);

        return response()->json($blog, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string',
            'description' => 'string',
            'category_id' => 'integer',
            'summary' => 'string',
            'read_time' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json([
                'msgErr' => 'Blog not found.',
            ], 404);
        }

        $image = $blog->image;
        if ($request->image)
            $image = imageUploader($request->image, 'blogs');

        $powered_by_logo = $blog->powered_by_logo;
        if ($request->powered_by_logo)
            $powered_by_logo = imageUploader($request->powered_by_logo, 'powered_logo');

        $blog->update([
            'title' => $request->title ?? $blog->title,
            'slug' => Str::slug($request->title ?? $blog->title),
            'description' => $request->description ?? $blog->description,
            'category_id' => $request->category_id ?? $blog->category_id,
            'status' => trim($request->status) === 'draft' ? 4 : 1,
            'image' => $image,
            'summary' => $request->summary ?? $blog->summary,
            'read_time' => $request->read_time ?? $blog->read_time,
            'powered_by_logo' => $powered_by_logo,
        ]);

        return response()->json([
            'msg' => 'Blog is in pending status and will be published after review.',
            'data' => $blog,
        ], 201);
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json([
                'msgErr' => 'Blog not found.',
            ], 404);
        }

        $blog->delete();

        return response()->json([
            'msg' => 'Blog deleted successfully.',
        ], 200);
    }





    // dashboard_statistics
    public function dashboard_statistics()
    {
        $all_blogs = Blog::currentuser()->count();
        $published_blogs = Blog::currentuser(BlogStatus::PUBLISHED)->count();
        // Rejected Blogs
        $rejected_blogs = Blog::currentuser(BlogStatus::REJECTED)->count();
        $pending_blogs = Blog::currentuser(BlogStatus::PENDING)->count();

        return response()->json([
            'all_blogs' => $all_blogs,
            'published_blogs' => $published_blogs,
            'rejected_blogs' => $rejected_blogs,
            'pending_blogs' => $pending_blogs,
        ], 200);
    }

    // dashboard_recent_blogs
    public function dashboard_recent_blogs()
    {
        $blogs = Blog::currentuser()
            ->with('category')->orderBy('id', 'desc')->limit(3)->get()
            ->map(function ($blog) {
                $blog->image = url($blog->image);
                $category = $blog->category->title ?? null;
                $blog->created_date = $blog->updated_at->format('d/m/Y');
                $blog->status_text = BlogStatus::getStatusName($blog->status);

                unset($blog->category);
                $blog->category = $category;
                $blog->category_slug = Str::slug($category);

                return $blog;
            });

        return response()->json($blogs, 200);
    }
}
