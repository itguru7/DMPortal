<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('fetchSubdomain', 'APIController@fetchSubdomain');
Route::post('fetchFilters', 'APIController@fetchFilters');

Route::post('fetchApplications', 'APIController@fetchApplications');
Route::post('fetchParts', 'APIController@fetchParts');
Route::post('fetchInterchanges', 'APIController@fetchInterchanges');

Route::post('fetchAssets', 'APIController@fetchAssets');
Route::post('fetchInformation', 'APIController@fetchInformation');
Route::post('fetchAttributes', 'APIController@fetchAttributes');
Route::post('fetchBuyerGuide', 'APIController@fetchBuyerGuide');
