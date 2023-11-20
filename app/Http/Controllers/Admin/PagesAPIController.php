<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesAPIController extends Controller
{
    // ----------------- Home Page -----------------
    public function getHomePageData()
    {
        $homePageData = \App\Models\HomePage::first();

        $homePageData->image = url($homePageData->image);

        return response()->json($homePageData);
    }

    public function updateHomePageData(Request $request)
    {
        $homePageData = \App\Models\HomePage::first();

        $image = $request->has('image') ? imageUploader($request->image, 'home page image') : $homePageData->image;

        $homePageData->update([
            'seo_title' => $request->seo_title ? $request->seo_title : $homePageData->seo_title,
            'seo_meta_tags' => $request->seo_meta_tags ? $request->seo_meta_tags : $homePageData->seo_meta_tags,
            'image' => $image,
            'countries' => $request->countries ? $request->countries : $homePageData->countries,
        ]);

        return response()->json([
            'msg' => 'Home page data updated successfully',
            'data' => $homePageData
        ]);
    }



    // ----------------- About Page -----------------
    public function getAboutPageData()
    {
        $aboutPageData = \App\Models\AboutPage::first();

        $aboutPageData->image = url($aboutPageData->image);

        return response()->json($aboutPageData);
    }

    public function updateAboutPageData(Request $request)
    {
        $aboutPageData = \App\Models\AboutPage::first();

        $image = $request->image ? imageUploader($request->image, 'about page image') : $aboutPageData->image;

        $aboutPageData->update([
            'seo_title' => $request->seo_title ? $request->seo_title : $aboutPageData->seo_title,
            'seo_meta_tags' => $request->seo_meta_tags ? $request->seo_meta_tags : $aboutPageData->seo_meta_tags,
            'image' => $image,
            'about_heroic_block_pre_title' => $request->about_heroic_block_pre_title ? $request->about_heroic_block_pre_title : $aboutPageData->about_heroic_block_pre_title,
            'about_heroic_block_title' => $request->about_heroic_block_title ? $request->about_heroic_block_title : $aboutPageData->about_heroic_block_title,
            'about_cta_link' => $request->about_cta_link ? $request->about_cta_link : $aboutPageData->about_cta_link,
            'about_open_source_culture' => $request->about_open_source_culture ? $request->about_open_source_culture : $aboutPageData->about_open_source_culture,
        ]);

        return response()->json([
            'msg' => 'About page data updated successfully',
            'data' => $aboutPageData
        ]);
    }



    // ----------------- Service Page -----------------
    public function getServicePageData()
    {
        $servicePageData = \App\Models\ServicePage::first();

        $servicePageData->image = url($servicePageData->image);
        $servicePageData->services_process_image = url($servicePageData->services_process_image);

        return response()->json($servicePageData);
    }

    public function updateServicePageData(Request $request)
    {
        $servicePageData = \App\Models\ServicePage::first();

        $image = $request->image ? imageUploader($request->image, 'service page image') : $servicePageData->image;
        $services_process_image = $request->services_process_image ? imageUploader($request->services_process_image, 'service page process image') : $servicePageData->services_process_image;

        $servicePageData->update([
            'seo_title' => $request->seo_title ? $request->seo_title : $servicePageData->seo_title,
            'seo_meta_tags' => $request->seo_meta_tags ? $request->seo_meta_tags : $servicePageData->seo_meta_tags,
            'image' => $image,
            'services_heroic_block_pre_title' => $request->services_heroic_block_pre_title ? $request->services_heroic_block_pre_title : $servicePageData->services_heroic_block_pre_title,
            'services_heroic_block_title' => $request->services_heroic_block_title ? $request->services_heroic_block_title : $servicePageData->services_heroic_block_title,
            'services_process_image' => $services_process_image,
        ]);

        return response()->json([
            'msg' => 'Service page data updated successfully',
            'data' => $servicePageData
        ]);
    }



    // ----------------- Case Study Page -----------------
    public function getCaseStudyPageData()
    {
        $caseStudyPageData = \App\Models\CaseStudyPage::first();

        $caseStudyPageData->image = url($caseStudyPageData->image);

        return response()->json($caseStudyPageData);
    }

    public function updateCaseStudyPageData(Request $request)
    {
        $caseStudyPageData = \App\Models\CaseStudyPage::first();

        $image = $request->image ? imageUploader($request->image, 'case study page image') : $caseStudyPageData->image;

        $caseStudyPageData->update([
            'seo_title' => $request->seo_title ? $request->seo_title : $caseStudyPageData->seo_title,
            'seo_meta_tags' => $request->seo_meta_tags ? $request->seo_meta_tags : $caseStudyPageData->seo_meta_tags,
            'image' => $image,
            'casestudy_heroic_block_pre_title' => $request->casestudy_heroic_block_pre_title ? $request->casestudy_heroic_block_pre_title : $caseStudyPageData->casestudy_heroic_block_pre_title,
            'casestudy_heroic_block_title' => $request->casestudy_heroic_block_title ? $request->casestudy_heroic_block_title : $caseStudyPageData->casestudy_heroic_block_title,
        ]);

        return response()->json([
            'msg' => 'Case study page data updated successfully',
            'data' => $caseStudyPageData
        ]);
    }

    // ----------------- Blog Page -----------------
    public function getBlogPageData()
    {
        $blogPage = \App\Models\BlogPage::first();

        $blogPage->image = url($blogPage->image);

        return response()->json($blogPage);
    }

    public function updateBlogPageData(Request $request)
    {
        $blogPageData = \App\Models\BlogPage::first();

        $image = $request->image ? imageUploader($request->image, 'blog page image') : $blogPageData->image;

        $blogPageData->update([
            'seo_title' => $request->seo_title ? $request->seo_title : $blogPageData->seo_title,
            'seo_meta_tags' => $request->seo_meta_tags ? $request->seo_meta_tags : $blogPageData->seo_meta_tags,
            'image' => $image,
            'pre_title' => $request->pre_title ? $request->pre_title : $blogPageData->pre_title,
            'title' => $request->title ? $request->title : $blogPageData->title,
            'description' => $request->description ? $request->description : $blogPageData->description,
        ]);

        return response()->json([
            'msg' => 'Blog page data updated successfully',
            'data' => $blogPageData
        ]);
    }
}
