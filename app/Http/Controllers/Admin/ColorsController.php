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
        $colors = BackgroundColor::where('color_name', 'LIKE', "%{$request->search}%")
            ->orWhere('color_code', 'LIKE', "%{$request->search}%")
            ->paginate(10)
            ->through(function ($color) {
                return $color;
            });

        return response()->json($colors, 200);
    }

    public function store(Request $request)
    {
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
    }

    public function show($id)
    {
        $color = BackgroundColor::find($id);

        if (!$color) {
            return response()->json([
                'msgErr' => 'Color not found.',
            ], 404);
        }

        return response()->json($color, 200);
    }

    public function update(Request $request, $id)
    {
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
    }

    public function destroy($id)
    {
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
    }
}
