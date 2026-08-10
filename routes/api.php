<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfileController;

use App\Http\Controllers\Api\AuthController;
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

Route::get('get-profile/{id}',[ProfileController::class,'getprofile']);
Route::get('/get-messages/{id}',[ProfileController::class,'getmessages']);
Route::post('/profile-update',[ProfileController::class,'profileupdate']);
Route::get('/get-smartcard',[ProfileController::class,'getsmartcards']);
Route::get('/get-professionalcard',[ProfileController::class,'getprofessionalcards']);
Route::get('/get-profession',[ProfileController::class,'getprofession']);
Route::post('/add-cart/{id}',[ProfileController::class,'shoping_cart']);
Route::get('/product/{id}',[ProfileController::class,'product']);
Route::post('/google-login',[ProfileController::class,'googlelogin']);
Route::get('/coupon-list',[ProfileController::class,'couponlist']);
Route::get('/get-link/{uid}',[ProfileController::class,'getlink']);
Route::post('/login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
Route::post('/changepassword',[AuthController::class,'changepassword']);
Route::get('order-list/{id}',[ProfileController::class,'orderlist']);
Route::post('/confirm-order',[ProfileController::class,'confirmorderr']);




