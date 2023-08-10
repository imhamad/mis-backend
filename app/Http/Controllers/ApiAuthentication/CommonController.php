<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Theme;

class CommonController extends Controller
{
    // termsOfUse
    public function termsOfUse()
    {
        $settings = Setting::first();

        return response()->json([
            'terms_of_use' => $settings->terms_of_use
        ]);
    }

    // privacyPolicy
    public function privacyPolicy()
    {
        $settings = Setting::first();

        return response()->json([
            'privacy_policy' => $settings->privacy_policy
        ]);
    }

    // countriesList
    public function countriesList()
    {
        $countries = \App\Models\Country::where('status', 1)->select('id AS value', 'name AS label')->get();

        return response()->json($countries);
    }

    // getThemeData
    public function getThemeData()
    {
        $theme = Theme::first();

        return response()->json($theme);
    }

    // updateThemeData
    public function updateThemeData(Request $request)
    {
        $theme = Theme::first();

        // about page
        $theme->about_heroic_block_pre_title = $request->about_heroic_block_pre_title ? $request->about_heroic_block_pre_title : $theme->about_heroic_block_pre_title;
        $theme->about_heroic_block_title = $request->about_heroic_block_title ? $request->about_heroic_block_title : $theme->about_heroic_block_title;
        $theme->about_cta_link = $request->about_cta_link ? $request->about_cta_link : $theme->about_cta_link;
        $theme->about_open_source_culture = $request->about_open_source_culture ? $request->about_open_source_culture : $theme->about_open_source_culture;

        // services page
        $theme->services_heroic_block_pre_title = $request->services_heroic_block_pre_title ? $request->services_heroic_block_pre_title : $theme->services_heroic_block_pre_title;
        $theme->services_heroic_block_title = $request->services_heroic_block_title ? $request->services_heroic_block_title : $theme->services_heroic_block_title;

        if ($request->services_process_image)
            $theme->services_process_image = imageUploader($request->services_process_image, 'service process-imag');

        // case studies page
        $theme->casestudy_heroic_block_pre_title = $request->casestudy_heroic_block_pre_title ? $request->casestudy_heroic_block_pre_title : $theme->casestudy_heroic_block_pre_title;
        $theme->casestudy_heroic_block_title = $request->casestudy_heroic_block_title ? $request->casestudy_heroic_block_title : $theme->casestudy_heroic_block_title;

        $theme->save();

        return response()->json([
            'msg' => 'Theme data updated successfully.'
        ]);
    }
}
