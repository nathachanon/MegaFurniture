@extends('layouts.layout_brand')

@section('content')
<head>
  <link href="css/addPord_excel.css" rel="stylesheet">
</head>
<body >

  <div class="row mt-mt ibox-title">

   <h2>เพิ่มสินค้าหลายชิ้น</h2> 
   <div class="hr-line-dashed"></div>

   <div class="col-lg-8">
    <div class="panel panel-mega">
     <div class="panel-heading">
      <i class="fa fa-file-excel-o"></i> เพิ่มไฟล์ Excel
    </div>

    <form method="post" action="{{url('/api/excelUpload')}}" enctype="multipart/form-data"
    class="dropzone" id="dropzone">
  </form>


</div>
</div>


<div class="col-lg-4">
  <div class="box8">
    <img src="/css/patterns/excel-01.png">
    <h3 class="title">ดาวน์โหลด Template สินค้า</h3>
    <h3 class="title2">เพื่อความสะดวกรวดเร็ว<br> กรุณาศึกษาคู่มือการใช้งาน Template <br>การเพิ่มสินค้าทีละหลายชิ้น </h3>

    <div class="box-content">

      <div class="icon">
        <button   class="btn btn-white input-lg col-lg-6" type="button" >คู่มือการใช้งาน</button>
        <button  class="btn btn-white input-lg col-lg-6 " onclick="window.location.href = 'excel/MegaFurniture_Product_Create.xlsx';" type="button" >ดาวน์โหลด</button>

      </div>


    </div>
  </div><br>
  <button id="upload" class="btn btn-primary input-lg col-lg-6 btn-lg " type="button" >เพิ่มสินค้า</button>
  <button id="cancel" class="btn btn-white input-lg  col-lg-6 btn-lg " type="button" >ยกเลิก</button>
</div>





</div>





</body>
<script src="js/jquery-2.1.1.js"></script>
<script type="text/javascript"
src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js">
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/toastr/toastr.min.js"></script>
<script>
  var pid=0;
  var b_id = localStorage.getItem("b_id");
  var token = localStorage.getItem("user_token");
  var id;
  var elem = document.querySelector('.js-switch');

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
  }


  function getCookie(name) {
    function escape(s) { return s.replace(/([.*+?\^${}()|\[\]\/\\])/g, '\\$1'); };
    var match = document.cookie.match(RegExp('(?:^|;\\s*)' + escape(name) + '=([^;]*)'));
    return match ? match[1] : null;
  }


  $(document).ready(function(){
    Dropzone.options.dropzone = {
      autoProcessQueue: false,
      parallelUploads: 1,
      maxFiles:1,
      success: function(file, response){
        alert('เพิ่มสินค้าสำเร็จ');
        window.location.replace('/product');
      }
    }
    var value1='';
    $("#upload").click(function(){
      var myDropzone = Dropzone.forElement(".dropzone");
      myDropzone.processQueue();
    });


    $("#cancel").click(function(){
      window.location.replace('/product');
    });

    window.onload = load();
  });



</script>
@endsection
