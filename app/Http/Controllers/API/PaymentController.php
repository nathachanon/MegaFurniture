<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Authenticator;
use DB;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use SMartins\PassportMultiauth\PassportMultiauth;
use Socialize;
use Validator;
use Postmark\PostmarkClient;

class PaymentController extends Controller
{
  public $successStatus = 200;

  public function sendEmail(Request $request){

    $validator = Validator::make($request->all(), [
    'email' => 'required',
    'orderid' => 'required',
    'tracking' => 'required',
  ]);

  if ($validator->fails()) {
    return response()->json(['error'=>$validator->errors()], 201);
  }
  $input = $request->all();

  $client = new PostmarkClient("c7161358-981a-4088-806d-381d1991c33a");
  // Send an email:
  $sendResult = $client->sendEmail(
    "sfi98135@zoqqa.com",
    $input['email'],
    $input['orderid'],
    $input['tracking']
  );
    return response()->json(['success' => 'Send Email Success !!'], $this-> successStatus);
  }

  public function getBank_brand(Request $request){

    $validator = Validator::make($request->all(), [
    'brand_id' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()], 201);
    }
    $input = $request->all();

    $getBrandBank = DB::table('brands')
    ->select('brands.brand_name','bank_accounts.bankaccount_id','bank_accounts.account_name','bank_accounts.bank_account','banks.bank_name')
    ->join('bank_accounts', 'brands.brand_id', '=', 'bank_accounts.brand_id')
    ->join('banks', 'bank_accounts.bank_id', '=', 'banks.bank_id')
    ->where('brands.brand_id', $input['brand_id'])
    ->where('bank_accounts.status', 1)
    ->get();

    return response()->json(['success' => $getBrandBank], $this-> successStatus);
  }

  public function getBank_id(Request $request){

    $validator = Validator::make($request->all(), [
    'bankaccount_id' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()], 201);
    }
    $input = $request->all();

    $getBank = DB::table('bank_accounts')
    ->select('bank_accounts.bankaccount_id','bank_accounts.account_name','bank_accounts.bank_account','banks.bank_name')
    ->join('banks', 'bank_accounts.bank_id', '=', 'banks.bank_id')
    ->where('bank_accounts.bankaccount_id', $input['bankaccount_id'])
    ->where('bank_accounts.status', 1)
    ->get();

    return response()->json(['success' => $getBank], $this-> successStatus);
  }

  public function addPayment(Request $request){

    $validator = Validator::make($request->all(), [
    'BankAccount_id' => 'required',
    'amount' => 'required',
    'bank_account' => 'required',
    'bank_name' => 'required',
    'date_time' => 'required'
    ]);
    $request['pay_status'] = 0;

    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()], 201);
    }
    $input = $request->all();

    $getOrder = DB::table('orderdetails')
    ->select('orderdetails.order_detail_id','orderdetails.price')
    ->join('orders', 'orderdetails.order_id', '=', 'orders.order_id')
    ->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
    ->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
    ->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
    ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
    ->where('orders.order_id', $request['order_id'])
    ->where('brands.brand_id', $request['brand_id'])
    ->get();

    DB::table('orderdetails')
    ->join('orders', 'orderdetails.order_id', '=', 'orders.order_id')
    ->join('carts', 'orders.cart_id', '=', 'carts.cart_id')
    ->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
    ->join('products', 'orderdetails.prod_id', '=', 'products.prod_id')
    ->join('brands', 'products.brand_id', '=', 'brands.brand_id')
    ->where('brands.brand_id', $request['brand_id'])
    ->where('orders.order_id', $request['order_id'])
    ->update([
                'orderdetails.status' => 1,
                'orderdetails.updated_at' => date('Y-m-d H:i:s')
              ]);
    for($x = 0;$x<count($getOrder);$x++){
      $input['order_detail_id'] = $getOrder[$x]->order_detail_id;
      $input['amount'] = $getOrder[$x]->price;
      $insertPayment = Payment::create($input);
    }

    return response()->json(['success' => $getOrder], $this-> successStatus);
  }

}
