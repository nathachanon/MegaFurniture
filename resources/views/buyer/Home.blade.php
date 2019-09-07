@extends('layouts.layout')

@section('content')
<!-- Sweet Alert -->
<link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="layout/styles/shop_siderbar.css">

<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-b-sm">
                <div class="card">

                    <div id="slot1" class="card-body">
                        <div style=" width:100%; height: 355px !important;" id="carouselExampleControls"
                            class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100"
                                        src="https://sbmedia3.sbdesignsquare.com/output/images/content/98087/6e80858c35f52bcb3a99de4897bc9c67.jpg"
                                        alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100"
                                        src="https://sbmedia3.sbdesignsquare.com/output/images/content/98040/fb5990e830252df82bca4f46c2fbda65.jpg"
                                        alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100"
                                        src="https://sbmedia3.sbdesignsquare.com/output/images/banner/fd5022efc34e1d233a691e1080ebad0aresized_1920.jpg"
                                        alt="Third slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>


            </div>


            <div class="col-lg-4 m-b-sm">
                <div class="row">
                    <div class="col-lg-12 col-xs-12 col-md-12">
                        <div class="card h-promo">
                            <img src="https://sbmedia3.sbdesignsquare.com/output/images/content/97546/d1844d4421adcdd8f3637778ec06a53f.jpg"
                                class="card-img-top" alt="...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xs-12 col-md-12">

                        <div class="card h-promo">
                            <img src="https://sbmedia3.sbdesignsquare.com/output/images/content/96445/daf05693b98833a2b7e0614f38a6cdf3.jpg"
                                class="card-img-top" alt="...">
                        </div>

                    </div>

                </div>





            </div>
        </div><br>

        <!-- fdfdf -->
        <div class="row">
		<div class="col-md-12">
            <h3 class="text-center">ประเภทเฟอร์นิเจอร์</h3>
            <h5 class="text-center"><a href="/Index">ดูประเภทเฟอร์นิเจอร์ทั้งหมด></a></h5>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
	
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<div class="row">
						<div class="col-sm-3" onclick="go_Catprod('โซฟา')">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="https://www.ikea.com/PIAimages/0479958_PE619110_S5.JPG?f=s" class="img-responsive img-fluid" alt="">									
								</div>
								<div class="thumb-content">
									<h4>โซฟา</h4>																	
								</div>						
							</div>
						</div>
							
						<div class="col-sm-3" onclick="go_Catprod('เตียง')">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="https://www.baanandbeyond.com/media/catalog/product/cache/image/800x/beff4985b56e3afdbeabfc89641a4582/6/0/60270199.jpg" class="img-responsive img-fluid" alt="">
								</div>
								<div class="thumb-content">
									<h4>เตียงนอน</h4>																		
								</div>						
							</div>
                        </div>
                        								
						<div class="col-sm-3" onclick="go_Catprod('ชั้นวางทีวี')">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="https://www.chicrepublicthai.com/media/catalog/product/cache/1/image/800x800/9df78eab33525d08d6e5fb8d27136e95/C/T/CTV094-WOGL-NA5CL1-2_1.jpg" class="img-responsive img-fluid" alt="">
								</div>
								<div class="thumb-content">
									<h4>ชั้นวางทีวี</h4>																	
								</div>						
							</div>
                        </div>

                        <div class="col-sm-3" onclick="go_Catprod('โต๊ะทำงาน')">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="https://www.goodchoiz.com/content/images/thumbs/0038612_550.jpeg" class="img-responsive img-fluid" alt="">
								</div>
								<div class="thumb-content">
									<h4>โต๊ะทำงาน</h4>																	
								</div>						
							</div>
						</div>
					</div>
                </div>
                
				<div class="item carousel-item">
					<div class="row">
                    <div class="col-sm-3" onclick="go_Catprod('โต๊ะข้างเตียง')">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="https://www.chicrepublicthai.com/media/catalog/product/cache/1/image/800x800/9df78eab33525d08d6e5fb8d27136e95/C/N/CNT076-WOWO-NA2WH1-1_1.jpg" class="img-responsive img-fluid" alt="">
								</div>
								<div class="thumb-content">
									<h4>โต๊ะข้างเตียง</h4>
								</div>						
							</div>
                        </div>
                        
						<div class="col-sm-3" onclick="go_Catprod('ตู้หนังสือ')">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="https://www.chicrepublicthai.com/media/catalog/product/cache/1/image/800x800/9df78eab33525d08d6e5fb8d27136e95/C/B/CBS051-WOWO-NA2NA2-2_2.jpg" class="img-responsive img-fluid" alt="">
								</div>
								<div class="thumb-content">
									<h4>ตู้หนังสือ</h4>																		
								</div>						
							</div>
                        </div>
                        
						<div class="col-sm-3" onclick="go_Catprod('เก้าอี้')">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="https://aumento.officemate.co.th/media/catalog/product/O/F/OFMA010213.jpg?imwidth=320" class="img-responsive img-fluid" alt="">
								</div>
								<div class="thumb-content">
									<h4>เก้าอี้</h4>																	
								</div>						
							</div>
                        </div>
                        
						<div class="col-sm-3" onclick="go_Catprod('ตู้เสื้อผ้า')">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="https://www.chicrepublicthai.com/media/catalog/product/cache/1/image/800x800/9df78eab33525d08d6e5fb8d27136e95/C/W/CWD016-WOWO-WH1WH1-1_1.jpg" class="img-responsive img-fluid" alt="">
								</div>
								<div class="thumb-content">
									<h4>ตู้เสื้อผ้า </h4>																	
								</div>						
							</div>
						</div>						
					</div>
				</div>
				<div class="item carousel-item">
					<div class="row">
						<div class="col-sm-3" onclick="go_Catprod('ชั้นวางของ')">
							<div class="thumb-wrapper">
								<div class="img-box">
									<img src="https://www.ikea.com/PIAimages/0675716_PE718484_S5.JPG?f=s" class="img-responsive img-fluid" alt="">
								</div>
								<div class="thumb-content">
									<h4>ชั้นวางของ</h4>							
								</div>						
							</div>
						</div>
					
					</div>
				</div>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>

        <div class="row m-t-lg">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 m-b-xs">
                <h3>ไอเดียสำหรับคุณ</h3>
            </div>
            <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <h5 class="text-end"><a>ดูเพิ่มเติม></a></h5>
            </div>
            
            <div class="col-lg-12 col-md-12 m-b-sm">
                    <div class ="content-12">
                <div class="c-left">
                        <img src="https://sbmedia3.sbdesignsquare.com/output/images/content/98018/7351acf132199fa81f59bcd24092a76b.jpg"
                            class="card-img-top-content" alt="...">
                    </div>

                    <div  class="c-right card-body">
                        <h4 class="card-title content-title">ไอเดียเลือก “โคมไฟ” แต่งบ้านยังไงให้ปัง
                        </h4>
                        <p class="card-text content-over">“โคมไฟไม่ใช่แค่ให้แสงสว่าง..แต่ยังสร้างมิติให้บ้านสวยทรงเสน่ห์” เคยได้ยินไหมว่า ...พื้นที่ที่เต็มไปด้วยแสงสว่างจะช่วยสร้างพลังบวกได้เป็นอย่างดี 
                            ฉะนั้นนอกจากแสงธรรมชาติที่จำเป็นต่อห้องนั่งเล่นแล้ว โคมไฟก็เป็นอีกหนึ่งไอเท็มที่ขาดไม่ได้ 
                            เพราะโคมไฟนี่แหละที่จะเนรมิตพื้นที่สุดธรรมดาให้กลายเป็นมุมสุดพิเศษได้แบบรวดเร็วทันใจ ช่วยเปลี่ยน Mood ให้บ้านได้ง่ายที่สุด!! ไปดูไอเดีย</p>
                        <a href="#" class="btn btn-warning">อ่านต่อ..</a>
                    </div>
                </div>

            </div>

           
            <div class="col-lg-4 m-b-sm">
                <div class="card">
                    <img src="https://sbmedia3.sbdesignsquare.com/output/images/content/97992/e5df2060df9da8205fdbb448ebdb0c49.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title content-title">5 เหตุผลสำคัญกับการแต่งคอนโด สวย คุ้ม คอมพลีท!</h4>
                        <p class="card-text content-over">รีวิวการตกแต่งคอนโดจริงของห้องตัวอย่างในสไตล์ Metro Luxe จาก
                            Condo Solutions กับราคาเริ่มต้น 5,500.-
                            กับเหตุผลที่น่าสนใจว่าทำไมห้องนี้จึงคู่ควรกับเงินในกระเป๋าของ</p>
                        <a href="#" class="btn btn-warning">อ่านต่อ..</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 m-b-sm">
                <div class="card">
                    <img src="https://sbmedia3.sbdesignsquare.com/output/images/content/97899/bfced3b42014b4e03c155fd204d7bc4f.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title content-title">5 จุดสำคัญ ในการตกแต่งคอนโดสวยในสไตล์โมเดิร์น</h4>
                        <p class="card-text content-over">คอนโด Nara 9 มีขนาด 39 ตร.ม. แต่งในสไตล์ Modern
                            ที่ช่วยเสริมให้ห้องดูหรูหราด้วยลายหินอ่อนสีน้ำตาลและกระจกเงาทอง</p>
                        <a href="#" class="btn btn-warning">อ่านต่อ..</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 m-b-sm">
                <div class="card">
                    <img src="https://sbmedia3.sbdesignsquare.com/output/images/content/97819/b7b242365992cb96cf708a9ecab79cfd.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title content-title">แต่งห้องนั่งเล่นให้สวยมีสไตล์ด้วยชั้นวางทีวีดีไซน์พรีเมี่ยม
                        </h4>
                        <p class="card-text content-over">ห้องนั่งเล่น นอกจากจะเป็นมุมพักผ่อนของสมาชิกทุกคนในครอบครัว
                            และรับรองแขกผู้มาเยือนคนสำคัญแล้ว ยังเป็นมุมที่เผยถึงรสนิยมและความมีสไตล์ในตัวคุณอีกด้วย
                            ดังนั้น การ</p>
                        <a href="#" class="btn btn-warning">อ่านต่อ..</a>
                    </div>
                </div>
            </div>

            <div>
              


        </div>
   
    </div>
</div>

<style>
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
    

</style>
<script>
document.cookie = "home_Catprod=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
document.cookie = "searchProduct=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

function go_Catprod(name){
    createCookie('home_Catprod',name,60000);
    window.location.replace('/searchResult');
}

function createCookie(name, value, second) {
    if (second) {
        var date = new Date();
        date.setTime(date.getTime() + (second * 1000));
        var expires = "; expires=" + date.toGMTString();
    } else {
        var expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}
</script>
@endsection
