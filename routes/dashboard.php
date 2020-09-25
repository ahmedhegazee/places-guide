<?php

Route::group(['middleware' => ['auth', 'auto-check-permission']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('government', 'GovernorateController');
    Route::resource('/{govern}/city', 'CityController')->except(['index', 'show']);
    Route::resource('category', 'CategoryController');
    Route::resource('worker-category', 'WorkerCategoryController')->except('show');
    Route::resource('/{category}/subcategory', 'SubCategoryController')->except('show');
    Route::resource('client', 'ClientController')->only(['index', 'destroy', 'update']);
    Route::resource('place-owner', 'OwnerController')->only(['index', 'destroy', 'update']);
    Route::resource('place', 'PlaceController');
    Route::put('place/{place}/best', 'PlaceController@best')->name('place.best');
    Route::resource('setting', 'SettingController')->only(['index', 'edit', 'update']);
    Route::resource('message', 'ClientMessageController')->only(['index', 'destroy']);
    Route::resource('owner-request', 'OwnerRequestController')->except(['edit', 'show']);
    Route::resource('user', 'UserController')->except(['show']);
    Route::resource('role', 'RoleController')->except(['show']);
    // Route::resource('permission', 'PermissionController')->except(['show']);
    Route::get('change-password', 'UserController@showPasswordForm')->name('change-password-form');
    Route::post('change-password', 'UserController@changePassword')->name('change-password');
});