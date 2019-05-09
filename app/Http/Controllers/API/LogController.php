<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\AuthenticationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Session;
use App\Model\Authenticator;
use File;
use Hash;


use App\Historyview;

class LogController extends Controller
{


   public function saveHistoryview(Request $request)
    {
        $Historyview = new Historyview();
        $Historyview->prod_id = $request->get('prod_id');
        $Historyview->buyer_id = $request->get('buyer_id');
        $Historyview->save();
      return response()->json(['success'=>'1']);
    }

    public function create()
    {
        return view('carcreate');
    }
  }
    ?>
