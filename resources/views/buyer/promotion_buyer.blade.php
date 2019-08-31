@extends('layouts.layout')
@section('content')


<style>
  /* Make the image fully responsive */
  .carousel-inner img {

      width: 80%;
      height: 500px;
  }
  </style>

<center>
<h3>โปรโมชัน</h3>
<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>

  </ul>

<div class="carousel-inner">

</div>
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

<script src="../js/jquery-2.1.1.js"></script>
<script>

getPromotion();
function getPromotion(){
  $.ajax({
    type: "GET",
    url: "/api/getPromotion",
    success: function(data){
      console.log(data);

      var p_count = data['promotion_count']-1;
      $('.carousel-inner').append(
      '<div class="carousel-item active">'+
      '<a href="/promotion/'+data["promotion"][p_count]["promotion_id"]+'">'+
        '<img src="../images_promotion/'+ data["promotion"][p_count]["promotion_pic"]+'" alt="" width="1100" height="500">'+
      '</a></div>');
      for(var i=data["promotion"].length-2 ;i>=0 ;i--){
        console.log(i);
        $('.carousel-inner').append(
            '<div class="carousel-item">'+
            '<a href="/promotion/'+data["promotion"][i]["promotion_id"]+'">'+
              '<img src="../images_promotion/'+ data["promotion"][i]["promotion_pic"]+'" alt="" width="1100" height="500">'+
            '</a></div>');

      }
        console.log(i);
      for(var i=1 ;i<data['promotion_count'];i++){

      $('.carousel-indicators').append(
        '<li data-target="#demo" data-slide-to="'+i+'"></li>'
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
