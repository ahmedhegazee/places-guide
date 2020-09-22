<?php
// Route::group(['namespace' => 'Front'], function () {
Route::get('/', 'MainController@home')->name('index');
Route::get('/about', 'MainController@about')->name('about');
Route::get('/contact', 'MainController@contact')->name('contact');
Route::post('/contact', 'MainController@storeMessage')->name('contact.store');
Route::get('/category/{category}', 'MainController@category')->name('category');
Route::get('/discounts', 'MainController@discounts')->name('discount');
Route::get('/discount/{place}', 'MainController@showPlaceDiscounts')->name('discount.show');
Route::get('/workads', 'MainController@workads')->name('workads');
Route::get('/workads/{ad}', 'MainController@showWorkAd')->name('workads.show');
Route::get('/place/{place}', 'MainController@place')->name('place');
Route::view('/nearest-places', 'front.nearest_places')->name('nearest-places');
Route::group(['namespace' => 'Auth'], function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('front.login');
    Route::post('/login', 'LoginController@login');
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('front.register');
    Route::post('/register', 'RegisterController@register');
    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
});

Route::group(['middleware' => ['auth:clients']], function () {
    Route::get('/profile', 'MainController@profile')->name('front.profile');
    Route::put('/profile', 'MainController@updateProfile');
    Route::get('/change-password', 'MainController@password')->name('front.password');
    Route::put('/change-password', 'MainController@updatePassword');
    Route::post('/logout', 'Auth\LoginController@logout');
    Route::post('/review/{place}', 'MainController@review')->name('review');
});
// });