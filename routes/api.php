<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PageTypeController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubProductController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('country',CountryController::class);
Route::resource('company',CompanyController::class);
Route::resource('page_type',PageTypeController::class);
Route::resource('template',TemplateController::class);
Route::resource('product',ProductController::class);
Route::resource('sub_product',SubProductController::class);

Route::get('search_country',[CountryController::class,'search']);
Route::get('search_company',[CompanyController::class,'search']);

