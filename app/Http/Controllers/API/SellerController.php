<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Authenticator;
use App\Seller;
use App\User;
use App\bank_account;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use SMartins\PassportMultiauth\PassportMultiauth;
use Session;
use Socialize;
use Validator;
//use Redirect;

class SellerController extends Controller
{

  public $successStatus = 200;
  private $authenticator;
  public function __construct(Authenticator $authenticator)
  {
    $this->authenticator = $authenticator;
  }


  public function loginSell(Request $request)
  {

   $credentials = array_values($request->only('email','provider'));
   if (! $user = $this->authenticator->attempt(...$credentials)) {
     throw new AuthenticationException();
   }

   //$token = $user->createToken('seller Token')->accessToken;
   $seller = DB::table('sellers')->where('email', $request->email)->value('name');
   $sellerID = DB::table('sellers')->where('email', $request->email)->value('id');
   $success['token'] =  $user->createToken('seller '.$seller)-> accessToken;
   $success['sid'] = $sellerID;
   return response()->json(['success' => $success], $this-> successStatus);

 }

 public function facebookAuthRedirect()
 {
  return Socialize::driver('facebook')->redirect();
}


public function facebookSuccess() {

  $users = Socialize::driver('facebook')->user();
  $cutStr  = $users->name;
  $pieces = explode(" ", $cutStr);
  $name = $pieces[0];
  $surname = $pieces[1];

  $checkEmail = DB::table('sellers')->where('email', $users->email)->first();

  if(!$checkEmail){

  Seller::create([
    "name" => $name,
    "surname" => $surname,
    "avatar" => $users->avatar_original,
    "fbAccount" => $users->id,
    "email" => $users->email

  ]);
  setcookie("email", $users->email, time() + (30), "/");
   return redirect('facebook');

  }else{

    setcookie("email", $users->email, time() + (30), "/");
    return redirect('facebook');
  }

}



public function getDetailsSell()
{
  $user = Auth::user();
  return response()->json(['seller'=>$user], $this-> successStatus);
}



public function logoutSell() {
  $accessToken = Auth::user()->token();
  DB::table('oauth_refresh_tokens')
  ->where('access_token_id', $accessToken->id)
  ->update([
    'revoked' => true
  ]);

  $accessToken->revoke();
  return response()->json(['message'=>'Logout Success!'], $this-> successStatus);
}

public function addBankAccount(Request $request) {

  $validator = Validator::make($request->all(), [
   'bank_id' => 'required',
   'bank_account' => 'required',
   'brand_id' => 'required',
   'account_name' => 'required'
  ]);

  if ($validator->fails()) {
    return response()->json(['error'=>$validator->errors()], 401);
  }

  $input = $request->all();

  $input['status'] = 0;

   $bankAccount = bank_account::create($input);

    return response()->json(['success'=>'Add bankaccount success !'], $this-> successStatus);
  }

public function getBankName(){

  $getbank = DB::table('banks')->select('bank_id','bank_name')->get();

  return response()->json(['success'=>$getbank], $this-> successStatus);
}

public function getBankAccount(Request $request){

  $validator = Validator::make($request->all(), [
   'brand_id' => 'required'
  ]);


  if ($validator->fails()) {
    return response()->json(['error'=>$validator->errors()], 401);
  }

  $input = $request->all();

  $getbankaccount = DB::table('bank_accounts')
  ->select('bank_accounts.BankAccount_id','banks.bank_name','banks.bank_id','account_name','bank_account','status')
  ->join('banks', 'bank_accounts.bank_id', '=', 'banks.bank_id')
  ->where('brand_id',$input['brand_id'])
  ->get();

  return response()->json(['success'=>$getbankaccount], $this-> successStatus);
}

public function getbrandName(Request $request){

  $validator = Validator::make($request->all(), [
   'brand_id' => 'required'
  ]);


  if ($validator->fails()) {
    return response()->json(['error'=>$validator->errors()], 401);
  }

  $input = $request->all();

  $getbrand_name = DB::select('SELECT brand_name FROM brands where brand_id = :brand_id', ['brand_id' => $input['brand_id']]);

  return response()->json(['success'=>$getbrand_name], $this-> successStatus);
}

public function changeStatusBank(Request $request){
  $validator = Validator::make($request->all(), [
   'bank_id' => 'required',
   'status' => 'required',
   'BankAccount_id' => 'required'
  ]);


  if ($validator->fails()) {
    return response()->json(['error'=>$validator->errors()], 401);
  }

  $input = $request->all();

  if($input['status'] == 0){
    DB::table('bank_accounts')
    ->where('bank_id', $input['bank_id'])
    ->where('status', 1)
    ->update([
                'status' => 0,
                'updated_at' => date('Y-m-d H:i:s')
              ]);

              DB::table('bank_accounts')
              ->where('BankAccount_id', $input['BankAccount_id'])
              ->update([
                          'status' => 1,
                          'updated_at' => date('Y-m-d H:i:s')
                        ]);
  }else{

    DB::table('bank_accounts')
    ->where('bank_id', $input['bank_id'])
    ->where('status', 1)
    ->update([
                'status' => 0,
                'updated_at' => date('Y-m-d H:i:s')
              ]);

              DB::table('bank_accounts')
              ->where('BankAccount_id', $input['BankAccount_id'])
              ->update([
                          'status' => 0,
                          'updated_at' => date('Y-m-d H:i:s')
                        ]);

  }

  return response()->json(['success'=>'Change status success !'], $this-> successStatus);

}

public function deletebankAccount(Request $request){
  $validator = Validator::make($request->all(), [
   'BankAccount_id' => 'required'
  ]);


  if ($validator->fails()) {
    return response()->json(['error'=>$validator->errors()], 401);
  }

  $input = $request->all();

  DB::table('bank_accounts')->where('BankAccount_id', $input['BankAccount_id'])->delete();

  return response()->json(['success'=>'Delete bankaccount success !'], $this-> successStatus);

}


}
