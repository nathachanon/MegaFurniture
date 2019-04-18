@extends('layouts.layout')


@section('content')
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
        /*
				$('#product_list').append('<div class="col-md-4">'+
					 '<div class="ibox">'+
							 '<div class="ibox-content product-box">'+
									 '<div class="product-imitation-prod">'+
											 '<img src="'+data['product1'][0]['pic_url1']+'" alt="">'+
									 '</div>'+
									'<div class="product-desc">'+
											 '<span class="product-price">'+
													data['product1'][0]['prod_price']+'฿'+
											 '</span>'+
												'<div class="shop_bar"></div><br>'+
												'<a href="#" class="product-name">'+data['product1'][0]['prod_name']+'</a>'+
											 '<div class="text-muted m-t-xs">'+
													 data['product1'][0]['prod_desc']+
											 '</div>'+
											 '<div class="text-muted m-t-xs">'+
													 'วัสดุ : '+data['product1'][0]['RM_value']+
											 '</div>'+
											 '<div class="text-muted m-t-xs">'+
													 'ขนาด(กว้างxยาวxสูง) เซ็นติเมตร : '+data['product1'][0]['SizeProd_width']+' x '+data['product1'][0]['SizeProd_length']+' x ' +data['product1'][0]['SizeProd_height']+
											 '</div>'+
											 '<div class="text-muted m-t-xs">'+
													 'ขนาด (ฟุต) : '+data['product1'][0]['SizeProd_foot']+
											 '</div>'+
											 '<div class="text-muted m-t-xs">'+
													 'ราคา (บาท) : '+data['product1'][0]['prod_price']+
											 '</div>'+
											 '<div class="m-t text-righ">'+
													 '<a href="#" onclick="alert('+data['product1'][0]['Prod_id']+');" class="btn btn-xs btn-outline btn-primary"><i class="fa fa-comment"></i> </a>'+
											 '</div>'+
									 '</div>'+
							 '</div>'+
					 '</div>'+
			 '</div>');
			 $('#product_list').append('<div class="col-md-4">'+
					'<div class="ibox">'+
							'<div class="ibox-content product-box">'+
									'<div class="product-imitation-prod">'+
											'<img src="'+data['product2'][0]['pic_url1']+'" alt="">'+
									'</div>'+
								 '<div class="product-desc">'+
											'<span class="product-price">'+
												 data['product2'][0]['prod_price']+'฿'+
											'</span>'+
											 '<div class="shop_bar"></div><br>'+
											 '<a href="#" class="product-name">'+data['product2'][0]['prod_name']+'</a>'+
											'<div class="text-muted m-t-xs">'+
													data['product2'][0]['prod_desc']+
											'</div>'+
											'<div class="text-muted m-t-xs">'+
													'วัสดุ : '+data['product2'][0]['RM_value']+
											'</div>'+
											'<div class="text-muted m-t-xs">'+
													'ขนาด(กว้างxยาวxสูง) เซ็นติเมตร : '+data['product2'][0]['SizeProd_width']+' x '+data['product2'][0]['SizeProd_length']+' x ' +data['product2'][0]['SizeProd_height']+
											'</div>'+
											'<div class="text-muted m-t-xs">'+
													'ขนาด (ฟุต) : '+data['product2'][0]['SizeProd_foot']+
											'</div>'+
											'<div class="text-muted m-t-xs">'+
													'ราคา (บาท) : '+data['product2'][0]['prod_price']+
											'</div>'+
											'<div class="m-t text-righ">'+
													'<a href="#" onclick="alert('+data['product2'][0]['Prod_id']+');" class="btn btn-xs btn-outline btn-primary"><i class="fa fa-comment"></i> </a>'+
											'</div>'+
									'</div>'+
							'</div>'+
					'</div>'+
			'</div>');
			if(data['product3'] != null)
			{
				$('#product_list').append('<div class="col-md-4">'+
 					'<div class="ibox">'+
 							'<div class="ibox-content product-box">'+
 									'<div class="product-imitation-prod">'+
 											'<img src="'+data['product3'][0]['pic_url1']+'" alt="">'+
 									'</div>'+
 								 '<div class="product-desc">'+
 											'<span class="product-price">'+
 												 data['product3'][0]['prod_price']+'฿'+
 											'</span>'+
 											 '<div class="shop_bar"></div><br>'+
 											 '<a href="#" class="product-name">'+data['product3'][0]['prod_name']+'</a>'+
 											'<div class="text-muted m-t-xs">'+
 													data['product3'][0]['prod_desc']+
 											'</div>'+
											'<div class="text-muted m-t-xs">'+
													'วัสดุ : '+data['product3'][0]['RM_value']+
											'</div>'+
											'<div class="text-muted m-t-xs">'+
													'ขนาด(กว้างxยาวxสูง) เซ็นติเมตร : '+data['product3'][0]['SizeProd_width']+' x '+data['product3'][0]['SizeProd_length']+' x ' +data['product3'][0]['SizeProd_height']+
											'</div>'+
											'<div class="text-muted m-t-xs">'+
													'ขนาด (ฟุต) : '+data['product3'][0]['SizeProd_foot']+
											'</div>'+
											'<div class="text-muted m-t-xs">'+
													'ราคา (บาท) : '+data['product3'][0]['prod_price']+
											'</div>'+
 											'<div class="m-t text-righ">'+
 													'<a href="#" onclick="alert('+data['product3'][0]['Prod_id']+');" class="btn btn-xs btn-outline btn-primary"><i class="fa fa-comment"></i> </a>'+
 											'</div>'+
 									'</div>'+
 							'</div>'+
 					'</div>'+
 			'</div>');
			}
			*/
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
				'  <th>สินค้าที่ 1</th>'+
				' <th>สินค้าที่ 2</th>'+
				' <th class="compare_P_3">สินค้าที่ 3</th>'+
				' </thead>'+
				'<tbody>'+
				'<tr>'+
				'<td>รูปสินค้า</th>'+
				'<td ><img class="comparePic" src="'+data['product1'][0]['pic_url1']+'"></img></td>'+
				'<td ><img class="comparePic" src="'+data['product2'][0]['pic_url1']+'"></img></td>'+
				'<td class="compare_P_3"><img class="comparePic" src="'+product_3_pic+'"></img></td>'+
				'</tr>'+
				'<tr>'+
				'<td>ชื่อสินค้า</th>'+
				'<td >'+data['product1'][0]['prod_name']+'</td>'+
				'<td >'+data['product2'][0]['prod_name']+'</td>'+
				'<td class="compare_P_3">'+product_3_name+'</td>'+
				'</tr>'+
				'<td>รายละเอียดสินค้า</th>'+
				'<td >'+data['product1'][0]['prod_desc']+'</td>'+
				'<td >'+data['product2'][0]['prod_desc']+'</td>'+
				'<td class="compare_P_3">'+prod_3_desc+'</td>'+
				'</tr>'+
				'<tr>'+
				'<td style="width:auto;">ขนาด(กว้าง x ยาว x สูง) เซนติเมตร</th>'+
				'<td >'+data['product1'][0]['SizeProd_width']+' x  '+data['product1'][0]['SizeProd_length']+' x  '+data['product1'][0]['SizeProd_height']+'</td>'+
				'<td >'+data['product2'][0]['SizeProd_width']+' x  '+data['product2'][0]['SizeProd_length']+' x  '+data['product2'][0]['SizeProd_height']+'</td>'+
				'<td class="compare_P_3">'+product_3_width+' x  '+product_3_length+' x  '+product_3_height+'</td>'+
				'</tr>'+
				'<tr>'+
				'<td>ขนาด(ฟุต)</th>'+
				'<td >'+data['product1'][0]['SizeProd_foot']+'</td>'+
				'<td >'+data['product2'][0]['SizeProd_foot']+'</td>'+
				'<td class="compare_P_3">'+product_3_foot+'</td>'+
				'</tr>'+
				'<tr>'+
				'<td>วัสดุ</th>'+
				'<td >'+data['product1'][0]['RM_value']+'</td>'+
				'<td >'+data['product2'][0]['RM_value']+'</td>'+
				'<td class="compare_P_3">'+product_3_rm+'</td>'+
				'</tr>'+
				'<tr>'+
				'<td>สี</th>'+
				'<td >'+data['product1'][0]['ColorProd_value']+'</td>'+
				'<td >'+data['product2'][0]['ColorProd_value']+'</td>'+
				'<td class="compare_P_3">'+product_3_color+'</td>'+
				'</tr>'+
				'<tr>'+
				'<td>ราคา</th>'+
				'<td >'+data['product1'][0]['prod_price']+'</td>'+
				'<td >'+data['product2'][0]['prod_price']+'</td>'+
				'<td class="compare_P_3">'+product_3_price+'</td>'+
				'</tr>'+
				'<tr>'+
				'<td>คะแนน</th>'+
				'<td >'+'5.0'+'</td>'+
				'<td >'+'5.0'+'</td>'+
				'<td class="compare_P_3">'+'5.0'+'</td>'+
				'</tr>'+
				'<tr>'+
				'<td>ใส่ตะกร้า</th>'+

				'<td ><a href="#"  class="btn btn-xs btn-outline btn-primary"><i class="fa fa-shopping-cart"></i></a></td>'+
				'<td ><a href="#"  class="btn btn-xs btn-outline btn-primary"><i class="fa fa-shopping-cart"></i></a></td>'+
				'<td class="compare_P_3"><a href="#"  class="btn btn-xs btn-outline btn-primary"><i class="fa fa-shopping-cart"></i></a></td>'+
				'</tr>'+
				'<tr>'+
				'<td>ความคิดเห็น</th>'+

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

aa();
}

</script>
@endsection
