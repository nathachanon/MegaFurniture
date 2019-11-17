<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;
use Illuminate\Http\Response;
use DB;
use Validator;
use File;
use Redirect;

class BrandController extends Controller
{
  public $successStatus = 200;

  function AddBrand(Request $request)
  {
   $image = $request->file('brand_logo');
   $imageName =date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
   $image->move(public_path("images_brand"),$imageName);
   $validator = Validator::make($request->all(), [
    'seller_id' => 'required',
    'brand_name' => 'required',
    'brand_des' => 'required',
    'brand_status' => 'required',
  ]);

   if ($validator->fails()) {
     return response()->json(['error'=>$validator->errors()], 401);
   }

   $input = $request->all();

   $seller_id = DB::table('sellers')->where('id', $input['seller_id'])->count();
   $b_name = DB::table('brands')->where('brand_name', $input['brand_name'])->count();

   if($seller_id != 1)
   {
    $error = 'ไม่พบ ID ผู้ขายนี้';
    return response()->json(['success'=>$error], $this-> successStatus);
  }else if($b_name != 0){
    $error = 'ชื่อร้านนี้มีผู้ใช้งานแล้ว';
    return response()->json(['success'=>$error], $this-> successStatus);
  }else{
    $input['brand_logo'] = $imageName;

    $brand = Brand::create($input);

    $success['brand_name'] =  $brand->brand_name;
    //return Redirect::back()->withErrors(['msg', 'The Message']);

    return response()->json(['success'=>'1'], $this-> successStatus);
  }
}

function editBrand(Request $request)
{
 
 $validator = Validator::make($request->all(), [
  'seller_id' => 'required',
  'brand_des' => 'required',

]);

 if ($validator->fails()) {
   return response()->json(['error'=>$validator->errors()], 401);
 }

 $input = $request->all();

 $seller_id = DB::table('sellers')->where('id', $input['seller_id'])->count();

 
 if($seller_id != 1)
 {
  $error = 'ไม่พบ ID ผู้ขายนี้';
  return response()->json(['success'=>$error], $this-> successStatus);
}else{


  
 if($request->hasfile('brand_logo')){
  $image = $request->file('brand_logo');
  $imageName =date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
  $image->move(public_path("images_brand"),$imageName);
  $input['brand_logo'] = $imageName;
  $getimage_path =DB::table('brands')
  ->where('brand_id', $input["brand_id"])->get();
  $image_path = "images_brand/".$getimage_path[0]->brand_logo;
  echo $image_path ;
  if(File::exists($image_path)) {
    File::delete($image_path);
}
  DB::table('brands')
  ->where('brand_id', $input["brand_id"])
  ->update(  ['brand_des' =>  $input["brand_des"] , 'brand_logo'=> $input["brand_logo"]  ]);
 }else{ 
  DB::table('brands')
  ->where('brand_id', $input["brand_id"])
  ->update( ['brand_des' =>  $input["brand_des"]  ]);
 }
  //return Redirect::back()->withErrors(['msg', 'The Message']);

  return response()->json(['success'=>'1'], $this-> successStatus);
}
}

function getBrand(Request $request)
{
  $validator = Validator::make($request->all(), [
    'seller_id' => 'required',
  ]);

  if ($validator->fails()) {
   return response()->json(['error'=>$validator->errors()], 401);
 }

 $input = $request->all();
 $brand = DB::table('brands')->where('brand_status', 0)->where('seller_id', $input['seller_id'])->count();
 $brand2 = DB::table('brands')->select('brand_id', 'brand_name','brand_des','brand_logo')->where('brand_status', 0)->where('seller_id', $input['seller_id'])->get();
 if($brand == 0){
   return response()->json(['brand_count'=>$brand], $this-> successStatus);
 }
 else{
  return response()->json(['brand_count'=>$brand,'brand'=>$brand2], $this-> successStatus);
}
}
function sbrand(Request $request)
{
  $validator = Validator::make($request->all(), [
    'brand_id' => 'required',
  ]);

  if ($validator->fails()) {
   return response()->json(['error'=>$validator->errors()], 401);
 }

 $input = $request->all();
 $getBrand = DB::table('brands')->select('brand_name')->where('brand_id', $input['brand_id'])->get();
 $getProduct = DB::table('products')->where('brand_id', $input['brand_id'])->where('status', 0)->count();
 $getProduct2 = DB::table('products')->select('Prod_id', 'prod_name','prod_desc','prod_price','show','qty','sku','colorproducts.ColorProd_value')
 ->join('colorproducts', 'products.ColorProd_id', '=', 'colorproducts.ColorProd_id')
 ->where('status', 0)->where('brand_id', $input['brand_id'])->get();

 $getCountProductSell = DB::select( DB::raw("SELECT products.Prod_id,sum(orderdetails.count) as sell_count from orderdetails
  join orders on orderdetails.Order_id = orders.Order_id
  left join products on orderdetails.Prod_id = products.Prod_id
  join brands on products.brand_id = brands.brand_id
  where orders.status >= 2 and brands.brand_id = :somevariable GROUP BY products.Prod_id "), array(
     'somevariable' => $input['brand_id'],
   ));

 if($getProduct == 0){
  return response()->json(['brand_count'=>$getProduct,'brand_name'=>$getBrand], $this-> successStatus);
}else{
  return response()->json(['brand_name'=>$getBrand,'product_count'=>$getProduct,'product'=>$getProduct2,'sellcount'=>$getCountProductSell], $this-> successStatus);
}
}


function sbrands(Request $request)
{
  $validator = Validator::make($request->all(), [
    'brand_id' => 'required',
  ]);

  if ($validator->fails()) {
    return response()->json(['error'=>$validator->errors()], 401);
  }

  $input = $request->all();
  $getBrand = DB::table('brands')->select('brand_name')->where('brand_id', $input['brand_id'])->get();
  $getProduct = DB::table('products')->where('brand_id', $input['brand_id'])->where('status', 1)->count();
  $getProduct2 = DB::table('products')->select('Prod_id','prod_name','prod_desc','prod_price','show','qty','sku')->where('status', 1)->where('brand_id', $input['brand_id'])->get();
  if($getProduct == 0){
    return response()->json(['brand_count'=>$getProduct,'brand_name'=>$getBrand], $this-> successStatus);
  }else{
    return response()->json(['brand_name'=>$getBrand,'product_count'=>$getProduct,'product'=>$getProduct2], $this-> successStatus);
  }
}


function getCatagoiesRoom()
{
  $CatagoiesRoom_count = DB::table('catagoiesRooms')->select('CatRoom_id','CatRoom_name')->count();
  $CatagoiesRoom = DB::table('catagoiesRooms')->select('CatRoom_id','CatRoom_name')->get();

  if($CatagoiesRoom_count == 0){
    return response()->json(['catRoom_count'=>$CatagoiesRoom_count], $this-> successStatus);
  }else{
    return response()->json(['catRoom_count'=>$CatagoiesRoom_count,'CatagoiesRoom'=>$CatagoiesRoom], $this-> successStatus);
  }
}

function getCatagoiesProduct(Request $request)
{
$request['catroom_id'] = $request->cookie('CatRoom_id');

  $validator = Validator::make($request->all(), [
    'catroom_id' => 'required',
  ]);

  if ($validator->fails()) {
   return response()->json(['error'=>$validator->errors()], 401);
 }

 $input = $request->all();

 $CatagoiesProd_count = DB::table('catagoiesProducts')->select('CatProd_id','CatProd_name')->where('CatRoom_id', $input['catroom_id'])->count();
 $CatagoiesProd = DB::table('catagoiesProducts')->select('CatProd_id','CatProd_name')->where('CatRoom_id', $input['catroom_id'])->get();

 if($CatagoiesProd_count == 0){
  return response()->json(['catProduct_count'=>$CatagoiesProd_count], $this-> successStatus);
}else{
  return response()->json(['catProduct_count'=>$CatagoiesProd_count,'CatagoiesProduct'=>$CatagoiesProd], $this-> successStatus);
}
}
}
