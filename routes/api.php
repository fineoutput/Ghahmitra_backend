<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\HomeController;

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

    Route::get('/states', [AuthController::class, 'getstates']);
    Route::post('/cities', [AuthController::class, 'getcityes']);
    Route::post('/register-partner', [AuthController::class, 'register_partner']);
    Route::post('/login-partner', [AuthController::class, 'Partnerlogin']);
    Route::post('/verify-partner-otp', [AuthController::class, 'verifyPartnerOtp']);



    Route::post('/register-customer', [AuthController::class, 'register_customer']);
    Route::post('/login-customers', [AuthController::class, 'customerslogin']);
    Route::post('/verify-customers-otp', [AuthController::class, 'verifycustomersOtp']);


    Route::get('/banner', [HomeController::class, 'banner']);
    Route::get('/services', [HomeController::class, 'services']);
    Route::post('/services-se', [HomeController::class, 'ServicesSe']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
});


Route::middleware('partnerapi.auth')->prefix('partner')->group(function () {
    Route::post('/partner-logout', [AuthController::class, 'logoutPartner']);
      
});

Route::middleware('customer.auth')->prefix('customer')->group(function () {
 Route::post('/customer-logout', [AuthController::class, 'logoutCustomer']);
 Route::post('/customer-profile', [AuthController::class, 'customerProfile']);
 Route::post('/update-customer-profile', [AuthController::class, 'updatecustomerProfile']);
 Route::post('/delete-account', [AuthController::class, 'deleteaccount']);
 Route::post('/add-customer-address', [CustomerController::class, 'addcustomeraddress']);
 Route::post('/get-customer-address', [CustomerController::class, 'getcustomeraddress']);
 Route::post('/edit-customer-address', [CustomerController::class, 'editcustomeraddress']);
      
});