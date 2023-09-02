<?php

namespace App\Http\Controllers;

use App\Models\BackgroundColor;
use App\Models\Theme;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\OurTeamMember;

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

    // getTeamMembersDropdown
    public function getTeamMembersDropdown()
    {
        $teamMembers = OurTeamMember::selectRaw('id as value, CONCAT(name, " - ", designation) as label')->get();

        return response()->json($teamMembers);
    }

    // getCategoriesDropdown
    public function getCategoriesDropdown(Request $request)
    {
        $categories = Category::where('type', $request->type)->selectRaw('id as value, title as label')->get();

        return response()->json($categories);
    }

    // getColorsDropdown
    public function getColorsDropdown()
    {
        $colors = BackgroundColor::selectRaw('color_code as value, color_name as label')->get();

        return response()->json($colors);
    }
}
