@extends('layouts.layout')
@section('content')


<style>
  /* Make the image fully responsive */


    .card-img-top-content{
    height: 220px;
    width: 100%;
    border-top-left-radius: calc(.25rem - 1px);
    border-top-right-radius: calc(.25rem - 1px);
    object-fit: cover;
}
    .content-12{
        min-height: 100%;
        position: relative;
        display: -ms-flexbox;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border-radius: .25rem;
    }
    .content-12:hover{
        box-shadow: 0 14px 28px rgba(0,0,0,0.15), 0 10px 10px rgba(0,0,0,0.18);
    }
    .shop {
    background: #f6f6f6fc;
    }
    .card{
        border:0;
    }

    .c-left {
        float:left;
        width: 50%;
    }

    .c-right {
        float:right;
        width: 50%;
    }

    #slot1 {
        flex: 1 1 auto;
        padding: 0;
    }

    .h-promo {
        height: 175px;
        margin-bottom: 5px;
    }

    .carousel-item>.w-100 {
        height: 355px;
        width: 100% !important;
        object-fit: cover;
    }

    .card-img-top {
        height: 175px;
        width: 100%;
        border-top-left-radius: calc(.25rem - 1px);
        border-top-right-radius: calc(.25rem - 1px);
        object-fit: cover;
    }

    .text-end {
        text-align: end;
    }

    .content-over {
        display: block;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .content-title {
        display: block;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .card:hover{
        box-shadow: 0 14px 28px rgba(0,0,0,0.15), 0 10px 10px rgba(0,0,0,0.18);
    }
    .carousel .thumb-wrapper:hover{
        cursor:pointer;
        box-shadow: 0 14px 28px rgba(0,0,0,0.15), 0 10px 10px rgba(0,0,0,0.18);
    }
#carouselExampleControls{
    margin:0px;
    padding:0px;
}



    .carousel {
	margin: 50px 0 0 0;
	padding: 0 70px;
}
.carousel .item {
	color: #747d89;
	min-height: 325px;
    text-align: center;
	overflow: hidden;
}
.carousel .thumb-wrapper {
	padding: 25px 15px;
	background: #fff;
	border-radius: 6px;
	text-align: center;
	position: relative;
	box-shadow: 0 2px 3px rgba(0,0,0,0.2);
}
.carousel .item .img-box {
	height: 120px;
	margin-bottom: 20px;
	width: 100%;
	position: relative;
}
.carousel .item img {	
	max-width: 100%;
	max-height: 100%;
	display: inline-block;
	position: absolute;
	bottom: 0;
	margin: 0 auto;
	left: 0;
	right: 0;
}
.carousel .item h4 {
	font-size: 18px;
}
.carousel .item h4, .carousel .item p, .carousel .item ul {
	margin-bottom: 5px;
}
.carousel .thumb-content .btn {
	color: #7ac400;
    font-size: 11px;
    text-transform: uppercase;
    font-weight: bold;
    background: none;
    border: 1px solid #7ac400;
    padding: 6px 14px;
    margin-top: 5px;
    line-height: 16px;
    border-radius: 20px;
}
.carousel .thumb-content .btn:hover, .carousel .thumb-content .btn:focus {
	color: #fff;
	background: #7ac400;
	box-shadow: none;
}
.carousel .thumb-content .btn i {
	font-size: 14px;
    font-weight: bold;
    margin-left: 5px;
}
.carousel .carousel-control {
	height: 44px;
	width: 40px;
	background: #f59121;	
    margin: auto 0;
    border-radius: 4px;
	opacity: 0.8;
}
.carousel .carousel-control:hover {
	background: #d77200;
	opacity: 1;
}
.carousel .carousel-control i {
    font-size: 36px;
    position: absolute;
    top: 50%;
    display: inline-block;
    margin: -19px 0 0 0;
    z-index: 5;
    left: 0;
    right: 0;
    color: #fff;
	text-shadow: none;
    font-weight: bold;
}
.carousel .item-price {
	font-size: 13px;
	padding: 2px 0;
}
.carousel .item-price strike {
	opacity: 0.7;
	margin-right: 5px;
}
.carousel .carousel-control.left i {
	margin-left: -2px;
}
.carousel .carousel-control.right i {
	margin-right: -4px;
}
.carousel .carousel-indicators {
	bottom: -50px;
}
.carousel-indicators li, .carousel-indicators li.active {
	width: 10px;
	height: 10px;
	margin: 4px;
	border-radius: 50%;
	border: none;
}
.carousel-indicators li {	
	background: rgba(0, 0, 0, 0.2);
}
.carousel-indicators li.active {	
	background: rgba(0, 0, 0, 0.6);
}
.carousel .wish-icon {
	position: absolute;
	right: 10px;
	top: 10px;
	z-index: 99;
	cursor: pointer;
	font-size: 16px;
	color: #abb0b8;
}
.carousel .wish-icon .fa-heart {
	color: #ff6161;
}
.star-rating li {
	padding: 0;
}
.star-rating i {
	font-size: 14px;
	color: #ffc000;
}
    



  body {
    background-color: #fafafa;
  }
</style>
<div class="shop">
  <div class="container">
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
      </div>


      <div class="wrapper wrapper-content animated fadeInRight">
      <div class="col-lg-12">
        <div id='listcontent' class="row m-t-lg">
        
            </div>




        </div>
      </div>
  </div>
  </div>
      </div>



  <script src="../js/jquery-2.1.1.js"></script>
  <script>
    getContent();

    function getContent() {
      $.ajax({
        type: "GET",
        url: "/api/getContent",
        success: function(data) {
            console.log(data);
            var c_count = data["content_count"];
            $('#listcontent').empty();
            for (var i = 0; i < c_count; i++) {
              $('#listcontent').append(
                '<div class="col-lg-4 m-b-sm">'+
                '<div class="card">'+
                '<img src="images_content/'+data["content"][i]["content_pic"]+'" class="card-img-top" alt="...">'+
                ' <div class="card-body">'+
                '  <h4 class="card-title content-title">'+data["content"][i]["content_name"]+'</h4>'+
                '   <p class="card-text content-over">'+data["content"][i]["content_des"]+'</p>'+
                '  <a href="/content/' + data["content"][i]["content_id"] + '" class="btn btn-warning">อ่านต่อ..</a>'+
                '   </div>'+
                ' </div>'+
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