<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use  DB;
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
      $prod_count = DB::table('products')->select('RM_value','SizeProd_width','SizeProd_height','SizeProd_length','ColorProd_value','weight')
      ->join('rmproducts', 'products.RM_id', '=', 'rmproducts.RM_id')
      ->join('sizeproducts', 'products.SizeProd_id', '=', 'sizeproducts.SizeProd_id')
      ->join('colorproducts', 'products.ColorProd_id', '=', 'colorproducts.ColorProd_id')
      ->where('status',0)->where('show',0)
      ->where('Prod_id', $this->Prod_id)->count();

      $prod_info = DB::table('products')->select('CatRoom_Name','CatProd_Name','RM_value','SizeProd_width','SizeProd_height','SizeProd_length','SizeProd_foot','ColorProd_value','weight')
      ->join('rmproducts', 'products.RM_id', '=', 'rmproducts.RM_id')
      ->join('catagoiesproducts', 'products.CatProd_id', '=', 'catagoiesproducts.CatProd_id')
      ->join('catagoiesrooms', 'catagoiesproducts.CatRoom_id', '=', 'catagoiesrooms.CatRoom_id')
      ->join('sizeproducts', 'products.SizeProd_id', '=', 'sizeproducts.SizeProd_id')
      ->join('colorproducts', 'products.ColorProd_id', '=', 'colorproducts.ColorProd_id')
      ->where('status',0)->where('show',0)
      ->where('Prod_id', $this->Prod_id)->first();


      $prod_pic = DB::table('products')->select('pic_url1','pic_url2','pic_url3','pic_url4','pic_url5')
      ->where('status',0)->where('show',0)->where('Prod_id', $this->Prod_id)->first();

      $prod_delivery = DB::select( DB::raw("SELECT deliverys.DeliveryName , delivery_prices.Price FROM `products`
       join  delivery_prices on products.Prod_id = delivery_prices.Prod_id join deliverys on delivery_prices.Delivery_id = deliverys.Delivery_id where products.status = 0 and products.show = 0 and products.Prod_id = :somevariable"), array(
        'somevariable' => $this->Prod_id,
      ));

      $getRating = DB::select( DB::raw("SELECT ROUND(AVG(rating),1) as RatingAVG from reviews where Prod_id = :somevariable"), array(
         'somevariable' => $this->Prod_id,
       ));

       $getReview = DB::select( DB::raw("SELECT rating , description , name , surname , reviews.created_at FROM `reviews` join buyers on reviews.Buyer_id = buyers.id WHERE `Prod_id` = :somevariable"), array(
          'somevariable' => $this->Prod_id,
        ));

      if($prod_count == 0){
        return [
          'product'=>'IS NULL'
        ];
      
      }else{
        return ['foot' => $prod_info->SizeProd_foot,
        'RatingAVG2' => $getRating,
        'Comment' => $getReview,
        'CatRoom_name' => $prod_info->CatRoom_Name,
        'CatProd_name' => $prod_info->CatProd_Name,
        'prod_id' => $this->Prod_id,
        'name' => $this->prod_name,
        'description' => $this->prod_desc,
        'price' => $this->prod_price,
        'stock' => $this->qty == 0 ? 'Out of stock' : $this->qty,
        'Color'=> $prod_info->ColorProd_value,
        'Material'=> $prod_info->RM_value,
        'Size' =>  "" . $prod_info->SizeProd_width . " x " . $prod_info->SizeProd_length . " x ". $prod_info->SizeProd_height ."",
        'Weight'=> $prod_info->weight ." kg",
        'Picture'=> $prod_pic,
        'Delivery'=> $prod_delivery,
        'Review'=> [
          'Link' => route('reviews.index',$this->Prod_id)
        ]

      ];
    }
  }
}
