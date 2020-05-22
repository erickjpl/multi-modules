<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'profile'], function () {
    Route::resource('users', 'Profile\UserAPIController');
});


Route::group(['prefix' => 'products.config'], function () {
    Route::resource('categories', 'Products\Config\CategoryAPIController');
});


Route::group(['prefix' => 'products'], function () {
    Route::resource('products', 'Products\ProductAPIController');
});


Route::group(['prefix' => 'products.sales'], function () {
    Route::resource('inventories', 'Products\Sales\InventoryAPIController');
});


Route::group(['prefix' => 'customers'], function () {
    Route::resource('customers', 'Customers\CustomerAPIController');
});


Route::group(['prefix' => 'billings'], function () {
    Route::resource('billings', 'Billings\BillingAPIController');
});


Route::group(['prefix' => 'billings'], function () {
    Route::resource('billing_details', 'Billings\BillingDetailAPIController');
});
