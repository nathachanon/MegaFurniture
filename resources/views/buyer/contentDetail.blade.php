@extends('layouts.layout')
@section('content')

<style>
<style>
.preview{
  margin-left: 0px;
  max-height: 500px;
  width: 100%;
}
.content_pic{
  margin-left: 0px;
  max-height: 500px;
  width: 100%;
}
h3,p.{
  display: block;
}
</style>
  <div class="container">
    <div class="row">
      <h3>&nbsp;&nbsp;"{{ $contentDetail->content_name }}"</h3>
    </div>
      <div class="row">
          <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"{{ $contentDetail->created_at }}"</p>
        </div>
    <img  class="content_pic"src= "../images_content/{{ $contentDetail->content_pic }}"   > </img>

            <div class="row">
                <div class="col-md-12">
                    <div class="caption">

                        <div class="row">
                              <p >{!! $contentDetail->content_des !!}</p>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
<div class="col-md-12">

@endsection
