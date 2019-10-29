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

Route::get('/', 'SigninController@index')->name('/');
Route::post('/pub/searchcompany','PublicController@searchCompany')->name("searchcompanypub");
Route::post('/pub/searchIdentity','PublicController@searchIdentity')->name("searchIdentitypub");
Route::post('/pub/searchProvinsi','PublicController@searchProvinsi')->name("searchprovincepub");
Route::post('/pub/searchDistrict','PublicController@searchDistrict')->name("searchdistrictpub");
Route::post('/pub/searchSubDistrict','PublicController@searchSubDistrict')->name("searchsubdistrictpub");
Route::post('/pub/searchZip','PublicController@searchZip')->name("searchZipPub");
Route::post('/pub/register','PublicController@register')->name("registerPub");
Route::post('/pub/emailchecker','PublicController@emailChecker')->name("emailcheckerPub");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//*User Type Route
Route::resource('usertype','DataMaster\UserTypeController');
Route::post('/searchusertype','DataMaster\UserTypeController@search')->name("searchusertype");
Route::post('/searchusernonadmin','DataMaster\UserTypeController@searchNonAdmin')->name("searchusernonadmin");

Route::resource('identity','DataMaster\IdentityController');
Route::post('searchidentity','DataMaster\IdentityController@search')->name("searchidentity");

Route::resource('companytype','DataMaster\CompanyController');
Route::post('/getcompanytypedtl','DataMaster\CompanyController@getCompanyDtl')->name("getcompanydtl");
Route::post('/searchcompanytype','DataMaster\CompanyController@search')->name("searchcompanytype");

Route::resource('detail','DataMaster\CompanyDetailController');
Route::get('companytype/detail/{id}','DataMaster\CompanyDetailController@detail');
Route::post('companytype/getdetail','DataMaster\CompanyDetailController@getDetail');
Route::get('getTemplate', 'AssumptionController@getAssumptionTemplate')->name("getTemplate");
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

Route::resource('mortalita','DataMaster\MortalitaController');
Route::post('searchmortalita','DataMaster\MortalitaController@searchMortalita')->name("searchmortalita");
Route::post('searchMortalitaDtl','DataMaster\MortalitaController@searchMortalitaDtl')->name("searchMortalitaDtl");

Route::resource('benefit','DataMaster\BenefitController');
Route::post('searchbenefit','DataMaster\BenefitController@searchBenefit')->name("searchBenefit");
Route::post('searchbenefitdtl','DataMaster\BenefitController@searchBenefitDtl')->name("searchBenefitDtl");

Route::resource('service','DataMaster\ServiceController');
Route::post('/searchservice','DataMaster\ServiceController@search')->name("searchservice");
Route::post('/serviceDetail','DataMaster\ServiceController@serviceDetail')->name("servicedetail");
Route::post('/getDetail','DataMaster\ServiceController@getDetail')->name("getdetail");

Route::resource('program','DataMaster\ProgramController');
Route::post('/searchprogram','DataMaster\ProgramController@search')->name("searchprogram");

Route::post('/getpartner','Transaction\CompanyPartnerController@searchApi')->name("getpartner");

Route::resource('/bank', 'DataMaster\BankController');
Route::post('/searchbank','DataMaster\BankController@search')->name("searchbank");

Route::resource('agent','Transaction\AgentController');
Route::post('/searchagent','Transaction\AgentController@search')->name("searchagent");
Route::post('/emailchecker','Transaction\AgentController@emailChecker')->name("emailchecker");

Route::resource('pic','Transaction\PicController');
Route::post('/searchpic','Transaction\PicController@search')->name("searchpic");

Route::resource('partner','Transaction\CompanyPartnerController');
Route::post('/searchpartner','Transaction\CompanyPartnerController@search')->name("searchpartner");

Route::resource('order','Transaction\OrderController');
Route::post('searchorder','Transaction\OrderController@search')->name("searchorder");
Route::post('searchVerify','Transaction\VBayarController@search')->name("searchverify");
Route::post('/getOrderDetail','Transaction\OrderController@getOrderDetail')->name("getorderdetail");
Route::post('/getAssumption','Transaction\OrderAssumptionController@getAssumption')->name("getassumption");
Route::post('/setAssumption','Transaction\OrderAssumptionController@setAssumption')->name("setassumption");
Route::post('/getProgressive','Transaction\OrderAssumptionController@getProgressive')->name("getprogressive");
Route::post('/setProgressive','Transaction\OrderAssumptionController@setProgressive')->name("setprogressive");
Route::post('/comfirmOrder','Transaction\OrderController@comfirmOrder')->name("comfirmorder");

Route::resource('perhitungan','Transaction\PerhitunganController');
Route::post('searchperhitungan','Transaction\PerhitunganController@search')->name("searchperhitungan");
Route::post('hitungOrder','Transaction\PerhitunganController@hitungOrder')->name("hitungorder");
Route::post('getKaryawan','Transaction\PerhitunganController@getKaryawan')->name("getkaryawan");
Route::post('getTahun','Transaction\PerhitunganController@getTahun')->name("gettahun");
Route::post('cariHasil','Transaction\PerhitunganController@cariHasil')->name("carihasil");
Route::post('cariHasilDtl','Transaction\PerhitunganController@cariHasilDtl')->name("carihasildtl");

Route::resource('vbayar','Transaction\VBayarController');
Route::post('/searchvbayar','Transaction\VBayarController@search')->name("searchvbayar");
Route::post('/verificationOrder','Transaction\VBayarController@verificationOrder')->name("verificationOrder");

Route::resource('setting','SettingController');
Route::post('/changePassword','SettingController@changePassword')->name("changepassword");

Route::get('/upload', 'UploadController@upload');
Route::post('/upload/proses', 'UploadController@proses_upload');

Route::get('/test', 'Util\WordController@proses_word')->name("word");
Route::get('/testpdf', 'Util\WordController@process_pdf')->name("word");

Route::resource('menu','MenuController');
Route::post('searchmenu','MenuController@search')->name("searchmenu");
Route::post('searchmenuview','MenuController@searchview')->name("searchmenuview");
Route::post('/findParent','MenuController@findParent')->name("findParent");


