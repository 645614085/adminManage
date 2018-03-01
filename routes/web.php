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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('admin/login','Admin\LoginController@getLogin');
Route::post('admin/login','Admin\LoginController@postLogin');

Route::group(['prefix'=>'admin','middleware'=>['auth.admin','menu'],'namespace'=>'Admin'],function (){
    Route::get('/','IndexController@index')->name('admin.index');
    Route::get('/logout','LoginController@logout')->name('admin.logout');

    //菜单
    Route::get('/menu','MenuController@all')->name('admin.menu');
    Route::get('/menu/add','MenuController@add')->name('admin.menu_add');
    Route::get('/menu/edit/{id}','MenuController@edit')->name('admin.menu_edit');
    Route::post('/menu/update','MenuController@update')->name('admin.menu_update');
    Route::post('/menu/create','MenuController@create')->name('admin.menu_create');
    Route::get('/menu/del/{id}','MenuController@del')->name('admin.menu_del');


    //角色权限
    Route::get("/role",'RoleController@all')->name('admin.role');
    Route::get("/role/detail/{id}",'RoleController@detail')->name('admin.role_detail');
    Route::post("/role/permission",'RoleController@permission')->name('admin.role_permission');

    //角色基本信息
    Route::get("/role/edit/{id}",'RoleController@edit')->name('admin.role_edit');
    Route::post('/role/update','RoleController@update')->name('admin.role_update');
    Route::get('/role/add','RoleController@add')->name('admin.role_add');
    Route::post('/role/create','RoleController@create')->name('admin.role_create');
    Route::get('/role/del/{id}','RoleController@del')->name('admin.role_del');

    //用户
    Route::get("/user/add",'AdminUserController@add');
    Route::post("/user/create",'AdminUserController@create');
    Route::get("/user/edit/{id}",'AdminUserController@edit');
    Route::post("/user/update",'AdminUserController@update');
    Route::get("/user/del/{id}",'AdminUserController@del');

});


//API
Route::get("/index",'Api\IndexController@index');
