<?php

namespace App\Http\Controllers\Contributor;

use App\Models\Blog;
use App\Enums\BlogStatus;
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
            ->with('category')
            ->paginate(10)->through(function ($blog) {
                $blog->image = url($blog->image);
                $category = $blog->category->title ?? null;
                $blog->created_date = $blog->created_at->format('d M, Y');
                $blog->status_text = BlogStatus::getStatusName($blog->status);

                unset($blog->category);
                $blog->category = $category;
                $blog->category_slug = str_replace(' ', '-', strtolower($category));

                return $blog;
            });

        return response()->json($blogs, 200);
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => $request->status == 'draft' ? '' : 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $blog = Blog::create([
            'title' => $request->title,
            'slug' => str_replace(' ', '-', strtolower($request->title)),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
            'status' => trim($request->status) === 'draft' ? 4 : 1,
        ]);

        return response()->json([
            'msg' => 'Blog created successfully.',
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

        return response()->json($blog, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string',
            'description' => 'string',
            'category_id' => 'integer',
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

        $blog->update([
            'title' => $request->title ?? $blog->title,
            'slug' => str_replace(' ', '-', strtolower($request->title ?? $blog->title)),
            'description' => $request->description ?? $blog->description,
            'category_id' => $request->category_id ?? $blog->category_id,
            'status' => trim($request->status) === 'draft' ? 4 : 1,
        ]);

        return response()->json([
            'msg' => 'Blog updated successfully.',
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
}
