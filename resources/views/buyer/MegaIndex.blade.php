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
                        <div class="sidebar_title ">
                            <div class="shop_bar-t clearfix"> หมวดหมู่สินค้า</div>
                        </div><br>
                        <ul class="li">

                            <li id="side" class="bor "><input type="checkbox" id="cb1" /><label for="cb1">ห้องนอน
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

                        </ul><br>
                        <hr>
                        <label for="amount">สี:</label>

                        <div class="group_color">
                            <label id="black">
                                <input id="black_c" value="ดำ" type="checkbox" class="option-input checkbox" onclick="color_select(this)"/>
                                ดำ
                            </label>
                            <label id="red">
                                <input id="red_c" type="checkbox" value="แดง" class="option-input checkbox" onclick="color_select(this)"/>
                                แดง
                            </label>
                            <label id="brown">
                                <input id="brown_c" value="น้ำตาล" type="checkbox" class="option-input checkbox" onclick="color_select(this)"/>
                                น้ำตาล
                            </label>
                            <label id="grey">
                                <input id="grey_c" type="checkbox" value="เทา" class="option-input checkbox" onclick="color_select(this)"/>
                                เทา
                            </label>
                            <label id="blue">
                                <input id="blue_c" value="ฟ้า" type="checkbox" class="option-input checkbox" onclick="color_select(this)"/>
                                ฟ้า
                            </label>
                            <label id="green">
                                <input id="green_c" type="checkbox" value="เขียว" class="option-input checkbox" onclick="color_select(this)"/>
                                เขียว
                            </label>
                            <label id="orange">
                                <input id="orange_c" value="ส้ม" type="checkbox" class="option-input checkbox" onclick="color_select(this)"/>
                                ส้ม
                            </label>
                            <label id="violet">
                                <input id="violet_c" value="ม่วง" type="checkbox" class="option-input checkbox" onclick="color_select(this)"/>
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
                            <h4 id="p_counts"></h4>
                        </div>
                        <div class="shop_sorting">
                            <span>ค้นหาโดย:</span>
                            <ul>
                                <li>
                                    <span class="sorting_text" id="select_fillter">ตัวเลือก<i class="fas fa-chevron-down"></span></i>
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
                <div id="small_cart">
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
            $(function () {
                $("#slider-range").slider({
                    range: true,
                    min: 0,
                    max: 100000,
                    values: [75, 30000],
                    slide: function (event, ui) {
                        $("#amount").val(ui.values[0] + " - " + ui.values[1] + " บาท");
                        console.log(ui.values[0])
                    }
                });
                $("#amount").val($("#slider-range").slider("values", 0) +
                    " - " + $("#slider-range").slider("values", 1) + " บาท");
            });

        </script>

        <style>
            .ui-slider .ui-slider-range {
                background-color: #f59121;
            }

            .ui-state-active,
            .ui-widget-content .ui-state-active,
            .ui-widget-header .ui-state-active,
            a.ui-button:active,
            .ui-button:active,
            .ui-button.ui-state-active:hover {
                border: 1px solid #f59121;
                background: #ffffff;
                font-weight: normal;
                color: #ffffff;
            }

            .price_range {
                line-height: 30px;
                width: 100px;
                padding-left: 5px;
            }

            .range {
                margin: 0px 20px;
            }

            .price_range_div {
                display: flex;
                justify-content: center;

            }

            .group_color {
                display: flow-root;
            }


            .option-input {
                -webkit-appearance: none;
                -moz-appearance: none;
                -ms-appearance: none;
                -o-appearance: none;
                appearance: none;
                position: relative;
                top: 5px;
                right: 0;
                bottom: 0;
                left: 0;
                height: 20px;
                width: 20px;
                transition: all 0.15s ease-out 0s;
                background: #dedede;
                border: none;
                border-radius: 5px;
                color: #fff;
                cursor: pointer;
                display: inline-block;
                margin-right: 0.5rem;
                outline: none;
                position: relative;
                z-index: 1000;
            }

            .option-input:hover {
                background: #d3d3d3;
            }

            #black .option-input:checked {
                background: #464141;
            }

            #red .option-input:checked {
                background: #e01919;
            }

            #brown .option-input:checked {
                background: #a56c3e;
            }

            #grey .option-input:checked {
                background: #989494;
            }

            #blue .option-input:checked {
                background: #479df3;
            }

            #green .option-input:checked {
                background: #2ca21d;
            }

            #orange .option-input:checked {
                background: #ffba00;
            }

            #violet .option-input:checked {
                background: #8e0270;
            }

            .option-input:checked::before {
                height: 20px;
                width: 20px;
                position: absolute;
                content: '✔';
                display: inline-block;
                font-size: 20px;
                text-align: center;
                line-height: 20px;
            }

            .option-input:checked::after {
                -webkit-animation: click-wave 0.65s;
                -moz-animation: click-wave 0.65s;
                animation: click-wave 0.65s;
                background: #40e0d0;
                content: '';
                display: block;
                position: relative;
                z-index: 100;
            }

            .option-input.radio {
                border-radius: 50%;
            }

            .option-input.radio::after {
                border-radius: 50%;
            }

        </style>

        @endsection
