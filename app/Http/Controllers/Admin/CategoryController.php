<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request  $request)
    {
        $categories = Category::where('title', 'LIKE', "%{$request->search}%")
            ->paginate(10)
            ->through(function ($category) {
                return $category;
            });

        return response()->json($categories, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:categories',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category = Category::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
        ]);

        return response()->json([
            'msg' => 'Category created successfully',
            'data' => $category,
        ], 201);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'msgErr' => 'Category not found.',
            ], 404);
        }

        return response()->json($category, 200);
    }

    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:categories,title,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'msgErr' => 'Category not found.',
            ], 404);
        }

        $category->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
        ]);

        return response()->json([
            'msg' => 'Category updated successfully.',
            'data' => $category,
        ], 201);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'msgErr' => 'Category not found.',
            ], 404);
        }

        $category->delete();

        return response()->json([
            'msg' => 'Category deleted successfully.',
        ], 200);
    }
}
