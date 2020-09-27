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

// Route::view('/test', 'welcome');
// Route::post('/test', function (Request $request) {
//     // $image = $request->file('image');
//     // $extension = ImageUtility::getExtension($image);
//     // $randomStr = Str::random(40);
//     // dd(Storage::cloud()->put('test.txt', 'Hello World'));
//     dd($request->file('image')->store('images'));
//     return 'File was saved to Google Drive';
// });


Route::group(['prefix' => 'dashboard'], function () {
    Auth::routes(['register' => false, 'verify' => false, 'reset' => false]);
});
Route::get('/join-us', 'Owner\Auth\RegisterController@showRegistrationForm')->name('owner.register');
Route::post('/join-us', 'Owner\Auth\RegisterController@register');
// Route::view('/test','welcome');
// Route::post('/test',function(Request $request){
//     dd(storeFileOnGoogleCloud($request->file('image'), 'images'));
// });