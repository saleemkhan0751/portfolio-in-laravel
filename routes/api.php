<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', '\App\Http\Controllers\UserController@login');
Route::get('dashboard', '\App\Http\Controllers\DashboardController@dashboard');
Route::resource('services', '\App\Http\Controllers\ServiceController');
Route::post('service-update', '\App\Http\Controllers\ServiceController@update');
Route::resource('teams', '\App\Http\Controllers\TeamController');
Route::post('team-update', '\App\Http\Controllers\TeamController@update');
Route::resource('portfolio', '\App\Http\Controllers\PortolioController');
Route::post('portfolio-update', '\App\Http\Controllers\PortolioController@update');
Route::resource('testimonial', '\App\Http\Controllers\TestimonialController');
Route::post('testimonial-update', '\App\Http\Controllers\TestimonialController@update');
Route::resource('settings', '\App\Http\Controllers\SettingController');
Route::post('setting-update', '\App\Http\Controllers\SettingController@update');
Route::resource('faqs', '\App\Http\Controllers\FAQController');
Route::post('faq-update', '\App\Http\Controllers\FAQController@update');
Route::resource('about-us', '\App\Http\Controllers\AboutUsController');
Route::post('about-us-update', '\App\Http\Controllers\AboutUsController@update');


Route::get('get-fronted-data', '\App\Http\Controllers\FrontedController@getFrontedData');
