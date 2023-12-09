<?php

namespace App\Http\Controllers\Admin;

use App\Models\CaseStudy;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\CaseStudyService;
use Illuminate\Support\Facades\Validator;

class CaseStudiesController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $caseStudies = CaseStudy::where('title', 'LIKE', "%{$request->search}%")
            ->select('id', 'title', 'slug', 'case_study_image', 'button_title', 'cta', 'tags', 'video')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $caseStudies->each(function ($caseStudy) {
            $caseStudy->case_study_image = url($caseStudy->case_study_image);
            $caseStudy->video = url($caseStudy->video);
        });
        return response()->json($caseStudies, 200);
    }

    public function store(Request $request)
    {
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
            // 'services' => 'required',
            'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:20000'
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

        $video = '';
        if ($request->file('video')) {
            $video = videoUploader($request->file('video'), 'client-video');
        }

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
            'video' => $video,
            'keywords' => $request->keywords
        ]);

        // if ($request->services) {
        //     foreach ($request->services as $service => $key) {
        //         CaseStudyService::create([
        //             'service' => $request->services[$key],
        //             'url' => $request->service_url[$key],
        //             'case_study_id' => $caseStudy->id
        //         ]);
        //     }
        // }

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
        $caseStudy->video = url($caseStudy->video);

        $project_credits = $caseStudy->caseStudyCredits->pluck('member_id');
        $caseStudy->project_credits = $project_credits;

        return response()->json($caseStudy, 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
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
            'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:20000'
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

        $video = $caseStudy->video;
        if ($request->file('video')) {
            $video = videoUploader($request->file('video'), 'client-video');
        }

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
            'project_credit' => $request->project_credit,
            'client_name' => $request->client_name,
            'client_designation' => $request->client_designation,
            'client_review' => $request->client_review,
            'client_image' => $clientImage,
            'video' => $video,
            'keywords' => $request->keywords
        ]);

        // if ($request->services) {
        //     $caseStudy->caseStudyServices()->delete();
        //     foreach ($request->services as $service => $key) {
        //         CaseStudyService::create([
        //             'service' => $request->services[$key],
        //             'url' => $request->service_url[$key],
        //             'case_study_id' => $caseStudy->id
        //         ]);
        //     }
        // }

        if ($request->project_credits) {
            $caseStudy->caseStudyCredits()->delete();
            foreach ($request->project_credits as $member) {
                $caseStudy->caseStudyCredits()->create([
                    'member_id' => $member
                ]);
            }
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
