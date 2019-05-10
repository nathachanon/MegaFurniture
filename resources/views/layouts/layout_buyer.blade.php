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
	<link rel="stylesheet" type="text/css" href="layout/styles/product_styles.css">

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
						<div class="col-lg-12 col-sm-3 col-6 order-1">
							<div id ="nav-buyer" class="logo_container-b">
								<div class="logo-b"><a href="/">MEGA Furniture</a></div>
								
							</div>
							
						</div>

					</header>


					@yield('content')

				</div>





				<script src="layout/js/jquery-3.3.1.min.js"></script>
				<script src="layout/styles/bootstrap4/popper.js"></script>
				<script src="layout/styles/bootstrap4/bootstrap.min.js"></script>

				<!-- Mainly scripts -->
				<script src="js/jquery-2.1.1.js"></script>
				<script src="js/bootstrap.min.js"></script>
				<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
				<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

				<!-- Custom and plugin javascript -->
				<script src="js/inspinia.js"></script>
				<script src="js/plugins/pace/pace.min.js"></script>

				<script src="js/plugins/iCheck/icheck.min.js"></script>
				<script>
					var b_token = localStorage.getItem("b_token");
					var buyer_id = localStorage.getItem("buyer_id");

					check_user();

					function check_user(){

						if(b_token != null && buyer_id != null){
							$("#top_bar_user").empty();
							$("#top_bar_user").html('<div class="user_icon"><img src="layout/images/user.svg" alt=""></div><div ><div class="btn-group">'+
								'<a data-toggle="dropdown" class="btn-xs dropdown-toggle" aria-expanded="false">'+localStorage.getItem("name")+'<span class="caret"></span></a>'+
								'<ul class="dropdown-menu">'+
								'<li><a href="/purchase">การสั่งซื้อของฉัน</a></li>'+
								'<li><a href="/account">บัญชีของฉัน</a></li>'+
								'<li><a href="#" id="logout">ออกจากระบบ</a></li>'+
								'</ul>'+
								'</div>');
						}else{
							window.location.replace('/');
						}

					}

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
								alert("ออกจากระบบแล้ว !");
								removeCookies();
								localStorage.removeItem("b_token");
								localStorage.removeItem("name");
								localStorage.removeItem("buyer_id");
								window.location.replace('/');
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
				</script>
			</body>
			</html>
