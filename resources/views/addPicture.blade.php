@extends('layouts.layout_brand')

@section('content')
<body >

    <div class="row mt-mt">
              <div class="col-lg-12">
                  <div class="ibox float-e-margins">
                      <div class="ibox-title">
                          <h3>เพิ่มไฟล์รูปภาพ</h3>
                          <div class="form-group">
                            <img id='spic1' src="#" class="preview" hidden="true" width="250" height="180"></img>
                            <label for="catagry_name">ภาพปก</label>
                            <input id="file_pic1" type="file" name="pic1" class="form-control" onchange="showpic1(this)">
                          </div>
                          <div class="form-group">
                            <img id='spic2' src="#" class="preview" hidden="true" width="250" height="180"></img>
                            <label for="catagry_name">รูปที่ 2</label>
                            <input id="file_pic2" type="file" name="pic2" class="form-control" onchange="showpic2(this)">
                          </div>
                          <div class="form-group">
                            <img id='spic3' src="#" class="preview" hidden="true" width="250" height="180"></img>
                            <label for="catagry_name">รูปที่ 3</label>
                            <input id="file_pic3" type="file" name="pic3" class="form-control" onchange="showpic3(this)">
                          </div>
                          <div class="form-group">
                            <img id='spic4' src="#" class="preview" hidden="true" width="250" height="180"></img>
                            <label for="catagry_name">รูปที่ 4</label>
                            <input id="file_pic4" type="file" name="pic4" class="form-control" onchange="showpic4(this)">
                          </div>
                          <div class="form-group">
                            <img id='spic5' src="#" class="preview" hidden="true" width="250" height="180"></img>
                            <label for="catagry_name">รูปที่ 5</label>
                            <input id="file_pic5" type="file" name="pic5" class="form-control" onchange="showpic5(this)">
                          </div>
                      </div>
                  </div>
                  <div><button id="upload" type="button" class="btn btn-info btn-lg col-lg-12">เพิมรูป</button></div>
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

$("#upload").click(function(){
  var product_ids = getCookie('product_id');
  var token = localStorage.getItem("user_token");
  if(document.getElementById("file_pic1").files[0] != undefined)
  {
    var formData = new FormData();

    formData.append("pic1", document.getElementById("file_pic1").files[0]);
    formData.append("pic2", document.getElementById("file_pic2").files[0]);
    formData.append("pic3", document.getElementById("file_pic3").files[0]);
    formData.append("pic4", document.getElementById("file_pic4").files[0]);
    formData.append("pic5", document.getElementById("file_pic5").files[0]);
    formData.append("Prod_id", product_ids);

    $.ajax({
      url: '/api/editupload',
      headers: {
          'Authorization':'Bearer '+token,
      },
      method: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(data){
        if(data['success'] != null)
        {
          alert('เพิ่มรูปภาพสำเร็จ !');
          window.location.replace('/product');
        }else{
          alert('เกิดข้อผิดพลาด !');
        }
      }
    });

 }else{
   alert('กรุณาใส่รูปก่อนกดเพิ่ม (บังคับรูปปก)');
 }

});



  $("#cancel").click(function(){
    window.location.replace('/addDetail');
  });

  window.onload = load();
});

function showpic1(input) {
 $('#spic1').attr('hidden',false);
 if (input.files && input.files[0]) {
   var reader = new FileReader();
   reader.onload = function (e) {
     $('#spic1')
     .attr('src', e.target.result);
   };
   reader.readAsDataURL(input.files[0]);
 }
}

function showpic2(input) {
$('#spic2').attr('hidden',false);
if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload = function (e) {
    $('#spic2')
    .attr('src', e.target.result);
  };
  reader.readAsDataURL(input.files[0]);
}
}
function showpic3(input) {
$('#spic3').attr('hidden',false);
if (input.files && input.files[0]) {
 var reader = new FileReader();
 reader.onload = function (e) {
   $('#spic3')
   .attr('src', e.target.result);
 };
 reader.readAsDataURL(input.files[0]);
}
}
function showpic4(input) {
$('#spic4').attr('hidden',false);
if (input.files && input.files[0]) {
 var reader = new FileReader();
 reader.onload = function (e) {
   $('#spic4')
   .attr('src', e.target.result);
 };
 reader.readAsDataURL(input.files[0]);
}
}
function showpic5(input) {
$('#spic5').attr('hidden',false);
if (input.files && input.files[0]) {
 var reader = new FileReader();
 reader.onload = function (e) {
   $('#spic5')
   .attr('src', e.target.result);
 };
 reader.readAsDataURL(input.files[0]);
}
}



</script>
@endsection
