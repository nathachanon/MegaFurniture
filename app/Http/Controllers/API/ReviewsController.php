<?php

namespace App\Http\Controllers\API;


use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\ReviewResource;
use App\Product;
use App\Review;
use Validator;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;


class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $products) //$products match in database
    {

       return ReviewResource::collection($products->reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request,Product $products)
    {
         $validator = Validator::make($request->all(), [
                'buyer_id' => 'required',
                'rating' => 'required|between:0,5'

  ]);

   if ($validator->fails()) {
     return response()->json(['error'=>$validator->errors()], 401);
   }

        $review = new Review($request->all());
        $products->reviews()->save($review);
        return Response([
            'data' => 'Review Success'
        ],201);
    }


    public function show(Reviews $reviews)
    {
        //
    }


    public function edit(Reviews $reviews)
    {
        //
    }


    public function update(Request $request, Product $products, Reviews $review)
    {
        //
    }


    public function destroy(Reviews $reviews)
    {
        //
    }
}
