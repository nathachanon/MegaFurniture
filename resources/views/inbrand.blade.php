@extends('layouts.layout_brand')

@section('content')
<style>
.preview
{
  margin-left: 27%;
  max-width:250px;

}
.brand_logo
{
  width:100%;
  height:100%;
}
</style>

<body >
 <div class="row border-bottom2">
  <nav class="navbar navbar-static-top2" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
    </div>
    <ul class="nav navbar-top-links navbar-right">
     <li>

     </li>
   </ul>

 </nav>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox-content m-b-md">
    <div class="p-xs">
      <div class="pull-left m-r-md">
        <i class="fa fa-bookmark   text-mega mid-icon"></i>
      </div>
      <h2>Brand Name : </h2>
      <span>จัดการแบรนด์ของคุณได้ง่าย สะดวก รวดเร็ว</span>
    </div>
  </div>
  <div class="ibox-content ">
    <div class="animated bounceIn">
      <a href="product"><button class="btn btn-info dim2 ani btn-large-dim ani b-shadow " type="button"><i class="fa fa-list"></i><div class="text-title">สินค้า</div></button></a>
      <a href="order"><button class="btn btn-danger dim2 ani btn-large-dim ani b-shadow " type="button"><i class="fa fa-th-large"></i><div class="text-title">คำสั่งซื้อ</div></button></a>
      <a href="brandSettings"><button class="btn btn-primary  dim2 btn-large-dim ani b-shadow" type="button"><i class="fa fa-gears"></i><div class="text-title">ตั้งค่าร้าน</div></button></a>
    </div>
  </div>
</div>
</body>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/toastr/toastr.min.js"></script>
<script src="layout/js/jquery-3.3.1.min.js"></script>
<script>
  var token = localStorage.getItem("user_token");
  var id= localStorage.getItem("sid");
  var b_id = localStorage.getItem("b_id");

 $(document).ready(function(){
   $('.ani').each(function() {
     animationHover(this, 'pulse');
   });
  function getDetails(){
    $.ajax({
      url: '/api/getDetailsSell',
      headers: {
        'Authorization':'Bearer '+token,
        'Content-Type':'application/json'
      },
      method: 'GET',
      dataType: 'json',
      success: function(data){
        var id = data['seller']['id'];
        var name = data['seller']['name'];
        var surname = data['seller']['surname'];
        var email = data['seller']['email'];
        var img = data['seller']['avatar'];

        document.getElementById("welcomes").innerHTML = 'ยินดีต้อนรับคุณ : '+name+' '+surname;
        document.getElementById("nn").innerHTML = ' '+name+' '+surname;
        $('#img').append('<img  alt="image" class="img-circle img-48" src="'+img+'" />');
      }
    });
  }

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
