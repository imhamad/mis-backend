<?php

namespace App\Http\Controllers\Admin;

use App\Models\CaseStudy;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CaseStudiesController extends Controller
{
    public function index()
    {
        return view('admin.case-studies.index');
    }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'title' => 'required',
    //         'description' => 'required',
    //         'icon' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     $image = '';
    //     if ($request->icon) {

    //         $iconData = $request->icon;
    //         $iconName = time() . '-' . Str::slug($request->title) . '.png';
    //         $iconDirectory = 'images';

    //         $image = saveBase64Image($iconData, $iconDirectory, $iconName);
    //     }

    //     $expertiesAndOfferings = ExpertiesAndOffering::create([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'icon' => $image,
    //     ]);

    //     return response()->json([
    //         'msg' => 'Experties and offering created successfully.',
    //         'data' => $expertiesAndOfferings,
    //     ], 201);
    // }

    public function store(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'button_title' => 'required',
            'cta' => 'required',
            'image' => 'required',
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
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $image = '';
        if ($request->image)
            $image = imageUploader($request->image, $request->title);

        $caseStudy = CaseStudy::create([
            'title' => $request->title,
            'button_title' => $request->button_title,
            'cta' => $request->cta,
            'image' => $image,
            'tags' => $request->tags,
            'about_the_client' => $request->about_the_client,
            'industry_of_client' => $request->industry_of_client,
            'industry_of_client_image' => $request->industry_of_client_image,
            'challenge' => $request->challenge,
            'value' => $request->value,
            'project_credit' => $request->project_credit,
            'client_name' => $request->client_name,
            'client_designation' => $request->client_designation,
            'client_review' => $request->client_review,
            'client_image' => $request->client_image,
        ]);

        if ($request->services)
            $caseStudy->services()->createMany($request->services);
        
        
        return response()->json([
            'msg' => 'Case study created successfully.',
            'data' => $caseStudy,
        ], 201);
    }
}
