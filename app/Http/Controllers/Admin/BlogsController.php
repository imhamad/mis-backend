<?php

namespace App\Http\Controllers\Admin;

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

    public function show($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json([
                'msgErr' => 'Blog not found.',
            ], 404);
        }

        $blog->image = url($blog->image);
        $category = $blog->category->title ?? null;
        $blog->created_date = $blog->updated_at->format('d M, Y');
        $blog->status_text = BlogStatus::getStatusName($blog->status);

        unset($blog->category);
        $blog->category = $category;
        $blog->category_slug = Str::slug($category);
        $blog->reviews = $blog->reviews()->with('user')->get();

        return response()->json($blog, 200);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

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
    }
}
