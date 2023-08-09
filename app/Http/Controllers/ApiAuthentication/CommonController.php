<?php

namespace App\Http\Controllers\ApiAuthentication;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
