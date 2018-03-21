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
Route::get('register','Auth\RegisterController@create');
Route::post('register','Auth\RegisterController@store')->name('register');
Route::post('duplication','Auth\RegisterController@namecheck')->name('duplication');
Route::resource('login','Auth\LoginController');