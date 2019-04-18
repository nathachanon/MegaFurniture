@extends('layouts.layout')
  <link rel="stylesheet" type="text/css" href="css/LR.css">

@section('content')

<div class="row justify-content-md-center animated fadeInUp">
  <div class="col-md-10 offset+md-1">
    <h2>สมัครสมาชิก</h2>
    <div class="row justify-content-md-center">
      <div class="col-md-6 register-left">
        <div class="register-form">
          <div class="form-group">
            <label for="name">ชื่อ</label>
            <input type="text"  onkeypress="return (event.charCode != 32)" name="name" id="name" class="form-control" placeholder="ชื่อ" required>
          </div>
          <div class="form-group">
            <label for="surname">นามสกุล</label>
            <input type="text" onkeypress="return (event.charCode != 32)" name="surname" id="surname" class="form-control" placeholder="นามสกุล" required>
          </div>
          <div class="form-group">
            <label for="birthday">วันเกิด</label>
            <input type="date" onkeypress="return (event.charCode != 32)" name="birthday"  id="birthday" class="form-control" placeholder="วันเกิด" required>
          </div>
          <div class="center-on-page ">
            <h5 for="sex">เพศ</h5>

            <input type="radio" name="sex" id="sex_m" value="ชาย" />
            <label style="padding-left: 30px;" class="lb" for="sex_m">ชาย</label>
            <input type="radio" name="sex" id="sex_f" value="หญิง" />
            <label style="padding-left: 30px;" class="lb" for="sex_f">หญิง</label>
          </div>

        </div>

      </div>
      <div class="col-md-6 register-right">
        <div class="form-group">
          <label for="email">อีเมล</label>
          <input type="email" onkeypress="return (event.charCode != 32)" id="email" class="form-control" placeholder="อีเมล" required>
        </div>
        <div class="form-group">
          <label for="password">รหัสผ่าน</label>
          <input type="password" onkeypress="return (event.charCode != 32)" id="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
        </div>

        <div class="form-group">
          <label for="c_password">ยืนยันรหัสผ่าน</label>
          <input type="password" onkeypress="return (event.charCode != 32)" id="c_password" name="c_password" class="form-control" placeholder="ยืนยันรหัสผ่าน" required>
        </div>
        <div class="form-group-mg">
          <label> <input id="role" required="" value="true" type="checkbox" class="checkbox i-checks"><i></i> ยอมรับเงื่อนไขข้อตกลงจากผู้ให้บริการ </label>
        </div>
        <a href="#" id="reg" class="pm btn">สมัครสมาชิก</a>


      </div>
    </div>
  </div>
</div>
</div>
<!-- Mainly scripts -->
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
  $(document).ready(function(){

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
       name : $("#name").val(),
       surname : $("#surname").val(),
       sex :sex,
       birthday : $("#birthday").val(),
       email : $("#email").val(),
       password : $("#password").val(),
       c_password : $("#c_password").val()

     };

     if( $("#name").val() != '' && $("#surname").val() != '' && $("#birthday").val() != '' && $("#email").val() != '' && $("#password").val() != ''){
      if(isEmail($("#email").val()) == ''){
        alert("รูปแบบ Email ไม่ถูกต้อง");
      }
      else if($("#password").val() != $("#c_password").val()){
        alert("รหัสผ่านไม่ตรงกัน");
      }
      else if($("input[id='role']:checked").val() == null){
        alert("กรุณายอมรับเงื่อนไขข้อตกลงจากผู้ให้บริการ ก่อนทำการสมัครสมาชิก");
      }else if(sex == null){
        alert("กรุณาระบุเพศ");
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

              alert("Email นี้ถูกใช้งานแล้ว !");
              $("#email").val('');
            }
            else if (status == "\"Register Success\""){
              alert("สมัครสมาชิกสำเร็จ !");
              window.location.replace('/');
            }
          },
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
  });

</script>


@endsection
