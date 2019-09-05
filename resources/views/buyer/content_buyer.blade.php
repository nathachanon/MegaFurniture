@extends('layouts.layout')
@section('content')


<style>
  /* Make the image fully responsive */
  .carousel-inner img {

      width: 80%;
      height: 500px;
  }
  body{
    background-color: #fafafa;
  }
  </style>
  <div id="wrapper">
  <div class="row">
<div class="col-lg-12">
  <div class="row wrapper border-bottom white-bg page-heading">
                  <div class="col-sm-4">
                      <h2>คอนเทนต์</h2>
                      <ol class="breadcrumb">
                          <li>
                              <a href="content">คอนเทนต์</a>
                          </li>
                          <li class="active">
                              <strong> /บทความ</strong>
                          </li>
                      </ol>
                  </div>
              </div>
              <div class="col-lg-12">
                    <div class="wrapper wrapper-content animated fadeInRight">
                      <div id='listcontent'>
                      </div>
                        <div class="vote-item">
                            <div class="row">
                                <div class="col-md-10">
                                    <a href="#" class="vote-title">
                                        It is a long established fact that a reader will be distracted
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
              </div>
            </div>
          </div>


<script src="../js/jquery-2.1.1.js"></script>
<script>

getContent();
function getContent(){
  $.ajax({
    type: "GET",
    url: "/api/getContent",
    success: function(data){
      console.log(data);
      var c_count = data["content_count"];
      $('#listcontent').empty();
      for(var i=0 ;i<c_count ;i++){
      $('#listcontent').append(
        '<div class="vote-item">'+
            '<div class="row">'+
                '<div class="col-md-10">'+
                    '<a href="/content/'+data["content"][i]["content_id"]+'" class="vote-title">'+
                      data["content"][i]["content_name"] +
                    '</a>'+
                '</div>'+
            '</div>'+
        '</div>'

      );
    }
    }

    ,
    failure: function(errMsg) {
      alert(errMsg);
    }
  });
}
</script>


@endsection
