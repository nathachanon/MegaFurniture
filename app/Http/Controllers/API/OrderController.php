<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\AuthenticationException;
use App\Http\Controllers\Controller;
use App\User;
use App\Cart;
use App\Product_in_cart;
use App\Order;
use App\Orderdetail;
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
		for($x = 0; $x < count($input['order_list']);$x++){
			$totalprice += $input['order_list'][$x]['price'];
		}

		$createdOrder = Order::create(
			['Cart_id' => $cartID,
			'total_price' => $totalprice,
			'status' => 0,
		]);

		$orderID = $createdOrder->id;

		for($x = 0; $x < count($input['order_list']);$x++){
			$order_detail_id = $orderID . "P" . $input['order_list'][$x]['prod_id'];
			$createdOrderDetail = Orderdetail::create(
				['order_detail_id' => $order_detail_id,
				'Add_id' => $input['order_list'][$x]['add_id'],
				'Order_id' => $orderID,
				'Prod_id' => $input['order_list'][$x]['prod_id'],
				'del_price_id' => $input['order_list'][$x]['del_price_id'],
				'requiredDate' => date('Y-m-d H:i:s', strtotime("+3 days")),
				'price' => $input['order_list'][$x]['price'],
				'status' => 0
			]);
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
			'brand_id' => 'required'
		]);

    if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();

		$getOrder = DB::table('orderdetails')
		->select(DB::raw('DATE_FORMAT(orderdetails.created_at, "%m/%d/%Y %H:%i:%s") as created_at') , 'brands.brand_name' , 'buyers.name' , 'buyers.surname' , 'orderdetails.prod_id' , 'orderdetails.order_id', 'orderdetails.order_detail_id' , 'orderdetails.price' , DB::raw('DATE_FORMAT(orderdetails.updated_at, "%m/%d/%Y %H:%i:%s") as updated_at') , 'products.prod_id' , 'orderdetails.status')
		->join('orders', 'orderdetails.order_id', '=', 'orders.order_id')
		->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
		->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
		->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
		->join('brands', 'products.brand_id', '=', 'brands.brand_id')
		->where('brands.brand_id', $input['brand_id'])
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
		->select(DB::raw('DATE_FORMAT(orderdetails.created_at, "%m/%d/%Y %H:%i:%s") as created_at') , 'brands.brand_name' , 'brands.brand_id' , 'orderdetails.prod_id' , 'orderdetails.order_id', 'orderdetails.order_detail_id' , 'orderdetails.price' , DB::raw('DATE_FORMAT(orderdetails.updated_at, "%m/%d/%Y %H:%i:%s") as updated_at') , 'products.prod_id' , 'orderdetails.status')
		->join('orders', 'orderdetails.order_id', '=', 'orders.order_id')
		->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
		->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
		->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
		->join('brands', 'products.brand_id', '=', 'brands.brand_id')
		->where('buyers.id', $input['buyer_id'])
		->get();

		$getOrderID = DB::table('orderdetails')
		->select('orders.order_id',DB::raw('DATE_FORMAT(orders.created_at, "%m/%d/%Y %H:%i:%s") as created_at'))->distinct('orders.order_id')
		->join('orders', 'orderdetails.order_id', '=', 'orders.order_id')
		->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
		->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
		->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
		->join('brands', 'products.brand_id', '=', 'brands.brand_id')
		->where('buyers.id', $input['buyer_id'])
		->get();

		$getBrandID = DB::table('orderdetails')
		->select('orderdetails.status','brands.brand_id','brands.brand_name')->distinct('brands.brand_id')
		->join('orders', 'orderdetails.order_id', '=', 'orders.order_id')
		->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
		->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
		->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
		->join('brands', 'products.brand_id', '=', 'brands.brand_id')
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

		return response()->json(['success'=>$getOrder,'order_list'=>$getOrderID,'brand_list'=>$getBrandID,'sum'=>$purchases], $this-> successStatus);

	}

	function getDetailOrderByID(Request $request){

		$validator = Validator::make($request->all(), [
			'prod_id' => 'required',
			'order_id' => 'required'
		]);

    if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();

		$getDetailOrder = DB::table('orderdetails')
		->select('buyers.name' , 'buyers.surname' , 'orderdetails.order_detail_id' ,'orderdetails.price' , 'products.prod_name' , 'products.prod_price' , 'delivery_prices.price as delivery_price' , 'orderdetails.status' , 'deliverys.deliveryname','products.pic_url1',DB::raw('DATE_FORMAT(orderdetails.created_at, "%m/%d/%Y %H:%i:%s") as created_at'),DB::raw('DATE_FORMAT(orderdetails.updated_at, "%m/%d/%Y %H:%i:%s") as updated_at'))
		->join('orders', 'orderdetails.order_id', '=', 'orders.order_id')
		->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
		->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
		->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
		->join('delivery_prices', 'orderdetails.del_price_id', '=', 'delivery_prices.del_price_id')
		->join('deliverys', 'delivery_prices.delivery_id', '=', 'deliverys.delivery_id')
		->where('orderdetails.prod_id', $input['prod_id'])
		->where('orderdetails.order_id', $input['order_id'])
		->get();

		return response()->json($getDetailOrder, $this-> successStatus);
	}

}
