<?php

namespace App\Http\Controllers;

use App\Rmproduct;
use App\Colorproduct;
use App\Sizeproduct;
use App\Product;
use App\Keyword;
use App\Keyword_values;
use App\Delivery_price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\SearchResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use DB;
use Validator;
use File;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {

        $getProduct = Product::where('prod_id',$id)->first();

        $getKeyword = DB::table('keywords')->where('prod_id',$id)->get();

        $Keyword = "";

        foreach ($getKeyword as $keywords) {
            $getKeyword_th = Keyword_values::where('keyword_value_id',$keywords->keyword_value_id)->first();
            $Keyword .= $getKeyword_th->keyword_value . ",";
        }
    
        return view('buyer.productDetail')->with(compact('getProduct','Keyword'));

    }

}