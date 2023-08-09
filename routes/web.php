<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CharactersController;
use App\Http\Controllers\PrebuiltPromptController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::redirect('/', '/dashboard')->name('home');

Route::get('/dashboard', [RouterController::class, 'dashboard'])->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UsersController::class);
    Route::resource('plans', PlansController::class);
    // characters  
    Route::resource('characters', CharactersController::class);

    // prompts
    Route::resource('prebuiltprompts', PrebuiltPromptController::class);

    // categories
    Route::resource('categories', CategoryController::class);

    // settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings-update/{id}', [SettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';
