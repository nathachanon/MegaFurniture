<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin : Login</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.min.css">

</head>

<body class="gray-bg">
  <center>
  <h1 class="logo-name" >MEGA </h1>
  <h1 class="logo-name" >Furniture </h1>

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>



            </div>
            <h3>เพิ่มผู้ดูแลระบบ</h3>


                <div class="form-group">
                    <input type="text" id="username" class="form-control" placeholder="ชื่อยูสเซอร์" required="">
                </div>
                <div class="form-group">
                    <input type="password" id="password" class="form-control" placeholder="รหัสผ่าน" required="">
                </div>
                <button type="submit" id="registerAdmin" class="btn btn-primary block full-width m-b" style="background-color: #F59121;border: 1px solid gray;">บันทึก</button>




        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/js/jquery-2.1.1.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.all.min.js"></script>

</body>

</html>


<script>
var a_token = localStorage.getItem("a_token");
var admin_id = localStorage.getItem("admin_id");



check_user();

	function check_user(){

		if(a_token != null && admin_id != null){
      console.log("goto index");
			window.location.replace('/admin/index');
		}

	}



$('#registerAdmin').click(function(){
  var username = $("#username").val();
  var password = $("#password").val();
    if(username != '' && password != ''){

            $.ajax({
                type: "POST",
                url: "/api/registerAdmin",
                data: JSON.stringify({
                "username": username,
                "password": password,
                "provider": "admin",
                    }),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data){
                    console.log(data);
                  alert("เพิ่มผู้ดูแลระบบสำเร็จ !");
                  //window.location.replace('/admin');
                },
                error: function(data){
                  console.log(data);
                  Swal.fire({
                    type: 'error',
                    title: 'มียูสเซอร์เนมนี้ในระบบแล้ว',
                    showConfirmButton: false,
                    timer: 1500
                  });
                }
                ,
                failure: function(errMsg) {
                    alert(errMsg);
                }
            });
        }

    else{
      alert("กรอกข้อมูลให้ครบ");
    }

});
</script>
