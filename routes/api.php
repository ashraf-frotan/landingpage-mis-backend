<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PageTypeController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use PharIo\Manifest\AuthorElement;

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

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('country',CountryController::class);
    Route::resource('company',CompanyController::class);
    Route::resource('template',TemplateController::class);
    Route::resource('product',ProductController::class);
    Route::resource('sub_product',SubProductController::class);
    Route::resource('user',UserController::class);
    
    Route::get('filter_country',[CountryController::class,'filter']);
    Route::get('filter_company',[CompanyController::class,'filter']);
    Route::get('filter_template',[TemplateController::class,'filter']);
    Route::get('filter_landing_page',[ProductController::class,'filter']);
    Route::get('filter_user',[UserController::class,'filter']);
    
    Route::get('get_info',[ProductController::class,'getInfo']);
    Route::post('change_product_status',[ProductController::class,'changeProductStatus']);
    
    Route::get('me',[AuthController::class,'me']);
    Route::post('logout', [AuthController::class, 'logout']);
});


