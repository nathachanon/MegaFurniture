<?php

namespace App\Http\Controllers\API;

use App\Rmproduct;
use App\Colorproduct;
use App\Sizeproduct;
use App\Product;
use App\Keyword;
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

class ProductController extends Controller
{

    public function index() //$products match in database
    {

      return  ProductResource::collection(Product::all());
    }

    public function show(Product $product) //$products match in database
    {

      return new ProductResource($product);
    }


    //
public $successStatus = 200;

function excelUpload(Request $request)
{
  if($request->hasFile('file')){
    $path = $request->file('file')->getRealPath();
    $data = Excel::import(new ProductImport, $path);
    return response()->json(['success'=>'Success'], $this-> successStatus);
  }
  dd('Request data does not have any files to import.');
}



function EditProduct(Request $request){
  $validator = Validator::make($request->all(), [
    'brand_id' => 'required',
    'CatProd_id' => 'required',
    'prod_name' => 'required',
    'prod_desc' => 'required',
    'prod_price' => 'required',
    'qty' => 'required',
    'show' => 'required',
    'status' => 'required',
    'SizeProd_width' => 'required',
    'SizeProd_length' => 'required',
    'SizeProd_height' => 'required',
    'SizeProd_foot' => 'required',
    'ColorProd_value' => 'required',
    'weight' => 'required'
  ]);

  if ($validator->fails()) {
   return response()->json(['error'=>$validator->errors()], 401);
 }

 $input = $request->all();

 $rmCount = DB::table('rmproducts')->where('RM_value', $input['RM_value'])->count();
 $rmData = DB::table('rmproducts')->where('RM_value', $input['RM_value'])->pluck('RM_id');
 if($rmCount != 0)
 {
  $rm = str_replace('[', '', $rmData);
  $RM_id = str_replace(']', '', $rm);
}else{
  $productRM = Rmproduct::create(
    ['CatProd_id' => $input['CatProd_id'],
    'RM_value' => $input['RM_value']
  ]);

  $RM_id = $productRM->id;
}

$colorCount = DB::table('colorProducts')->where('ColorProd_value', $input['ColorProd_value'])->count();
$colorData = DB::table('colorProducts')->where('ColorProd_value', $input['ColorProd_value'])->pluck('ColorProd_id');
if($colorCount != 0)
{
  $color = str_replace('[', '', $colorData);
  $COLOR_id = str_replace(']', '', $color);
}else{
  $productColor = Colorproduct::create(
    ['CatProd_id' => $input['CatProd_id'],
    'ColorProd_value' => $input['ColorProd_value']
  ]);

  $COLOR_id = $productColor->id;
}

$sizeCount = DB::table('sizeProducts')
->where('SizeProd_width', $input['SizeProd_width'])
->where('SizeProd_length', $input['SizeProd_length'])
->where('SizeProd_height', $input['SizeProd_height'])
->where('SizeProd_foot', $input['SizeProd_foot'])->count();
$sizeData = DB::table('sizeproducts')
->where('SizeProd_width', $input['SizeProd_width'])
->where('SizeProd_length', $input['SizeProd_length'])
->where('SizeProd_height', $input['SizeProd_height'])
->where('SizeProd_foot', $input['SizeProd_foot'])->pluck('SizeProd_id');
if($sizeCount != 0)
{
  $size = str_replace('[', '', $sizeData);
  $SIZE_id = str_replace(']', '', $size);
}else{
  $productSize = Sizeproduct::create(
    ['CatProd_id' => $input['CatProd_id'],
    'SizeProd_width' => $input['SizeProd_width'],
    'SizeProd_length' => $input['SizeProd_length'],
    'SizeProd_height' => $input['SizeProd_height'],
    'SizeProd_foot' => $input['SizeProd_foot']
  ]);

  $SIZE_id = $productSize->id;
}


$updateProduct = DB::table('products')
->where('Prod_id', $input['Prod_id'])
->update(['CatProd_id' => $input['CatProd_id'],
  'SizeProd_id' => $SIZE_id,
  'ColorProd_id' => $COLOR_id,
  'RM_id' => $RM_id,
  'prod_name' => $input['prod_name'],
  'prod_desc' => $input['prod_desc'],
  'prod_price' => $input['prod_price'],
  'qty' => $input['qty'],
  'show' => $input['show'],
  'status' => $input['status'],
  'weight' => $request['weight'],
  'sku' => $request['sku'],
]);

$success['Prod_id'] =  $input['Prod_id'];

$kerry = DB::table('delivery_prices')
->where('Prod_id', $input['Prod_id'])
->where('Delivery_id', 1)
->update(['Price' => $request['kerry']]);

$dhl = DB::table('delivery_prices')
->where('Prod_id', $input['Prod_id'])
->where('Delivery_id', 2)
->update(['Price' => $request['dhl']]);


$sb = DB::table('delivery_prices')
->where('Prod_id', $input['Prod_id'])
->where('Delivery_id', 3)
->update(['Price' => $request['sb']]);

$ems = DB::table('delivery_prices')
->where('Prod_id', $input['Prod_id'])
->where('Delivery_id', 4)
->update(['Price' => $request['ems']]);

$buyer = DB::table('delivery_prices')
->where('Prod_id', $input['Prod_id'])
->where('Delivery_id', 5)
->update(['Price' => $request['buyer']]);

$seller = DB::table('delivery_prices')
->where('Prod_id', $input['Prod_id'])
->where('Delivery_id', 6)
->update(['Price' => $request['seller']]);

  if ($request->hasFile('pic1'))//img1 start
  {
    $image = $request->file('pic1');
    $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
    $image->move(public_path('image_product'),$imageName);
    $pathImg1 = "image_product/$imageName";
    $success['img1'] = $pathImg1;

    DB::table('products')
    ->where('Prod_id', $input['Prod_id'])
    ->update(['pic_url1' => $pathImg1]);

  }else{
    $success['img1'] = 'null';

  }//img1 end

  if (Input::hasFile('pic2'))//img2 start
  {
    $image = Input::file('pic2');
    $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
    $image->move(public_path('image_product'),$imageName);
    $pathImg2 = "image_product/$imageName";
    $success['img2'] = $pathImg2;

    DB::table('products')
    ->where('Prod_id', $input['Prod_id'])
    ->update(['pic_url2' => $pathImg2]);

  }else{
      $success['img2'] = 'null';

  } //img2 end

  if (Input::hasFile('pic3'))//img3 start
  {
    $image = Input::file('pic3');
    $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
    $image->move(public_path('image_product'),$imageName);
    $pathImg3 = "image_product/$imageName";
    $success['img3'] = $pathImg3;

    DB::table('products')
    ->where('Prod_id', $input['Prod_id'])
    ->update(['pic_url3' => $pathImg3]);


  }else{
      $success['img3'] = 'null';

  } //img3 end
  if (Input::hasFile('pic4'))//img4 start
  {
    $image = Input::file('pic4');
    $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
    $image->move(public_path('image_product'),$imageName);
    $pathImg4 = "image_product/$imageName";
    $success['img4'] = $pathImg4;

    DB::table('products')
    ->where('Prod_id', $input['Prod_id'])
    ->update(['pic_url4' => $pathImg4]);

  }else{
      $success['img4'] = 'null';

  } //img4 end

  if (Input::hasFile('pic5'))//img5 start
  {
    $image = Input::file('pic5');
    $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
    $image->move(public_path('image_product'),$imageName);
    $pathImg5 = "image_product/$imageName";
    $success['img5'] = $pathImg5;

    DB::table('products')
    ->where('Prod_id', $input['Prod_id'])
    ->update(['pic_url5' => $pathImg5]);

  }else{
      $success['img5'] = 'null';

  } //img5 end


return response()->json(['success'=>$success], $this-> successStatus);

}

function AddProduct(Request $request){
  $validator = Validator::make($request->all(), [
    'brand_id' => 'required',
    'CatProd_id' => 'required',
    'prod_name' => 'required',
    'prod_desc' => 'required',
    'prod_price' => 'required',
    'qty' => 'required',
    'show' => 'required',
    'status' => 'required',
    'SizeProd_width' => 'required',
    'SizeProd_length' => 'required',
    'SizeProd_height' => 'required',
    'SizeProd_foot' => 'required',
    'ColorProd_value' => 'required',
    'weight' => 'required',
    'pic1' => 'required'
  ]);

  if ($validator->fails()) {
   return response()->json(['error'=>$validator->errors()], 401);
 }

 $input = $request->all();
 $rmCount = DB::table('rmproducts')->where('RM_value', $input['RM_value'])->count();
 $rmData = DB::table('rmproducts')->where('RM_value', $input['RM_value'])->pluck('RM_id');
 if($rmCount != 0)
 {
  $rm = str_replace('[', '', $rmData);
  $RM_id = str_replace(']', '', $rm);
}else{
  $productRM = Rmproduct::create(
    ['CatProd_id' => $input['CatProd_id'],
    'RM_value' => $input['RM_value']
  ]);

  $RM_id = $productRM->id;
}

$colorCount = DB::table('colorProducts')->where('ColorProd_value', $input['ColorProd_value'])->count();
$colorData = DB::table('colorProducts')->where('ColorProd_value', $input['ColorProd_value'])->pluck('ColorProd_id');
if($colorCount != 0)
{
  $color = str_replace('[', '', $colorData);
  $COLOR_id = str_replace(']', '', $color);
}else{
  $productColor = Colorproduct::create(
    ['CatProd_id' => $input['CatProd_id'],
    'ColorProd_value' => $input['ColorProd_value']
  ]);

  $COLOR_id = $productColor->id;
}

$sizeCount = DB::table('sizeProducts')
->where('SizeProd_width', $input['SizeProd_width'])
->where('SizeProd_length', $input['SizeProd_length'])
->where('SizeProd_height', $input['SizeProd_height'])
->where('SizeProd_foot', $input['SizeProd_foot'])->count();
$sizeData = DB::table('sizeproducts')
->where('SizeProd_width', $input['SizeProd_width'])
->where('SizeProd_length', $input['SizeProd_length'])
->where('SizeProd_height', $input['SizeProd_height'])
->where('SizeProd_foot', $input['SizeProd_foot'])->pluck('SizeProd_id');
if($sizeCount != 0)
{
  $size = str_replace('[', '', $sizeData);
  $SIZE_id = str_replace(']', '', $size);
}else{
  $productSize = Sizeproduct::create(
    ['CatProd_id' => $input['CatProd_id'],
    'SizeProd_width' => $input['SizeProd_width'],
    'SizeProd_length' => $input['SizeProd_length'],
    'SizeProd_height' => $input['SizeProd_height'],
    'SizeProd_foot' => $input['SizeProd_foot']
  ]);

  $SIZE_id = $productSize->id;
}



  $product = Product::create(
    ['brand_id' => $input['brand_id'],
    'CatProd_id' => $input['CatProd_id'],
    'SizeProd_id' => $SIZE_id,
    'ColorProd_id' => $COLOR_id,
    'RM_id' => $RM_id,
    'prod_name' => $input['prod_name'],
    'prod_desc' => $input['prod_desc'],
    'prod_price' => $input['prod_price'],
    'qty' => $input['qty'],
    'show' => $input['show'],
    'status' => $input['status'],
    'weight' => $request['weight'],
    'sku' => $request['sku']
  ]);
  $PID = $product->Prod_id;

  $success['Prod_id'] =  $product->Prod_id;




//addKeyword
for($x = 0;$x<count($input["tags"]);$x++){
  $keyword = Keyword::create(
   ['Prod_id' => $PID,
    'keyword_value' => $input["tags"][$x]
  ]);
}


$kerry = Delivery_price::create(
 ['Prod_id' => $PID,
  'Delivery_id' => 1,
  'Price' => $request['kerry']
]);

$dhl = Delivery_price::create(
 ['Prod_id' => $PID,
  'Delivery_id' => 2,
  'Price' => $request['dhl']
]);

$sb = Delivery_price::create(
 ['Prod_id' => $PID,
  'Delivery_id' => 3,
  'Price' => $request['sb']
]);

$ems = Delivery_price::create(
 ['Prod_id' => $PID,
  'Delivery_id' => 4,
  'Price' => $request['ems']
]);

$buyer = Delivery_price::create(
 ['Prod_id' => $PID,
  'Delivery_id' => 5,
  'Price' => $request['buyer']
]);

$seller = Delivery_price::create(
 ['Prod_id' => $PID,
  'Delivery_id' => 6,
  'Price' => $request['seller']
]);

if ($request->hasFile('pic1'))//img1 start
{
  $image = $request->file('pic1');
  $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
  $image->move(public_path('image_product'),$imageName);
  $pathImg1 = "image_product/$imageName";
  $success['img1'] = $pathImg1;

  DB::table('products')
  ->where('Prod_id', $success['Prod_id'])
  ->update(['pic_url1' => $pathImg1]);

  if (Input::hasFile('pic2'))//img2 start
  {
    $image = Input::file('pic2');
    $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
    $image->move(public_path('image_product'),$imageName);
    $pathImg2 = "image_product/$imageName";
    $success['img2'] = $pathImg2;

    DB::table('products')
    ->where('Prod_id', $PID)
    ->update(['pic_url2' => $pathImg2]);
    if (Input::hasFile('pic3'))//img3 start
    {
      $image = Input::file('pic3');
      $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
      $image->move(public_path('image_product'),$imageName);
      $pathImg3 = "image_product/$imageName";
      $success['img3'] = $pathImg3;

      DB::table('products')
      ->where('Prod_id', $PID)
      ->update(['pic_url3' => $pathImg3]);
      if (Input::hasFile('pic4'))//img4 start
      {
        $image = Input::file('pic4');
        $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('image_product'),$imageName);
        $pathImg4 = "image_product/$imageName";
        $success['img4'] = $pathImg4;

        DB::table('products')
        ->where('Prod_id', $PID)
        ->update(['pic_url4' => $pathImg4]);
        if (Input::hasFile('pic5'))//img5 start
        {
          $image = Input::file('pic5');
          $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
          $image->move(public_path('image_product'),$imageName);
          $pathImg5 = "image_product/$imageName";
          $success['img5'] = $pathImg5;

          DB::table('products')
          ->where('Prod_id', $PID)
          ->update(['pic_url5' => $pathImg5]);

        }else{
            $success['img5'] = 'null';

        } //img5 end

      }else{
          $success['img4'] = 'null';

      } //img4 end

    }else{
        $success['img3'] = 'null';

    } //img3 end

  }else{
      $success['img2'] = 'null';

  } //img2 end

}else{
    $success['img1'] = 'null';

}//img1 end

return response()->json(['success'=>$success], $this-> successStatus);
}

function DeleteProduct(Request $request){
  $validator = Validator::make($request->all(), [
    'Prod_id' => 'required',
  ]);

  if ($validator->fails()) {
   return response()->json(['error'=>$validator->errors()], 401);
 }

 $input = $request->all();

 $updateDelete = DB::table('products')
 ->where('Prod_id', $input['Prod_id'])
 ->update(['status' => 2]);

 return response()->json(['success'=>'Delete Success'], $this-> successStatus);
}

function changeStatusProduct(Request $request){
  $validator = Validator::make($request->all(), [
    'Prod_id' => 'required',
    'status' => 'required',
  ]);

  if ($validator->fails()) {
    return response()->json(['error'=>$validator->errors()], 401);
  }

  $input = $request->all();

  if($input['status'] == '0'){
    $updateStatus = DB::table('products')
    ->where('Prod_id', $input['Prod_id'])
    ->update(['show' => 1]);
    return response()->json(['success'=>'change Success'], $this-> successStatus);
  }else{
    $updateStatus = DB::table('products')
    ->where('Prod_id', $input['Prod_id'])
    ->update(['show' => 0]);
    return response()->json(['success'=>'change Success'], $this-> successStatus);
  }
}




function uploadProductImage(Request $request)
{
 $image = $request->file('file');
 $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
 $image->move(public_path('images'),$imageName);

 return response()->json(['success'=>$imageName]);
}

function getProductDetails(Request $request){
 $validator = Validator::make($request->all(), [
   'Prod_id' => 'required',
 ]);
 if ($validator->fails()) {
  return response()->json(['error'=>$validator->errors()], 401);
}

$input = $request->all();
$getCat = DB::table('products')
->select( 'products.CatProd_id','catagoiesrooms.CatRoom_id')
->join('catagoiesproducts', 'products.CatProd_id', '=', 'catagoiesproducts.CatProd_id')
->join('catagoiesrooms', 'catagoiesproducts.CatRoom_id', '=', 'catagoiesrooms.CatRoom_id')
->where('Prod_id', $input['Prod_id'])
->get();


$getProduct = DB::table('products')
->select('CatProd_id','prod_name','prod_desc','prod_price','qty','weight')
->where('Prod_id', $input['Prod_id'])
->get();


$getProductSize = DB::table('products')
->select('sizeproducts.SizeProd_width','sizeproducts.SizeProd_height','sizeproducts.SizeProd_length','sizeproducts.SizeProd_foot')
->join('sizeproducts', 'products.SizeProd_id', '=', 'sizeproducts.SizeProd_id')
->where('Prod_id', $input['Prod_id'])
->get();

$getProductColor = DB::table('products')
->select('colorproducts.ColorProd_value')
->join('colorproducts', 'products.ColorProd_id', '=', 'colorproducts.ColorProd_id')
->where('Prod_id', $input['Prod_id'])
->get();

$getProductRM = DB::table('products')
->select('rmproducts.RM_value')
->join('rmproducts', 'products.RM_id', '=', 'rmproducts.RM_id')
->where('Prod_id', $input['Prod_id'])
->get();

$getPicProduct = DB::table('products')
->select('pic_url1','pic_url2','pic_url3','pic_url4','pic_url5')
->where('Prod_id', $input['Prod_id'])
->get();

$getProductDV_count = DB::select( DB::raw("SELECT Count(delivery_prices.Price) as Count FROM `products`  join delivery_prices on products.Prod_id = delivery_prices.Prod_id join deliverys on delivery_prices.Delivery_id = deliverys.Delivery_id where products.Prod_id = :somevariable"), array(
   'somevariable' => $input['Prod_id'],
 ));
$getProductDV = DB::select( DB::raw("SELECT deliverys.DeliveryName , delivery_prices.Price FROM `products`  join delivery_prices on products.Prod_id = delivery_prices.Prod_id join deliverys on delivery_prices.Delivery_id = deliverys.Delivery_id where products.Prod_id = :somevariable"), array(
   'somevariable' => $input['Prod_id'],
 ));

return response()->json(['catagoies'=>$getCat,'product'=>$getProduct,'product_size'=>$getProductSize,'product_color'=>$getProductColor,'product_rm'=>$getProductRM,'product_pic'=>$getPicProduct,'product_dv'=>$getProductDV,'delivery_count'=>$getProductDV_count], $this-> successStatus);
}

public function picupload(Request $request)
{

  $pid = $request->cookie('product_id');
  $image = $request->file('file');
  $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
  $image->move(public_path('image_product'),$imageName);
  $pathImg = "image_product/$imageName";


  $pic1 = DB::table('products')->where('Prod_id', $pid)->whereNull('pic_url1')->count();
  if($pic1 == 1)
  {

    DB::table('products')
    ->where('Prod_id', $pid)
    ->update(['pic_url1' => $pathImg]);

    DB::table('products')
    ->where('Prod_id', $pid)
    ->update(['status' => 0]);


  }else{

    $pic2 = DB::table('products')->where('Prod_id', $pid)->whereNull('pic_url2')->count();

    if($pic2 == 1){

      DB::table('products')
      ->where('Prod_id', $pid)
      ->update(['pic_url2' => $pathImg]);

    }else{

      $pic3 = DB::table('products')->where('Prod_id', $pid)->whereNull('pic_url3')->count();

      if($pic3 == 1){

        DB::table('products')
        ->where('Prod_id', $pid)
        ->update(['pic_url3' => $pathImg]);
      }else{

        $pic4 = DB::table('products')->where('Prod_id', $pid)->whereNull('pic_url4')->count();

        if($pic4 == 1){

          DB::table('products')
          ->where('Prod_id', $pid)
          ->update(['pic_url4' => $pathImg]);
        }else{

          $pic5 = DB::table('products')->where('Prod_id', $pid)->whereNull('pic_url5')->count();

          if($pic5 == 1){

            DB::table('products')
            ->where('Prod_id', $pid)
            ->update(['pic_url5' => $pathImg]);

          }

        }

      }
    }
  }
}

public function picedit(Request $request)
{
  $pid = $request->cookie('product_id');
  if ($request->hasFile('pic1'))//img1 start
  {
    $image = $request->file('pic1');
    $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
    $image->move(public_path('image_product'),$imageName);
    $pathImg1 = "image_product/$imageName";
    $success['img1'] = $pathImg1;

    DB::table('products')
    ->where('Prod_id', $pid)
    ->update(['pic_url1' => $pathImg1]);

  }else{
    $success['img1'] = 'null';

  }//img1 end

  if (Input::hasFile('pic2'))//img2 start
  {
    $image = Input::file('pic2');
    $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
    $image->move(public_path('image_product'),$imageName);
    $pathImg2 = "image_product/$imageName";
    $success['img2'] = $pathImg2;

    DB::table('products')
    ->where('Prod_id', $pid)
    ->update(['pic_url2' => $pathImg2]);

  }else{
      $success['img2'] = 'null';

  } //img2 end

  if (Input::hasFile('pic3'))//img3 start
  {
    $image = Input::file('pic3');
    $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
    $image->move(public_path('image_product'),$imageName);
    $pathImg3 = "image_product/$imageName";
    $success['img3'] = $pathImg3;

    DB::table('products')
    ->where('Prod_id', $pid)
    ->update(['pic_url3' => $pathImg3]);


  }else{
      $success['img3'] = 'null';

  } //img3 end
  if (Input::hasFile('pic4'))//img4 start
  {
    $image = Input::file('pic4');
    $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
    $image->move(public_path('image_product'),$imageName);
    $pathImg4 = "image_product/$imageName";
    $success['img4'] = $pathImg4;

    DB::table('products')
    ->where('Prod_id', $pid)
    ->update(['pic_url4' => $pathImg4]);

  }else{
      $success['img4'] = 'null';

  } //img4 end

  if (Input::hasFile('pic5'))//img5 start
  {
    $image = Input::file('pic5');
    $imageName = date('mdYHis').uniqid().'.'.$image->getClientOriginalExtension();
    $image->move(public_path('image_product'),$imageName);
    $pathImg5 = "image_product/$imageName";
    $success['img5'] = $pathImg5;

    DB::table('products')
    ->where('Prod_id', $pid)
    ->update(['pic_url5' => $pathImg5]);

  }else{
      $success['img5'] = 'null';

  } //img5 end

  if($success != null){
    $updateStatus = DB::table('products')
    ->where('Prod_id', $request['Prod_id'])
    ->update(['status' => 0]);
  }

  return response()->json(['success'=>$success], $this-> successStatus);

}



function compareProduct(Request $request){
 $validator = Validator::make($request->all(), [
   'compare_P_1' => 'required',
   'compare_P_2' => 'required',
   'compare_P_3' => 'nullable',

 ]);
 if ($validator->fails()) {
  return response()->json(['error'=>$validator->errors()], 401);
}

//compare_P_1
$input = $request->all();
$countReviw = DB::table('reviews')->where('Prod_id',$input['compare_P_1'])->count();
$getProduct_1 = DB::table('products')
->select('products.Prod_id','prod_name','prod_desc','prod_price','qty','rmproducts.RM_value','colorproducts.ColorProd_value',
'sizeproducts.SizeProd_width','sizeproducts.SizeProd_height','sizeproducts.SizeProd_length','sizeproducts.SizeProd_foot',
'pic_url1')
->join('rmproducts', 'products.RM_id', '=', 'rmproducts.RM_id')
->join('colorproducts', 'products.ColorProd_id', '=', 'colorproducts.ColorProd_id')
->join('sizeproducts', 'products.SizeProd_id', '=', 'sizeproducts.SizeProd_id')
->where('status', 0)->where('show', 0)
->where('products.Prod_id', $input['compare_P_1'])
->get();


//compare_P_2
$getProduct_2 = DB::table('products')
->select('products.Prod_id','prod_name','prod_desc','prod_price','qty','rmproducts.RM_value','colorproducts.ColorProd_value',
'sizeproducts.SizeProd_width','sizeproducts.SizeProd_height','sizeproducts.SizeProd_length','sizeproducts.SizeProd_foot',
'pic_url1')
->join('rmproducts', 'products.RM_id', '=', 'rmproducts.RM_id')
->join('colorproducts', 'products.ColorProd_id', '=', 'colorproducts.ColorProd_id')
->join('sizeproducts', 'products.SizeProd_id', '=', 'sizeproducts.SizeProd_id')
->where('status', 0)->where('show', 0)
->where('products.Prod_id', $input['compare_P_2'])
->get();

if($input['compare_P_3'] != null){
  //compare_P_3
  $getProduct_3 = DB::table('products')
  ->select('products.Prod_id','prod_name','prod_desc','prod_price','qty','rmproducts.RM_value','colorproducts.ColorProd_value',
  'sizeproducts.SizeProd_width','sizeproducts.SizeProd_height','sizeproducts.SizeProd_length','sizeproducts.SizeProd_foot',
  'pic_url1')
  ->join('rmproducts', 'products.RM_id', '=', 'rmproducts.RM_id')
  ->join('colorproducts', 'products.ColorProd_id', '=', 'colorproducts.ColorProd_id')
  ->join('sizeproducts', 'products.SizeProd_id', '=', 'sizeproducts.SizeProd_id')
  ->where('status', 0)->where('show', 0)

  ->where('products.Prod_id', $input['compare_P_3'])
  ->get();

}else{
  $getProduct_3 = null;
}


return response()->json(['product1'=>$getProduct_1,'product2'=>$getProduct_2,'product3'=>$getProduct_3], $this-> successStatus);

}

function getProduct(Request $request){

  $countProduct = DB::table('products')->where('status', 0)->count();
  $getProduct = DB::table('products')
  ->select('Prod_id','prod_name','prod_desc','prod_price','pic_url1')->where('status', 0)->where('show',0)->get();

  if($countProduct == 0){
    return response()->json(['product_count'=>$countProduct], $this-> successStatus);
  }else{
   return response()->json(['product_count'=>$countProduct,'product'=>$getProduct], $this-> successStatus);
  }


}

function searchProduct(Request $request){
  $validator = Validator::make($request->all(), [
    'product_name' => 'required',
  ]);
  if ($validator->fails()) {
   return response()->json(['error'=>$validator->errors()], 401);
 }

 $input = $request->all();
 $search1 = DB::table('products')
 ->distinct()->select('prod_name')
 ->where('prod_name', 'like', $input['product_name'])
  ->where('show',0)->where('status',0)
 ->get();

 return response()->json(['product' => $search1], $this-> successStatus);
}

function getProductMain(){
  $countProduct = DB::table('products')->where('status', 0)->where('show',0)->count();
  $getProduct = DB::select( DB::raw("select products.prod_id , products.prod_name as Name , catagoiesrooms.CatRoom_name as Room , products.prod_desc as Description , products.prod_price as Price , products.pic_url1 as Pic from products
  join catagoiesproducts on products.CatProd_id = catagoiesproducts.CatProd_id
  join catagoiesrooms on catagoiesproducts.CatRoom_id = catagoiesrooms.CatRoom_id where products.status = 0 and products.show = 0 order by products.prod_id"));

  $getRating = DB::select( DB::raw("select products.prod_id , ROUND(AVG(reviews.rating),1) as Rating from products
  join catagoiesproducts on products.CatProd_id = catagoiesproducts.CatProd_id
  join catagoiesrooms on catagoiesproducts.CatRoom_id = catagoiesrooms.CatRoom_id
  left join reviews on products.Prod_id = reviews.prod_id where products.status = 0 and products.show = 0
  group by products.prod_id"));

  if($countProduct == 0){
    return response()->json(['product_count'=>'NULL'], $this-> successStatus);
  }else{
   return response()->json(['product_count'=>$countProduct,'product'=>$getProduct,'rating'=>$getRating], $this-> successStatus);
  }
}

function searchResult(Request $request){
  $validator = Validator::make($request->all(), [
    'product_name' => 'required',
  ]);
  if ($validator->fails()) {
   return response()->json(['error'=>$validator->errors()], 401);
 }

  $input = $request->all();
  $prod_names = $input['product_name'];
  $countProduct = DB::table('products')->where('status', 0)->where('show', 0)->where('prod_name', 'like', $input['product_name'])->count();
  $getProduct = DB::select( DB::raw("SELECT products.prod_id , products.prod_name as Name , catagoiesrooms.CatRoom_name as Room , products.prod_desc as Description , products.prod_price as Price , products.pic_url1 as Pic from products
  join catagoiesproducts on products.CatProd_id = catagoiesproducts.CatProd_id
  join catagoiesrooms on catagoiesproducts.CatRoom_id = catagoiesrooms.CatRoom_id where products.status = 0 and products.show = 0 and products.prod_name like '$prod_names' order by products.prod_id"));

  $getRating = DB::select( DB::raw("SELECT products.prod_id , ROUND(AVG(reviews.rating),1) as Rating from products
  join catagoiesproducts on products.CatProd_id = catagoiesproducts.CatProd_id
  join catagoiesrooms on catagoiesproducts.CatRoom_id = catagoiesrooms.CatRoom_id
  left join reviews on products.Prod_id = reviews.prod_id where products.status = 0 and products.show = 0 and products.prod_name like '$prod_names'
  group by products.prod_id "));

  if($countProduct == 0){
    return response()->json(['product_count'=>'NULL'], $this-> successStatus);
  }else{
   return response()->json(['product_count'=>$countProduct,'product'=>$getProduct,'rating'=>$getRating], $this-> successStatus);
  }
}

function getProductType(Request $request){
  $validator = Validator::make($request->all(), [
    'CatProd_name' => 'required',
  ]);
  if ($validator->fails()) {
   return response()->json(['error'=>$validator->errors()], 401);
 }

  $input = $request->all();

  $countProduct = DB::select( DB::raw("SELECT Count(*) as count from products
  join catagoiesproducts on products.CatProd_id = catagoiesproducts.CatProd_id
  join catagoiesrooms on catagoiesproducts.CatRoom_id = catagoiesrooms.CatRoom_id
  left join reviews on products.Prod_id = reviews.prod_id where products.status = 0 and products.show = 0 and catagoiesproducts.CatProd_name = :somevariable"), array(
     'somevariable' => $input['CatProd_name'],
   ));

  $getProduct = DB::select( DB::raw("SELECT products.prod_id , products.prod_name as Name , catagoiesrooms.CatRoom_name as Room , products.prod_desc as Description , products.prod_price as Price , products.pic_url1 as Pic from products
  join catagoiesproducts on products.CatProd_id = catagoiesproducts.CatProd_id
  join catagoiesrooms on catagoiesproducts.CatRoom_id = catagoiesrooms.CatRoom_id where products.status = 0 and products.show = 0 and catagoiesproducts.CatProd_name = :somevariable order by products.prod_id"), array(
     'somevariable' => $input['CatProd_name'],
   ));

  $getRating = DB::select( DB::raw("SELECT products.prod_id , ROUND(AVG(reviews.rating),1) as Rating from products
  join catagoiesproducts on products.CatProd_id = catagoiesproducts.CatProd_id
  join catagoiesrooms on catagoiesproducts.CatRoom_id = catagoiesrooms.CatRoom_id
  left join reviews on products.Prod_id = reviews.prod_id where products.status = 0 and products.show = 0 and catagoiesproducts.CatProd_name = :somevariable
  group by products.prod_id "), array(
     'somevariable' => $input['CatProd_name'],
   ));

  if($countProduct == 0){
    return response()->json(['product_count'=>'NULL'], $this-> successStatus);
  }else{
   return response()->json(['product_count'=>$countProduct,'product'=>$getProduct,'rating'=>$getRating], $this-> successStatus);
  }
}

function groupchange_status(Request $request){
  $length = $request['length'];
  $prodlist = $request['prodlist'];
  $status = $request['status'];

  for($i = 0 ; $i < $request['length'];$i++){

    $updateStatus = DB::table('products')
    ->where('Prod_id', $prodlist[$i])
    ->update(['show' => $status]);

  }

  return response()->json(['success'=>'change Success'], $this-> successStatus);
}

function groupchange_price(Request $request){
  $length = $request['length'];
  $prodlist = $request['prodlist'];
  $price = $request['prod_price'];

  for($i = 0 ; $i < $request['length'];$i++){

    $updateStatus = DB::table('products')
    ->where('Prod_id', $prodlist[$i])
    ->update(['prod_price' => $price]);

  }

  return response()->json(['success'=>'change Success'], $this-> successStatus);
}

function groupchange_color(Request $request){
  $length = $request['length'];
  $prodlist = $request['prodlist'];
  $prod_color = $request['prod_color'];

  for($i = 0 ; $i < $request['length'];$i++){

    $colorCount = DB::table('colorProducts')->where('ColorProd_value', $prod_color)->count();
    $colorData = DB::table('colorProducts')->where('ColorProd_value', $prod_color)->pluck('ColorProd_id');

    $getCatProd_id = DB::table('products')->where('Prod_id', $prodlist[$i])->pluck('CatProd_id');

    $getcata = str_replace('[', '', $getCatProd_id);
    $CatProd_id = str_replace(']', '', $getcata);

    if($colorCount != 0)
    {
      $color = str_replace('[', '', $colorData);
      $COLOR_id = str_replace(']', '', $color);
    }else{
      $productColor = Colorproduct::create(
        ['CatProd_id' => $CatProd_id,
        'ColorProd_value' => $prod_color
      ]);

      $COLOR_id = $productColor->id;
    }

    $updateStatus = DB::table('products')
    ->where('Prod_id', $prodlist[$i])
    ->update(['ColorProd_id' => $COLOR_id]);

  }

  return response()->json(['success'=>'change Success'], $this-> successStatus);
}

function groupchange_qty(Request $request){
  $length = $request['length'];
  $prodlist = $request['prodlist'];
  $qty = $request['prod_qty'];

  for($i = 0 ; $i < $request['length'];$i++){

    $updateStatus = DB::table('products')
    ->where('Prod_id', $prodlist[$i])
    ->update(['qty' => $qty]);

  }

  return response()->json(['success'=>'change Success'], $this-> successStatus);
}

function groupchange_delete(Request $request){
  $length = $request['length'];
  $prodlist = $request['prodlist'];

  for($i = 0 ; $i < $request['length'];$i++){

    $updateDelete = DB::table('products')
    ->where('Prod_id', $prodlist[$i])
    ->update(['status' => 2]);

  }

  return response()->json(['success'=>'change Success'], $this-> successStatus);
}

function change_sku(Request $request){
  $prod_id = $request['prod_id'];
  $sku = $request['prod_sku'];

    $updateSKU = DB::table('products')
    ->where('Prod_id', $prod_id)
    ->update(['sku' => $sku]);

  return response()->json(['success'=>'change Success'], $this-> successStatus);
}

function product_recommend(Request $request){
  $validator = Validator::make($request->all(), [
    'prod_id' => 'required'
  ]);

  if ($validator->fails()) {
   return response()->json(['error'=>$validator->errors()], 401);
 }

 $input = $request->all();

 $getCatProd_id = DB::table('products')
 ->where('prod_id', $input['prod_id'])->value('CatProd_id');

 $myproduct = DB::table('products')
 ->select('prod_id','prod_name','prod_price')
 ->where('prod_id', $input['prod_id'])
 ->get();

 $recommendProduct = DB::table('products')
 ->select('prod_id','prod_name','prod_price')
 ->where('CatProd_id', $getCatProd_id)
 ->where('prod_id', "!=" , $input['prod_id'])
 ->limit(5)
 ->get();

 return response()->json(['myproduct'=>$myproduct,'recommend'=>$recommendProduct], $this-> successStatus);
}

}
