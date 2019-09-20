<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\AuthenticationException;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Promotion;
use App\Content;
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
      return response()->json(['error' => $validator->errors()], 201);
    }
    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $username = DB::table('admins')->where('username', $input['username'])->count();
    if ($username != 0) {
      $error = 'username is already';
      return response()->json(['error' => $error], $this->successStatus);
    } else {
      $user = Admin::create($input);

      $status = 'Register Success';
      return response()->json(['success' => $status], $this->successStatus);
    }
  }

  public function loginAdmin(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'username' => 'required',
      'password' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 201);
    }

    $request['username'] = str_replace(' ', '', $request['username']);
    $request['password'] = str_replace(' ', '', $request['password']);

    $credentials = array_values($request->only('username', 'password', 'provider'));
    if (!$user = $this->authenticator->attemptAdmin(...$credentials)) {
      throw new AuthenticationException();
    }



    $admin = DB::table('admins')->where('username', $request['username'])->value('username');
    $token = $user->createToken('Admin ' . $admin)->accessToken;
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
    $imageName = date('mdYHis') . uniqid() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path("images_promotion"), $imageName);
    $validator = Validator::make($request->all(), [
      'admin_id' => 'required',
      'promotion_name' => 'required',
      'promotion_des' => 'required',
      'promotion_status' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 401);
    }

    $input = $request->all();

    $admin_id = DB::table('admins')->where('id', $input['admin_id'])->count();



    $input['promotion_pic'] = $imageName;

    $promotion = Promotion::create($input);

    $success['promotion_name'] =  $promotion->promotion_name;
    //return Redirect::back()->withErrors(['msg', 'The Message']);

    return response()->json(['success' => '1'], $this->successStatus);
  }
  function getPromotion(Request $request)
  {
    $countPromotion = DB::table('promotions')->where('promotion_status', 1)->count();
    $getPromotion = DB::table('promotions')
      ->join('admins', 'promotions.admin_id', '=', 'admins.id')
      ->select('admins.username', 'promotion_id', 'promotion_name', 'promotion_des', 'promotion_pic', 'promotions.created_at')->where('promotion_status', 1)->get();

    if ($countPromotion == 0) {
      return response()->json(['promotion_count' => $countPromotion], $this->successStatus);
    } else {
      return response()->json(['promotion_count' => $countPromotion, 'promotion' => $getPromotion], $this->successStatus);
    }
  }

  function promotionDetail($id = null)
  {
    $promotionDetail = Promotion::where('promotion_id', $id)->first();
    return view('buyer.promotionDetail')->with(compact('promotionDetail'));
  }
  function geteditPromotion($id = null)
  {
    $promotionDetail = Promotion::where('promotion_id', $id)->first();
    return view('admin.editPromotion')->with(compact('promotionDetail'));
  }
  function editPromotion(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'promotion_id' => 'required',
      'promotion_name' => 'required',
      'promotion_des' => 'required',
      'promotion_status' => 'required',
    ]);
    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 401);
    }
    $image = $request->file('promotion_pic');
    if ($image != null) {
      $imageName = date('mdYHis') . uniqid() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path("images_promotion"), $imageName);
      DB::table('promotions')
        ->where('promotion_id', $request['promotion_id'])
        ->update(['promotion_pic' => $imageName]);
    }

    DB::table('promotions')
      ->where('promotion_id', $request['promotion_id'])
      ->update(['promotion_name' => $request['promotion_name'], 'promotion_des' => $request['promotion_des']]);

    return response()->json(['success' => '1'], $this->successStatus);
  }

  function delPromotion(Request $request)
  {
    DB::table('promotions')
      ->where('promotion_id', $request['promotion_id'])
      ->delete();
    return response()->json(['success' => '1'], $this->successStatus);
  }


  function addContent(Request $request)
  {

    $image = $request->file('content_pic');
    $imageName = date('mdYHis') . uniqid() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path("images_content"), $imageName);
    $validator = Validator::make($request->all(), [
      'admin_id' => 'required',
      'content_name' => 'required',
      'content_des' => 'required',
      'content_all' => 'required',
      'content_status' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 401);
    }

    $input = $request->all();
    $input['content_pic'] = $imageName;
    $content = Content::create($input);

    //$success['content_name'] =  $content->content_name;
    //return Redirect::back()->withErrors(['msg', 'The Message']);

    return response()->json(['success' => '1'], $this->successStatus);
  }
  function getContent(Request $request)
  {
    $countContent = DB::table('contents')->where('content_status', 1)->count();
    $getContent = DB::table('contents')
      ->join('admins', 'contents.admin_id', '=', 'admins.id')
      ->select('admins.username', 'content_id', 'content_name', 'content_des', 'content_pic', 'contents.created_at')->where('content_status', 1)->get();

    if ($countContent == 0) {
      return response()->json(['content_count' => $countContent], $this->successStatus);
    } else {
      return response()->json(['content_count' => $countContent, 'content' => $getContent], $this->successStatus);
    }
  }

  function contentDetail($id = null)
  {
    $contentDetail = Content::where('content_id', $id)->first();
    return view('buyer.contentDetail')->with(compact('contentDetail'));
  }
  function geteditContent($id = null)
  {
    $contentDetail = Content::where('content_id', $id)->first();
    return view('admin.editContent')->with(compact('contentDetail'));
  }
  function editContent(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'content_id' => 'required',
      'content_name' => 'required',
      'content_des' => 'required',
      'content_all' => 'required',
      'content_status' => 'required',
    ]);
    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 401);
    }
    $image = $request->file('content_pic');
    if ($image != null) {
      $imageName = date('mdYHis') . uniqid() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path("images_content"), $imageName);
      DB::table('contents')
        ->where('content_id', $request['content_id'])
        ->update(['content_pic' => $imageName]);
    }

    DB::table('contents')
      ->where('content_id', $request['content_id'])
      ->update(['content_name' => $request['content_name'], 'content_des' => $request['content_des'], 'content_all' => $request['content_all']]);

    return response()->json(['success' => '1'], $this->successStatus);
  }

  function delContent(Request $request)
  {
    DB::table('contents')
      ->where('content_id', $request['content_id'])
      ->delete();
    return response()->json(['success' => '1'], $this->successStatus);
  }
  function logoutAdmin()
  {
    $accessToken = Auth::user()->token();
    DB::table('oauth_refresh_tokens')
      ->where('access_token_id', $accessToken->id)
      ->update([
        'revoked' => true
      ]);

    $accessToken->revoke();
    return response()->json(['message' => 'Logout Success!'], $this->successStatus);
  }
}
