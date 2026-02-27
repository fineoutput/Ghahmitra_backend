<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\PartnerController;

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
    Route::post('/register-customer-verify', [AuthController::class, 'verifyRegisterOtp']);
    Route::post('/login-customers', [AuthController::class, 'customerslogin']);
    Route::post('/verify-customers-otp', [AuthController::class, 'verifycustomersOtp']);


    Route::get('/banner', [HomeController::class, 'banner']);
    Route::get('/services', [HomeController::class, 'services']);
    Route::post('/services-se', [HomeController::class, 'ServicesSe']);
    Route::post('/services-th', [HomeController::class, 'ServicesTh']);

    Route::get('/home', [HomeController::class, 'homeData']);

    Route::post('/services-details', [HomeController::class, 'ServicesDetails']);
    Route::post('/services-availability', [HomeController::class, 'servicesavAvailability']);
    Route::get('/about-us', [HomeController::class, 'aboutUs']);
    Route::get('/privacy-policy', [HomeController::class, 'PrivacyPolicy']);
    Route::get('/terms-condition', [HomeController::class, 'tc']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
});


Route::middleware('partnerapi.auth')->prefix('partner')->group(function () {


    Route::post('/add-leave-req', [PartnerController::class, 'LeaveReq']);
    Route::get('/get-leave-req', [PartnerController::class, 'getLeaveReq']);

    Route::post('/partner-logout', [AuthController::class, 'logoutPartner']);
    Route::post('/delete-account', [PartnerController::class, 'deleteaccount']);
    Route::post('/add-document', [PartnerController::class, 'document']);
  Route::get('/profile', [PartnerController::class, 'getProfile']);
    Route::post('/profile/update', [PartnerController::class, 'updateProfile']);
      
});

Route::middleware('customer.auth')->prefix('customer')->group(function () {
 Route::post('/customer-logout', [AuthController::class, 'logoutCustomer']);
 Route::post('/customer-profile', [AuthController::class, 'customerProfile']);
 Route::post('/update-customer-profile', [AuthController::class, 'updatecustomerProfile']);
 Route::post('/delete-account', [AuthController::class, 'deleteaccount']);
 Route::post('/add-customer-address', [CustomerController::class, 'addcustomeraddress']);
 Route::post('/get-customer-address', [CustomerController::class, 'getcustomeraddress']);
 Route::post('/edit-customer-address', [CustomerController::class, 'editcustomeraddress']);

 Route::post('/add-wallet', [CustomerController::class, 'addWallet']);
 Route::get('/wallet', [CustomerController::class, 'getWallet']);
 Route::get('/wallet-history', [CustomerController::class, 'walletHistory']);

 Route::post('/add-cart', [CartController::class, 'addtocart']);
 Route::post('/get-cart', [CartController::class, 'getcart']);
 Route::post('/update-cart', [CartController::class, 'updatecart']);
 Route::post('feedback/store', [CartController::class, 'storeFeedback']);
 Route::post('calculate', [CartController::class, 'calculate']);
      
});