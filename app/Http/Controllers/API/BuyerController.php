<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\AuthenticationException;
use App\Http\Controllers\Controller;
use App\User;
use App\Seller;
use App\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Session;
use App\Model\Authenticator;
use File;
use Hash;

class BuyerController extends Controller
{

	public $successStatus = 200;
  private $authenticator;
  public function __construct(Authenticator $authenticator)
  {
      $this->authenticator = $authenticator;
  }

  public function loginBuyer(Request $request)
   {
		 $validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}

		$request['email'] = str_replace(' ', '', $request['email']);
		$request['password'] = str_replace(' ', '', $request['password']);

       $credentials = array_values($request->only('email', 'password', 'provider'));
       if (! $user = $this->authenticator->attemptBuyer(...$credentials)) {
           throw new AuthenticationException();
       }



			 $buyer = DB::table('buyers')->where('email', $request['email'])->value('name');
       $token = $user->createToken('Buyer '.$buyer)->accessToken;

			 $buyerid = DB::table('buyers')->where('email', $request['email'])->value('id');
			 $buyername = DB::table('buyers')->where('email', $request['email'])->value('name');
       return response()->json([
				 	 'buyer_id' => $buyerid,
					 'name' => $buyername,
           'token_type' => 'Bearer',
           'access_token' => $token,
           'message' => 'Login Success'

       ]);
   }


	public function registerBuyer(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'surname' => 'required',
			'sex' => 'required',
			'birthday' => 'required',
			'email' => 'required|email',
			'password' => 'required',
			'c_password' => 'required|same:password',
		]);

		if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();
		$input['password'] = bcrypt($input['password']);
		$email = DB::table('buyers')->where('email', $input['email'])->count();
		if($email != 0)
		{
			$error = 'Email is already';
			return response()->json(['error'=>$error], $this-> successStatus);
		}else{
			$user = User::create($input);

			$status = 'Register Success';
			return response()->json(['success'=>$status], $this-> successStatus);
		}
	}


	public function getDetailsBuyer()
	{
		$user = Auth::user();
		return response()->json(['id' => $user->id,'name' => $user->name,'surname' => $user->surname,'email' => $user->email,'sex' => $user->sex,'birthday' => $user->birthday,'tel' => $user->tel], $this-> successStatus);
	}

	public function logoutBuyer() {
		$accessToken = Auth::user()->token();
		DB::table('oauth_refresh_tokens')
		->where('access_token_id', $accessToken->id)
		->update([
			'revoked' => true
		]);

		$accessToken->revoke();
		return response()->json(['message'=>'Logout Success!'], $this-> successStatus);
	}

	public function updateBuyer(Request $request){
		$validator = Validator::make($request->all(), [
			'buyer_id' => 'required',
			'tel' => 'required',
			'sex' => 'required',
			'birthday' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();

		$input['tel'] = str_replace(' ', '', $input['tel']);
		$input['sex'] = str_replace(' ', '', $input['sex']);

		DB::table('buyers')
		->where('id', $input['buyer_id'])
		->update([
			'tel' => $input['tel'],
			'sex' => $input['sex'],
			'birthday' => $input['birthday'],
			'updated_at' => date('Y-m-d H:i:s')
		]);

		return response()->json(['message'=>'Update Success!'], $this-> successStatus);
	}

	function addAddress(Request $request){

		$validator = Validator::make($request->all(), [
			'buyer_id' => 'required',
			'province' => 'required',
			'district' => 'required',
			'zipcode' => 'required',
			'area' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();
		$input['status'] = 0;
		$addADS = Address::create($input);

		return response()->json(['success'=>'Add Address Success!'], $this-> successStatus);

	}

	function getAddress(Request $request){

		$validator = Validator::make($request->all(), [
			'buyer_id' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();

		$getAddress = DB::table('addresses')->where('buyer_id', $input['buyer_id'])->where('status',0)->get();

		return response()->json(['success'=>$getAddress], $this-> successStatus);

	}

	public function deleteAddress(Request $request){
	  $validator = Validator::make($request->all(), [
	   'add_id' => 'required'
	  ]);


	  if ($validator->fails()) {
	    return response()->json(['error'=>$validator->errors()], 401);
	  }

	  $input = $request->all();

		DB::table('addresses')
		->where('add_id', $input['add_id'])
		->update([
			'status' => 1,
			'updated_at' => date('Y-m-d H:i:s')
		]);

	  return response()->json(['success'=>'Delete address success !'], $this-> successStatus);

	}

	public function telCheck(Request $request){
	  $validator = Validator::make($request->all(), [
	   'buyer_id' => 'required'
	  ]);


	  if ($validator->fails()) {
	    return response()->json(['error'=>$validator->errors()], 401);
	  }

	  $input = $request->all();

	  $getTel = DB::table('buyers')->select('tel')->where('id', $input['buyer_id'])->get();

	  	return response()->json(['success'=>$getTel], $this-> successStatus);

	}

}
