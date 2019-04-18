<?php

namespace App\Http\Resources;
use DB;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {

       $search1 = DB::table('products')
       ->select('Prod_id','prod_name')
       ->where('prod_name', 'like', $request->product_name)
       ->get();

      // $t = $search1[]->Prod_id;
      /* $searchcount = DB::table('products')
       ->select('Prod_id','prod_name')
       ->where('prod_name', 'like', $input['product_name'])
       ->count();
       $buyer = DB::table('buyers')->where('id', $this->Buyer_id)->value('name');*/
      $total = count((array)$search1[2]);
   
   return [
      
          'product' => $total,
          'product2' => $search1
           
       
        
         ];
     
        
}
}
