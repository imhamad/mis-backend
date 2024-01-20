<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesAPIController extends Controller
{
    // ----------------- Home Page -----------------
    public function getHomePageData()
    {
        try {
            $homePageData = \App\Models\HomePage::first();

            $homePageData->image = baseURL($homePageData->image);

            return response()->json($homePageData);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function updateHomePageData(Request $request)
    {
        try {
            $homePageData = \App\Models\HomePage::first();

            $image = $request->image ? imageUploader($request->image, 'home page image') : $homePageData->image;

            $homePageData->update([
                'seo_title' => $request->seo_title ? $request->seo_title : $homePageData->seo_title,
                'seo_meta_tags' => $request->seo_meta_tags ? $request->seo_meta_tags : $homePageData->seo_meta_tags,
                'image' => $image,
                'countries' => $request->countries ? $request->countries : $homePageData->countries,
                'keywords' => $request->keywords ? $request->keywords : $homePageData->keywords,
                'og_url' => $request->og_url ? $request->og_url : $homePageData->og_url,
            ]);

            return response()->json([
                'msg' => 'Home page data updated successfully',
                'data' => $homePageData
            ]);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }



    // ----------------- About Page -----------------
    public function getAboutPageData()
    {
        try {
            $aboutPageData = \App\Models\AboutPage::first();

            $aboutPageData->image = baseURL($aboutPageData->image);

            return response()->json($aboutPageData);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function updateAboutPageData(Request $request)
    {
        try {
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
                'keywords' => $request->keywords ? $request->keywords : $aboutPageData->keywords,
                'og_url' => $request->og_url ? $request->og_url : $aboutPageData->og_url,
            ]);

            return response()->json([
                'msg' => 'About page data updated successfully',
                'data' => $aboutPageData
            ]);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }



    // ----------------- Service Page -----------------
    public function getServicePageData()
    {
        try {
            $servicePageData = \App\Models\ServicePage::first();

            $servicePageData->image = baseURL($servicePageData->image);
            $servicePageData->services_process_image = baseURL($servicePageData->services_process_image);

            return response()->json($servicePageData);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function updateServicePageData(Request $request)
    {
        try {
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
                'keywords' => $request->keywords ? $request->keywords : $servicePageData->keywords,
                'og_url' => $request->og_url ? $request->og_url : $servicePageData->og_url,
            ]);

            return response()->json([
                'msg' => 'Service page data updated successfully',
                'data' => $servicePageData
            ]);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }



    // ----------------- Case Study Page -----------------
    public function getCaseStudyPageData()
    {
        try {
            $caseStudyPageData = \App\Models\CaseStudyPage::first();

            $caseStudyPageData->image = baseURL($caseStudyPageData->image);

            return response()->json($caseStudyPageData);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function updateCaseStudyPageData(Request $request)
    {
        try {
            $caseStudyPageData = \App\Models\CaseStudyPage::first();

            $image = $request->image ? imageUploader($request->image, 'case study page image') : $caseStudyPageData->image;

            $caseStudyPageData->update([
                'seo_title' => $request->seo_title ? $request->seo_title : $caseStudyPageData->seo_title,
                'seo_meta_tags' => $request->seo_meta_tags ? $request->seo_meta_tags : $caseStudyPageData->seo_meta_tags,
                'image' => $image,
                'casestudy_heroic_block_pre_title' => $request->casestudy_heroic_block_pre_title ? $request->casestudy_heroic_block_pre_title : $caseStudyPageData->casestudy_heroic_block_pre_title,
                'casestudy_heroic_block_title' => $request->casestudy_heroic_block_title ? $request->casestudy_heroic_block_title : $caseStudyPageData->casestudy_heroic_block_title,
                'keywords' => $request->keywords ? $request->keywords : $caseStudyPageData->keywords,
                'og_url' => $request->og_url ? $request->og_url : $caseStudyPageData->og_url,
            ]);

            return response()->json([
                'msg' => 'Case study page data updated successfully',
                'data' => $caseStudyPageData
            ]);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    // ----------------- Blog Page -----------------
    public function getBlogPageData()
    {
        try {
            $blogPage = \App\Models\BlogPage::first();

            $blogPage->image = baseURL($blogPage->image);

            return response()->json($blogPage);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    public function updateBlogPageData(Request $request)
    {
        try {
            $blogPageData = \App\Models\BlogPage::first();

            $image = $request->image ? imageUploader($request->image, 'blog page image') : $blogPageData->image;

            $blogPageData->update([
                'seo_title' => $request->seo_title ? $request->seo_title : $blogPageData->seo_title,
                'seo_meta_tags' => $request->seo_meta_tags ? $request->seo_meta_tags : $blogPageData->seo_meta_tags,
                'image' => $image,
                'pre_title' => $request->pre_title ? $request->pre_title : $blogPageData->pre_title,
                'title' => $request->title ? $request->title : $blogPageData->title,
                'description' => $request->description ? $request->description : $blogPageData->description,
                'keywords' => $request->keywords ? $request->keywords : $blogPageData->keywords,
                'og_url' => $request->og_url ? $request->og_url : $blogPageData->og_url,
            ]);

            return response()->json([
                'msg' => 'Blog page data updated successfully',
                'data' => $blogPageData
            ]);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }
}
