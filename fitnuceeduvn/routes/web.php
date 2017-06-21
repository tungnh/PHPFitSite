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

Route::group(['prefix' => 'error'], function() {
    Route::get('/403', ['as' => 'getError403', 'uses' => 'ErrorController@error403']);
    Route::get('/404', ['as' => 'getError404', 'uses' => 'ErrorController@error404']);
});

//Authencation FrontEnd
Auth::routes();
//Admin Areas
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    //Authencation Admin
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        //Authencation
        Route::get('/login', ['as' => 'getAdminAuthLogin', 'uses' => 'LoginController@getLogin']);
        Route::post('/login', ['as' => 'postAdminAuthLogin', 'uses' => 'LoginController@postLogin']);
        Route::post('/logout', ['as' => 'postAdminAuthLogout', 'uses' => 'LoginController@postLogout']);
        
        //Forgot pasword
        Route::group(['prefix' => 'password'], function () {
            Route::get('/reset', ['as' => 'getAdminAuthPasswordReset', 'uses' => 'ResetPasswordController@getReset']);
            Route::post('/reset/{token}', ['as' => 'postAdminAuthPasswordReset', 'uses' => 'ResetPasswordController@postReset']);
            Route::post('/email', ['as' => 'postAdminAuthPasswordEmail', 'uses' => 'ForgotPasswordController@postEmail']);
        });
    });

    //Check Authencation
    Route::group(['middleware' => 'auth'], function() {
        //Errors
        Route::group(['prefix' => 'error'], function() {
            Route::get('/403', ['as' => 'getAdminError403', 'uses' => 'ErrorController@error403']);
            Route::get('/404', ['as' => 'getAdminError404', 'uses' => 'ErrorController@error404']);
        });
        
        //Home
        Route::group(['prefix' => 'home'], function() {
            Route::get('/index', ['as' => 'getAdminHomeIndex', 'uses' => 'HomeController@index']);
        });

        //Menu
        Route::group(['prefix' => 'menu'], function() {
            Route::get('/index', ['as' => 'getAdminMenuIndex', 'uses' => 'MenuController@index']);
            Route::get('/add', ['as' => 'getAdminMenuAdd', 'uses' => 'MenuController@getAdd']);
            Route::post('/add', ['as' => 'postAdminMenuAdd', 'uses' => 'MenuController@postAdd']);
            Route::get('/edit/{id}', ['as' => 'getAdminMenuEdit', 'uses' => 'MenuController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'postAdminMenuEdit', 'uses' => 'MenuController@postEdit']);
            Route::post('/delete/{id}', ['as' => 'postAdminMenuDelete', 'uses' => 'MenuController@postDelete']);
        });

        //Post
        Route::group(['prefix' => 'post'], function() {
            Route::get('/index', ['as' => 'getAdminPostIndex', 'uses' => 'PostController@index'])->middleware('can:view,App\Model\Post');
            Route::get('/add', ['as' => 'getAdminPostAdd', 'uses' => 'PostController@getAdd']);
            Route::post('/add', ['as' => 'postAdminPostAdd', 'uses' => 'PostController@postAdd']);
            Route::get('/edit/{id}', ['as' => 'getAdminPostEdit', 'uses' => 'PostController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'postAdminPostEdit', 'uses' => 'PostController@postEdit']);
            Route::post('/delete/{id}', ['as' => 'postAdminPostDelete', 'uses' => 'PostController@postDelete']);
        });
        
        //Comment
        Route::group(['prefix' => 'comment'], function() {
            Route::get('/index', ['as' => 'getAdminCommentIndex', 'uses' => 'CommentController@index']);
            Route::get('/commentsbypost/{id?}/{reply_id?}', ['as' => 'getAdminCommentGetCommentsByPost', 'uses' => 'CommentController@getCommentsByPost']);
            Route::get('/add', ['as' => 'getAdminCommentAdd', 'uses' => 'CommentController@getAdd']);
            Route::post('/add', ['as' => 'postAdminCommentAdd', 'uses' => 'CommentController@postAdd']);
            Route::get('/reply/{id}', ['as' => 'getAdminCommentReply', 'uses' => 'CommentController@getReply']);
            Route::post('/reply/{id}', ['as' => 'postAdminCommentReply', 'uses' => 'CommentController@postReply']);
            Route::get('/edit/{id}', ['as' => 'getAdminCommentEdit', 'uses' => 'CommentController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'postAdminCommentEdit', 'uses' => 'CommentController@postEdit']);
            Route::post('/delete/{id}', ['as' => 'postAdminCommentDelete', 'uses' => 'CommentController@postDelete']);
        });

        //Slide
        Route::group(['prefix' => 'slide'], function() {
            Route::get('/index', ['as' => 'getAdminSlideIndex', 'uses' => 'SlideController@index']);
            Route::get('/add', ['as' => 'getAdminSlideAdd', 'uses' => 'SlideController@getAdd']);
            Route::post('/add', ['as' => 'postAdminSlideAdd', 'uses' => 'SlideController@postAdd']);
            Route::get('/edit/{id}', ['as' => 'getAdminSlideEdit', 'uses' => 'SlideController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'postAdminSlideEdit', 'uses' => 'SlideController@postEdit']);
            Route::post('/delete/{id}', ['as' => 'postAdminSlideDelete', 'uses' => 'SlideController@postDelete']);
        });
        
        //Account
        Route::group(['prefix' => 'account'], function() {
            Route::get('/index', ['as' => 'getAdminAccountIndex', 'uses' => 'AccountController@index']);
            Route::get('/add', ['as' => 'getAdminAccountAdd', 'uses' => 'AccountController@getAdd']);
            Route::post('/add', ['as' => 'postAdminAccountAdd', 'uses' => 'AccountController@postAdd']);
            Route::get('/edit/{id}', ['as' => 'getAdminAccountEdit', 'uses' => 'AccountController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'postAdminAccountEdit', 'uses' => 'AccountController@postEdit']);
            Route::post('/delete/{id}', ['as' => 'postAdminAccountDelete', 'uses' => 'AccountController@postDelete']);
        });
        
        //User
        Route::group(['prefix' => 'user'], function() {
            Route::get('/index', ['as' => 'getAdminUserIndex', 'uses' => 'UserController@index']);
            Route::get('/add', ['as' => 'getAdminUserAdd', 'uses' => 'UserController@getAdd']);
            Route::post('/add', ['as' => 'postAdminUserAdd', 'uses' => 'UserController@postAdd']);
            Route::get('/edit/{id}', ['as' => 'getAdminUserEdit', 'uses' => 'UserController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'postAdminUserEdit', 'uses' => 'UserController@postEdit']);
            Route::post('/delete/{id}', ['as' => 'postAdminUserDelete', 'uses' => 'UserController@postDelete']);
        });
        
        //Department
        Route::group(['prefix' => 'department'], function() {
            Route::get('/index', ['as' => 'getAdminDepartmentIndex', 'uses' => 'DepartmentController@index']);
            Route::get('/add', ['as' => 'getAdminDepartmentAdd', 'uses' => 'DepartmentController@getAdd']);
            Route::post('/add', ['as' => 'postAdminDepartmentAdd', 'uses' => 'DepartmentController@postAdd']);
            Route::get('/edit/{id}', ['as' => 'getAdminDepartmentEdit', 'uses' => 'DepartmentController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'postAdminDepartmentEdit', 'uses' => 'DepartmentController@postEdit']);
            Route::post('/delete/{id}', ['as' => 'postAdminDepartmentDelete', 'uses' => 'DepartmentController@postDelete']);
        });
        
        //Position
        Route::group(['prefix' => 'position'], function() {
            Route::get('/index', ['as' => 'getAdminPositionIndex', 'uses' => 'PositionController@index']);
            Route::get('/add', ['as' => 'getAdminPositionAdd', 'uses' => 'PositionController@getAdd']);
            Route::post('/add', ['as' => 'postAdminPositionAdd', 'uses' => 'PositionController@postAdd']);
            Route::get('/edit/{id}', ['as' => 'getAdminPositionEdit', 'uses' => 'PositionController@getEdit']);
            Route::post('/edit/{id}', ['as' => 'postAdminPositionEdit', 'uses' => 'PositionController@postEdit']);
            Route::post('/delete/{id}', ['as' => 'postAdminPositionDelete', 'uses' => 'PositionController@postDelete']);
        });
    });
});

