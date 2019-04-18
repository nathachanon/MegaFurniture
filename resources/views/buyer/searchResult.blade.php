@extends('layouts.layout')

@section('content')

<style type="text/css">
  .center-cropped {
    width: 250px;
    height:250px;
    background-position: center center;
    background-repeat: no-repeat;
  }
  .center-cropped img {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    background-attachment: fixed;
  }
</style>
<div class="shop">
  <div class="container">
    <div class="row ">
      <div class="col-lg-3 ">

        <!-- Shop Sidebar -->
        <div class="shop_sidebar">
          <div class="sidebar_section ">
            <div class="sidebar_title "><div class="shop_bar-t clearfix"> หมวดหมู่สินค้า</div></div><br>
            <ul class="li">

              <li class="bor"><input   type="checkbox" id="cb1"/><label for="cb1">ห้องนอน </label>
                <ul >
                  <li ><label onclick="searchCat('เตียง')">เตียง</label></li>
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

            </ul>
          </div>
          <div class="sidebar_section filter_by_section">
            <div class="sidebar_title">Filter By</div>
            <div class="sidebar_subtitle">Price</div>
            <div class="filter_price">
              <div id="slider-range" class="slider_range"></div>
              <p>Range: </p>
              <p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
            </div>
          </div>
          <div class="sidebar_section">
            <div class="sidebar_subtitle color_subtitle">Color</div>
            <ul class="colors_list">
              <li class="color"><a href="#" style="background: #b19c83;"></a></li>
              <li class="color"><a href="#" style="background: #000000;"></a></li>
              <li class="color"><a href="#" style="background: #999999;"></a></li>
              <li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
              <li class="color"><a href="#" style="background: #df3b3b;"></a></li>
              <li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-9 ">

        <!-- Shop Content -->
        <div class="shop_sidebar">
          <div class="shop_bar clearfix">
            <div class="shop_product_count"><h3 id="p_counts"></h3></div>
            <div class="shop_sorting">
              <span>Sort by:</span>
              <ul>
                <li>
                  <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                  <ul>
                    <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                    <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
                    <li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <br><br><br>
          <div class="row" id="product_list">
          </div>
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
    <script src="js/jquery-2.1.1.js"></script>

    <script src="js/Scripts/searchResult.js"></script>
@endsection
