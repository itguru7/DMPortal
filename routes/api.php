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

Route::post('fetchFilters', 'APIController@fetchFilters');
Route::post('fetchApplications', 'APIController@fetchApplications');
Route::post('fetchParts', 'APIController@fetchParts');
Route::post('fetchInterchanges', 'APIController@fetchInterchanges');
