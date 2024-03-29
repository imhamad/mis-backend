<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CaseStudy;
use Illuminate\Http\Request;
use App\Models\OurTeamMember;
use App\Models\CaseStudyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CaseStudiesController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $caseStudies = CaseStudy::where('title', 'LIKE', "%{$request->search}%")
                ->select('id', 'title', 'slug', 'case_study_image', 'button_title', 'cta', 'tags', 'video')
                ->orderBy('id', 'desc')
                ->paginate(10);

            $caseStudies->each(function ($caseStudy) {
                $caseStudy->case_study_image = baseURL($caseStudy->case_study_image);
                $caseStudy->video = baseURL($caseStudy->video);
            });
            return response()->json($caseStudies, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'seo_title' => 'required',
                'seo_meta_tags' => 'required',
                'image' => 'required',
                'title' => 'required',
                'pre_title' => 'required',
                'button_title' => 'required',
                'cta' => 'required',
                'case_study_image' => 'required',
                'tags' => 'required',
                'about_the_client' => 'required',
                'industry_of_client' => 'required',
                'industry_of_client_image' => 'required',
                'challenge' => 'required',
                'value' => 'required',
                'category_id' => 'required',
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
                'pre_title' => $request->pre_title,
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
                'category_id' => $request->category_id,
                'client_name' => $request->client_name,
                'client_designation' => $request->client_designation,
                'client_review' => $request->client_review,
                'client_image' => $clientImage,
                'video' => $request->video,
                'keywords' => $request->keywords
            ]);

            if ($request->services)
                $caseStudy->caseStudyServices()->createMany($request->services);

            if ($request->project_credits) {
                foreach ($request->project_credits as $member) {
                    $caseStudy->caseStudyCredits()->create([
                        'member_id' => $member
                    ]);
                }
            }

            return response()->json([
                'msg' => 'Case study created successfully.',
                'data' => $caseStudy,
            ], 201);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function edit($id): JsonResponse
    {
        try {
            $caseStudy = CaseStudy::with('caseStudyServices')->find($id);
            return response()->json($caseStudy, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $caseStudy = CaseStudy::with('caseStudyServices')->find($id);
            $caseStudy->image = baseURL($caseStudy->image);
            $caseStudy->case_study_image = baseURL($caseStudy->case_study_image);
            $caseStudy->industry_of_client_image = baseURL($caseStudy->industry_of_client_image);
            $caseStudy->client_image = baseURL($caseStudy->client_image);
            $caseStudy->video = $caseStudy->video ? baseURL($caseStudy->video) : '';

            $project_credits = $caseStudy->caseStudyCredits->pluck('member_id');
            $project_credits = OurTeamMember::whereIn('id', $project_credits)->select('id as value', DB::raw('CONCAT(name, " - ", designation) AS label'))->get()->toArray();
            $caseStudy->project_credits = $project_credits;

            return response()->json($caseStudy, 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'seo_title' => 'required',
                'seo_meta_tags' => 'required',
                'pre_title' => 'required',
                'title' => 'required',
                'button_title' => 'required',
                'cta' => 'required',
                // 'case_study_image' => 'required',
                'tags' => 'required',
                'about_the_client' => 'required',
                'industry_of_client' => 'required',
                // 'industry_of_client_image' => 'required',
                'challenge' => 'required',
                'value' => 'required',
                'category_id' => 'required',
                // 'project_credit' => 'required',
                'client_name' => 'required',
                'client_designation' => 'required',
                'client_review' => 'required',
                // 'client_image' => 'required',
                // 'services' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $caseStudy = CaseStudy::find($id);

            if (!$caseStudy) {
                return response()->json(['msgErr' => 'Case study not found.'], 404);
            }

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
                'pre_title' => $request->pre_title,
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
                'category_id' => $request->category_id,
                'project_credit' => '$request->project_credit',
                'client_name' => $request->client_name,
                'client_designation' => $request->client_designation,
                'client_review' => $request->client_review,
                'client_image' => $clientImage,
                'video' => $request->video,
                'keywords' => $request->keywords
            ]);

            if ($request->services) {
                $caseStudy->caseStudyServices()->delete();
                $caseStudy->caseStudyServices()->createMany($request->services);
            }

            if ($request->project_credit) {
                $caseStudy->caseStudyCredits()->delete();
                foreach ($request->project_credit as $member) {
                    $caseStudy->caseStudyCredits()->create([
                        'member_id' => $member
                    ]);
                }
            }

            return response()->json([
                'msg' => 'Case study updated successfully.',
                'data' => $caseStudy,
            ], 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $caseStudy = CaseStudy::find($id);
            $caseStudy->caseStudyServices()->delete();
            $caseStudy->delete();
            return response()->json([
                'msg' => 'Case study deleted successfully.',
            ], 200);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }
}
