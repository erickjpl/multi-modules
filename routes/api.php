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


// Perfil de usuarios
Route::group(['namespace' => 'Profile','prefix' => 'profile'], function () {
    Route::resource('users', 'UserAPIController');
});


// Productos y su configuracion
Route::group(['namespace' => 'Products', 'prefix' => 'products'], function () { 
    Route::group(['namespace' => 'Config', 'prefix' => 'config'], function () {
        Route::resource('categories', 'CategoryAPIController');
    });

    Route::resource('products', 'ProductAPIController');
    
    Route::group(['namespace' => 'Sales', 'prefix' => 'sales'], function () {
        Route::resource('inventories', 'InventoryAPIController');
    });
});


// Clientes
Route::group(['namespace' => 'Customers', 'prefix' => 'customers'], function () {
    Route::resource('customers', 'CustomerAPIController');
});


// Ordenes de compras
Route::group(['namespace' => 'Billings', 'prefix' => 'billings'], function () {
    Route::resource('billings', 'BillingAPIController');

    Route::resource('billing_details', 'BillingDetailAPIController');
});
