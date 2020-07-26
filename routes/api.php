<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('promotions', 'PromotionController@index');
    Route::get('promotions/{promotion}', 'PromotionController@show');
    Route::post('promotions', 'PromotionController@store');
    Route::put('promotions/{promotion}', 'PromotionController@update');
    Route::delete('promotions/{promotion}', 'PromotionController@delete');
});
