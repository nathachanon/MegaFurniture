<?php

namespace App\Http\Controllers\API;

use App\Historyview;
use App\Http\Controllers\API\AuthenticationException;
use App\Http\Controllers\Controller;
use App\Model\Authenticator;
use DB;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Session;

use Validator;

class LogController extends Controller
{


   public function saveHistoryview(Request $request)
    {
        $Historyview = new Historyview();
        $input = $request->all();
       // $Historyview->prod_id = $request->get('prod_id');
      //  $Historyview->buyer_id = $request->get('buyer_id');
        $Historyview->create($input);
      return response()->json(['success'=> 'success']);
    }

    public function create()
    {
        return view('carcreate');
    }

    public function getHistory()
    {
     $users = Historyview::all();
      return response()->json(['success'=>$users]);
    }
  }
    ?>
