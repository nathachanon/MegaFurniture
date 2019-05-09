@extends('layouts.layout_isme')

@section('content')
<body class="bg-white">
  <div class="text-head">
    <h1 class="animated fadeInRight">ยินดีต้อนรับเข้าสู่ Seller Centre</h1>

    <div class="ibox-content ">
      <div class="animated bounceIn">
        <a href="brand" ><button class="btn btn-info dim2 btn-large-dim  ani b-shadow " type="button"><i class="fa fa-th-list"></i><div class="text-title">แบรนด์</div></button></a>
        <a href="order"><button class="btn btn-danger dim2 ani btn-large-dim ani b-shadow " type="button"><i class="fa fa-th-large"></i><div class="text-title">คำสั่งซื้อ</div></button></a>
      <a href="brandSettings"><button class="btn btn-primary  dim2 btn-large-dim ani b-shadow" type="button"><i class="fa fa-gears"></i><div class="text-title">ตั้งค่าร้าน</div></button></a>
      </div>

    </div>
  </div>
</body>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/toastr/toastr.min.js"></script>
<script>
  $(document).ready(function(){

   $('.ani').each(function() {
     animationHover(this, 'pulse');
   });



   function getDetails(){
    var token = localStorage.getItem("user_token");
    $.ajax({
      url: '/api/getDetailsSell',
      headers: {
        'Authorization':'Bearer '+token,
        'Content-Type':'application/json'
      },
      method: 'GET',
      dataType: 'json',
      success: function(data){
        console.log(data);
        var id = data['seller']['id'];
        console.log(id);
        var name = data['seller']['name'];
        var surname = data['seller']['surname'];
        var email = data['seller']['email'];
        var img = data['seller']['avatar'];

        localStorage.setItem("sid",id);
        document.getElementById("welcomes").innerHTML = 'ยินดีต้อนรับคุณ : '+name+' '+surname;
        document.getElementById("nn").innerHTML = ' '+name+' '+surname;
        $('#img').append('<img  alt="image" class="img-circle img-48" src="'+img+'" />');

        setTimeout(function() {
          toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
          };
          toastr.success(email, 'ยินดีต้อนรับ');

        }, 1300);
      }
    });
  }
  $("#logout").click(function(){
    var token = localStorage.getItem("user_token");
    console.log(token);
    $.ajax({
      url: '/api/logoutSell',
      headers: {
        'Authorization':'Bearer '+token,
        'Content-Type':'application/json'
      },
      method: 'GET',
      dataType: 'json',
      success: function(data){
        alert("ออกจากระบบแล้ว !");
        document.cookie = 'b_id=; Max-Age=-99999999;';
        document.cookie = 'product_id=; Max-Age=-99999999;';
        document.cookie = 'view_id=; Max-Age=-99999999;';
        localStorage.removeItem("b_id");

        localStorage.removeItem("user_token");
        window.location.replace('/login');
      }
    });
  });
  function checksession()
  {
    var token = localStorage.getItem("user_token");
    if(token == null)
    {
      alert('กรุณา Login ก่อนเข้าใช้งาน !');
      window.location.replace('/login');
    }
  }

  function load()
  {
    checksession();
    getDetails();
  }

  window.onload = load;
});
</script>
@endsection
