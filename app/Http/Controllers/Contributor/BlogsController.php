<?php

namespace App\Http\Controllers\Contributor;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogsController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::where('title', 'LIKE', "%{$request->search}%")
            ->paginate(10)->through(function ($blog) {
                // attach the image url
                $blog->image = url($blog->image);

                return $blog;
            });

        return response()->json($blogs, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $image = imageUploader($request->image, 'blog-image') ?? '';

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => str_replace(' ', '-', strtolower($request->title)),
            'description' => $request->description,
            'image' => $image,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
        ]);

        return response()->json([
            'msg' => 'Blog created successfully.',
            'data' => $blog,
        ], 201);
    }

    public function show($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json([
                'msgErr' => 'Blog not found.',
            ], 404);
        }

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

        $image = $blog->image;
        if ($request->image) {
            // You need to define your imageUploader function here
            $image = imageUploader($request->image, 'blog-image');
        }

        $blog->update([
            'title' => $request->title ?? $blog->title,
            'slug' => str_replace(' ', '-', strtolower($request->title ?? $blog->title)),
            'description' => $request->description ?? $blog->description,
            'image' => $image,
            'category_id' => $request->category_id ?? $blog->category_id,
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
