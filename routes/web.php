<?php

use Illuminate\Support\Facades\Route;

Route::get('test', 'TestController@index')->name('test.index');
Route::get('bestSeller', 'TestController@bestSeller')->name('test.bestSeller');
Route::post('test', 'TestController@create')->name('test.create');
Route::get('test/{product}', 'TestController@show')->name('test.show');

Route::get('{any?}', function () {
    return view('app');
})->where('any', '.*');