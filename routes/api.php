<?php

use App\Http\Controllers\Api\DetailsController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::post('login', [UserController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);


Route::group(['middleware' => 'auth:sanctum'], function(){

// Route::post('details', [DetailsController::class, 'detail']);
Route::get('get_detail', [DetailsController::class, 'getcheckin']);
Route::post('update', [UserController::class, 'update']);
Route::get('checkall', [DetailsController::class, 'checkinoutdetail']);
Route::get('check_out', [DetailsController::class, 'checkoutdetail']);


// Route::get('checkout_detail', [DetailsController::class, 'checkoutdetail']);
Route::post('checkin', [DetailsController::class, 'checkin']);
Route::post('checkout', [DetailsController::class, 'checkout']);
Route::get('history', [DetailsController::class, 'checkdetailbyDate']);


Route::get('checkdate', [DetailsController::class, 'CheckdetailNow']);

Route::post('checkinsss', [DetailsController::class, 'checkiusers']);
Route::get('get_checkout', [DetailsController::class, 'getcheckout']);

Route::post('/logout', [UserController::class, 'logout']);


});

