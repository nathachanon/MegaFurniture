@extends('layouts.layout')


@section('content')
<link rel="stylesheet" type="text/css" href="layout/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="layout/styles/product_responsive.css">
<style>
	td,th{
		text-align: center;
		vertical-align: middle;
	}
	.comparePic {
		width: 150px;
		height: 150px;
	}

	td,th{
		text-align: center;
		vertical-align: middle;
	}
	tr:nth-child(even){background-color: #f2f2f2}
	.comparePic {
		object-fit: contain;
		width: 200px;
		height: 200px;
	}
	th {
		background-color: #F59121;
		color: white;
	}
</style>


<center>
	<div  class="row" id="compare_list">
	</div>

	<div class="shop">
		<div class="container">
			<div class="row ">

				<div class="col-lg-3 ">




					<!-- Shop Sidebar -->

				</div>


				<div class="col-lg-12 ">


					<!-- Shop Content -->

					<div class="shop_sidebar">



						<br><br><br>

						<div class="row" id="product_list" >
						</div>

					</div>

				</div>
			</div>

			<script src="js/jquery-2.1.1.js"></script>
			<script>
				function getCookie() {
					var names = 'CompareProduct';
					var value = "; " + document.cookie;
					var parts = value.split("; " + names + "=");
					if (parts.length == 2) return parts.pop().split(";").shift();
				}

				if(getCookie() == undefined)
				{
					window.location.href = '/';
				}else{
					var Product_id = JSON.parse(getCookie());
					var p1 = Product_id[0]['prod_id'];
					var p2 = Product_id[1]['prod_id'];
					var p3;
					if(Product_id['length'] == 3)
					{
						p3 = Product_id[2]['prod_id'];
					}else{
						p3 = 0;
					}

					function aa(){

						$.ajax({
							url: '/api/compareProduct',
							headers: {
								'Content-Type':'application/json'
							},
							data: JSON.stringify({
								"compare_P_1": p1 ,
								"compare_P_2": p2 ,
								"compare_P_3": p3 ,
							}),
							method: 'POST',
							dataType: 'json',
							success: function(data){
								console.log(data);
       
			if(data['product3'] != null)
			{
				var product_3_pic = data['product3'][0]['pic_url1'];
				var product_3_name = data['product3'][0]['prod_name'];
				var prod_3_desc = data['product3'][0]['prod_desc'];
				var product_3_width = data['product3'][0]['SizeProd_width'];
				var product_3_length = data['product3'][0]['SizeProd_length']
				var product_3_height = data['product3'][0]['SizeProd_height'];
				var product_3_foot = data['product3'][0]['SizeProd_foot'];
				var product_3_rm = data['product3'][0]['RM_value'];
				var product_3_color = data['product3'][0]['ColorProd_value'];
				var product_3_price = data['product3'][0]['prod_price'];
				var product_3_id = data['product3'][0]['prod_id'];
			}else{
				var product_3_pic = "";
				var product_3_name = "";
				var prod_3_desc = "";
				var product_3_width = "";
				var product_3_length = "";
				var product_3_height = "";
				var product_3_foot = "";
				var product_3_rm = "";
				var product_3_color = "";
				var product_3_price = "";
				var product_3_id = "";

			}






			$('#product_list').append(
				' <div class="ibox-content product-box" style="display: block; overflow-x:auto;margin: 0 auto;" align="center">'+

				' <table class="table">'+
				' <thead>'+
				' <tr>'+
				' <th></th>'+
				' <th><h4>สินค้าที่ 1</h4></th>'+
				' <th><h4>สินค้าที่ 2</h4></th>'+
				' <th class="compare_P_3"><h4>สินค้าที่ 3</h4></th>'+
				' </thead>'+
				'<tbody>'+
				'<tr>'+
				'<td><h4>รูปสินค้า</h4></th>'+
				'<td ><img class="comparePic" src="'+data['product1'][0]['pic_url1']+'"></img></td>'+
				'<td ><img class="comparePic" src="'+data['product2'][0]['pic_url1']+'"></img></td>'+
				'<td class="compare_P_3"><img class="comparePic" src="'+product_3_pic+'"></img></td>'+
				'</tr>'+
				'<tr>'+
				'<td><h4>ชื่อสินค้า</h4></th>'+
				'<td ><h5>'+data['product1'][0]['prod_name']+'</h5></td>'+
				'<td ><h5>'+data['product2'][0]['prod_name']+'</h5></td>'+
				'<td class="compare_P_3"><h5>'+product_3_name+'</h5></td>'+
				'</tr>'+
				'<td><h4>รายละเอียดสินค้า</h4></th>'+
				'<td >'+data['product1'][0]['prod_desc']+'</td>'+
				'<td >'+data['product2'][0]['prod_desc']+'</td>'+
				'<td class="compare_P_3">'+prod_3_desc+'</td>'+
				'</tr>'+
				'<tr>'+
				'<td style="width:auto;"><h4>ขนาด(กว้าง x ยาว x สูง) เซนติเมตร</h4></th>'+
				'<td ><h5>'+data['product1'][0]['SizeProd_width']+' x  '+data['product1'][0]['SizeProd_length']+' x  '+data['product1'][0]['SizeProd_height']+'</h5></td>'+
				'<td ><h5>'+data['product2'][0]['SizeProd_width']+' x  '+data['product2'][0]['SizeProd_length']+' x  '+data['product2'][0]['SizeProd_height']+'</h5></td>'+
				'<td class="compare_P_3"><h5>'+product_3_width+' x  '+product_3_length+' x  '+product_3_height+'</h5></td>'+
				'</tr>'+
				'<tr>'+
				'<td><h4>ขนาด(ฟุต)</h4></th>'+
				'<td ><h5>'+data['product1'][0]['SizeProd_foot']+'</h5></td>'+
				'<td ><h5>'+data['product2'][0]['SizeProd_foot']+'</h5></td>'+
				'<td class="compare_P_3"><h5>'+product_3_foot+'</h5></td>'+
				'</tr>'+
				'<tr>'+
				'<td><h4>วัสด</h4>ุ</th>'+
				'<td ><h5>'+data['product1'][0]['RM_value']+'</h5></td>'+
				'<td ><h5>'+data['product2'][0]['RM_value']+'</h5></td>'+
				'<td class="compare_P_3"><h5>'+product_3_rm+'</h5></td>'+
				'</tr>'+
				'<tr>'+
				'<td><h4>สี</h4></th>'+
				'<td ><h5>'+data['product1'][0]['ColorProd_value']+'</h5></td>'+
				'<td ><h5>'+data['product2'][0]['ColorProd_value']+'</h5></td>'+
				'<td class="compare_P_3"><h5>'+product_3_color+'</h5></td>'+
				'</tr>'+
				'<tr>'+
				'<td><h4>ราคา</h4></th>'+
				'<td ><h5>'+data['product1'][0]['prod_price']+'</h5></td>'+
				'<td ><h5>'+data['product2'][0]['prod_price']+'</h5></td>'+
				'<td class="compare_P_3"><h5>'+product_3_price+'</h5></td>'+
				'</tr>'+
				'<tr>'+
				'<td><h4>คะแนน</h4></th>'+
				'<td >'+
				'<div id="Rating_AVG_1"></div>'+
				'</td>'+
				'<td >'+
				'<div id="Rating_AVG_2"></div>'+
				'</td>'+
				'<td class="compare_P_3">'+
				'<div id="Rating_AVG_3"></div>'+
				'</td>'+
				'</tr>'+
				'<tr>'+
				'<td><h4>ใส่ตะกร้า</h4></th>'+

				'<td ><a href="#"  class="btn btn-xs btn-outline btn-primary"><i class="fa fa-shopping-cart"></i></a></td>'+
				'<td ><a href="#"  class="btn btn-xs btn-outline btn-primary"><i class="fa fa-shopping-cart"></i></a></td>'+
				'<td class="compare_P_3"><a href="#"  class="btn btn-xs btn-outline btn-primary"><i class="fa fa-shopping-cart"></i></a></td>'+
				'</tr>'+
				'<tr>'+
				'<td><h4>ความคิดเห็น</h4></th>'+

				'<td ><a href="#"  class="btn btn-xs btn-outline btn-primary"><i class="fa fa-comment"></i></a></td>'+
				'<td ><a href="#"  class="btn btn-xs btn-outline btn-primary"><i class="fa fa-comment"></i></a></td>'+
				'<td class="compare_P_3"><a href="#"  class="btn btn-xs btn-outline btn-primary"><i class="fa fa-comment"></i></a></td>'+
				'</tr>'+
				'</tbody>'+
				'</table>'+
				'</div>'



				);
			if(data['product3'] == null)
			{
				$(".compare_P_3").hide();
			}

		},
		failure: function(errMsg) {
			alert(errMsg);
		}
	});
}

function getRating(Compare_id,Prod_id){


	$("input[name='rating']").attr("checked", false);

			$('#comment').empty();
			$('#Rating_AVG').empty();
		$.ajax({
		type: "GET",
		url: "/api/products/"+Prod_id,
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		success: function(data){

			var div_rating = "";
			if(Compare_id == 1){div_rating = '#Rating_AVG_1';}
			else if(Compare_id == 2){div_rating = '#Rating_AVG_2';}
			else if(Compare_id == 3){div_rating = '#Rating_AVG_3';}


			console.log(data['data']);
			if(data['data'] != ''){


				 var rating_point = data['data']['RatingAVG2'][0]['RatingAVG'];
				 if(0 < rating_point && rating_point <= 0.5)
				 {
					 rating =
					 '<span class="fas fa-star-half-alt"></span>'+
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
					 '<span class="fas fa-star-half-alt"></span>'+
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
					 '<span class="fas fa-star-half-alt"></span>'+
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
					 '<span class="fas fa-star-half-alt"></span>'+
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
					 '<span class="fas fa-star-half-alt"></span>';
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
				 $(div_rating).append('<h5 class="viewed_title">'+(data['data']['RatingAVG2'][0]['RatingAVG'] != null ? data['data']['RatingAVG2'][0]['RatingAVG']:0)+'  เต็ม  5</h5>'+
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

aa();
getRating(1,p1);
getRating(2,p2	);
if(p3!=0){
getRating(3,p3);
}

}

</script>
@endsection
