@extends('layouts.layout')


@section('content')
<link rel="stylesheet" type="text/css" href="layout/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="layout/styles/product_responsive.css">
<link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<div class="single_product">


	<div class="container">
		<div class="row" id="show">
		</div>

		<hr>

		<div class="row">
			<div class="col-md-12" id="desc">
			</div>
		</div>
	</div>
</div>
<hr>
<div class="wrapper wrapper-content2 animated fadeInRight">
	<h4 class="viewed_title">สินค้าแนะนำ</h4>
	<div class="row" id="recommend-list">
	</div>
</div>
<hr>

<div class="viewed">
	<div class="container">
		<div class="row">

			<div class="viewed_title_container">
				<h4 class="viewed_title">คะแนนของสินค้า</h4>

			</div>
			<div class="col-md-12 bg-cc">
				<div class="row">
					<div class="col-lg-3 ct" id="Rating_AVG">
					</div>
					<div class="col-lg-8">

						<button type="button" class="btn mr10 btn-outline btn-warning">ทั้งหมด</button>
						<button type="button" class="btn mr10 btn-outline btn-warning">5 ดาว(1)</button>
						<button type="button" class="btn mr10 btn-outline btn-warning">4 ดาว(0)</button>
						<button type="button" class="btn mr10 btn-outline btn-warning">3 ดาว(0)</button>
						<button type="button" class="btn mr10 btn-outline btn-warning">2 ดาว(0)</button>
						<button type="button" class="btn mr10 btn-outline btn-warning">1 ดาว(0)</button>



					</div>
				</div>

			</div>
			<div class="col-md-12 bg-c" id="comment">
			</div>
		</div>
	</div>
</div>



<script src="layout/js/jquery-3.3.1.min.js"></script>
<script src="layout/js/product_custom.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/plugins/sweetalert/sweetalert.min.js"></script>

<script src="js/Scripts/megaindex.js"></script>
<script>

	if(getCookie() != null)
	{
		var prod_id = getCookie();

		$(document).ready(function(){
			$("#sub_review").click(function(){
				$.ajax({
					type: "POST",
					url: "/api/products/"+prod_id+"/reviews",
					headers: {
						'Content-Type':'application/json'
					},
					data: JSON.stringify({
						"buyer_id": 1,
						"rating": $("input[name='rating']:checked").val(),
						"description": $('#reiview_content').val()
					}),
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					success: function(data){
						getComment();
						console.log(data);

					},
					failure: function(errMsg) {
						alert(errMsg);
					}
				});
			})
		});

		getProduct();

	}else{
		window.location.replace('/');
	}

	function getCookie() {
		var names = 'viewProduct';
		var value = "; " + document.cookie;
		var parts = value.split("; " + names + "=");
		if (parts.length == 2) return parts.pop().split(";").shift();
	}
	function getComment(){
		$('#reiview_content').val("");

		$("input[name='rating']").attr("checked", false);

		$('#comment').empty();
		$('#Rating_AVG').empty();
		$.ajax({
			type: "GET",
			url: "/api/products/"+prod_id,
			contentType: "application/json; charset=utf-8",
			dataType: "json",
			success: function(data){
				console.log(data['data']);
				if(data['data'] != ''){
					for(var x = 0 ; x < data['data']['Comment']['length'] ; x++){
						var rating_point = data['data']['Comment'][x]['rating'];
						if(0 < rating_point && rating_point <= 0.5)
						{
							rating =
							'<span class="fa fa-star-half-full"></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>';
						}else if(0.5 < rating_point && rating_point <= 1){
							rating =
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>';
						}else if(1 < rating_point && rating_point <= 1.5){
							rating =
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star-half-full"></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>';
						}else if(1.5 < rating_point && rating_point <= 2){
							rating =
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>';
						}else if(2 < rating_point && rating_point <= 2.5){
							rating =
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star-half-full"></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>';
						}else if(2.5 < rating_point && rating_point <= 3){
							rating =
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>';
						}else if(3 < rating_point && rating_point <= 3.5){
							rating =
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star-half-full"></span>'+
							'<span class="fa  fa-grey fa-star "></span>';
						}else if(3.5 < rating_point && rating_point <= 4){
							rating =
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-grey fa-star "></span>';
						}else if(4 < rating_point  && rating_point <= 4.5){
							rating =
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star-half-full"></span>';
						}else if(4.5 < rating_point  && rating_point <= 5){
							rating =
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>'+
							'<span class="fa fa-star checked"></span>';
						}else{
							rating =
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>'+
							'<span class="fa  fa-grey fa-star "></span>';
						}
						$('#comment').append('<div class="product-rating animated fadeIn">'+
							'<div class="product-rating-avatar">'+
							'<div class="avatar">'+
							'<img src="img/a8.jpg">'+
							'</div>'+
							'</div>'+
							'<div class="product-rating-main">'+
							'<div class="product-rating-author-name">'+data['data']['Comment'][x]['name']+' '+data['data']['Comment'][x]['surname']+'</div>'+
							'<fieldset class="rating2"  id="rating2">'+
							rating +
							'</fieldset>'+
							'<div class="product-rating-content">'+data['data']['Comment'][x]['description']+'</div>'+
							'<div class="product-rating-time">'+data['data']['Comment'][x]['created_at']+'</div>'+
							'</div>'+
							'</div>');
					}

					var rating_point = data['data']['RatingAVG2'][0]['RatingAVG'];
					if(0 < rating_point && rating_point <= 0.5)
					{
						rating =
						'<span class="fa fa-star-half-full"></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}else if(0.5 < rating_point && rating_point <= 1){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}else if(1 < rating_point && rating_point <= 1.5){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star-half-full"></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}else if(1.5 < rating_point && rating_point <= 2){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}else if(2 < rating_point && rating_point <= 2.5){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star-half-full"></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}else if(2.5 < rating_point && rating_point <= 3){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}else if(3 < rating_point && rating_point <= 3.5){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star-half-full"></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}else if(3.5 < rating_point && rating_point <= 4){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-grey fa-star "></span>';
					}else if(4 < rating_point  && rating_point <= 4.5){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star-half-full"></span>';
					}else if(4.5 < rating_point  && rating_point <= 5){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>';
					}else{
						rating =
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}
					$('#Rating_AVG').append('<h4 class="viewed_title">'+(data['data']['RatingAVG2'][0]['RatingAVG'] != null ? data['data']['RatingAVG2'][0]['RatingAVG']:0)+'  เต็ม  5</h4>'+
						'<fieldset class="rating ct">'+
						rating+
						'</fieldset>');
				}
			},
			failure: function(errMsg) {
				alert(errMsg);
			}
		});

}

function getProduct(){
	$.ajax({
		type: "GET",
		url: "/api/products/"+getCookie(),
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		success: function(data){
			console.log(data['data']);
			if(data['data'] != ''){
				$('#show').append('<div class="col-lg-2 order-lg-1 order-2">'+
					'<ul class="image_list">'+
					(data['data']['Picture']['pic_url1'] != null ? '<li data-image="'+data['data']['Picture']['pic_url1']+'"><img src="'+data['data']['Picture']['pic_url1']+'" alt=""></li>':'')+
					(data['data']['Picture']['pic_url2'] != null ? '<li data-image="'+data['data']['Picture']['pic_url2']+'"><img src="'+data['data']['Picture']['pic_url2']+'" alt=""></li>':'')+
					(data['data']['Picture']['pic_url3'] != null ? '<li data-image="'+data['data']['Picture']['pic_url3']+'"><img src="'+data['data']['Picture']['pic_url3']+'" alt=""></li>':'')+
					(data['data']['Picture']['pic_url4'] != null ? '<li data-image="'+data['data']['Picture']['pic_url4']+'"><img src="'+data['data']['Picture']['pic_url4']+'" alt=""></li>':'')+
					(data['data']['Picture']['pic_url5'] != null ? '<li data-image="'+data['data']['Picture']['pic_url5']+'"><img src="'+data['data']['Picture']['pic_url5']+'" alt=""></li>':'')+
					'</ul>'+
					'</div>'+
					'<div class="col-lg-6 order-lg-2 order-1">'+
					'<div class="image_selected"><img src="'+data['data']['Picture']['pic_url1']+'" alt=""></div>'+
					'</div>'+
					'<div class="col-lg-4 order-3">'+
					'<div class="product_description">'+
					'<div class="product_category"><a href="#">#'+data['data']['CatRoom_name']+'</a> <a href="#">#'+data['data']['CatProd_name']+'</a></div>'+
					'<div class="product_name">'+data['data']['name']+'</div>'+
					'<div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>'+
					'<div class="product_price">'+data['data']['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' บาท</div>'+
					'<div class="product_text"><p>'+data['data']['description']+'</p></div><br>'+
					'<div class=" d-flex flex-row">'+
					'<form action="#">'+
					'<div class="clearfix" style="z-index: 1000;">'+
					'<div class="product_quantity clearfix">'+
					'<span>จำนวน: </span>'+
					'<input id="quantity_input" type="text" pattern="[0-9]*" value="1" min="1" max="'+data['data']['stock']+'">'+
					'<div class="quantity_buttons">'+
					'<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>'+
					'<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>'+
					'</div>'+
					'</div>'+
					'</div>'+
					'<div class="button_container">'+
					'<button type="button" class="button cart_button" onclick="addCart(\'' + data['data']['name'] + '\','+data['data']['prod_id']+','+data['data']['price']+',\'' + data['data']['Picture']['pic_url1'] + '\')">เพิ่มใส่ตะกร้า</button>'+
					'<div class="product_fav"><i class="fas fa-heart"></i></div>'+
					'<h4>สินค้าจากร้าน : '+data['data']['ShopName']+' '+data['data']['ShopSurname']+'</h4>'+
					'<p>แบรนด์ : '+data['data']['BrandName']+'</p>'+
					'</div>'+
					'</form>'+
					'</div>'+
					'</div>'+
					'</div>');
				var prod_foots = '';
				if(data['data']['foot'] == null){
					prod_foots = "-";
				}else{
					prod_foots = data['data']['foot'];
				}
				$('#desc').append('<h4>รายละเอียดสินค้า</h4>'+
					'<div class=" text-muted des-bt" id="prod_desc">'+
					'</div>'+
					'<div class="row deriery-mt grey ">'+
					'<div class="col-sm-5">'+
					'<dt>วัสดุ</dt>'+
					'<dt>สี</dt>'+
					'<dt>ขนาด กว้าง x ยาว x สูง (เซ็นติเมตร)</dt>'+
					'<dt>ขนาด ฟุต</dt>'+
					'<dt>จำนวนคงเหลือ</dt>'+
					'</div>'+
					'<div class="col-sm-6">'+
					'<dd id="prod_mat">'+data['data']['Material']+'</dd>'+
					'<dd id="prod_color">'+data['data']['Color']+'</dd>'+
					'<dd id="prod_size">'+data['data']['Size']+'</dd>'+
					'<dd id="prod_foot">'+prod_foots+'</dd>'+
					'<dd id="prod_qty">'+data['data']['stock']+'</dd>'+
					'</div>'+
					'</div>'+
					'<hr>'+
					'<div>'+
					'<h1>จัดส่งผ่านทาง</h1></br>'+
					(data['data']['Delivery'][0]['Price'] != null ? '<dd>Kerry ค่าจัดส่ง : '+data['data']['Delivery'][0]['Price']+' บาท</dd>':'')+
					(data['data']['Delivery'][1]['Price'] != null ? '<dd>DHL ค่าจัดส่ง : '+data['data']['Delivery'][1]['Price']+' บาท</dd>':'')+
					(data['data']['Delivery'][2]['Price'] != null ? '<dd>SB (พร้อมติดตั้ง) ค่าจัดส่ง : '+data['data']['Delivery'][2]['Price']+' บาท</dd>':'')+
					(data['data']['Delivery'][3]['Price'] != null ? '<dd>EMS ค่าจัดส่ง : '+data['data']['Delivery'][3]['Price']+' บาท</dd>':'')+
					(data['data']['Delivery'][4]['Price'] != null ? '<dd>ผู้ซื้อมารับเอง ค่าจัดส่ง : '+data['data']['Delivery'][4]['Price']+' บาท</dd>':'')+
					(data['data']['Delivery'][5]['Price'] != null ? '<dd>ผู้ขายทำการส่งให้ ค่าจัดส่ง : '+data['data']['Delivery'][5]['Price']+' บาท</dd>':'')+
					'</div>');
				for(var x = 0 ; x < data['data']['Comment']['length'] ; x++){
					var rating_point = data['data']['Comment'][x]['rating'];
					if(0 < rating_point && rating_point <= 0.5)
					{
						rating =
						'<span class="fa fa-star-half-full"></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}else if(0.5 < rating_point && rating_point <= 1){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}else if(1 < rating_point && rating_point <= 1.5){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star-half-full"></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}else if(1.5 < rating_point && rating_point <= 2){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}else if(2 < rating_point && rating_point <= 2.5){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star-half-full"></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}else if(2.5 < rating_point && rating_point <= 3){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}else if(3 < rating_point && rating_point <= 3.5){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star-half-full"></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}else if(3.5 < rating_point && rating_point <= 4){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-grey fa-star "></span>';
					}else if(4 < rating_point  && rating_point <= 4.5){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star-half-full"></span>';
					}else if(4.5 < rating_point  && rating_point <= 5){
						rating =
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>'+
						'<span class="fa fa-star checked"></span>';
					}else{
						rating =
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>'+
						'<span class="fa  fa-grey fa-star "></span>';
					}
					$('#comment').append('<div class="product-rating">'+
						'<div class="product-rating-avatar">'+
						'<div class="avatar">'+
						'<img src="img/a8.jpg">'+
						'</div>'+
						'</div>'+
						'<div class="product-rating-main">'+
						'<div class="product-rating-author-name">'+data['data']['Comment'][x]['name']+' '+data['data']['Comment'][x]['surname']+'</div>'+
						'<fieldset class="rating2"  id="rating2">'+
						rating +
						'</fieldset>'+
						'<div class="product-rating-content">'+data['data']['Comment'][x]['description']+'</div>'+
						'<div class="product-rating-time">'+data['data']['Comment'][x]['created_at']+'</div>'+
						'</div>'+
						'</div>');
				}

				var rating_point = data['data']['RatingAVG2'][0]['RatingAVG'];
				if(0 < rating_point && rating_point <= 0.5)
				{
					rating =
					'<span class="fa fa-star-half-full"></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>';
				}else if(0.5 < rating_point && rating_point <= 1){
					rating =
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>';
				}else if(1 < rating_point && rating_point <= 1.5){
					rating =
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star-half-full"></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>';
				}else if(1.5 < rating_point && rating_point <= 2){
					rating =
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>';
				}else if(2 < rating_point && rating_point <= 2.5){
					rating =
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star-half-full"></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>';
				}else if(2.5 < rating_point && rating_point <= 3){
					rating =
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>';
				}else if(3 < rating_point && rating_point <= 3.5){
					rating =
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star-half-full"></span>'+
					'<span class="fa  fa-grey fa-star "></span>';
				}else if(3.5 < rating_point && rating_point <= 4){
					rating =
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-grey fa-star "></span>';
				}else if(4 < rating_point  && rating_point <= 4.5){
					rating =
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star-half-full"></span>';
				}else if(4.5 < rating_point  && rating_point <= 5){
					rating =
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>'+
					'<span class="fa fa-star checked"></span>';
				}else{
					rating =
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>'+
					'<span class="fa  fa-grey fa-star "></span>';
				}

				$('#Rating_AVG').append('<h4 class="viewed_title">'+(data['data']['RatingAVG2'][0]['RatingAVG'] != null ? data['data']['RatingAVG2'][0]['RatingAVG']:0)+'  เต็ม  5</h4>'+
					'<fieldset class="rating ct">'+
					rating+
					'</fieldset>');

			}
		},
		failure: function(errMsg) {
			alert(errMsg);
		}
	});
}

function getRecommend(){
	var prod_id = getCookie();
	(async () => {
		const rawResponse = await fetch('/api/recommend-product', {
			method: 'POST',
			headers: {
				'Authorization':'Bearer '+b_token,
				'Accept': 'application/json',
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({"prod_id":prod_id})
		});
		const content = await rawResponse.json();
		if(content['recommend'] != ''){
			console.log(content['recommend']);
			for(i=0;i<content['recommend'].length;i++){
				$('#recommend-list').append('<div class="col-md-2">'+
					'<div class="ibox">'+
					'<div class="ibox-content product-box" >'+
					'<div class="product-imitation-prod" onclick="productDetail('+content['recommend'][i]['prod_id']+')">'+
					'<img src="'+content['recommend'][i]['pic_url1']+'" alt="">'+
					'</div>'+
					'<div class="product-desc">'+
					'<span class="product-price">'+
					content['recommend'][i]['prod_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'฿'+
					'</span>'+
					'<div class="shop_bar"></div><a> <div class="product-name-a" onclick="productDetail('+content['recommend'][i]['prod_id']+')">'+
					content['recommend'][i]['prod_name']+'</div></a>'+
					'<div class="text-muted m-t-xs cut-str">'+
					content['recommend'][i]['prod_desc']+
					'</div>'+
					'</div>'+
					'</div>'+
					'</div>'+
					'</div>');
			}
		}else{
			Swal.fire({
				title: '<strong>เกิดข้อผิดพลาด</strong>',
				type:'error',
				showConfirmButton: true,
			});
		}

	})();
}
function saveHistoryview(){
	console.log('function_Historyview');
    var buyer_id = localStorage.getItem("buyer_id");
	  var b_token = localStorage.getItem("b_token");
		var prod_id = getCookie();
		
		$.ajax({
			type: "POST",
			url: "/api/saveHistoryview",
			headers: {
				'Authorization':'Bearer '+ b_token,
				'Content-Type':'application/json'
			},
			data: JSON.stringify({
				"buyer_id": buyer_id,
				"prod_id": prod_id
			}),
			contentType: "application/json; charset=utf-8",
			dataType: "json",
			success: function(data){
				var s = JSON.stringify(data['success']).replace(/['"]+/g, '');
				if(s == "1")
				{
					console.log("saveHistoryview : success");

				}else{
					console.log("saveHistoryview : fail");

				}
			},
			failure: function(errMsg) {
				alert(errMsg);
			}
		});
}
getRecommend();
saveHistoryview();
</script>
@endsection
