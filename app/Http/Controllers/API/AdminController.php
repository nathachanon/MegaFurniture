<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\AuthenticationException;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Promotion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Session;
use App\Model\Authenticator;
use File;
use Hash;

class AdminController extends Controller
{
  public $successStatus = 200;
  private $authenticator;

  public function __construct(Authenticator $authenticator)
  {
      $this->authenticator = $authenticator;
  }
  public function registerAdmin(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'username' => 'required',
			'password' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}
		$input = $request->all();
		$input['password'] = bcrypt($input['password']);
		$username = DB::table('admins')->where('username', $input['username'])->count();
		if($username != 0)
		{
			$error = 'username is already';
			return response()->json(['error'=>$error], $this-> successStatus);
		}else{
			$user = Admin::create($input);

			$status = 'Register Success';
			return response()->json(['success'=>$status], $this-> successStatus);
		}
	}

  public function loginAdmin(Request $request)
   {
		 $validator = Validator::make($request->all(), [
			'username' => 'required',
			'password' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()], 201);
		}

		$request['username'] = str_replace(' ', '', $request['username']);
		$request['password'] = str_replace(' ', '', $request['password']);

    $credentials = array_values($request->only('username', 'password', 'provider'));
    if (! $user = $this->authenticator->attemptAdmin(...$credentials)) {
        throw new AuthenticationException();
    }



			 $admin = DB::table('admins')->where('username', $request['username'])->value('username');
       $token = $user->createToken('Admin '.$admin)->accessToken;
			 $adminid = DB::table('admins')->where('username', $request['username'])->value('id');

       return response()->json([
				 	 'admin_id' => $adminid,
           'token_type' => 'Bearer',
           'access_token' => $token,
           'username' => $request['username'],
           'message' => 'Login Success'

       ]);
   }



   function AddPromotion(Request $request)
   {
  
    $image = $request->file('promotion_pic');
    $imageName =date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
    $image->move(public_path("images_promotion"),$imageName);
    $validator = Validator::make($request->all(), [
     'admin_id' => 'required',
     'promotion_name' => 'required',
     'promotion_des' => 'required',
     'promotion_status' => 'required',
   ]);

    if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()], 401);
    }

    $input = $request->all();

    $admin_id = DB::table('admins')->where('id', $input['admin_id'])->count();



     $input['promotion_pic'] = $imageName;

     $promotion = Promotion::create($input);

     $success['promotion_name'] =  $promotion->promotion_name;
     //return Redirect::back()->withErrors(['msg', 'The Message']);

     return response()->json(['success'=>'1'], $this-> successStatus);
   }
   function getPromotion(Request $request){
   $countPromotion = DB::table('promotions')->where('promotion_status', 1)->count();
   $getPromotion = DB::table('promotions')
   ->join('admins', 'promotions.admin_id', '=', 'admins.id')
   ->select('admins.username','promotion_id','promotion_name','promotion_des','promotion_pic','promotions.created_at')->where('promotion_status', 1)->get();

   if($countPromotion == 0){
     return response()->json(['promotion_count'=>$countPromotion], $this-> successStatus);
   }else{
    return response()->json(['promotion_count'=>$countPromotion,'promotion'=>$getPromotion], $this-> successStatus);
   }
 }

  function promotionDetail($id = null){
    $promotionDetail = Promotion::where('promotion_id',$id)->first();
    return view('buyer.promotionDetail')->with(compact('promotionDetail'));
 }

 function logoutAdmin() {
  $accessToken = Auth::user()->token();
  DB::table('oauth_refresh_tokens')
  ->where('access_token_id', $accessToken->id)
  ->update([
    'revoked' => true
  ]);

  $accessToken->revoke();
  return response()->json(['message'=>'Logout Success!'], $this-> successStatus);
}


}
