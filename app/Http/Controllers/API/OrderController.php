<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\AuthenticationException;
use App\Http\Controllers\Controller;
use App\User;
use App\Cart;
use App\Product_in_cart;
use App\Order;
use App\Orderdetail;
use App\Tracking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Session;
use App\Model\Authenticator;
use File;
use Hash;

class OrderController extends Controller
{

	public $successStatus = 200;

  function addCart(Request $request){
    $validator = Validator::make($request->all(), [
			'buyer_id' => 'required',
			'prod_id' => 'required',
			'prod_price' => 'required'
		]);

    if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();

		$cartCount = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->count();

		if($cartCount == 0){
			$addCartID = Cart::create(
		    ['Buyer_id' => $input['buyer_id'],
		  ]);
		}

		$cartCount = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->count();

		if($cartCount == 1){
			$cartID = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->value('Cart_id');

			$cartprod_count = DB::table('Product_in_carts')->where('Cart_id', $cartID)->where('Prod_id', $input['prod_id'])->value('count');

			if($cartprod_count >= 1){
				$cartprod_count += 1;
				DB::table('Product_in_carts')->where('Cart_id', $cartID)->where('Prod_id', $input['prod_id'])->update([
															'count' => $cartprod_count,
															'updated_at' => date('Y-m-d H:i:s')
												]);

												$cartPrice = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->value('Price');
												$cartPrice += $input['prod_price'];
												DB::table('Carts')->where('Cart_id',$cartID)->update([
																							'Price' => $cartPrice,
																							'updated_at' => date('Y-m-d H:i:s')
																				]);

			}else{
				$addProductInCart = Product_in_cart::create(
			    ['Cart_id' => $cartID,
					'Prod_id' => $input['prod_id'],
					'count' => 1,
			  ]);

				$cartPrice = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->value('Price');
				$cartNumOfProduct = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->value('NumOfProduct');
				$cartNumOfProduct += 1;
				$cartPrice += $input['prod_price'];
				DB::table('Carts')->where('Cart_id',$cartID)->update([
															'Price' => $cartPrice,
															'NumOfProduct' => $cartNumOfProduct,
															'updated_at' => date('Y-m-d H:i:s')
												]);
			}

		}else{
			return response()->json(['error'=>'This is error'], $this-> successStatus);
		}
			return response()->json(['success'=>'Add product to cart success'], $this-> successStatus);
  }

	function deleteCart(Request $request){
    $validator = Validator::make($request->all(), [
			'buyer_id' => 'required',
			'prod_id' => 'required',
			'prod_price' => 'required'
		]);

    if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();

		$cartID = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->value('Cart_id');

		$cartprod_count = DB::table('Product_in_carts')->where('Cart_id', $cartID)->where('Prod_id', $input['prod_id'])->value('count');
		$productPrice = $cartprod_count * $input['prod_price'];

		DB::table('Product_in_carts')->where('Cart_id', $cartID)->where('Prod_id', $input['prod_id'])->delete();

		$cartNumOfProduct = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->value('NumOfProduct');
		$cartNumOfProduct -= 1;
		$cartPrice = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->value('Price');
		$cartPrice -= $productPrice;

		DB::table('Carts')->where('Cart_id',$cartID)->update([
													'Price' => $cartPrice,
													'NumOfProduct' => $cartNumOfProduct,
													'updated_at' => date('Y-m-d H:i:s')
										]);

		return response()->json(['success'=>'Delete ProductInCart Success'], $this-> successStatus);

  }

	function decrease(Request $request){
		$validator = Validator::make($request->all(), [
			'buyer_id' => 'required',
			'prod_id' => 'required',
			'prod_price' => 'required'
		]);

    if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();

		$cartID = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->value('Cart_id');

		$cartprod_count = DB::table('Product_in_carts')->where('Cart_id', $cartID)->where('Prod_id', $input['prod_id'])->value('count');

		if($cartprod_count > 1){

			$cartprod_count -= 1;

											DB::table('Product_in_carts')->where('Cart_id',$cartID)->where('Prod_id',$input['prod_id'])->update([
																						'count' => $cartprod_count,
																						'updated_at' => date('Y-m-d H:i:s')
																			]);

				$cartPrice = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->value('Price');
				$cartPrice -= $input['prod_price'];
											DB::table('Carts')->where('Cart_id',$cartID)->update([
																						'Price' => $cartPrice,
																						'updated_at' => date('Y-m-d H:i:s')
																			]);

		}else{
			DB::table('Product_in_carts')->where('Cart_id', $cartID)->where('Prod_id', $input['prod_id'])->delete();

			$cartNumOfProduct = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->value('NumOfProduct');
			$cartNumOfProduct -= 1;
			$cartPrice = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->value('Price');
			$cartPrice -= $input['prod_price'];

			DB::table('Carts')->where('Cart_id',$cartID)->update([
														'Price' => $cartPrice,
														'NumOfProduct' => $cartNumOfProduct,
														'updated_at' => date('Y-m-d H:i:s')
											]);
		}


		return response()->json(['success'=>'decrease ProductInCart Success'], $this-> successStatus);
	}

	function getCart(Request $request){
    $validator = Validator::make($request->all(), [
			'buyer_id' => 'required',
		]);

    if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();

		$cartCount = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->count();

		if($cartCount == 0){
			$addCartID = Cart::create(
		    ['Buyer_id' => $input['buyer_id'],
		  ]);
		}

		$cartCount = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->count();

		if($cartCount == 1){
			$cartID = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->value('Cart_id');

			$getCart = DB::table('Carts')
			->select( 'NumOfProduct','Price')
			->where('Buyer_id', $input['buyer_id'])
			->get();

			$getShopInCart = DB::table('Product_in_carts')
			->select('sellers.name','sellers.surname','sellers.id')
			->join('products', 'Product_in_carts.Prod_id', '=', 'products.Prod_id')
			->join('brands', 'products.brand_id', '=', 'brands.brand_id')
			->join('sellers', 'brands.seller_id', '=', 'sellers.id')
			->where('Cart_id', $cartID)
			->distinct()->get();

			$getBrandInCart = DB::table('Product_in_carts')
			->select( 'brands.brand_name','sellers.id')
			->join('products', 'Product_in_carts.Prod_id', '=', 'products.Prod_id')
			->join('brands', 'products.brand_id', '=', 'brands.brand_id')
			->join('sellers', 'brands.seller_id', '=', 'sellers.id')
			->where('Cart_id', $cartID)
			->distinct()->get();

			$getProductInCart = DB::table('Product_in_carts')
			->select( 'brands.brand_name','products.prod_name','products.prod_price','products.prod_desc','products.pic_url1','products.Prod_id','Product_in_carts.count','sellers.id')
			->join('products', 'Product_in_carts.Prod_id', '=', 'products.Prod_id')
			->join('brands', 'products.brand_id', '=', 'brands.brand_id')
			->join('sellers', 'brands.seller_id', '=', 'sellers.id')
			->where('Cart_id', $cartID)
			->orderBy('products.Prod_id', 'asc')
			->get();

			$getProductDelivery = DB::table('Product_in_carts')
			->select( 'products.Prod_id','deliverys.deliveryname','delivery_prices.price','delivery_prices.del_price_id')
			->join('products', 'Product_in_carts.Prod_id', '=', 'products.Prod_id')
			->join('delivery_prices', 'products.Prod_id', '=', 'delivery_prices.Prod_id')
			->join('deliverys', 'delivery_prices.delivery_id', '=', 'deliverys.delivery_id')
			->where('Cart_id', $cartID)
			->orderBy('products.Prod_id', 'asc')
			->get();

		}else{
			return response()->json(['error'=>'This is error'], $this-> successStatus);
		}
			return response()->json(['success'=>$getCart,'ProductInCart'=>$getProductInCart,'Delivery'=>$getProductDelivery,'Brand'=>$getBrandInCart,'Shop'=>$getShopInCart], $this-> successStatus);
  }


	function createOrder(Request $request){
		$validator = Validator::make($request->all(), [
			'order_list' => 'required',
			'shop_list' => 'required',
			'buyer_id' => 'required'
		]);

    if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();

		$cartID = DB::table('Carts')->where('Buyer_id', $input['buyer_id'])->value('Cart_id');

		if($cartID == ''){
			return response()->json(['error'=>'Cart ID Not Found !'], $this-> successStatus);
		}
		$totalprice = 0;

		for($x = 0; $x < count($input['shop_list']);$x++){
			$totalprice = 0;
			for($y = 0; $y < count($input['order_list']);$y++){
				if($input['order_list'][$y]['seller_id'] == $input['shop_list'][$x]['seller_id']){
					
					$totalprice += $input['order_list'][$y]['price'];

				}
			}

			$createdOrder = Order::create(
						['Cart_id' => $cartID,
						'total_price' => $totalprice,
						'status' => 0,
					]);

			$orderID = $createdOrder->id;

			for($y = 0; $y < count($input['order_list']);$y++){
				if($input['order_list'][$y]['seller_id'] == $input['shop_list'][$x]['seller_id']){
					$order_detail_id = $orderID . "P" . $input['order_list'][$y]['prod_id'];
					$createdOrderDetail = Orderdetail::create(
						['order_detail_id' => $order_detail_id,
						 'Add_id' => $input['order_list'][$y]['add_id'],
						 'Order_id' => $orderID,
						 'Prod_id' => $input['order_list'][$y]['prod_id'],
						 'del_price_id' => $input['order_list'][$y]['del_price_id'],
						 'requiredDate' => date('Y-m-d H:i:s', strtotime("+3 days")),
						 'price' => $input['order_list'][$y]['price']
						]);
				}
			}
		}

		DB::table('Product_in_carts')->where('Cart_id', $cartID)->delete();

		DB::table('Carts')->where('Cart_id',$cartID)->update([
													'Price' => null,
													'NumOfProduct' => null,
													'updated_at' => date('Y-m-d H:i:s')
										]);

		return response()->json(['success'=>'Order Created Success !','varsion'=>'f08d51f05d19125d8a890644b7649bb0','data'=>null,'error_msg'=>null,'error'=>0], $this-> successStatus);
	}

	function getOrder(Request $request){
		$validator = Validator::make($request->all(), [
			'seller_id' => 'required'
		]);

    if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();

		$getOrder = DB::table('orders')
		->select(DB::raw('DATE_FORMAT(orders.created_at, "%m/%d/%Y %H:%i:%s") as created_at') , 'buyers.name' , 'buyers.surname' , 'orders.order_id' , 'orders.total_price' , DB::raw('DATE_FORMAT(orders.updated_at, "%m/%d/%Y %H:%i:%s") as updated_at') , 'orders.status')
		->distinct('orders.order_id')
		->join('orderdetails', 'orders.order_id', '=', 'orderdetails.order_id')
		->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
		->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
		->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
		->join('brands', 'products.brand_id', '=', 'brands.brand_id')
		->join('sellers', 'brands.seller_id', '=', 'sellers.id')
		->where('sellers.id', $input['seller_id'])
		->get();

		return response()->json(['success'=>$getOrder], $this-> successStatus);

	}

	function getOrder_buyer(Request $request){
		$validator = Validator::make($request->all(), [
			'buyer_id' => 'required'
		]);

    if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();

		$getOrder = DB::table('orderdetails')
		->select(DB::raw('DATE_FORMAT(orderdetails.created_at, "%m/%d/%Y %H:%i:%s") as created_at') , 'brands.brand_name' , 'brands.brand_id' , 'orderdetails.prod_id' , 'orderdetails.order_id', 'orderdetails.order_detail_id' , 'orderdetails.price' , DB::raw('DATE_FORMAT(orderdetails.updated_at, "%m/%d/%Y %H:%i:%s") as updated_at') , 'products.prod_id')
		->join('orders', 'orderdetails.order_id', '=', 'orders.order_id')
		->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
		->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
		->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
		->join('brands', 'products.brand_id', '=', 'brands.brand_id')
		->where('buyers.id', $input['buyer_id'])
		->get();

		$getOrderID = DB::table('orderdetails')
		->select('orders.order_id','orders.status','orders.total_price','sellers.id',DB::raw('DATE_FORMAT(orders.created_at, "%m/%d/%Y %H:%i:%s") as created_at'))->distinct('orders.order_id')
		->join('orders', 'orderdetails.order_id', '=', 'orders.order_id')
		->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
		->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
		->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
		->join('brands', 'products.brand_id', '=', 'brands.brand_id')
		->join('sellers', 'brands.seller_id', '=', 'sellers.id')
		->where('buyers.id', $input['buyer_id'])
		->get();

		$purchases = DB::table('orderdetails')
		->select(DB::raw('SUM(orderdetails.price) as price'),'orders.order_id')
		->join('orders', 'orderdetails.order_id', '=', 'orders.order_id')
		->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
		->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
		->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
		->join('brands', 'products.brand_id', '=', 'brands.brand_id')
		->where('buyers.id', $input['buyer_id'])
		->groupBy('orders.order_id')
		->get();

		return response()->json(['success'=>$getOrder,'order_list'=>$getOrderID,'sum'=>$purchases], $this-> successStatus);

	}

	function getDetailOrderByID(Request $request){

		$validator = Validator::make($request->all(), [
			'order_id' => 'required'
		]);

    if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();

		$getOrder = DB::table('orders')
		->select('buyers.name' , 'buyers.surname','buyers.tel' , 'orders.order_id' ,'orders.total_price' , 'orders.status' ,DB::raw('DATE_FORMAT(orders.created_at, "%m/%d/%Y %H:%i:%s") as created_at'),DB::raw('DATE_FORMAT(orders.updated_at, "%m/%d/%Y %H:%i:%s") as updated_at'))->distinct('orders.order_id')
		->join('orderdetails', 'orders.order_id', '=', 'orderdetails.order_id')
		->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
		->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
		->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
		->join('delivery_prices', 'orderdetails.del_price_id', '=', 'delivery_prices.del_price_id')
		->join('deliverys', 'delivery_prices.delivery_id', '=', 'deliverys.delivery_id')
		->where('orderdetails.order_id', $input['order_id'])
		->get();

		$getOrderTracking = DB::table('orderdetails')
		->select('orderdetails.order_detail_id','trackings.track_number')
		->leftjoin('trackings', 'orderdetails.order_detail_id', '=', 'trackings.order_detail_id')
		->where('orderdetails.order_id', $input['order_id'])
		->get();

		$getOrderDetail = DB::table('orders')
		->select('products.sku','orderdetails.order_detail_id' ,'orderdetails.price','orderdetails.Add_id','deliverys.deliveryname','products.prod_price','delivery_prices.price as del_price','addresses.area','addresses.district','addresses.province','addresses.zipcode')
		->join('orderdetails', 'orders.order_id', '=', 'orderdetails.order_id')
		->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
		->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
		->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
		->join('delivery_prices', 'orderdetails.del_price_id', '=', 'delivery_prices.del_price_id')
		->join('deliverys', 'delivery_prices.delivery_id', '=', 'deliverys.delivery_id')
		->join('addresses', 'orderdetails.Add_id', '=', 'addresses.Add_id')
		->where('orderdetails.order_id', $input['order_id'])
		->get();

		return response()->json(['order'=>$getOrder,'orderDetail'=>$getOrderDetail,'tracking'=>$getOrderTracking], $this-> successStatus);
	}

	function orderbuyer(Request $request){

		$validator = Validator::make($request->all(), [
			'order_id' => 'required'
		]);

    if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();

		$getOrderDetail = DB::table('orders')
		->select('products.sku','orderdetails.price','orderdetails.order_detail_id','deliverys.deliveryname','products.prod_price','delivery_prices.price as del_price')
		->join('orderdetails', 'orders.order_id', '=', 'orderdetails.order_id')
		->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
		->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
		->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
		->join('delivery_prices', 'orderdetails.del_price_id', '=', 'delivery_prices.del_price_id')
		->join('deliverys', 'delivery_prices.delivery_id', '=', 'deliverys.delivery_id')
		->join('addresses', 'orderdetails.Add_id', '=', 'addresses.Add_id')
		->where('orderdetails.order_id', $input['order_id'])
		->get();

		$getOrderTracking = DB::table('orderdetails')
		->select('orderdetails.order_detail_id','trackings.track_number')
		->leftjoin('trackings', 'orderdetails.order_detail_id', '=', 'trackings.order_detail_id')
		->where('orderdetails.order_id', $input['order_id'])
		->get();

		$getOrder = DB::table('orders')
		->select('buyers.name' , 'buyers.surname','buyers.tel' , 'orders.order_id' ,'orders.total_price' , 'orders.status' ,DB::raw('DATE_FORMAT(orders.created_at, "%m/%d/%Y %H:%i:%s") as created_at'),DB::raw('DATE_FORMAT(orders.updated_at, "%m/%d/%Y %H:%i:%s") as updated_at'))->distinct('orders.order_id')
		->join('orderdetails', 'orders.order_id', '=', 'orderdetails.order_id')
		->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
		->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
		->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
		->join('delivery_prices', 'orderdetails.del_price_id', '=', 'delivery_prices.del_price_id')
		->join('deliverys', 'delivery_prices.delivery_id', '=', 'deliverys.delivery_id')
		->where('orderdetails.order_id', $input['order_id'])
		->get();

		return response()->json(['orderDetail'=>$getOrderDetail,'order'=>$getOrder,'tracking'=>$getOrderTracking], $this-> successStatus);
	}

	public function addTracking(Request $request){
		$validator = Validator::make($request->all(), [
			'order_detail_id' => 'required',
			'track_number' => 'required',
			'status' => 'required'
		]);

    if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();

		$createdTracking = Tracking::create($input);

		return response()->json(['success'=>'success'], $this-> successStatus);

	}

}
