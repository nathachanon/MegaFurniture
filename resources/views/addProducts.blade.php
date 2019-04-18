@extends('layouts.layout_brand')

@section('content')
<body >

  <div class="row mt-mt ibox-title">

    <div class="col-lg-7">
      <div class="panel panel-mega">
       <div class="panel-heading">
        <i class="fa fa-file-excel-o"></i> เพิ่มไฟล์ Excel
      </div>


      <form method="post" action="{{url('/api/excelUpload')}}" enctype="multipart/form-data"
      class="dropzone" id="dropzone">
    </form>


  </div>
</div>
<div class="col-lg-5">
  <div class="panel panel-warning">

    <div class="panel-body">
      <div></div>
        <h3>ดาวน์โหลด Template สินค้า</h3>
      <p>ทดสอบๆๆๆๆ</p>
    </div>
  </div>
</div>

<div class="col-lg-12">

  <div class="ibox float-e-margins">


</div>
<div><button id="upload" type="button" class="btn btn-info btn-lg col-lg-12">เพิ่มสินค้า</button></div>
<div><button id="cancel" type="button" class="btn btn-danger btn-lg col-lg-12">ยกเลิก</button></div>
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
