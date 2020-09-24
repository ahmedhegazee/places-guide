<?php
// Route::group(['prefix' => 'company-panel', 'namespace' => 'Owner'], function () {
Route::group(['namespace' => 'Auth'], function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('owner.login');
    Route::post('/login', 'LoginController@login');

    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('owner.password.request');
    Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('owner.password.reset');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('owner.password.email');
    Route::post('/password/reset', 'ResetPasswordController@reset')->name('owner.password.update');
});
Route::group(['middleware' => ['auth:owners']], function () {
    Route::get('/', 'HomeController@index')->name('owner.home');
    Route::get('change-password', 'MainController@showPasswordForm')->name('owner.change-password-form');
    Route::post('change-password', 'MainController@changePassword')->name('owner.change-password');
    Route::post('change-info', 'MainController@changeInfo')->name('owner.change-info');
    Route::get('change-info', 'MainController@showChangeInfoForm')->name('owner.change-info-form');
    Route::post('change-info-company', 'MainController@changeCompanyInfo')->name('owner.change-info-company');
    Route::get('change-info-company', 'MainController@showChangeCompanyInfoForm')->name('owner.change-info-company-form');
    Route::group(['middleware' => ['is-premimum']], function () {
        Route::resource('photo', 'PlacePhotoController');
        Route::resource('video', 'PlaceVideoController');
        Route::resource('work-ad', 'WorkAdController');
        Route::resource('discount', 'DiscountController');
    });

    Route::post('/logout', 'Auth\LoginController@logout')->name('owner.logout');
});