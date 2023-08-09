<?php

namespace App\Http\Controllers\API;

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
}
