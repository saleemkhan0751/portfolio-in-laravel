<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('services', '\App\Http\Controllers\Admin\ServiceController');
Route::delete('delete/service/{id}', '\App\Http\Controllers\Admin\ServiceController@deleteService')->name('service.delete');
Route::post('services/restore/{id}', '\App\Http\Controllers\Admin\ServiceController@restore')->name('service.restore');
Route::delete('services/permanentDelete/{id}', '\App\Http\Controllers\Admin\ServiceController@permanentDelete')->name('service.permanent.delete');

Route::resource('testimonials', '\App\Http\Controllers\Admin\TestimonialController');
Route::delete('delete/testimonial/{id}', '\App\Http\Controllers\Admin\TestimonialController@deleteService')->name('testimonial.delete');
Route::post('testimonials/restore/{id}', '\App\Http\Controllers\Admin\TestimonialController@restore')->name('testimonial.restore');
Route::delete('testimonials/permanentDelete/{id}', '\App\Http\Controllers\Admin\TestimonialController@permanentDelete')->name('testimonial.permanent.delete');

Route::resource('teams', '\App\Http\Controllers\Admin\TeamController');
Route::delete('delete/team/{id}', '\App\Http\Controllers\Admin\TeamController@deleteTeam')->name('team.delete');
Route::post('teams/restore/{id}', '\App\Http\Controllers\Admin\TeamController@restore')->name('team.restore');
Route::delete('teams/permanentDelete/{id}', '\App\Http\Controllers\Admin\TeamController@permanentDelete')->name('team.permanent.delete');

Route::resource('portfolios', '\App\Http\Controllers\Admin\PortfolioController');
Route::delete('delete/portfolio/{id}', '\App\Http\Controllers\Admin\PortfolioController@deletePortfolio')->name('portfolio.delete');
Route::post('portfolios/restore/{id}', '\App\Http\Controllers\Admin\PortfolioController@restore')->name('portfolio.restore');
Route::delete('portfolios/permanentDelete/{id}', '\App\Http\Controllers\Admin\PortfolioController@permanentDelete')->name('portfolio.permanent.delete');
