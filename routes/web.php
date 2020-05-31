<?php

use Illuminate\Support\Facades\Route;

Route::get('test', 'TestController@index')->name('test.index');
Route::get('test/{product}', 'TestController@show')->name('test.show');

Route::get('{any?}', function () {
    return view('app');
})->where('any', '.*');