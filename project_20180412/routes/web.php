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
//개인적으로 쓰이는 test파일 경로
Route::get('/minsuk',function(){
   return view('minsuk'); 
});


//사이트 접속시 첫 페이지
Route::view('/', 'project');

//공유 게시판라우트
Route::post('buy','ShareController@buy')->name('Share.buy');
Route::post('/Share/getscorestring','ShareController@getscorestring')->name('Share.getscorestring');
Route::post('/Share/create','ShareController@create')->name('Share.create');
Route::resource('Share','ShareController');
//자유게시판라우트
Route::resource('Post','PostController');
/*//게시판 검색 라우트

Route::get('sellboard/search','SellBoardController@search')->name('sellboard.search');
*/
//메인페이지 라우트
Route::post('main/xml','MainController@getxml')->name('main.xml');
Route::resource('main','MainController');
//메인페이지 외부악보 라우트
Route::post('main/transfer','MainController@transfer')->name('upload');
//마이 악보 페이지 보여주기
Route::get('score','PersonalController@getScore')->name('getScore');
Route::get('ShowScore','PersonalController@ShowScore')->name('ShowScore');
Route::get('/myinfo','PersonalController@myinfo')->name('myinfo');


//로그인 계정 관리
Route::get('login','Auth\LoginController@getLogin')->name('getLogin');
Route::post('login','Auth\LoginController@postLogin')->name('postLogin');
Route::get('logout','Auth\LoginController@getLogout')->name('getLogout');
Route::get('register','Auth\RegisterController@getRegister')->name('getRegister');
Route::post('register','Auth\RegisterController@postRegister')->name('postRegister');

//패스워드 초기화 링크 요청 routes..
Route::get('password/email','Auth\ResetPasswordController@getEmail')->name('getEmail');
Route::post('password/email','Auth\ResetPasswordController@postEmail')->name('postEmail');
//패스워드 초기화
Route::get('password/reset/{token}','Auth\ResetPasswordController@getReset')->name('getReset');
Route::post('password/reset','Auth\ResetPasswordController@postReset')->name('postReset');


//모바일(회원)
Route::get('Mlogin','Auth\MobileLoginController@getLogin')->name('getMLogin');
Route::post('Mlogin','Auth\MobileLoginController@postLogin')->name('postMLogin');
Route::get('Mlogout','Auth\MobileLoginController@getLogout')->name('getMLogout');
Route::get('Mregister','Auth\MobileRegisterController@getRegister')->name('getMRegister');
Route::post('Mregister','Auth\MobileRegisterController@postRegister')->name('postMRegister');
Route::get('Mcheckname','Auth\MobileNameCheckController@getcheck')->name('getcheck');
Route::post('Mcheckname','Auth\MobileNameCheckController@postcheck')->name('postcheck');
//모바일(게시판)
Route::post('/Mshare/show','MoblieShareController@show')->name('Mshare.show');
Route::resource('Mshare','MoblieShareController');
Route::post('Mpurchase','MobilePurchaseController@purchase')->name('getPurchase');
Route::post('MshareScore','MobileShareScoreController@ShareScore')->name('getShareScore');
Route::post('MpurchaseSheet','MobilePurchaseSheetController@PurchaseSheet')->name('getPurchaseSheet');
Route::post('MretainSheet','MobileRetainSheetController@RetainSheet')->name('getRetainSheet');

















?>