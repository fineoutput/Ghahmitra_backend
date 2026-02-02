<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TeamController; 
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CrmController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Auth\adminlogincontroller;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\Services2Controller;
use App\Http\Controllers\Admin\Services3Controller;
use App\Http\Controllers\Admin\AvailabilityController;
use App\Http\Controllers\Admin\ServicePartnerController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PartnerServicesController;

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

// Route::get('/clear-cache', function () {
//     $exitCode = Artisan::call('cache:clear');
//     // $exitCode = Artisan::call('route:clear');
//     // $exitCode = Artisan::call('config:clear');
//     // $exitCode = Artisan::call('view:clear');
//     // return what you want
// });
//=========================================== FRONTEND =====================================================

Route::group(['prefix' => '/'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('/');
});

//======================================= ADMIN ===================================================
Route::group(['prifix' => 'admin'], function () {
    Route::group(['middleware'=>'admin.guest'],function(){

        Route::get('/admin_index', [adminlogincontroller::class, 'admin_login'])->name('admin_login');
        Route::post('/login_process', [adminlogincontroller::class, 'admin_login_process'])->name('admin_login_process');

    });
Route::group(['middleware'=>'admin.auth'],function(){

 Route::get('/index', [TeamController::class, 'admin_index'])->name('admin_index');
 Route::get('/logout', [adminlogincontroller::class, 'admin_logout'])->name('admin_logout');
 Route::get('/profile', [adminlogincontroller::class, 'admin_profile'])->name('admin_profile');
 Route::get('/view_change_password', [adminlogincontroller::class, 'admin_change_pass_view'])->name('view_change_password');
 Route::post('/admin_change_password', [adminlogincontroller::class, 'admin_change_password'])->name('admin_change_password');

        // Admin Team ------------------------

Route::get('/view_team', [TeamController::class, 'view_team'])->name('view_team');
Route::get('/add_team_view', [TeamController::class, 'add_team_view'])->name('add_team_view');
Route::post('/add_team_process', [TeamController::class, 'add_team_process'])->name('add_team_process');
Route::get('/UpdateTeamStatus/{status}/{id}', [TeamController::class, 'UpdateTeamStatus'])->name('UpdateTeamStatus');
Route::get('/deleteTeam/{id}', [TeamController::class, 'deleteTeam'])->name('deleteTeam');



// Admin CRM settings ------------------------
Route::get('/add_settings', [CrmController::class, 'add_settings'])->name('add_settings');
Route::get('/view_settings', [CrmController::class, 'view_settings'])->name('view_settings');
Route::get('/update_settings/{id}', [CrmController::class, 'update_settings'])->name('update_settings');
Route::post('/add_settings_process', [CrmController::class, 'add_settings_process'])->name('add_settings_process');
Route::post('/update_settings_process/{id}', [CrmController::class, 'update_settings_process'])->name('update_settings_process');
Route::get('/deletesetting/{id}', [CrmController::class, 'deletesetting'])->name('deletesetting');


Route::get('/customers/index', [CustomersController::class, 'index'])->name('customers.index');
Route::patch('customers/update-status/{id}', [CustomersController::class, 'updateStatus'])->name('customers.updateStatus');


Route::get('/services/index', [ServicesController::class, 'index'])->name('services.index');
Route::get('/services/create', [ServicesController::class, 'create'])->name('services.create');
Route::post('/services/store', [ServicesController::class, 'store'])->name('services.store');
Route::patch('services/update-status/{id}', [ServicesController::class, 'updateStatus'])->name('services.updateStatus');
Route::get('services/{id}/edit', [ServicesController::class, 'edit'])->name('services.edit');
Route::put('services/{id}', [ServicesController::class, 'update'])->name('services.update');
Route::delete('services/{id}', [ServicesController::class, 'destroy'])->name('services.destroy');

Route::get('/services2/index', [Services2Controller::class, 'index'])->name('services2.index');
Route::get('/services2/create', [Services2Controller::class, 'create'])->name('services2.create');
Route::post('/services2/store', [Services2Controller::class, 'store'])->name('services2.store');
Route::patch('services2/update-status/{id}', [Services2Controller::class, 'updateStatus'])->name('services2.updateStatus');
Route::get('services2/{id}/edit', [Services2Controller::class, 'edit'])->name('services2.edit');
Route::put('services2/{id}', [Services2Controller::class, 'update'])->name('services2.update');
Route::delete('services2/{id}', [Services2Controller::class, 'destroy'])->name('services2.destroy');


Route::get('/services3/index', [Services3Controller::class, 'index'])->name('services3.index');
Route::get('/services3/create', [Services3Controller::class, 'create'])->name('services3.create');
Route::post('/services3/store', [Services3Controller::class, 'store'])->name('services3.store');

Route::patch('services3/update-status/{id}', [Services3Controller::class, 'updateStatus'])->name('services3.updateStatus');

Route::put(
    'services3/update-register_availability/{id}',
    [Services3Controller::class, 'updateStatusregister_availability']
)->name('services3.register_availability');

Route::get('/get-services-se', [Services3Controller::class, 'getServicesSe'])->name('get.services_se');

Route::get('services3/{id}/delete-image/{imageName}',[Services3Controller::class, 'deleteImage'])->name('services3.deleteImage');

Route::get('services3/{id}/edit', [Services3Controller::class, 'edit'])->name('services3.edit');
Route::put('services3/{id}', [Services3Controller::class, 'update'])->name('services3.update');
Route::delete('services3/{id}', [Services3Controller::class, 'destroy'])->name('services3.destroy');



Route::get('/availability/index/{id}', [AvailabilityController::class, 'index'])->name('availability.index');
Route::get('/availability/create/{id}', [AvailabilityController::class, 'create'])->name('availability.create');
Route::post('/availability/store/{id}', [AvailabilityController::class, 'store'])->name('availability.store');
Route::patch('availability/update-status/{id}', [AvailabilityController::class, 'updateStatus'])->name('availability.updateStatus');

Route::get('availability/{id}/edit', [AvailabilityController::class, 'edit'])->name('availability.edit');
Route::put('availability/{id}', [AvailabilityController::class, 'update'])->name('availability.update');
Route::delete('availability/{id}', [AvailabilityController::class, 'destroy'])->name('availability.destroy');


Route::get('/partner-services/index/{id}', [PartnerServicesController::class, 'index'])->name('partnerservice.index');


Route::patch('partnerservices/update-status/{id}', [PartnerServicesController::class, 'updateStatus'])->name('partnerservices.updateStatus');

Route::patch('service-partner/update-commission/{id}', [PartnerServicesController::class, 'updateCommission'])
    ->name('service-partner.updateCommission');

Route::get('/service-partner/index', [ServicePartnerController::class, 'index'])->name('service-partner.index');
Route::get('/active-service-partner/index', [ServicePartnerController::class, 'activeindex'])->name('activeservice-partner.index');
Route::get('/block-service-partner/index', [ServicePartnerController::class, 'blockindex'])->name('blockservice-partner.index');

Route::patch('service-partner/update-status/{id}', [ServicePartnerController::class, 'updateStatus'])->name('service-partner.updateStatus');

Route::get('/service-partner-document/index/{id}', [ServicePartnerController::class, 'document'])->name('service-partner-document.index');

Route::patch('partner-rank/update-commission/{id}', [ServicePartnerController::class, 'updaterank'])
    ->name('partner.rank');

Route::get('/banner/index', [BannerController::class, 'index'])->name('Banner.index');
Route::get('/banner/create', [BannerController::class, 'create'])->name('Banner.create');
Route::post('/banner/store', [BannerController::class, 'store'])->name('Banner.store');
Route::patch('banner/update-status/{id}', [BannerController::class, 'updateStatus'])->name('Banner.updateStatus');
Route::get('banner/{id}/edit', [BannerController::class, 'edit'])->name('Banner.edit');
Route::put('banner/{id}', [BannerController::class, 'update'])->name('Banner.update');
Route::delete('banner/{id}', [BannerController::class, 'destroy'])->name('Banner.destroy');


    });

});



