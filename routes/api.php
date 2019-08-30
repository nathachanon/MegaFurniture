<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//admins

Route::post('registerAdmin','API\AdminController@registerAdmin');
Route::post('loginAdmin','API\AdminController@loginAdmin');

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

//Seller
Route::post('recommend-product','API\ProductController@product_recommend');
Route::post('registerSell','API\SellerController@registerSell');
Route::post('loginSell','API\SellerController@loginSell');
Route::post('excelUpload','API\ProductController@excelUpload');
Route::post('AddBrand','API\BrandController@AddBrand');
Route::post('editupload','API\ProductController@picedit');
Route::post('upload','API\ProductController@picedit');
//public
Route::post('recommend','API\ProductController@recommend');




Route::group(['middleware' => 'multiauth:seller_api'],function(){
	Route::post('editTracking','API\OrderController@editTracking');

	Route::post('addTracking','API\OrderController@addTracking');
	Route::post('canclePayment','API\PaymentController@canclePayment');
	Route::post('changePayment','API\PaymentController@changePayment');
	Route::post('getPayment','API\PaymentController@getPayment');
	Route::post('getOrderDetails','API\OrderController@getDetailOrderByID');
	Route::post('getOrder','API\OrderController@getOrder');
	Route::post('change-Sku','API\ProductController@change_sku');
	Route::post('changegroup-Delete','API\ProductController@groupchange_delete');
	Route::post('changegroup-Qty','API\ProductController@groupchange_qty');
	Route::post('changegroup-Color','API\ProductController@groupchange_color');
	Route::post('changegroup-Price','API\ProductController@groupchange_price');
	Route::post('changegroup-Status','API\ProductController@groupchange_status');
	Route::post('editupload','API\ProductController@picedit');

	Route::get('getDetailsSell','API\SellerController@getDetailsSell');
	Route::post('getBrand','API\BrandController@getBrand');
	Route::post('sendEmail','API\PaymentController@sendEmail');
	//Route::post('AddBrand','API\BrandController@AddBrand');
	Route::get('getCatagoiesRoom','API\BrandController@getCatagoiesRoom');
	Route::post('sbrand','API\BrandController@sbrand');
	Route::post('EditProduct','API\ProductController@EditProduct');
	Route::post('AddProduct','API\ProductController@AddProduct');
	Route::post('getCatagoiesProduct','API\BrandController@getCatagoiesProduct');
	Route::post('DeleteProduct','API\ProductController@DeleteProduct');
	Route::post('getProductDetails','API\ProductController@getProductDetails');
	Route::post('LogoBrand','API\BrandController@LogoBrand');
	Route::post('statusProduct','API\ProductController@changeStatusProduct');
	Route::post('sbrands','API\BrandController@sbrands');
	Route::get('logoutSell', 'API\SellerController@logoutSell');

	Route::post('compareProduct','API\ProductController@compareProduct');
	Route::post('addBankAccount','API\SellerController@addBankAccount');
	Route::get('getBankName','API\SellerController@getBankName');
	Route::post('getBankAccount','API\SellerController@getBankAccount');
	Route::post('getbrandName','API\SellerController@getbrandName');
	Route::post('deletebankAccount','API\SellerController@deletebankAccount');
	Route::post('changeStatus-Bank','API\SellerController@changeStatusBank');
});
Route::apiResource('/products','API\ProductController');
Route::group(['prefix'=>'products'],function(){
Route::apiResource('/{products}/reviews','API\ReviewsController');

});


//Buyer
Route::get('com2','API\ProductController@com2');

Route::get('getProductMain','API\ProductController@getProductMain');
Route::post('getProductType','API\ProductController@getProductType');
Route::post('getProductPrice','API\ProductController@getProductPrice');
Route::post('searchResult','API\ProductController@searchResult');


Route::post('searchProduct','API\ProductController@searchProduct');
Route::post('getProduct','API\ProductController@getProduct');

Route::post('compareProduct','API\ProductController@compareProduct');

Route::post('loginBuyer','API\BuyerController@loginBuyer');
Route::post('registerBuyer','API\BuyerController@registerBuyer');

Route::post('saveHistoryview','API\LogController@saveHistoryview');
Route::get('getHistory','API\LogController@getHistory');



Route::post('saveHistoryview','API\LogController@saveHistoryview');

Route::group(['middleware' => 'multiauth:buyer_api'],function(){
	Route::post('success-Delivery','API\OrderController@statusTracking');
	Route::post('orderbuyer','API\OrderController@orderbuyer');
	Route::post('telCheck','API\BuyerController@telCheck');
	Route::post('payment-Add','API\PaymentController@addPayment');
	Route::post('getBank-id','API\PaymentController@getBank_id');
	Route::post('getBank-brand','API\PaymentController@getBank_brand');
	Route::post('getOrder-buyer','API\OrderController@getOrder_buyer');
	Route::post('updateBuyer','API\BuyerController@updateBuyer');
	Route::post('createOrder','API\OrderController@createOrder');
	Route::post('decrease','API\OrderController@decrease');
	Route::post('deleteCart','API\OrderController@deleteCart');
	Route::post('addCart','API\OrderController@addCart');
	Route::post('getCart','API\OrderController@getCart');
	Route::post('getAddress','API\BuyerController@getAddress');
	Route::post('addAddress','API\BuyerController@addAddress');
	Route::post('deleteAddress','API\BuyerController@deleteAddress');
	Route::get('getDetailsBuyer','API\BuyerController@getDetailsBuyer');
	Route::get('logoutBuyer', 'API\BuyerController@logoutBuyer');

});
