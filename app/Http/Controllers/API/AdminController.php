<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\AuthenticationException;
use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
           'message' => 'Login Success'

       ]);
   }



}
