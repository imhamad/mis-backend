<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Authentication;


Route::post('/signup', [Authentication::class,'sign_up']);
Route::post('/login', [Authentication::class, 'login']);


// admin routes
Route::prefix('admin')->group(function() {

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
