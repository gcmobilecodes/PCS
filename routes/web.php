<?php

use App\Http\Controllers\Admin\Checkincheckout_detailController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\UserlistController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'AdminLogin'])->name('Admin');


Auth::routes();
Route::middleware(['auth', 'adminn'])->group(function (){

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/home', [IndexController::class, 'index'])->name('home');
Route::get('users', [UserlistController::class, 'userlist'])->name('users.index');
Route::post('/delete/users',[UserlistController::class, 'deleteusers'])->name(' admin.user.delete');
Route::get('/detail',[Checkincheckout_detailController::class, 'FullDetail'])->name(' admin.users.detail');

Route::get('/userss', [Checkincheckout_detailController::class, 'FullDetail'])->name('userslists');
Route::get('/service_provider_detail',[Checkincheckout_detailController::class, 'service_provider_detail'])->name('Admin.service_provider');
Route::post('/delete/service_provider',[Checkincheckout_detailController::class, 'delete_service_provider'])->name(' admin.service_provider.delete');
Route::post('/service_providers',[Checkincheckout_detailController::class, 'service_providerss'])->name('admin.service_providers');
Route::post('/service/providerd',[Checkincheckout_detailController::class, 'servicesproviders'])->name('admin.serviceProvider');
Route::get('/dates_history_search',[Checkincheckout_detailController::class, 'login_history_search'])->name('admin.login_history_search');
Route::get('/datessearch',[Checkincheckout_detailController::class, 'datepicker'])->name('datepicker');
Route::get('/dates_history_search',[Checkincheckout_detailController::class, 'login_history_search'])->name('admin.login_history_search');
// Route::get('/datessearch',[Checkincheckout_detailController::class, 'datepicker'])->name('datepicker');
Route::get('/datepicker',[Checkincheckout_detailController::class, 'datePickers'])->name('datepickers');
Route::get('link',function(){
    Artisan::call('storage:link');
    });
});
