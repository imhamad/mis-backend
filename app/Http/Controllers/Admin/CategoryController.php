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
        try {
            $categories = Category::where('title', 'LIKE', "%{$request->search}%")
                ->where('type', $request->type)
                ->paginate(10)
                ->through(function ($category) {
                    return $category;
                });

            return response()->json($categories, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:categories',
                'type' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $category = Category::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'type' => $request->type,
            ]);

            return response()->json([
                'msg' => 'Category created successfully',
                'data' => $category,
            ], 201);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function show($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'msgErr' => 'Category not found.',
                ], 404);
            }

            return response()->json($category, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:categories,title,' . $id,
                'type' => 'required'
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
                'type' => $request->type,
            ]);

            return response()->json([
                'msg' => 'Category updated successfully.',
                'data' => $category,
            ], 201);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function destroy($id)
    {
        try {
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
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }
}
