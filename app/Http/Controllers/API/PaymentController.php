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
    'seller_id' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()], 201);
    }
    $input = $request->all();

    $getBrandBank = DB::table('sellers')
    ->select('sellers.name','sellers.surname','bank_accounts.bankaccount_id','bank_accounts.account_name','bank_accounts.bank_account','banks.bank_name')
    ->join('bank_accounts', 'sellers.id', '=', 'bank_accounts.seller_id')
    ->join('banks', 'bank_accounts.bank_id', '=', 'banks.bank_id')
    ->where('sellers.id', $input['seller_id'])
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
    'date_time' => 'required',
    'sl' => 'required'
    ]);
    $request['pay_status'] = 0;

    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()], 201);
    }
    $input = $request->all();

    $input['amount'] = str_replace(',', '', $input['amount']);

    DB::table('orders')
    ->where('order_id', $request['order_id'])
    ->update([
                'orders.status' => 1,
                'orders.updated_at' => date('Y-m-d H:i:s')
              ]);

    $insertPayment = Payment::create($input);

    $image = $request->file('sl');
    $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
    $image->move(public_path('image_payment'),$imageName);
    $pathImg1 = "image_payment/$imageName";

    DB::table('payments')
    ->where('pay_id', $insertPayment->id)
    ->update(['transfer_slip' => $pathImg1]);

    return response()->json(['success' => 'success'], $this-> successStatus);
  }

  public function getPayment(Request $request){
    $validator = Validator::make($request->all(), [
    'order_id' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()], 201);
    }
    $input = $request->all();

    $getPayment = DB::table('payments')
    ->select('payments.transfer_slip','payments.bank_account as buyer_account','payments.bank_name as buyer_name',DB::raw('DATE_FORMAT(payments.date_time, "%m/%d/%Y %H:%i:%s") as buyer_datetime'),'payments.amount as buyer_amount','banks.bank_name','bank_accounts.account_name','bank_accounts.bank_account')
    ->join('bank_accounts', 'payments.BankAccount_id', '=', 'bank_accounts.BankAccount_id')
    ->join('banks', 'bank_accounts.bank_id', '=', 'banks.bank_id')
    ->where('order_id', $input['order_id'])
    ->where('pay_status', 0)
    ->get();

    $getOrder = DB::table('orders')
    ->select(DB::raw('DATE_FORMAT(orders.created_at, "%m/%d/%Y %H:%i:%s") as created_at'),'status')
    ->where('order_id', $input['order_id'])
    ->get();

    return response()->json(['success' => $getPayment,'order'=>$getOrder], $this-> successStatus);
  }

  public function changePayment(Request $request){
    $validator = Validator::make($request->all(), [
    'order_id' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()], 201);
    }
    $input = $request->all();

    DB::table('orders')
    ->where('order_id', $input['order_id'])
    ->update([
                'orders.status' => 2,
                'orders.updated_at' => date('Y-m-d H:i:s')
              ]);

    DB::table('payments')
    ->where('order_id', $input['order_id'])
    ->update([
                'payments.pay_status' => 1,
                'payments.updated_at' => date('Y-m-d H:i:s')
              ]);

    $selectProduct = DB::table('orders')
    ->select('orderdetails.Prod_id','orderdetails.count')
    ->join('orderdetails', 'orders.Order_id', '=', 'orderdetails.Order_id')
    ->where('orders.order_id', $input['order_id'])
    ->get();

    $result = json_decode($selectProduct, true);

    for($y = 0; $y < count($result);$y++){
        DB::table('products')
          ->where('Prod_id', $result[$y]['Prod_id'])
          ->decrement('qty', $result[$y]['count']);
          
        DB::table('products')
        ->where('Prod_id', $result[$y]['Prod_id'])
        ->update([
                    'products.updated_at' => date('Y-m-d H:i:s')
                  ]);
      }

    return response()->json(['success' => 'success'], $this-> successStatus);
  }

  public function canclePayment(Request $request){
    $validator = Validator::make($request->all(), [
    'order_id' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()], 201);
    }
    $input = $request->all();

    DB::table('orders')
    ->where('order_id', $input['order_id'])
    ->update([
                'orders.status' => 0,
                'orders.updated_at' => date('Y-m-d H:i:s')
              ]);

    DB::table('payments')
    ->where('order_id', $input['order_id'])
    ->delete();

    return response()->json(['success' => 'success'], $this-> successStatus);
  }

}
