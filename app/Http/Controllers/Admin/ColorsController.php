<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\BackgroundColor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ColorsController extends Controller
{
    public function index(Request  $request)
    {
        try {
            $colors = BackgroundColor::where('color_name', 'LIKE', "%{$request->search}%")
                ->orWhere('color_code', 'LIKE', "%{$request->search}%")
                ->paginate(10)
                ->through(function ($color) {
                    return $color;
                });

            return response()->json($colors, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'color_name' => 'required|unique:background_colors',
                'color_code' => 'required|unique:background_colors',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $color = BackgroundColor::create([
                'color_name' => $request->color_name,
                'color_code' => $request->color_code,
            ]);

            return response()->json([
                'msg' => 'Color created successfully',
                'data' => $color,
            ], 201);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function show($id)
    {
        try {
            $color = BackgroundColor::find($id);

            if (!$color) {
                return response()->json([
                    'msgErr' => 'Color not found.',
                ], 404);
            }

            return response()->json($color, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'color_name' => 'required|unique:background_colors,color_name,' . $id,
                'color_code' => 'required|unique:background_colors,color_code,' . $id,
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $color = BackgroundColor::find($id);

            if (!$color) {
                return response()->json([
                    'msgErr' => 'Color not found.',
                ], 404);
            }

            $color->update([
                'color_name' => $request->color_name,
                'color_code' => $request->color_code,
            ]);

            return response()->json([
                'msg' => 'Color updated successfully.',
                'data' => $color,
            ], 201);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function destroy($id)
    {
        try {
            $color = BackgroundColor::find($id);

            if (!$color) {
                return response()->json([
                    'msgErr' => 'Color not found.',
                ], 404);
            }

            $color->delete();

            return response()->json([
                'msg' => 'Color deleted successfully.',
            ], 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }
}
