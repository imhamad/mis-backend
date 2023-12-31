<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $tesimonials = Testimonial::where('name', 'LIKE', "%{$request->search}%")
            ->paginate(10)
            ->through(function ($tesimonial) {
                $tesimonial->image = baseURL($tesimonial->image);
                return $tesimonial;
            });

        return response()->json($tesimonials, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
            'company' => 'required',
            'description' => 'required',
            // 'type' => 'required|regex:/^.*(?=.*-page)/',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $image = '';
        if ($request->image)
            $image = imageUploader($request->image, $request->name);

        $testimonial = Testimonial::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'company' => $request->company,
            'description' => $request->description,
            // 'type' => $request->type,
            'image' => $image,
        ]);

        return response()->json([
            'msg' => 'Testimonial created successfully.',
            'data' => $testimonial,
        ], 201);
    }

    public function show($id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return response()->json([
                'msgErr' => 'Testimonial not found.',
            ], 404);
        }

        $testimonial->image = baseURL($testimonial->image);

        return response()->json($testimonial, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'required',
            'company' => 'required',
            'description' => 'required',
            // 'type' => 'required|regex:/^.*(?=.*-page)/',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return response()->json([
                'msgErr' => 'Testimonial not found.',
            ], 404);
        }

        $image = $testimonial->image;
        if ($request->image)
            $image = imageUploader($request->image, $request->name);


        $testimonial->update([
            'name' => $request->name ? $request->name : $testimonial->name,
            'designation' => $request->designation ? $request->designation : $testimonial->designation,
            'company' => $request->company ? $request->company : $testimonial->company,
            'description' => $request->description ? $request->description : $testimonial->description,
            // 'type' => $request->type ? $request->type : $testimonial->type,
            'image' => $image,
        ]);

        return response()->json([
            'msg' => 'Testimonial updated successfully.',
            'data' => $testimonial,
        ], 201);
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return response()->json([
                'msgErr' => 'Testimonial not found.',
            ], 404);
        }

        $testimonial->delete();

        return response()->json([
            'msg' => 'Testimonial deleted successfully.',
        ], 200);
    }
}
