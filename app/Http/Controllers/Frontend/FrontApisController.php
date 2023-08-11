<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontApisController extends Controller
{
    // countriesList
    public function countriesList()
    {
        $countries = \App\Models\Country::where('status', 1)->select('id AS value', 'name AS label')->get();

        return response()->json($countries);
    }

    // expertiesAndOffering
    public function expertiesAndOffering()
    {
        $experties = \App\Models\ExpertiesAndOffering::where('status', 1)->inRandomOrder()->limit(6)->get()->map(function($item) {
            $item->icon = url($item->icon);
            return $item;
        });

        return response()->json($experties);
    }
}
