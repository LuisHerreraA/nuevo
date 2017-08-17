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

Route::get('/administrator/home', function () {
    return view('administrator.index');
});

Route::get('/administrator/user', function () {
    return view('administrator.user.index');
});

Route::get('/administrator/mark', function () {
    return view('administrator.mark.index');
});

Route::get('/administrator/category', function () {
    return view('administrator.category.index');
});

Route::get('/administrator/product', function () {
    return view('administrator.product.index');
});



Route::get('/administrative/home', function () {
    return view('administrative.index');
});

Route::get('/administrative/mark', function () {
    return view('administrative.mark.index');
});

Route::get('/administrative/category', function () {
    return view('administrative.category.index');
});

Route::get('/administrative/product', function () {
    return view('administrative.product.index');
});

Route::get('/administrative/product', function () {
    return view('administrative.product.index');
});

Route::get('/501', function () {
    return view('errors.501');
});



Route::get('/report/category',[
  'as'=> 'modules.report.category',
  'uses'=>'ModulesController@report_category'
]);

Route::get('/report/mark',[
  'as'=> 'modules.report.mark',
  'uses'=>'ModulesController@report_mark'
]);

Route::get('/report/product',[
  'as'=> 'modules.product.report',
  'uses'=>'ModulesController@report_product'
]);
