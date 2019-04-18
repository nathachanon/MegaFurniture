<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Authenticator;
use DB;
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

}
