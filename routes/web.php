<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
use App\ImageUtility;

Route::get('/b', function () {
    dd(route('owner.logout'));
});
// Route::view('/test', 'welcome');
// Route::post('/test', function (Request $request) {
//     // $image = $request->file('image');
//     // $extension = ImageUtility::getExtension($image);
//     // $randomStr = Str::random(40);
//     // dd(Storage::cloud()->put('test.txt', 'Hello World'));
//     dd($request->file('image')->store('images'));
//     return 'File was saved to Google Drive';
// });
// Route::group(['namespace' => 'Front'], function () {
//     Route::get('/', 'MainController@home')->name('index');
//     Route::get('/about', 'MainController@about')->name('about');
//     Route::get('/contact', 'MainController@contact')->name('contact');
//     Route::post('/contact', 'MainController@storeMessage')->name('contact.store');
//     Route::get('/post/{post}', 'MainController@post')->name('post.show');
//     Route::get('/login', 'Auth\LoginController@showLoginForm')->name('front.login');
//     Route::post('/login', 'Auth\LoginController@login');
//     Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('front.register');
//     Route::post('/register', 'Auth\RegisterController@register');
//     Route::post('/logout', 'Auth\LoginController@logout');
//     Route::get('/post/{post}', 'MainController@post')->name('front.post');
//     Route::get('/post', 'MainController@posts')->name('front.posts');
//     Route::get('/donation', 'MainController@donation')->name('front.requests');


//     Route::get('/donation-status/{request}', 'MainController@donation')->name('front.requests-status');

//     Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//     Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//     Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//     Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

//     Route::group(['middleware' => ['auth:client']], function () {
//         Route::get('/donation/create', 'MainController@createRequest')->name('front.donation.create');
//         Route::post('/donation', 'MainController@storeRequest')->name('front.donation.store');
//         Route::get('/profile', 'MainController@profile')->name('front.profile');
//         Route::put('/profile', 'MainController@updateProfile');
//         Route::group(['prefix' => 'favourite'], function () {
//             Route::post('post', 'MainController@toggleFavouritePosts');
//             Route::get('/posts', 'MainController@favouritePosts')->name('front.favourite.posts');
//         });
//     });
// });


Route::group(['prefix' => 'dashboard'], function () {
    Auth::routes(['register' => false, 'verify' => false, 'reset' => false]);

    Route::group(['middleware' => ['auth', 'auto-check-permission'], 'namespace' => 'cpanel'], function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('government', 'GovernorateController');
        Route::resource('/{govern}/city', 'CityController')->except(['index', 'show']);
        Route::resource('category', 'CategoryController');
        Route::resource('worker-category', 'WorkerCategoryController')->except('show');
        Route::resource('/{category}/subcategory', 'SubCategoryController')->except('show');
        Route::resource('client', 'ClientController')->only(['index', 'destroy', 'update']);
        Route::resource('place-owner', 'OwnerController')->only(['index', 'destroy', 'update']);
        Route::resource('place', 'PlaceController')->only(['show', 'index']);
        Route::resource('setting', 'SettingController')->only(['index', 'edit', 'update']);
        Route::resource('message', 'ClientMessageController')->only(['index', 'destroy']);
        Route::resource('owner-request', 'OwnerRequestController')->except(['edit', 'show']);
        Route::resource('user', 'UserController')->except(['show']);
        Route::resource('role', 'RoleController')->except(['show']);
        // Route::resource('permission', 'PermissionController')->except(['show']);
        Route::get('change-password', 'UserController@showPasswordForm')->name('change-password-form');
        Route::post('change-password', 'UserController@changePassword')->name('change-password');
    });
});
Route::group(['prefix' => 'company-panel', 'namespace' => 'Owner'], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('owner.login');
        Route::post('/login', 'LoginController@login');
        Route::get('/register', 'RegisterController@showRegistrationForm')->name('owner.register');
        Route::post('/register', 'RegisterController@register');

        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
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
});