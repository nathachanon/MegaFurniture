@extends('layouts.layout')


@section('content')
<link rel="stylesheet" type="text/css" href="layout/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="layout/styles/product_responsive.css">

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

<div class="viewed">
	<div class="container">
		<div class="row">
			
			<div class="viewed_title_container">
				<h4 class="viewed_title">คะแนนของสินค้า</h4>

			</div>
			<div class="col-md-12 bg-cc">
				<div class="row">
					<div class="col-lg-3 ct">
						<h4 class="viewed_title">4.3  เต็ม  5</h4>

						<fieldset class="rating2 ct">
							<input type="radio" id="5" name="rating" value="5"  /><label class = "full" for="5" title="Awesome - 5 stars"></label>
							<input type="radio" id="4.5" name="rating" value="4.5" /><label class="half" for="4.5" title="Pretty good - 4.5 stars"></label>
							<input type="radio" id="4"  name="rating" value="4" /><label class = "full" for="4" title="Pretty good - 4 stars"></label>
							<input type="radio" id="3.5" name="rating" value="3.5" /><label class="half" for="3.5" title="Meh - 3.5 stars"></label>
							<input type="radio" id="3" name="rating" value="3" /><label class = "full" for="3" title="Meh - 3 stars"></label>
							<input type="radio" id="2.5" name="rating" value="2.5" /><label class="half" for="2.5" title="Kinda bad - 2.5 stars"></label>
							<input type="radio" id="2" name="rating" value="2" /><label class = "full" for="2" title="Kinda bad - 2 stars"></label>
							<input type="radio" id="1.5" name="rating" value="1.5" /><label class="half" for="1.5" title="Meh - 1.5 stars"></label>
							<input type="radio" id="1" name="rating" value="1" /><label class = "full" for="1" title="Sucks big time - 1 star"></label>
							<input type="radio" id="0.5" name="rating" value="0.5" /><label class="half" for="0.5" title="Sucks big time - 0.5 stars"></label>
						</fieldset>

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
			<div class="col-md-12 bg-c">

				<!--คนที่2-->
				<div class="product-rating">
					<div class="product-rating-avatar">
						<div class="avatar">
							<img src="img/a8.jpg">

						</div>
					</div>
					<div class="product-rating-main">
						<div class="product-rating-author-name">pornpimon4687</div>
						<fieldset class="rating2"  id="rating2">
							<input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
							<input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input type="radio" id="star3half" name="rating" checked="" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
							<input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
							<input type="radio" id="star2" checked="" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input type="radio" id="star1half" name="rating" value="1.5" checked /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
							<input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
							<input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
						</fieldset>
						<div class="product-rating-content">สินค้าตรงตามรูปภาพ จัดส่งรวดเร็วดีมากกกค่ะ เสียบเเทนอันเก่า คุณภาพเสียงดีชัดแจ๋ว ไว้จะอุดหนุนสินค้าที่ร้านอีกนะคะ</div>
						<div class="product-rating-time">2019-02-26 13:35</div>


					</div>

				</div>
				<!--คนที่2-->
				<div class="product-rating">
					<div class="product-rating-avatar">
						<div class="avatar">
							<img src="img/a8.jpg">

						</div>
					</div>
					<div class="product-rating-main">
						<div class="product-rating-author-name">pornpimon4687</div>
						<fieldset class="rating2" id="rating2">
							<input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input type="radio"  id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
							<input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input type="radio" id="star3half" name="rating"  value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
							<input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
							<input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input type="radio" id="star1half" checked="" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
							<input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
							<input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
						</fieldset>
						<div class="product-rating-content">สินค้าตรงตามรูปภาพ จัดส่งรวดเร็วดีมากกกค่ะ เสียบเเทนอันเก่า คุณภาพเสียงดีชัดแจ๋ว ไว้จะอุดหนุนสินค้าที่ร้านอีกนะคะ</div>
						<div class="product-rating-time">2019-02-26 13:35</div>


					</div>

				</div>


			</div>
			<div class="col-md-12 bg-c" id="review_body">
				<div class="ibox-content">

					<div class="form-group">
						<div class="col-sm-12 "><fieldset class="rating" >
							<input type="radio" id="5" name="rating" value="5"  /><label class = "full" for="5" title="Awesome - 5 stars"></label>
							<input type="radio" id="4.5" name="rating" value="4.5" /><label class="half" for="4.5" title="Pretty good - 4.5 stars"></label>
							<input type="radio" id="4"  name="rating" value="4" /><label class = "full" for="4" title="Pretty good - 4 stars"></label>
							<input type="radio" id="3.5" name="rating" value="3.5" /><label class="half" for="3.5" title="Meh - 3.5 stars"></label>
							<input type="radio" id="3" name="rating" value="3" /><label class = "full" for="3" title="Meh - 3 stars"></label>
							<input type="radio" id="2.5" name="rating" value="2.5" /><label class="half" for="2.5" title="Kinda bad - 2.5 stars"></label>
							<input type="radio" id="2" name="rating" value="2" /><label class = "full" for="2" title="Kinda bad - 2 stars"></label>
							<input type="radio" id="1.5" name="rating" value="1.5" /><label class="half" for="1.5" title="Meh - 1.5 stars"></label>
							<input type="radio" id="1" name="rating" value="1" /><label class = "full" for="1" title="Sucks big time - 1 star"></label>
							<input type="radio" id="0.5" name="rating" value="0.5" /><label class="half" for="0.5" title="Sucks big time - 0.5 stars"></label>
						</fieldset></div>
						<div class="col-sm-12"><input placeholder="ระบุความคิดเห็นต่อสินค้า..." id="reiview_content" type="text" class="form-control input-lg"></div>
					</div>
					<div class="form-group" id="footer" >
						<div class="col-sm-6 col-sm-offset-2">

							<button class="btn btn-warning input-lg" type="button" id="sub_review">ส่งความคิดเห็น</button>
							<button class="btn btn-white input-lg" type="button" id="cancel">ยกเลิก</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script src="layout/js/jquery-3.3.1.min.js"></script>
<script src="layout/js/product_custom.js"></script>

<script>

	if(getCookie() != null)
	{
			var radioValue;
		$(document).ready(function(){
			$("input[type='radio']").click(function(){
				radioValue = $("input[name='rating']:checked").val();
				if(radioValue){
					alert( radioValue +" คะแนน");
				}
			});


			$(document).ready(function(){
				$("#sub_review").click(function(){
					$.ajax({
						type: "POST",
						url: "/api/products/"+ getCookie()+"/reviews",
						headers: {
							'Content-Type':'application/json'
						},
						data: JSON.stringify({
							"buyer_id": 1,
							"rating": radioValue,
							"description": $('#reiview_content').val()
						}),
						contentType: "application/json; charset=utf-8",
						dataType: "json",
						success: function(data){
							console.log(data);

						},
						failure: function(errMsg) {
							alert(errMsg);
						}
					});
				})
			});

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
		console.log(getCookie());

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
							'<div class="product_price">'+data['data']['price']+'</div>'+
							'<div class="product_text"><p>'+data['data']['description']+'</p></div>'+
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
							'<button type="button" class="button cart_button">เพิ่มใส่ตะกร้า</button>'+
							'<div class="product_fav"><i class="fas fa-heart"></i></div>'+
							'</div>'+
							'</form>'+
							'</div>'+
							'</div>'+
							'</div>');
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
							'<dd id="prod_foot">'+data['data']['foot']+'</dd>'+
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
					}
				},
				failure: function(errMsg) {
					alert(errMsg);
				}
			});
}


</script>
@endsection
