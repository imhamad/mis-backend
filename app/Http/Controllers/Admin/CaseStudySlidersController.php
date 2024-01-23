<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CaseStudySlider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CaseStudySlidersController extends Controller
{
    public function index(Request $request)
    {
        try {
            $caseStudySliders = CaseStudySlider::where('title', 'LIKE', "%{$request->search}%")
                ->where('case_study_id', $request->case_study_id)
                ->paginate(10)
                ->through(function ($caseStudySlider) {
                    // attach the image baseURL
                    $caseStudySlider->image = baseURL($caseStudySlider->image);

                    return $caseStudySlider;
                });

            return response()->json($caseStudySliders, 200);
        } catch (\Throwable $th) {
            return response()->json(['msgErr' => 'Something went wrong.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'case_study_id' => 'required',
                'title' => 'required',
                'descriptive_title' => 'required',
                'image' => 'required',
                'cta' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $image = $request->has('image') ? imageUploader($request->image, $request->title) : '';

            $caseStudySlider = CaseStudySlider::create([
                'case_study_id' => $request->case_study_id,
                'title' => $request->title,
                'descriptive_title' => $request->descriptive_title,
                'image' => $image,
                'cta' => $request->cta,
            ]);


            return response()->json([
                'msg' => 'Case Study Slider created successfully.',
                'data' => $caseStudySlider,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['msgErr' => 'Something went wrong.'], 500);
        }
    }

    public function show(CaseStudySlider $caseStudySlider)
    {
        try {
            if (!$caseStudySlider) {
                return response()->json(['msgErr' => 'Case Study Slider not found.'], 404);
            }

            // attach the image baseURL
            $caseStudySlider->image = baseURL($caseStudySlider->image);

            return response()->json($caseStudySlider, 200);
        } catch (\Throwable $th) {
            return response()->json(['msgErr' => 'Something went wrong.'], 500);
        }
    }

    public function edit(CaseStudySlider $caseStudySlider)
    {
        try {
            if (!$caseStudySlider) {
                return response()->json(['msgErr' => 'Case Study Slider not found.'], 404);
            }

            // attach the image baseURL
            $caseStudySlider->image = baseURL($caseStudySlider->image);

            return response()->json($caseStudySlider, 200);
        } catch (\Throwable $th) {
            return response()->json(['msgErr' => 'Something went wrong.'], 500);
        }
    }

    public function update(Request $request, CaseStudySlider $caseStudySlider)
    {
        try {
            if (!$caseStudySlider) {
                return response()->json(['msgErr' => 'Case Study Slider not found.'], 404);
            }

            $validator = Validator::make($request->all(), [
                'case_study_id' => 'required',
                'title' => 'required',
                'descriptive_title' => 'required',
                'cta' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $image = $request->has('image') ? imageUploader($request->image, $request->title) : $caseStudySlider->image;

            $caseStudySlider->update([
                'case_study_id' => $request->case_study_id,
                'title' => $request->title,
                'descriptive_title' => $request->descriptive_title,
                'image' => $image,
                'cta' => $request->cta,
            ]);

            return response()->json([
                'msg' => 'Case Study Slider updated successfully.',
                'data' => $caseStudySlider,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['msgErr' => 'Something went wrong.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $caseStudySlider = CaseStudySlider::find($id);
            if (!$caseStudySlider) {
                return response()->json(['msgErr' => 'Case Study Slider not found.'], 404);
            }

            $caseStudySlider->delete();

            return response()->json([
                'msg' => 'Case Study Slider deleted successfully.',
            ], 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }
}
