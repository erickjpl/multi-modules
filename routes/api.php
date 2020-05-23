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


// Perfil
Route::group(['prefix' => 'profiles'], function () {
    // Usuario
    Route::resource('users', 'Profile\UserAPIController')->except(['create', 'edit']);
    
    // Clientes
    Route::resource('customers', 'Customers\CustomerAPIController')->except(['create', 'edit']);
});

// Productos y su configuracion
Route::group(['namespace' => 'Products', 'prefix' => 'products'], function () { 
    // Categorias
    Route::group(['namespace' => 'Config', 'prefix' => 'config'], function () {
        Route::resource('categories', 'CategoryAPIController')->except(['create', 'edit']);
    });

    // Productos
    Route::resource('products', 'ProductAPIController')->except(['create', 'edit']);
    
    // Inventarios del producto
    Route::group(['namespace' => 'Sales', 'prefix' => 'sales'], function () {
        Route::resource('inventories', 'InventoryAPIController')->except(['create', 'edit']);
    });
});


// Ordenes de compras
Route::group(['namespace' => 'Billings', 'prefix' => 'billings'], function () {
    Route::resource('orders', 'BillingAPIController')->except(['create', 'edit']);
    
    Route::group(['prefix' => 'orders'], function () {
        Route::resource('details', 'BillingDetailAPIController')->except(['create', 'edit']);
    });
});
