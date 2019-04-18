@extends('layouts.layout_login')

@section('content')
<body class="gray-bg" >


        <div class="text-head text-head-mt ">

            <h1 class="animated rollIn">ยินดีต้อนรับเข้าสู่ Seller Centre</h1>

            <h3 class="animated rollIn">เข้าสู่ระบบด้วย Facebook แล้วขายสินค้าได้ทันที!</h3>
            <p class="animated rollIn">สำหรับผู้ที่ต้องการจะลงขาย เฟอร์นิเจอร์</p>
            <a href="{{url('/login/facebook')}}" class="btn btn-success btn-facebook btn-outline btn-lg mar-t animated rollIn">
                            <i class="fa fa-facebook"> </i> Sign in with Facebook
                    </a>

            <!--
            <form class="m-t" role="form">
                <div class="form-group">
                    <input id="email" type="email" class="form-control" placeholder="อีเมล์" required="">
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control" placeholder="รหัสผ่าน" required="">
                    <a href="#" class="fb btn"><i class="fa fa-facebook "></i>  Facebook</a>
                </div>
                <button id="login" type="button" class="btn btn-primary block full-width m-b">เข้าสู่ระบบ</button>
            </form>
          -->
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            window.onload = checksession;

            function checksession()
            {
              var token = localStorage.getItem("user_token");
              if(token != null)
              {
                window.location.replace('/profile');
              }
            }

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
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
                            url: "/api/loginSell",
                            data: JSON.stringify({
                            "email": email,
                            "provider": "seller",
                                }),
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            success: function(data){
                                console.log(data);
                              alert("เข้าสู่ระบบสำเร็จ !");
                              var mytoken = JSON.stringify(data['success']['token']);
                              var sid = JSON.stringify(data['success']['sid']);
                              localStorage.setItem("s_id",sid);
                              localStorage.setItem("user_token",mytoken.replace(/['"]+/g, ''));
                              //window.location.replace('/profile');
                            },
                            error: function(data){
                              console.log(data);
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
        });
    </script>
</body>

@endsection
