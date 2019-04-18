@extends('layouts.layout')
  <link rel="stylesheet" type="text/css" href="css/LR.css">

@section('content')

<div class="row justify-content-md-center animated fadeInUp">
  <div class="col-md-10 offset+md-1">
    <h2>เข้าสู่ระบบ</h2>
    <div class="row justify-content-md-center">
      <div class="col-md-6 register-right">

        <div class="form-group">
          <label for="email">อีเมล</label>
          <input type="email" name="email" onkeypress="return (event.charCode != 32)" id="email" class="form-control" placeholder="อีเมล" required>
        </div>
        <div class="form-group">
          <label for="password">รหัสผ่าน</label>
          <input type="password" onkeypress="return (event.charCode != 32)" id="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
        </div>
        <a href="#" id="login" class="pm btn">เข้าสู่ระบบ</a>


      </div>
    </div>
  </div>
</div>
</div>
<!-- Mainly scripts -->
<script src="layout/js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>
<script src="js/plugins/toastr/toastr.min.js"></script>

<script>
var b_token = localStorage.getItem("b_token");
var buyer_id = localStorage.getItem("buyer_id");

check_user();

	function check_user(){

		if(b_token != null && buyer_id != null){
			window.location.replace('/');
		}

	}
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

$('#login').click(function(){
  var email = $("#email").val();
  var password = $("#password").val();
    if(email != '' && password != ''){
        if(isEmail(email) == ''){
          alert("รูปแบบ Email ไม่ถูกต้อง");
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
                  alert("เข้าสู่ระบบสำเร็จ !");
                  var mytoken = JSON.stringify(data['access_token']);
                  var buyer_id = JSON.stringify(data['buyer_id']);
                  var name = JSON.stringify(data['name']);
                  localStorage.setItem("b_token",mytoken.replace(/['"]+/g, ''));
                  localStorage.setItem("buyer_id",buyer_id.replace(/['"]+/g, ''));
                  localStorage.setItem("name",name.replace(/['"]+/g, ''));
                  window.location.replace('/');
                },
                error: function(data){
                  console.log(data);
                  Swal.fire({
                    type: 'error',
                    title: 'Email หรือ Password ผิดพลาด กรุณาลองใหม่ !',
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
    }
    else{
      alert("กรอกข้อมูลให้ครบ");
    }

});
</script>


@endsection
