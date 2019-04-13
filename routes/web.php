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

// Route::prefix('admin')->group(function () {
//     Auth::routes();
//     Route::get('', 'AdminController@index')->name('admin');
//     Route::resource('portals', 'PortalController');
// });

// Route::get('/{vue_capture}', function () {
//     return view('portal');
// })->where('vue_capture', '[\/\w\.-]*');

Route::domain('admin.aftermarketdata.com')->group(function () {
    Auth::routes();
    Route::get('', 'AdminController@index')->name('admin');
    Route::resource('portals', 'PortalController');
});

Route::domain('{vendor}.aftermarketdata.com')->group(function () {
    Route::get('/', function () {
        return view('portal');
    });
});
