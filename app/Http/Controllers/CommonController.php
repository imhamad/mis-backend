<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Theme;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\OurTeamMember;
use App\Models\BackgroundColor;

class CommonController extends Controller
{
    // termsOfUse
    public function termsOfUse()
    {
        try {
            $settings = Setting::first();

            return response()->json([
                'terms_of_use' => $settings->terms_of_use
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    // privacyPolicy
    public function privacyPolicy()
    {
        try {
            $settings = Setting::first();

            return response()->json([
                'privacy_policy' => $settings->privacy_policy
            ]);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    // getThemeData
    public function getThemeData()
    {
        try {
            $theme = Theme::first();

            return response()->json($theme);
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    // updateThemeData
    public function updateThemeData(Request $request)
    {
        try {
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
        } catch (\Exception $exception) {
            return response()->json(['msgErr' => 'Internal server error']);
        }
    }

    // getTeamMembersDropdown
    public function getTeamMembersDropdown()
    {
        try {
            $teamMembers = OurTeamMember::selectRaw('id as value, CONCAT(name, " - ", designation) as label')->get();

            return response()->json($teamMembers);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    // getCategoriesDropdown
    public function getCategoriesDropdown(Request $request)
    {
        try {
            $categories = Category::where('type', $request->type)->selectRaw('id as value, title as label')->get();

            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }

    // getColorsDropdown
    public function getColorsDropdown()
    {
        try {
            $colors = BackgroundColor::selectRaw('color_code as value, color_name as label')->get();

            return response()->json($colors);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }
}
