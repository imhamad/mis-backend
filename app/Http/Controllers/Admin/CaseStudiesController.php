<?php

namespace App\Http\Controllers\Admin;

use App\Models\CaseStudy;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CaseStudiesController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $caseStudies = CaseStudy::where('title', 'LIKE', "%{$request->search}%")
            ->select('id', 'title', 'slug', 'case_study_image', 'button_title', 'cta', 'tags')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $caseStudies->each(function ($caseStudy) {
            $caseStudy->case_study_image = url($caseStudy->case_study_image);
        });
        return response()->json($caseStudies, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'seo_title' => 'required',
            'seo_meta_tags' => 'required',
            'image' => 'required',
            'title' => 'required',
            'button_title' => 'required',
            'cta' => 'required',
            'case_study_image' => 'required',
            'tags' => 'required',
            'about_the_client' => 'required',
            'industry_of_client' => 'required',
            'industry_of_client_image' => 'required',
            'challenge' => 'required',
            'value' => 'required',
            'project_credit' => 'required',
            'client_name' => 'required',
            'client_designation' => 'required',
            'client_review' => 'required',
            'client_image' => 'required',
            'services' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $image = '';
        if ($request->image)
            $image = imageUploader($request->image, 'sharing-image');

        $caseStudyImage = '';
        if ($request->case_study_image)
            $caseStudyImage = imageUploader($request->case_study_image, $request->title);

        $industryOfClientImage = '';
        if ($request->industry_of_client_image)
            $industryOfClientImage = imageUploader($request->industry_of_client_image, 'industry-of-client');

        $clientImage = '';
        if ($request->client_image)
            $clientImage = imageUploader($request->client_image, 'client-image');

        $caseStudy = CaseStudy::create([
            'seo_title' => $request->seo_title,
            'seo_meta_tags' => $request->seo_meta_tags,
            'image' => $image,

            'title' => $request->title,
            'slug' => $request->title,
            'button_title' => $request->button_title,
            'cta' => $request->cta,
            'case_study_image' => $caseStudyImage,
            'tags' => $request->tags,
            'about_the_client' => $request->about_the_client,
            'industry_of_client' => $request->industry_of_client,
            'industry_of_client_image' => $industryOfClientImage,
            'challenge' => $request->challenge,
            'value' => $request->value,
            'project_credit' => $request->project_credit,
            'client_name' => $request->client_name,
            'client_designation' => $request->client_designation,
            'client_review' => $request->client_review,
            'client_image' => $clientImage,
        ]);

        if ($request->services)
            $caseStudy->caseStudyServices()->createMany($request->services);

        if ($request->case_study_members)
            $caseStudy->caseStudyMembers()->createMany($request->case_study_members);


        return response()->json([
            'msg' => 'Case study created successfully.',
            'data' => $caseStudy,
        ], 201);
    }

    public function edit($id): JsonResponse
    {
        $caseStudy = CaseStudy::with('caseStudyServices')->find($id);
        return response()->json($caseStudy, 200);
    }

    public function show($id): JsonResponse
    {
        $caseStudy = CaseStudy::with('caseStudyServices')->find($id);
        $caseStudy->image = url($caseStudy->image);
        $caseStudy->case_study_image = url($caseStudy->case_study_image);
        $caseStudy->industry_of_client_image = url($caseStudy->industry_of_client_image);
        $caseStudy->client_image = url($caseStudy->client_image);
        return response()->json($caseStudy, 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'seo_title' => 'required',
            'seo_meta_tags' => 'required',
            'image' => 'required',
            'title' => 'required',
            'button_title' => 'required',
            'cta' => 'required',
            'case_study_image' => 'required',
            'tags' => 'required',
            'about_the_client' => 'required',
            'industry_of_client' => 'required',
            'industry_of_client_image' => 'required',
            'challenge' => 'required',
            'value' => 'required',
            'project_credit' => 'required',
            'client_name' => 'required',
            'client_designation' => 'required',
            'client_review' => 'required',
            'client_image' => 'required',
            'services' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $caseStudy = CaseStudy::find($id);

        $image = $caseStudy->image;
        if ($request->image)
            $image = imageUploader($request->image, 'sharing-image');

        $caseStudyImage = $caseStudy->case_study_image;
        if ($request->case_study_image)
            $caseStudyImage = imageUploader($request->case_study_image, $request->title);

        $industryOfClientImage = $caseStudy->industry_of_client_image;
        if ($request->industry_of_client_image)
            $industryOfClientImage = imageUploader($request->industry_of_client_image, 'industry-of-client');

        $clientImage = $caseStudy->client_image;
        if ($request->client_image)
            $clientImage = imageUploader($request->client_image, 'client-image');

        $caseStudy->update([
            'seo_title' => $request->seo_title,
            'seo_meta_tags' => $request->seo_meta_tags,
            'image' => $image,

            'title' => $request->title,
            'slug' => $request->title,
            'button_title' => $request->button_title,
            'cta' => $request->cta,
            'case_study_image' => $caseStudyImage,
            'tags' => $request->tags,
            'about_the_client' => $request->about_the_client,
            'industry_of_client' => $request->industry_of_client,
            'industry_of_client_image' => $industryOfClientImage,
            'challenge' => $request->challenge,
            'value' => $request->value,
            'project_credit' => $request->project_credit,
            'client_name' => $request->client_name,
            'client_designation' => $request->client_designation,
            'client_review' => $request->client_review,
            'client_image' => $clientImage,
        ]);

        if ($request->services) {
            $caseStudy->caseStudyServices()->delete();
            $caseStudy->caseStudyServices()->createMany($request->services);
        }

        if ($request->case_study_members) {
            $caseStudy->caseStudyMembers()->delete();
            $caseStudy->caseStudyMembers()->createMany($request->case_study_members);
        }

        return response()->json([
            'msg' => 'Case study updated successfully.',
            'data' => $caseStudy,
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        $caseStudy = CaseStudy::find($id);
        $caseStudy->caseStudyServices()->delete();
        $caseStudy->delete();
        return response()->json([
            'msg' => 'Case study deleted successfully.',
        ], 200);
    }
}
