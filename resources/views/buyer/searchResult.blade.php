@extends('layouts.layout')

@section('content')

<style type="text/css">
    .center-cropped {
        width: 250px;
        height: 250px;
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
<link rel="stylesheet" type="text/css" href="layout/styles/shop_siderbar.css">
<div class="shop">
    <div class="container">
        <div class="row ">
            <div class="col-lg-3 ">

                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section ">
                        <div class="sidebar_title ">
                            <div class="shop_bar-t clearfix"> หมวดหมู่สินค้า</div>
                        </div><br>
                        <ul class="li">

                            <li id="side" class="bor"><input type="checkbox" id="cb1" /><label for="cb1">ห้องนอน
                                </label>
                                <ul>
                                    <li><label onclick="searchCat('เตียง')">เตียง</label></li>
                                    <li><label onclick="searchCat('โต๊ะข้างเตียง')">โต๊ะข้างเตียง </label></li>
                                    <li><label onclick="searchCat('โซฟา')">โซฟา </label></li>
                                    <li><label onclick="searchCat('ตู้เสื้อผ้า')">ตู้เสื้อผ้า </label></li>

                                </ul>
                            </li>

                            <li id="side" class="bor"><input type="checkbox" id="cb2" /><label for="cb2">ห้องนั่งเล่น
                                </label>
                                <ul>
                                    <li><label onclick="searchCat('เก้าอี้')">เก้าอี้ </label></li>
                                    <li><label onclick="searchCat('ชั้นวางทีวี')">ชั้นวางทีวี</label></li>
                                    <li><label onclick="searchCat('โซฟา')">โซฟา </label></li>
                                    <li><label onclick="searchCat('ชั้นวางของ')">ชั้นวางของ </label></li>

                                </ul>
                            </li>

                            <li id="side" class="bor"><input type="checkbox" id="cb3" /><label for="cb3">ห้องทำงาน
                                </label>
                                <ul>
                                    <li><label onclick="searchCat('โต๊ะทำงาน')">โต๊ะทำงาน</label></li>
                                    <li><label onclick="searchCat('ตู้หนังสือ')">ตู้หนังสือ </label></li>
                                </ul>
                            </li>

                        </ul>
                        <br>
                        <hr>
                        <label for="amount">สี:</label>

                        <div class="group_color">
                            <label id="black">
                                <input id="black_c" value="ดำ" type="checkbox" class="option-input checkbox"
                                    onclick="color_select(this)" />
                                ดำ
                            </label>
                            <label id="red">
                                <input id="red_c" type="checkbox" value="แดง" class="option-input checkbox"
                                    onclick="color_select(this)" />
                                แดง
                            </label>
                            <label id="brown">
                                <input id="brown_c" value="น้ำตาล" type="checkbox" class="option-input checkbox"
                                    onclick="color_select(this)" />
                                น้ำตาล
                            </label>
                            <label id="grey">
                                <input id="grey_c" type="checkbox" value="เทา" class="option-input checkbox"
                                    onclick="color_select(this)" />
                                เทา
                            </label>
                            <label id="blue">
                                <input id="blue_c" value="ฟ้า" type="checkbox" class="option-input checkbox"
                                    onclick="color_select(this)" />
                                ฟ้า
                            </label>
                            <label id="green">
                                <input id="green_c" type="checkbox" value="เขียว" class="option-input checkbox"
                                    onclick="color_select(this)" />
                                เขียว
                            </label>
                            <label id="orange">
                                <input id="orange_c" value="ส้ม" type="checkbox" class="option-input checkbox"
                                    onclick="color_select(this)" />
                                ส้ม
                            </label>
                            <label id="violet">
                                <input id="violet_c" value="ม่วง" type="checkbox" class="option-input checkbox"
                                    onclick="color_select(this)" />
                                ม่วง
                            </label>
                        </div>
                        <hr>

                        <label for="amount">ช่วงราคา:</label>
                        <div class="price_range_div">
                            <input class="price_range" type="number" id="min_price" placeholder="น้อยที่สุด">
                            <p class="range">ถึง</p>
                            <input class="price_range" type="number" id="max_price" placeholder="มากที่สุด">
                        </div><br>
                        <button class="btn btn-block btn-warning" type="button" onclick="search_price()">ตกลง</button>
                    </div><Br>
                    <hr>

                </div>
            </div>
            <div class="col-lg-9 ">

                <!-- Shop Content -->
                <div class="shop_sidebar">
                    <div class="shop_bar clearfix">
                        <div class="shop_product_count">
                            <h3 id="p_counts"></h3>
                        </div>
                        <div class="shop_sorting">
                        <span>ค้นหาโดย:</span>
                            <ul>
                                <li>
                                    <span class="sorting_text">ตัวเลือก<i class="fas fa-chevron-down"></span></i>
                                    <ul>
                                        <li class="shop_sorting_button" id="ratingMin">คะแนนสินค้า ต่ำ - สูง
                                        </li>
                                        <li class="shop_sorting_button" id="ratingMax">คะแนนสินค้า สูง - ต่ำ
                                        </li>
                                      
                                        <li class="shop_sorting_button" 
                                            id="priceMin">ราคา ต่ำ - สูง</li>
                                            <li class="shop_sorting_button" 
                                            id="priceMax">ราคา สูง - ต่ำ</li>
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

            </div>
        </div>
        <script src="js/jquery-2.1.1.js"></script>

        <script src="js/Scripts/searchResult.js"></script>
        <script src="js/Scripts/filter.js"></script>
       
        @endsection
