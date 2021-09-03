<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');

//Admin
Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('category-tree-view','CategoryController@manageCategory')->name('category-tree-view');
        Route::post('add-category','CategoryController@addCategory')->name('add.category');
        Route::get('/category-list', 'CategoryController@list')->name('admin.category.list');
        Route::get('/category-edit/{id}', 'CategoryController@edit')->name('admin.category.edit');
        Route::post('/category-update/{id}', 'CategoryController@update')->name('admin.category.update');
        Route::post('/category-delete/{id}', 'CategoryController@delete')->name('admin.category.delete');

        Route::get('/product/list', 'ProductController@index')->name('admin.product.list');
        Route::get('/product/add', 'ProductController@add')->name('admin.product.add');
        Route::post('/upload-images-dz', 'ProductController@uploadImageDZ')->name('admin.upload.images.dz');
        Route::post('/remove-image-single', 'ProductController@removeImageSingle')->name('admin.remove.image.single');
        Route::post('/product/store', 'ProductController@store')->name('admin.product.store');
        Route::get('/product/edit/{id}', 'ProductController@edit')->name('admin.product.edit');
        Route::post('/product/update/{id}', 'ProductController@update')->name('admin.product.update');
        Route::post('/product/delete/{id}', 'ProductController@delete')->name('admin.product.delete');

        Route::post('/product/variant', 'ProductVariantController@store')->name('admin.product.variant.store');
        Route::post('/product/variant-ass', 'ProductVariantController@storeAss')->name('admin.product.variant_ass.store');
        Route::get('/product/variant/{id}', 'ProductVariantController@edit')->name('admin.product.variant.edit');
        Route::post('/product/variant/update/{id}', 'ProductVariantController@update')->name('admin.product.variant.update');
        Route::post('/product/variant-ass/update/{id}', 'ProductVariantController@updateAss')->name('admin.product.variantAss.update');
        Route::post('/product/variant/delete/{id}', 'ProductVariantController@delete')->name('admin.product.variant.delete');

        Route::get('/user/list', 'UserController@index')->name('admin.user.list');
        Route::get('/user/add', 'UserController@add')->name('admin.user.add')->middleware('CheckRole');
        Route::post('/user/store', 'UserController@store')->name('admin.user.store')->middleware('CheckRole');
        Route::get('/user/edit/{id}', 'UserController@edit')->name('admin.user.edit')->middleware('CheckRole');
        Route::post('/user/update/{id}', "UserController@update")->name('admin.user.update')->middleware('CheckRole');
        Route::post('/user/delete/{id}', 'UserController@delete')->name('admin.user.delete')->middleware('CheckRole');
    });
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

//Client
Route::get('/', 'Front\HomeController@index')->name('homeFront');
Route::get('/product/detail/{id}', 'Front\ProductController@detailProduct')->name('client.product.detail');
Route::post('/choose-size', 'Front\ProductController@chooseSize')->name('client.choose.size');
//Route::get('/product/step-1/{id}', 'Front\ProductController@detailStep1')->name('client.product.detail.step1');
//Route::get('/product/step-choose-color/{id}', 'Front\ProductController@chooseColor')->name('client.product.chooseColor');
//Route::get('/product/step-2/{id}/{size_id}', 'Front\ProductController@detailStep2')->name('client.product.detail.step2');
Route::post('/product/add-to-cart', 'Front\ProductController@addToCart')->name('client.product.add_to_cart');
Route::get('/gio-hang', 'Front\ProductController@renderCartInfo')->name('client.cart');
Route::post('/product/remove-to-cart', 'Front\ProductController@removeProduct')->name('client.product.remove');
Route::post('/product/updateQtyAjax/{rowId}', 'Front\ProductController@updateQty')->name('client.updateQty');
Route::get('/dat-hang', 'Front\ProductController@checkOutGet')->name('client.checkout');
Route::post('/thanh-toan', 'Front\OrderController@insertOrder')->name('client.insert.order');
