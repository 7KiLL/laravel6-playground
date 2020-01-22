<?php
Route::group(['prefix' => 'auth/', 'middleware' => ['guest']], function () {
    Route::post('register', 'V1\AuthController@register');
    Route::post('login', 'V1\AuthController@login');
});
