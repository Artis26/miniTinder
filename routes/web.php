<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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

//registration
Auth::routes();

Route::get('/', [HomeController::class, 'welcome']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::post('/user/create_profile', [UserController::class, 'create']);
Route::get('/user/profile_create', function () {
    return view('/user/profileCreate');
});

Route::get('/user', [UserController::class, 'index'])->name('user');

Route::post('/swipe_right/{id}', [UserController::class, 'swipeRight']);
Route::post('/swipe_left/{id}', [UserController::class, 'swipeLeft']);

Route::get('/edit', [UserController::class, 'edit']);
Route::post('/update', [UserController::class, 'update']);

Route::get('/matches', [UserController::class, 'myMatches']);

Route::post('/upload', [PictureController::class, 'upload']);

Route::get('/save_filters', [UserController::class, 'updateFilters']);
Route::get('/find_matches', [UserController::class, 'searchForMatches']);

Route::get('/example', [HomeController::class, 'withoutQueue']);
Route::get('/example2', [HomeController::class, 'withQueue']);

Route::get('/test', function () {
    return view('test');
});
