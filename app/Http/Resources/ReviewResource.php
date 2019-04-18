<?php

namespace App\Http\Resources;
use DB;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $buyer = DB::table('buyers')->where('id', $this->Buyer_id)->value('name');
        return [
            'review_id' => $this->Review_id,
            'buyer' => $buyer,
            'description' => $this->description,
            'star' => $this->rating
        ];
    }
}
