<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Frontend\HomeController;
use  App\Http\Controllers\Frontend\AuthController;

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

Route::get('locale/{locale}', function ($lang) {
    Session::put('locale', $lang);

    if (request()->fullUrl() === redirect()->back()->getTargetUrl()) {
        return redirect('/');
    }

    return redirect()->back();
});

Route::group(['middleware'=>'language'], function () {
    Route::get('/', function () {
        // return view('frontend.app');
        return view('welcome');
    });
});
