@extends('layouts.layout')
@section('content')

<style>
<style>
.preview{
  margin-left: 0px;
  max-height: 500px;
  width: 100%;
}
.promotion_pic{
  margin-left: 0px;
  max-height: 500px;
  width: 100%;
}
h3,p.{
  display: block;
}
</style>

    <img  class="promotion_pic"src= "../images_promotion/{{ $promotionDetail->promotion_pic }}"   > </img>
    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="caption">
                        <div class="row">
                          <h3>{{ $promotionDetail->promotion_name }}</h3>
                        </div>
                        <div class="row">
                              <p >{!! $promotionDetail->promotion_des !!}</p>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
<div class="col-md-12">

@endsection
