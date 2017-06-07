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
    return view('welcome');
});

//Authencation FrontEnd
//Auth::routes();

//Admin Areas
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function (){
    //Authencation Admin
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function (){
        Route::get('/login', ['as' => 'getAdminAuthLogin', 'uses' => 'LoginController@getLogin']);
        Route::post('/login', ['as' => 'postAdminAuthLogin', 'uses' => 'LoginController@postLogin']);
        Route::post('/logout', ['as' => 'postAdminAuthLogout', 'uses' => 'LoginController@postLogout']);
    });
    
    //Check Authencation
    Route::group(['middleware' => 'auth'], function() {
        //Home
        Route::group(['prefix' => 'home'], function(){
            Route::get('/index', ['as' => 'getAdminHomeIndex', 'uses' => 'HomeController@index']);
        });

        //Menu
        Route::group(['prefix' => 'menu'], function(){
            Route::get('/index', ['as' => 'getAdminMenuIndex', 'uses' => 'MenuController@index']);
            Route::get('/add', ['as' => 'getAdminMenuAdd', 'uses' => 'MenuController@getAdd']);
            Route::post('/add', ['as' => 'postAdminMenuAdd', 'uses' => 'MenuController@postAdd']);
            Route::get('/edit/{id}', ['as' => 'getAdminMenuEdit', 'uses' => 'MenuController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'postAdminMenuEdit', 'uses' => 'MenuController@postEdit']);
            Route::post('/delete/{id}', ['as' => 'postAdminMenuDelete', 'uses' => 'MenuController@postDelete']);
        });

        //Post
        Route::group(['prefix' => 'post'], function(){
            Route::get('/index', ['as' => 'getAdminPostIndex', 'uses' => 'PostController@index']);
            Route::get('/add', ['as' => 'getAdminPostAdd', 'uses' => 'PostController@getAdd']);
            Route::post('/add', ['as' => 'postAdminPostAdd', 'uses' => 'PostController@postAdd']);
            Route::get('/edit/{id}', ['as' => 'getAdminPostEdit', 'uses' => 'PostController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'postAdminPostEdit', 'uses' => 'PostController@postEdit']);
            Route::post('/delete/{id}', ['as' => 'postAdminPostDelete', 'uses' => 'PostController@postDelete']);
        });
    });
});

