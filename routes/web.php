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
Route::post('/searchusertype','DataMaster\UserTypeController@search')->name("searchusertype");

Route::resource('identity','DataMaster\IdentityController');
Route::post('searchidentity','DataMaster\IdentityController@search')->name("searchidentity");

Route::resource('company','DataMaster\CompanyController');
Route::post('/searchcompany','DataMaster\CompanyController@search')->name("searchcompany");

Route::resource('detail','DataMaster\CompanyDetailController');
Route::get('company/detail/{id}','DataMaster\CompanyDetailController@detail');
Route::post('company/getdetail','DataMaster\CompanyDetailController@getDetail');
Route::get('getTemplate', 'DataMaster\CompanyController@getTemplate')->name("getTemplate");
// Route::resource('companydetail','DataMaster\CompanyDetailController');

Route::resource('region','DataMaster\RegionController');
Route::get('/searchregion','DataMaster\RegionController@search');

Route::resource('province','DataMaster\ProvinceController');
Route::post('searchprovince','DataMaster\ProvinceController@search')->name("searchprovince");
Route::resource('district','DataMaster\DistrictController');
Route::post('/getdistrict','DataMaster\DistrictController@getdistrict')->name("getdistrict");
Route::post('searchdistrict','DataMaster\DistrictController@search')->name("searchdistrict");
Route::resource('subdistrict','DataMaster\SubDistrictController');
Route::post('searchsubdistrict','DataMaster\SubDistrictController@getsubdistrict')->name("searchsubdistrict");
Route::resource('village','DataMaster\VillageController');
Route::post('searchvillage','DataMaster\VillageController@getvillage')->name("searchvillage");
Route::resource('zip','DataMaster\ZipController');
Route::post('searchzip','DataMaster\ZipController@getzip')->name("searchzip");


// Route::get('/searchprovince','DataMaster\RegionController@searchProvince')->name('searchprovince');

Route::resource('service','DataMaster\OrderServiceController');
Route::post('/searchservice','DataMaster\OrderServiceController@search')->name("searchservice");
Route::resource('program','DataMaster\ProgramController');
Route::get('/searchprogram','DataMaster\ProgramController@search');
Route::resource('agent','Transaction\AgentController');
Route::get('/searchagent','Transaction\AgentController@search');
Route::resource('order','Transaction\OrderController');
Route::get('/searchorder','Transaction\OrderController@search');
Route::resource('vbayar','Transaction\VBayarController');
Route::get('/searchvbayar','Transaction\VBayarController@search');

