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
Route::get('/brandSettings', function () {
    return view('brandSettings');
});
Route::get('/cart2', function () {
    return view('buyer.cart2');
});

Route::get('/address', function () {
    return view('buyer.address');
});
Route::get('/account', function () {
    return view('buyer.account');
});
Route::get('/purchase', function () {
    return view('buyer.purchase');
});
Route::get('/cart', function () {
    return view('buyer.cart');
});
Route::get('/order', function () {
    return view('order');
});
Route::get('/inbrand', function () {
    return view('inbrand');
});

Route::get('/registerBuyer', function () {
    return view('auth.register');
});
Route::get('/loginBuyer', function () {
    return view('buyer.login');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/brand', function () {
    return view('brand');
});
Route::get('/product', function () {
    return view('product');
});
Route::get('/addProduct', function () {
    return view('addProduct');
});
Route::get('/addMultiProduct', function () {
    return view('addMultiProduct');
});

Route::get('/facebook',  function () {
    return view('facebook');
});

Route::get('/viewProduct', function () {
    return view('viewProduct');
});
Route::get('/addPic', function () {
    return view('addPicture');
});
Route::get('/addDetail', function () {
    return view('addProductDetail');
});

Route::get('/addProducts', function () {
    return view('addProducts');
});
Route::get('/editProduct', function () {
    return view('editProduct');
});
Route::get('/orderPurchase', function () {
    return view('orderPurchase');
});


Route::get('/', function () {
    return view('buyer.MegaIndex');
});

Route::get('/searchResult', function () {
    return view('buyer.searchResult');
});

Route::get('/compareProduct', function () {
    return view('compareProduct');
});

Route::get('/compare', function () {
    return view('buyer.compare');
});
Route::get('/promotion', function () {
    return view('buyer.promotion_buyer');
});
Route::get('/content', function () {
    return view('buyer.content_buyer');
});

Route::get('/productDetail', function () {
    return view('buyer.productDetail');
});

Route::get('/admin', function () {
    return view('admin.login');
});
Route::get('/admin/index', function () {
    return view('admin.index');
});
Route::get('/admin/promotion', function () {
    return view('admin.promotion_admin');
});
Route::get('/admin/addPromotion', function () {
    return view('admin.addPromotion');
});
Route::get('/admin/content', function () {
    return view('admin.content');
});

Route::get('/admin/addContent', function () {
    return view('admin.addContent');
});

Route::get('/promotion/{id}','API\AdminController@promotionDetail');
Route::get('/content/{id}','API\AdminController@contentDetail');
Route::get('/login/facebook', 'API\SellerController@facebookAuthRedirect');
Route::get('/login/facebook/callback', 'API\SellerController@facebookSuccess');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/seller', 'SellerController@index')->name('seller');
