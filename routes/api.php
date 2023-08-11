<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SEOTagsController;
use App\Http\Controllers\Admin\OurClientController;
use App\Http\Controllers\Admin\OurTeamMembersController;
use App\Http\Controllers\ApiAuthentication\Authentication;
use App\Http\Controllers\Admin\OpenSourceCultureController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Admin\ExpertiesAndOfferingsController;
use App\Http\Controllers\Admin\ServicesController;

Route::post('/signup', [Authentication::class,'sign_up']);
Route::post('/login', [Authentication::class, 'login']);


// open routes
Route::prefix('frontend')->group(function() {
    Route::get('/countries-list', [CommonController::class, 'countriesList']);
});


// admin routes
Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {
    Route::resource('experties-offerings', ExpertiesAndOfferingsController::class);
    Route::resource('seo-tags', SEOTagsController::class);

    Route::resource('open-source-cultures', OpenSourceCultureController::class);
    Route::resource('our-clients', OurClientController::class);
    Route::resource('our-team-members', OurTeamMembersController::class);

    Route::resource('our-services', ServicesController::class);

    Route::get('/get-theme-data', [CommonController::class, 'getThemeData']);
    Route::post('/update-theme-data', [CommonController::class, 'updateThemeData']);
});


// contributor routes
Route::prefix('contributor')->group(function() {

});

Route::group(["middleware" => "auth:sanctum"], function () {
    Route::post('/update-profile', [Authentication::class, 'update_profile']);
    Route::post('/logout', [Authentication::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});








Route::get('/execute-command', function (\Illuminate\Http\Request $request) {
    $command = $request->query('command');

    if ($command) {
        $output = '';
        $exitCode = \Artisan::call($command, [], $output);

        if ($exitCode === 0) {
            return "Command executed successfully.";
        } else {
            return "Command execution failed.";
        }
    } else {
        return "No command specified.";
    }
});
