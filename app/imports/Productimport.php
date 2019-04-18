<?php

namespace App\Imports;

use App\Product;
use App\Delivery_price;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Cookie;
use DB;
use App\Rmproduct;
use App\Colorproduct;
use App\Sizeproduct;
class ProductImport implements WithHeadingRow, ToModel
{

  public function model(array $row)
  {

    $rmCount = DB::table('rmproducts')->where('RM_value', $row['rm_value'])->count();
    $rmData = DB::table('rmproducts')->where('RM_value', $row['rm_value'])->pluck('RM_id');
    if($rmCount != 0)
    {
      $rm = str_replace('[', '', $rmData);
      $RM_id = str_replace(']', '', $rm);
    }else{
      $productRM = Rmproduct::create(
        ['CatProd_id' => $row['catproduct_id'],
        'RM_value' => $row['rm_value']
      ]);

      $RM_id = $productRM->id;
    }

    $colorCount = DB::table('colorProducts')->where('ColorProd_value', $row['colorproduct_value'])->count();
    $colorData = DB::table('colorProducts')->where('ColorProd_value', $row['colorproduct_value'])->pluck('ColorProd_id');
    if($colorCount != 0)
    {
      $color = str_replace('[', '', $colorData);
      $COLOR_id = str_replace(']', '', $color);
    }else{
      $productColor = Colorproduct::create(
        ['CatProd_id' => $row['catproduct_id'],
        'ColorProd_value' => $row['colorproduct_value']
      ]);

      $COLOR_id = $productColor->id;
    }

    $sizeCount = DB::table('sizeProducts')
    ->where('SizeProd_width', $row['width'])
    ->where('SizeProd_length', $row['length'])
    ->where('SizeProd_height', $row['height'])
    ->where('SizeProd_foot', $row['foot'])->count();
    $sizeData = DB::table('sizeproducts')
    ->where('SizeProd_width', $row['width'])
    ->where('SizeProd_length', $row['length'])
    ->where('SizeProd_height', $row['height'])
    ->where('SizeProd_foot', $row['foot'])->pluck('SizeProd_id');
    if($sizeCount != 0)
    {
      $size = str_replace('[', '', $sizeData);
      $SIZE_id = str_replace(']', '', $size);
    }else{
      $productSize = Sizeproduct::create(
        ['CatProd_id' => $row['catproduct_id'],
        'SizeProd_width' => $row['width'],
        'SizeProd_length' => $row['length'],
        'SizeProd_height' => $row['height'],
        'SizeProd_foot' => $row['foot']
      ]);

      $SIZE_id = $productSize->id;
    }
    if($row['pic_url1'] != ''){
      $status = 0;
    }else{
      $status = 1;
    }

    $product = Product::create(
      ['brand_id' => Cookie::get('b_id'),
      'CatProd_id' => $row['catproduct_id'],
      'SizeProd_id' => $SIZE_id,
      'ColorProd_id' => $COLOR_id,
      'RM_id' => $RM_id,
      'sku' => $row['prod_sku'],
      'prod_name'    => $row['prod_name'],
      'prod_desc'    => $row['prod_desc'],
      'prod_price'    => $row['prod_price'],
      'qty'    => $row['qty'],
      'show'    => $row['show'],
      'status'    => $status,
      'weight' => $row['weight'],
      'pic_url1' => $row['pic_url1'],
      'pic_url2' => $row['pic_url2'],
      'pic_url3' => $row['pic_url3'],
      'pic_url4' => $row['pic_url4'],
      'pic_url5' => $row['pic_url5']
    ]);

    $PID = $product->Prod_id;

  $kerry = Delivery_price::create(
   ['Prod_id' => $PID,
    'Delivery_id' => 1,
    'Price' => $row['kerry']
  ]);

  $dhl = Delivery_price::create(
   ['Prod_id' => $PID,
    'Delivery_id' => 2,
    'Price' => $row['dhl']
  ]);

  $sb = Delivery_price::create(
   ['Prod_id' => $PID,
    'Delivery_id' => 3,
    'Price' => $row['sb']
  ]);

  $ems = Delivery_price::create(
   ['Prod_id' => $PID,
    'Delivery_id' => 4,
    'Price' => $row['ems']
  ]);

  $buyer = Delivery_price::create(
   ['Prod_id' => $PID,
    'Delivery_id' => 5,
    'Price' => $row['buyer']
  ]);

  $seller = Delivery_price::create(
   ['Prod_id' => $PID,
    'Delivery_id' => 6,
    'Price' => $row['seller']
  ]);
  }
}
