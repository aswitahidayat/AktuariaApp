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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//*User Type Route
Route::resource('usertype','DataMaster\UserTypeController');
Route::get('/usersz','DataMaster\UserTypeController@indexuser')->name("usersz");
Route::resource('identity','DataMaster\IdentityController');
Route::get('/searchidentity','DataMaster\IdentityController@search');
Route::resource('company','DataMaster\CompanyController');
Route::get('/searchcompany','DataMaster\CompanyController@search');

Route::resource('region','DataMaster\RegionController');
Route::get('/searchregion','DataMaster\RegionController@search');

Route::resource('province','DataMaster\ProvinceController');
Route::resource('district','DataMaster\DistrictController');

// Route::get('/searchprovince','DataMaster\RegionController@searchProvince')->name('searchprovince');

Route::resource('service','DataMaster\ServiceController');
Route::get('/searchservice','DataMaster\ServiceController@search');
Route::resource('program','DataMaster\ProgramController');
Route::get('/searchprogram','DataMaster\ProgramController@search');
Route::resource('agent','Transaction\AgentController');
Route::get('/searchagent','Transaction\AgentController@search');
Route::resource('order','Transaction\OrderController');
Route::get('/searchorder','Transaction\OrderController@search');
Route::resource('vbayar','Transaction\VBayarController');
Route::get('/searchvbayar','Transaction\VBayarController@search');

