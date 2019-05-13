<!DOCTYPE html>
<html lang="en">
<head>
	<title>MEGA Furniture</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="OneTech shop project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="layout/styles/bootstrap4/bootstrap.min.css">
	<link href="layout/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
	<link href="css/style.css" rel="stylesheet">
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="layout/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="layout/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="layout/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="layout/plugins/slick-1.8.0/slick.css">
	<link rel="stylesheet" type="text/css" href="layout/styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="layout/styles/responsive.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.min.css">

	<link rel="stylesheet" type="text/css" href="layout/styles/shop_styles.css">
	<link rel="stylesheet" type="text/css" href="layout/styles/shop_responsive.css">
	<link rel="stylesheet" type="text/css" href="layout/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/radio.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

</head>


<body>
	<div class="super_container">

		<!-- Header -->

		<header class="header">

			<!-- Top Bar -->

			<div class="top_bar">
				<div class="container">
					<div class="row">
						<div class="col d-flex flex-row">
							<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="" alt=""></div>+38 068 005 3570</div>
							<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="" alt=""></div><a href="/login">ขายสินค้า</a></div>
							<div class="top_bar_content ml-auto">
								<div class="top_bar_menu">
									<ul class="standard_dropdown top_bar_dropdown">


									</ul>
								</div>
								<div class="top_bar_user" id="top_bar_user">

									<div class="user_icon"><img src="layout/images/user.svg" alt=""></div>
									<div><a data-toggle="modal" data-target="#modalRegisterForm">สมัครสมาชิก</a></div>
									<div><a  data-toggle="modal" data-target="#modalLoginForm">ลงชื่อเข้าใช้</a></div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Header Main -->

			<div class="header_main">
				<div class="container">
					<div class="row">

						<!-- Logo -->
						<div class="col-lg-3 col-sm-3 col-3 order-1">
							<div class="logo_container">
								<div class="logo"><a href="/">MEGA Furniture </a></div>
							</div>
						</div>

						<!-- Search -->
						<div class="col-lg-5 col-12 order-lg-2 order-3 text-lg-left text-right">
							<div class="header_search">
								<div class="header_search_content">
									<div class="header_search_form_container">
										<input id="searchIndex" list="product" type="search" required="required" class="header_search_input" placeholder="ค้นหาสินค้า , ร้านค้า ..." onkeyup="search()" autocomplete="off">
										<datalist id="product">
										</datalist>

										<div class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">ทั้งหมด</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
													<li><a class="clc" href="#">หมวดสินค้า</a></li>

												</ul>
											</div>
										</div>
										<button onclick="submitSearch()" type="button" class="header_search_button trans_300" value="Submit"><img src="layout/images/search.png" alt=""></button>

									</div>
								</div>
							</div>
						</div>

						<!-- Wishlist -->
						<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
							<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">

								<!-- Cart -->
								<div class="cart">
									<div class="cart_container d-flex flex-row align-items-center justify-content-end" data-toggle="dropdown" aria-expanded="false">
										<ul class="dropdown-menu dropdown-alerts">
											<div id="cart_list">
											</div>
											<li>
												<a>
													<div>
														<button type="button" class="btn btn-w-m btn-info" id="carts">จัดการตะกร้า</button>
													</div>
												</a>
											</li>
										</ul>
										<div class="cart_icon" id="icon_cart">
											<img src="layout/images/cart.png" alt="">
											<div class="cart_count"><span id="cart"></span></div>
										</div>
										<div class="cart_content">
											<div class="cart_text"><a>ตะกร้า</a></div>
											<div class="cart_price" id="allprice"></div>
										</div>
									</div>
								</div>

								<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
								<div class="compare">
									<div class="cart_container d-flex flex-row align-items-center justify-content-end" data-toggle="dropdown" aria-expanded="false">
										<ul class="dropdown-menu dropdown-alerts">
											<div id="compare_list">
											</div>
											<li>
												<a onclick="compare()">
													<div>
														<button type="button" class="btn btn-w-m btn-info">เปรียบเทียบสินค้า</button>
													</div>
												</a>
											</li>
										</ul>
										<div class="cart_icon" id="icon_compare">
											<img style="width:32px;height:32px;" src="layout/images/arrow.png" alt="">
											<div class="cart_count"><span id="compare"></span></div>
										</div>
										<div class="cart_content">
											<div class="cart_text"><a>เปรียบเทียบ</a></div>
											<div class="cart_price" id="allprice"></div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Main Navigation -->

			<nav class="main_nav">
				<div class="container">
					<div class="row">
						<div class="col">

							<div class="main_nav_content d-flex flex-row">

								<!-- Categories Menu -->

								<div class="cat_menu_container">
									<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
										<div class="cat_burger"><span></span><span></span><span></span></div>
										<div class="cat_menu_text">หมวดหมู่สินค้า</div>
									</div>

									<ul class="cat_menu">
										<li class="hassubs">
											<a href="#">ห้องนอน<i class="fas fa-chevron-right"></i></a>
											<ul>
												<li><a href="#">ชุดห้องนอน<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">เตียงนอน<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">เตียง 6 ฟุต<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">เตียง 5 ฟุต<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">เตียง 3.5 ฟุต<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">เตียงผ้า<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">กระจก<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">โต๊ะเครื่องแป้ง<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">ตู้ข้างเตียง<i class="fas fa-chevron-right"></i></a></li>
											</ul>
										</li>
										<li class="hassubs">
											<a href="#">ที่นอน<i class="fas fa-chevron-right"></i></a>
											<ul>
												<li><a href="#">ที่นอนสปริง<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">ที่นอนพ็อคเกตสปริง<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">ที่นอนยางพารา<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">ที่นอนเมมโมรี่โฟม<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">ที่นอนโฟม<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">หมอน<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">ผ้าปูที่นอน<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">แผ่นรองที่นอน<i class="fas fa-chevron-right"></i></a></li>
											</ul>
										</li>
										<li class="hassubs">
											<a href="#">ห้องนั่งเล่น<i class="fas fa-chevron-right"></i></a>
											<ul>

												<li><a href="#">ชั้นวางทีวี<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">ตู้เก็บของ<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">ตู้โชว์<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">ชุดตู้หนังสือ<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">กล่องเก็บของ<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">คอนโซล<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">ตู้รองเท้า<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">โต๊ะทำงาน<i class="fas fa-chevron-right"></i></a></li>
											</ul>
										</li>
										<li class="hassubs">
											<a href="#">ห้องครัว<i class="fas fa-chevron-right"></i></a>
											<ul>

												<li><a href="#">ชุดโต๊ะอาหาร<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">เคาน์เตอร์บาร์<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">ของใช้ในครัวและโต๊ะอาหาร<i class="fas fa-chevron-right"></i></a></li>
											</ul>
										</li>
										<li class="hassubs">
											<a href="#">ห้องอาหาร<i class="fas fa-chevron-right"></i></a>
											<ul>

												<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
												<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
											</ul>
										</li>
									</ul>
								</div>

								<!-- Main Nav Menu -->


								<!-- Menu Trigger -->

								<div class="menu_trigger_container ml-auto">
									<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
										<div class="menu_burger">
											<div class="menu_trigger_text">menu</div>
											<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</nav>

			<!-- Menu -->

		
		</header>



		<!-- Banner -->


		@yield('content')

	</div>
	<!-- Login Modal -->
	<div class="modal fade" data-dismiss="modal" id="modalLoginForm" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h4 class="modal-title w-100 font-weight-bold">เข้าสู่ระบบ</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body mx-3">

				<div class="md-form mb-5">
					<i class="fas fa-envelope prefix or"></i>
					<input type="email" placeholder="อีเมล" id="email" required class="form-control validate">

				</div>

				<div class="md-form mb-4">
					<i class="fas fa-lock prefix or"></i>
					<input type="password" placeholder="รหัสผ่าน" id="password" required class="form-control validate">
				</div>

			</div>
			<div class="modal-footer d-flex justify-content-center">
				<button id="login" class="btn btn-primary input-lg col-lg-8 btn-lg " type="button">เข้าสู่ระบบ</button>
			</div>
		</div>
	</div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="modalRegisterForm"  role="dialog" aria-labelledby="myModalLabel"
>
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header text-center">
			<h4 class="modal-title w-100 font-weight-bold">สมัครสมาชิก</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body mx-3">

			<div class="md-form mb-3"> 
				<i class="fas fa-user prefix or"></i>
				<input type="text"   name="regis_name" id="regis_name" class="form-control validate" placeholder="ชื่อ" required>
			</div>

			<div class="md-form mb-3">
				<i class="fas fa-user-edit prefix or"></i>
				<input type="text"  name="surname" id="surname" class="form-control validate" placeholder="นามสกุล" required>
			</div>
			<div class="md-form mb-2">
				<div class="center-on-page ">
					<input type="radio" name="sex" id="sex_m" value="ชาย" />
					<label style="padding-left: 30px;" class="lb label-regis" for="sex_m">ชาย</label>
					<input type="radio" name="sex" id="sex_f" value="หญิง" />
					<label style="padding-left: 30px;" class="lb label-regis" for="sex_f">หญิง</label>
				</div>
			</div>
			<div class="md-form mb-3"> 
				<i class="fas fa-birthday-cake prefix or"></i>
				<input type="date"  name="birthday"  id="birthday" class="form-control validate" placeholder="วันเกิด" required>
			</div>


			<div class="md-form mb-3">
				<i class="fas fa-envelope prefix or"></i>
				<input type="email"  id="regis_email" class="form-control validate" placeholder="อีเมล" required>

			</div>

			<div class="md-form mb-3">
				<i class="fas fa-lock prefix or"></i>
				<input type="password"  id="regis_password" name="regis_password" class="form-control validate" placeholder="รหัสผ่าน" required>
			</div>

			<div class="md-form mb-3">
				<i class="fas fa-unlock prefix or"></i>
				<input type="password"  id="c_password" name="c_password" class="form-control validate" placeholder="ยืนยันรหัสผ่าน" required>
			</div>

			<div class="form-group-mg ch mb-3">
				<label> <input id="role" required="" value="true" type="checkbox" class="checkbox i-checks"><i></i> ยอมรับเงื่อนไขข้อตกลงจากผู้ให้บริการ </label>
			</div>
		</div>
		<div class="modal-footer d-flex justify-content-center">
			<button id="reg" class="btn btn-primary input-lg col-lg-8 btn-lg" type="button">ลงทะเบียน</button>
		</div>
	</div>
</div>
</div>




</body>

<script src="layout/js/jquery-3.3.1.min.js"></script>
<script src="layout/styles/bootstrap4/popper.js"></script>
<script src="layout/styles/bootstrap4/bootstrap.min.js"></script>
<script src="layout/plugins/greensock/TweenMax.min.js"></script>
<script src="layout/plugins/greensock/TimelineMax.min.js"></script>
<script src="layout/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="layout/plugins/greensock/animation.gsap.min.js"></script>
<script src="layout/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="layout/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="layout/plugins/slick-1.8.0/slick.js"></script>
<script src="layout/plugins/easing/easing.js"></script>
<script src="layout/js/custom.js"></script>


<script src="layout/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="layout/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="layout/plugins/parallax-js-master/parallax.min.js"></script>




<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.all.min.js"></script>

<script>
	var b_token = localStorage.getItem("b_token");
	var buyer_id = localStorage.getItem("buyer_id");

	check_user();

	function check_user(){

		if(b_token != null && buyer_id != null){
			$("#top_bar_user").empty();
			$("#top_bar_user").html('<div class="user_icon"><img src="layout/images/user.svg" alt=""></div><div><div class="btn-group">'+
				'<a data-toggle="dropdown" class="btn-xs dropdown-toggle" aria-expanded="false">'+localStorage.getItem("name")+'<span class="caret"></span></a>'+
				'<ul class="dropdown-menu">'+
				'<li><a href="/purchase">การสั่งซื้อของฉัน</a></li>'+
				'<li><a href="/account">บัญชีของฉัน</a></li>'+
				'<li><a href="#" id="logout">ออกจากระบบ</a></li>'+
				'</ul>'+
				'</div>');
		}

	}

	function isEmail(email) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}


	$('#reg').click(function(){
		var sex;
		var m = document.getElementById("sex_m")
		var f = document.getElementById("sex_f")
		if(m.checked == true){
			sex = "ชาย"
			console.log(sex)
		}else if(f.checked == true){
			sex = "หญิง"
			console.log(sex)
		}else{
			sex = null;
			console.log(sex)
		}

		var data = {
			name : $("#regis_name").val(),
			surname : $("#surname").val(),
			sex :sex,
			birthday : $("#birthday").val(),
			email : $("#regis_email").val(),
			password : $("#regis_password").val(),
			c_password : $("#c_password").val()

		};
		console.log(data);
		if( $("#regis_name").val() != '' && $("#surname").val() != '' && $("#birthday").val() != '' && $("#regis_email").val() != '' ){
			if(isEmail($("#regis_email").val()) == ''){
				Swal.fire({
					type: 'error',
					title: 'รูปแบบ Email ไม่ถูกต้อง !',
					showConfirmButton: false,
					timer: 900
				});

			}
			else if($("#regis_password").val() != $("#c_password").val()){
				Swal.fire({
					type: 'error',
					title: 'รหัสผ่านไม่ตรงกัน!',
					showConfirmButton: false,
					timer: 900
				});

			}
			else if($("input[id='role']:checked").val() == null){
				Swal.fire({
					type: 'error',
					title: 'กรุณายอมรับเงื่อนไขข้อตกลงจากผู้ให้บริการ!',
					showConfirmButton: false,
					timer: 1100
				});

			}else if(sex == null){
				Swal.fire({
					type: 'error',
					title: 'กรุณาระบุเพศ !',
					showConfirmButton: false,
					timer: 900
				});
				
			}else{
				console.clear();
				console.log(data);

				$.ajax({
					type: "POST",
					url: "/api/registerBuyer",
					data: JSON.stringify(data),
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					success: function(data){
						console.log(data);
						var status = JSON.stringify(data['success']);
						var status2 = JSON.stringify(data['error']);
						if( status2 == "\"Email is already\""){

							Swal.fire({
								type: 'error',
								title: 'Email นี้ถูกใช้งานแล้ว !',
								showConfirmButton: false,
								timer: 900
							});
							$("#regis_email").val('');
						}
						else if (status == "\"Register Success\""){
							Swal.fire({
								type: 'success',
								title: 'สมัครสมาชิกสำเร็จ',
								showConfirmButton: false,
								timer: 900
							});
							
							$('#modalRegisterForm').hide();
							$('.modal-backdrop').hide();

							setTimeout(function () {
								$('#modalLoginForm').modal();
							}, 1100);
																	
						}
					},
					failure: function(errMsg) {
						alert(errMsg);
					}
				});
			}
		}
		else{
			Swal.fire({

				type: 'error',
				title: 'กรุณากรอกข้อมูลให้ครบ !',
				showConfirmButton: false,
				timer: 900
			});
		}

	});

	$('#login').click(function(){
		var email = $("#email").val();
		var password = $("#password").val();
		if(email != '' && password != ''){
			if(isEmail(email) == ''){
				Swal.fire({
					type: 'error',
					title: 'รูปแบบ Email ไม่ถูกต้อง !',
					showConfirmButton: false,
					timer: 900
				});
			}
			else{
				$.ajax({
					type: "POST",
					url: "/api/loginBuyer",
					data: JSON.stringify({
						"email": email,
						"password": password,
						"provider": "buyer",
					}),
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					success: function(data){
						console.log(data);
						Swal.fire({

							type: 'success',
							title: 'เข้าสู่ระบบสำเร็จ',
							showConfirmButton: false,
							timer: 900
						});

						var mytoken = JSON.stringify(data['access_token']);
						var buyer_id = JSON.stringify(data['buyer_id']);
						var name = JSON.stringify(data['name']);
						localStorage.setItem("b_token",mytoken.replace(/['"]+/g, ''));
						localStorage.setItem("buyer_id",buyer_id.replace(/['"]+/g, ''));
						localStorage.setItem("name",name.replace(/['"]+/g, ''));
						
						setTimeout(function () {
							window.location.replace('/'); 
						}, 1000);
						
					},
					error: function(data){
						console.log(data);
						Swal.fire({
							type: 'error',
							title: 'Email หรือ Password ผิดพลาด กรุณาลองใหม่ !',
							showConfirmButton: false,
							timer: 1000
						});
					}
					,
					failure: function(errMsg) {
						alert(errMsg);
					}
				});
			}
		}
		else{
			Swal.fire({

				type: 'error',
				title: 'กรุณากรอกข้อมูลให้ครบ !',
				showConfirmButton: false,
				timer: 900
			});
		}

	});

	$("#logout").click(function(){
		$.ajax({
			url: '/api/logoutBuyer',
			headers: {
				'Authorization':'Bearer '+b_token,
				'Content-Type':'application/json'
			},
			method: 'GET',
			dataType: 'json',
			success: function(data){
				console.log(data);
				Swal.fire({

					type: 'success',
					title: 'ออกจากระบบแล้ว',
					showConfirmButton: false,
					timer: 900
				});
				removeCookies();
				localStorage.removeItem("b_token");
				localStorage.removeItem("name");
				localStorage.removeItem("buyer_id");
				setTimeout(function () {
					window.location.replace('/'); 
				}, 1000);
			}
		});
	});

	function removeCookies() {
		var res = document.cookie;
		var multiple = res.split(";");
		for(var i = 0; i < multiple.length; i++) {
			var key = multiple[i].split("=");
			document.cookie = key[0]+" =; expires = Thu, 01 Jan 1970 00:00:00 UTC";
		}
	}
	function search() {
		var product_name = document.getElementById("searchIndex").value;
		var pn = product_name;
		var product_name2 = '%';
		if(product_name != ''){

			product_name2 += product_name;
			product_name2 += '%';
			$.ajax({
				url: '/api/searchProduct',
				headers: {
					'Content-Type':'application/json'
				},
				method: 'POST',
				data: JSON.stringify({ "product_name":product_name2}),
				contentType: "application/json; charset=utf-8",
				dataType: 'json',
				success: function(data){
					if(data['product'] != null)
					{

						$('#product').empty();
						$('#product').append('<option value="ค้นหา '+pn+' ร้านค้า">');
						for(var i=0;i<data['product'].length;i++)
						{
							$('#product').append('<option value="'+data['product'][i]['prod_name']+'"></option>');
						}

					}else{
						$('#product').empty();
					}
				}
			});

		}else{
			$('#product').empty();
		}
	}

	function submitSearch(){
		var product_name = document.getElementById("searchIndex").value;

		createCookie('searchProduct',product_name,30);
		window.location.href = '/searchResult';
	}

	function createCookie(name,value,second) {
		if (second) {
			var date = new Date();
			date.setTime(date.getTime()+(second*1000));
			var expires = "; expires="+date.toGMTString();
		} else {
			var expires = "";
		}
		document.cookie = name+"="+value+expires+"; path=/";
	}

	function test(){
		alert(1);
	}


	function compare(){
		if(jsonCart['length'] >= 2)
		{
			createCookie('CompareProduct',JSON.stringify(jsonCart),120);
			window.location.href = '/compare';
		}else{
			alert('เลือกสินค้ามากกว่า 2 ชิ้น');
		}
	}

	$(document).on('keypress',function(e) {
		if(e.which == 13) {
			if(document.getElementById("searchIndex").value != ''){
				submitSearch();
			}
		}
	});

	$("#carts").click(function(){
		window.location.href = "/cart";
	});


	
</script>
</html>
