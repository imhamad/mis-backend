<?php

use App\Http\Controllers\Admin\CaseStudiesController;
use App\Http\Controllers\Admin\CaseStudySlidersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OurClientController;
use App\Http\Controllers\Admin\OurTeamMembersController;
use App\Http\Controllers\ApiAuthentication\Authentication;
use App\Http\Controllers\Admin\OpenSourceCultureController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Admin\ExpertiesAndOfferingsController;
use App\Http\Controllers\Admin\PagesAPIController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Frontend\FrontApisController;

Route::post('/signup', [Authentication::class,'sign_up']);
Route::post('/login', [Authentication::class, 'login']);


// open routes
Route::prefix('frontend')->group(function() {
    Route::get('/home-page', [FrontApisController::class, 'homePage']);
    Route::get('/about-page', [FrontApisController::class, 'aboutPage']);
    Route::get('/service-page', [FrontApisController::class, 'servicePage']);
    Route::get('/case-study-page', [FrontApisController::class, 'caseStudyPage']);
    Route::get('/case-study-search', [FrontApisController::class, 'caseStudySearch']);
    Route::get('/case-study/{slug}', [FrontApisController::class, 'caseStudy']);
});


// admin routes
Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {
    Route::get('get-home-page-data', [PagesAPIController::class, 'getHomePageData']);
    Route::post('update-home-page-data', [PagesAPIController::class, 'updateHomePageData']);

    Route::get('get-about-page-data', [PagesAPIController::class, 'getAboutPageData']);
    Route::post('update-about-page-data', [PagesAPIController::class, 'updateAboutPageData']);

    Route::get('get-service-page-data', [PagesAPIController::class, 'getServicePageData']);
    Route::post('update-service-page-data', [PagesAPIController::class, 'updateServicePageData']);

    Route::get('get-case-study-page-data', [PagesAPIController::class, 'getCaseStudyPageData']);
    Route::post('update-case-study-page-data', [PagesAPIController::class, 'updateCaseStudyPageData']);

    Route::resource('experties-offerings', ExpertiesAndOfferingsController::class);

    Route::resource('open-source-cultures', OpenSourceCultureController::class);
    Route::resource('our-clients', OurClientController::class);
    Route::resource('our-team-members', OurTeamMembersController::class);

    Route::resource('our-services', ServicesController::class);

    Route::get('/get-theme-data', [CommonController::class, 'getThemeData']);
    Route::post('/update-theme-data', [CommonController::class, 'updateThemeData']);

    Route::resource('case-studies', CaseStudiesController::class);
    Route::resource('case-study-sliders', CaseStudySlidersController::class);
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
