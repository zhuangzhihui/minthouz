<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/9/11
 * Time: 10:16
 */

use think\Route;

//get请求组
Route::group('wavlink', function () {
    //登录登出
    Route::get('/login/index', 'wavlink/login/index');
    Route::get('/login/logout', 'wavlink/login/logout');
    Route::get('/login', 'wavlink/login/index');
    //几个首页
    Route::get('/index', 'wavlink/index/index');
    Route::get('/content/index', 'wavlink/content/index');
    //分类url
    Route::get('/category/index', 'wavlink/Category/index');
    Route::get('/category/add', 'wavlink/Category/add');
    Route::get('/Category/byStatus', 'wavlink/Category/byStatus');
    Route::get('/Category/edit', 'wavlink/Category/edit', [], ['id' => '\d+']);
    //推荐位
    Route::get('/Featured/index', 'wavlink/Featured/index');
    Route::get('/Featured/byStatus', 'wavlink/Featured/byStatus');
    Route::get('/Featured/add', 'wavlink/Featured/add');
    Route::get('/Featured/edit', 'wavlink/Featured/edit', [], ['id' => '\d+']);
    //首页推荐产品
    Route::get('/images/index', 'wavlink/images/index');
    Route::get('/images/add', 'wavlink/images/add');
    Route::get('/images/edit', 'wavlink/images/edit', [], ['id' => '\d+']);
    Route::get('/images/images_recycle', 'wavlink/images/images_recycle');
    //产品管理
    Route::get('/product/index', 'wavlink/product/index');
    Route::get('/product/add', 'wavlink/product/add');
    Route::get('/product/product_edit', 'wavlink/product/product_edit', [], ['id' => '\d+']);
    Route::get('/product/product_recycle', 'wavlink/product/product_recycle');
    //营销管理
    Route::get('/marketing/index', 'wavlink/marketing/index');
    Route::get('/marketing/add', 'wavlink/Marketing/add');
    Route::get('/marketing/edit', 'wavlink/Marketing/edit', [], ['id' => '\d+']);


});

//post请求组
Route::group('wavlink', function () {
    Route::post('/login/index', 'wavlink/login/index');
    Route::post('/category/save', 'wavlink/Category/save');
    Route::post('/Featured/save', 'wavlink/Featured/save');
    Route::post('/images/save', 'wavlink/Images/save');
    Route::post('/product/save', 'wavlink/product/save');
    Route::post('/marketing/save', 'wavlink/Marketing/save');
    Route::post('/Category/byStatus', 'wavlink/Category/byStatus');
    Route::post('/Featured/byStatus', 'wavlink/Featured/byStatus');
    Route::post('/Images/byStatus', 'wavlink/Images/byStatus');
    Route::post('/product/byStatus', 'wavlink/product/byStatus');
    Route::post('/marketing/byStatus', 'wavlink/Marketing/byStatus');
    Route::post('/Images/listorder', 'wavlink/Images/listorder');
    Route::post('/product/listorder', 'wavlink/product/listorder');
    Route::post('/product/sort', 'wavlink/product/sort');
    Route::post('/product/mark', 'wavlink/product/mark');
});