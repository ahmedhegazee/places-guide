<?php
//'auto-check-permission'
Route::group(['middleware' => ['auth', ]], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('government', 'GovernorateController');
    Route::resource('/{govern}/city', 'CityController')->except(['index', 'show']);
    Route::resource('category', 'CategoryController');
    Route::resource('banner', 'BannerController');
    Route::resource('worker-category', 'WorkerCategoryController')->except('show');
    Route::resource('/{category}/subcategory', 'SubCategoryController')->except('show');
    Route::resource('client', 'ClientController')->only(['index', 'destroy', 'update']);
    Route::resource('place-owner', 'OwnerController')->only(['index', 'destroy', 'update']);
    Route::resource('place', 'PlaceController');
    Route::put('place/{place}/best', 'PlaceController@best')->name('place.best');
    Route::resource('setting', 'SettingController')->only(['index', 'edit', 'update']);
    Route::resource('page', 'PageController')->only(['index', 'edit', 'update']);
    Route::resource('message', 'ClientMessageController')->only(['index', 'destroy']);
    Route::resource('owner-request', 'OwnerRequestController')->except(['edit', 'show']);

    Route::resource('user', 'UserController')->except(['show']);
    Route::resource('role', 'RoleController')->except(['show']);
    Route::name('dashboard.')->group(function () {
        Route::resource('work-ad', 'WorkAdController')->only(['index', 'show', 'destroy']);
        Route::resource('discount', 'DiscountController')->only(['index', 'show', 'destroy']);
        Route::resource('place/{place}/photo', 'PlacePhotoController');
        Route::resource('place/{place}/video', 'PlaceVideoController');
    });
    // Route::resource('permission', 'PermissionController')->except(['show']);
    Route::get('change-password', 'UserController@showPasswordForm')->name('change-password-form');
    Route::post('change-password', 'UserController@changePassword')->name('change-password');
});
