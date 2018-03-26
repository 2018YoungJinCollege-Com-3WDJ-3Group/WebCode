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
Route::get('minsuk',function(){
   return view('minsuk'); 
});



Route::get('/test',function(){
    return view('test');
});
//사이트 접속시 첫 페이지
Route::get('/', function (){
    return view('project');
});

//mobile게시판 라우트
Route::resource('Msellboard','MoblieSellBoardController');
//게시판라우트
Route::resource('sellboard','SellBoardController');
//게시판 검색 라우트
Route::get('sellboard/search','SellBoardController@search')->name('sellboard.search');

//메인페이지 라우트
Route::resource('main','MainController');
//메인페이지 외부악보 라우트
Route::post('main/transfer','MainController@transfer')->name('upload');



//로그인 계정 관리
Route::get('login','Auth\LoginController@getLogin')->name('getLogin');
Route::post('login','Auth\LoginController@postlogin')->name('postLogin');
Route::get('logout','Auth\LoginController@getLogout')->name('getLogout');
Route::get('register','Auth\RegisterController@getRegister')->name('getRegister');
Route::post('register','Auth\RegisterController@postRegister')->name('postRegister');
//Route::post('duplication','Auth\RegisterController@namecheck')->name('duplication');

//패스워드 초기화 링크 요청 routes..
Route::get('password/email','Auth\ResetPasswordController@getEmail')->name('getEmail');
Route::post('password/email','Auth\ResetPasswordController@postEmail')->name('postEmail');
//패스워드 초기화
Route::get('password/reset/{token}','Auth\ResetPasswordController@getReset')->name('getReset');
Route::post('password/reset','Auth\ResetPasswordController@postReset')->name('postReset');
//마이 악보 페이지 보여주기
Route::get('score','PersonalController@getScore')->name('getScore');