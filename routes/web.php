<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home/', 'HomeController@index');
Route::post('/upload','HomeController@upload' );

Route::get('auth/{provider}', 'LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'LoginController@handleProviderCallback');
Route::get('userpage/{id}','UsersController@index' )->middleware('auth');
Route::post('/addfriends', 'HomeController@addfriends');
Route::get('add_product', 'ProductController@addproduct');
Route::get('addnews','NewsController@addnews')->middleware('auth');
Route::post('postnews','NewsController@postnews')->middleware('auth');
Route::get('news','NewsController@index' )->middleware('auth');
Route::post('edit','NewsController@edit' );
Route::post('delete','NewsController@delete' );
Route::post('like','NewsController@like' );
Route::post('like','NewsController@like' );

Route::post('/postmessage', 'HomeController@postmessage');
Route::post('/showmessage', 'HomeController@showmessage');
Route::post('/showintervalmessage', 'HomeController@showintervalmessage');

Route::get('messages','MessagesController@index' )->middleware('auth');
Route::post('countmessage','MessagesController@countmessage');
Route::post('countOneMessage','MessagesController@countOneMessage');
Route::post('showintervalOneMessage','MessagesController@showintervalOneMessage');
Route::post('showOneMessage','MessagesController@showOneMessage');
Route::post('postChatMessage','MessagesController@postChatMessage');
Route::get('downloadFile/{filename}','MessagesController@downloadFile');

Route::get('users/{page}','HomeController@ajaxUser');

Route::get('pdf/{id}/{to_name}','MessagesController@pdf');
Route::get('calendardata','HomeController@calendar');

