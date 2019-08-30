@extends('layouts.layout')

@section('content')
<!-- Sweet Alert -->
<link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="layout/styles/shop_siderbar.css">

<div class="shop">
  <div class="container">
    <div class="row ">
      <div class="col-lg-3 ">

        <!-- Shop Sidebar -->
        <div class="shop_sidebar">
          <div class="sidebar_section ">
            <div class="sidebar_title "><div class="shop_bar-t clearfix"> หมวดหมู่สินค้า</div></div><br>
            <ul class="li">

              <li class="bor "><input   type="checkbox" id="cb1"/><label for="cb1">ห้องนอน </label>
                <ul >
                  <li  ><label onclick="searchCat('เตียง')">เตียง</label></li>
                  <li ><label onclick="searchCat('โต๊ะข้างเตียง')">โต๊ะข้างเตียง </label></li>
                  <li ><label onclick="searchCat('โซฟา')">โซฟา </label></li>
                  <li ><label onclick="searchCat('ตู้เสื้อผ้า')">ตู้เสื้อผ้า </label></li>
                </ul>
              </li>

              <li class="bor"><input   type="checkbox" id="cb2"/><label for="cb2">ห้องนั่งเล่น </label>
                <ul >
                  <li ><label  onclick="searchCat('เก้าอี้')">เก้าอี้ </label></li>
                  <li ><label  onclick="searchCat('ชั้นวางทีวี')">ชั้นวางทีวี</label></li>
                  <li ><label  onclick="searchCat('โซฟา')">โซฟา </label></li>
                  <li ><label  onclick="searchCat('ชั้นวางของ')">ชั้นวางของ </label></li>
                </ul>
              </li>

              <li class="bor"><input   type="checkbox" id="cb3"/><label for="cb3">ห้องทำงาน </label>
                <ul >
                  <li ><label  onclick="searchCat('โต๊ะทำงาน')">โต๊ะทำงาน</label></li>
                  <li ><label  onclick="searchCat('ตู้หนังสือ')">ตู้หนังสือ </label></li>
                </ul>
              </li>

            </ul><br>
            <p>
          <label for="amount">ช่วงราคาราคา:</label>
          <input type="number" id="min_price" placeholder="MIN"><input type="number" id="max_price" placeholder="MAX"><button type="button" onclick="search_price()">ตกลง</button>
        </p>
          </div>
       
      
        </div>
      </div>
      <div class="col-lg-9 ">

        <!-- Shop Content -->
        <div class="shop_sidebar">
          <div class="shop_bar clearfix">
            <div class="shop_product_count"><h4 id="p_counts"></h4></div>
            <div class="shop_sorting">
              <span>ค้นหาโดย:</span>
              <ul>
                <li>
                  <span class="sorting_text">คะแนนสินค้า<i class="fas fa-chevron-down"></span></i>
                  <ul>
                    <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }' id="rating">คะแนนสินค้า</li>
                    <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }' id="name">ชื่อสินค้า</li>
                    <li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }' id="price">ราคา</li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <br><br><br>
          <div class="row" id="product_list">
          </div>
        </div>
        <div id="small_cart">
        </div>

        <!-- Shop Page Navigation -->
        <div class="center">
          <div class="center  shop_page_nav d-flex flex-row">
            <div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
            <ul class="page_nav d-flex flex-row">
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">...</a></li>
              <li><a href="#">21</a></li>
            </ul>
            <div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
          </div>
        </div>
      </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Script -->
    <script src="js/Scripts/megaindex.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  document.cookie = "searchCat=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 100000,
      values: [ 75, 30000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] +" บาท");
      }
    });
    $( "#amount" ).val(  $( "#slider-range" ).slider( "values", 0 ) +
      " - " + $( "#slider-range" ).slider( "values", 1 ) + " บาท" );
  } );
  </script>

<style>
.ui-slider .ui-slider-range{
  background-color:#f59121;
}

.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover{
  border: 1px solid #f59121;
    background: #ffffff;
    font-weight: normal;
    color: #ffffff;
}
</style>

@endsection
