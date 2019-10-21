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
  width: 100%;
    height: 250px;
    object-fit: cover;
}
.modal-backdrop {
  z-index: 2040 !important;
}
.modal {
  z-index: 2050 !important;
}
</style>

<body >
 @if($errors->any())
 <h4>{{$errors->first()}}</h4>
 @endif
 <div class="row border-bottom2">
  <nav class="navbar navbar-static-top2" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
    </div>
    <ul class="nav navbar-top-links navbar-right">
      <li>
        <span id='welcomes' class="m-r-sm text-muted welcome-message"></span>
      </li>

      <li class="mt-mt">
       <button data-toggle="modal" data-target="#myModal" class="btn btn-success  " type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">เพิ่มแบรนด์</span></button>
     </li>
     <li>

     </li>
   </ul>

 </nav>
</div>
<div id="add">
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox-content m-b-md">
    <div class="p-xs">
      <div class="pull-left m-r-md">
        <i class="fa fa-bookmark   text-mega mid-icon"></i>
      </div>
      <h2>แบรนด์</h2>
      <span>เพิ่มแบรนด์ของคุณแล้วขายสินค้าได้ทันที</span>
    </div>
  </div>
  <div id="brand" class="row">
  </div>
</div>
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated bounceInRight">
      <div class="modal-header">
        <button type="button" id="btn_close" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-plus-circle modal-icon"></i>
        <h4 class="modal-title">เพิ่มแบรนด์สินค้า</h4>
      </div>
      <div class="modal-body">
        <input id="seller_id" name="seller_id" hidden="true">
        <input id="brand_status" name="brand_status" value="0" hidden="true">
        <div class="form-group"><label>ชื่อแบรนด์</label> <input id="brand_name" name="brand_name" type="text" placeholder="กรุณากรอกชื่อแบรนด์" class="form-control" require="true"></div>
        <div class="form-group"><label>รายละเอียดของแบรนด์</label> <input id="brand_des" name="brand_des" type="text" placeholder="กรุณากรอกรายละเอียดของแบรนด์" class="form-control"></div>
        <div class="form-group">
          <label>โลโก้แบรนด์</label>
          <div>  <img id='b_logo_show' src="#" class="preview" hidden="true"  ></img> <div>

            <input id="file_brand_logo" type="file" name="brand_logo" class="form-control" onchange="logoSelect(this)">

          </div>


      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">ปิด</button>
    <button id="Add" type="button" class="btn btn-primary">เพิ่มแบรนด์</button>
  </div>
  
</div>
</div>
</div>

</body>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/toastr/toastr.min.js"></script>
<script>
  var token = localStorage.getItem("user_token");
  var id= localStorage.getItem("sid");
   $("#brand-nav").addClass("active");
  $("#seller_id").val(id);
  function sbrand(b_id){
    if(b_id !=0)
    {
      document.cookie = "b_id="+b_id;

      localStorage.setItem("b_id",b_id);
      window.location.replace('/sbrand');
    }
  }

  function logoSelect(input) {
   $('#b_logo_show').attr('hidden',false);
   if (input.files && input.files[0]) {
     var reader = new FileReader();

     reader.onload = function (e) {
       $('#b_logo_show')
       .attr('src', e.target.result);

     };

     reader.readAsDataURL(input.files[0]);



   }



 }

 $(document).ready(function(){
  function getBrand(token,id){
    $.ajax({
      type: "POST",
      url: "/api/getBrand",
      headers: {
        'Authorization':'Bearer '+token,
        'Content-Type':'application/json'
      },
      data: JSON.stringify({
        "seller_id": id }),
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function(data){
        var b_count = data['brand_count'];
        for(var i=0 ;i<b_count ;i++){
          $('#brand').append('<div class="col-md-3">'+
            '<div class="ibox">'+
            '<div class="ibox-content product-box animated fadeInLeft">'+
            '<div class="product-imitation">'+
            '<img src="images_brand/'+data['brand'][i]['brand_logo']+'" class ="brand_logo"></img>'+
            '</div>'+
            '<div class="product-desc">'+
            '<a onclick="sbrand ('+data['brand'][i]['brand_id']+');" href="product" class="product-name">'+data['brand'][i]['brand_name']+'</a>'+
            '<div class="small m-t-xs">'+
            data['brand'][i]['brand_des']+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>');
        }



      }
      ,
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }
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
        id = data['seller']['id'];
        var name = data['seller']['name'];
        var surname = data['seller']['surname'];
        var email = data['seller']['email'];
        var img = data['seller']['avatar'];
        document.getElementById("welcomes").innerHTML = 'ยินดีต้อนรับคุณ : '+name+' '+surname;
        document.getElementById("nn").innerHTML = ' '+name+' '+surname;
        $('#img').append('<img  alt="image" class="img-circle img-48" src="'+img+'" />');

        getBrand(token,id);
      }
    });
  }
 $("#Add").click(function(){
    var token = localStorage.getItem("user_token");
    var brand_name = $("#brand_name").val();
    var brand_des = $("#brand_des").val();
    var brand_logo = $('#file_brand_logo').prop('files')[0];

      console.log("addBrand");
      var formData = new FormData();
      console.log($('#file_brand_logo').prop('files')[0]);
      formData.append("brand_logo",$('#file_brand_logo').prop('files')[0]);
      formData.append("brand_name",brand_name);
      formData.append("brand_des",brand_des);
      formData.append("brand_status",0);
      formData.append("seller_id",id);
     if(brand_name != '' && brand_des != '' && $('#file_brand_logo').prop('files')[0] != undefined){
        $.ajax({
           url: '/api/AddBrand',
           headers: {
             'Authorization':'Bearer '+token,
           },
           method: 'POST',
           data: formData,
           contentType: false,
           processData: false,
           dataType: 'json',
           success: function(data){
            var s = JSON.stringify(data['success']).replace(/['"]+/g, '');
            if(s == "1")
            {
              alert("เพิ่ม Brand สำเร็จ !");
              window.location.replace('/brand');
            }else{
              alert(s);
              $("#b_name").val('');
            }
          },
          failure: function(errMsg) {
            alert(errMsg);
          }
        });
      }else if(brand_name != '' && brand_des != ''){

        if($('#file_brand_logo').prop('files')[0] == undefined ){
          alert('กรุณาเลือกโลโก้แบรนด์');
        }else{
        alert('กรุณากรอกข้อมูลให้ครบ');
      }
    }
    else{
        alert('กรุณากรอกข้อมูลและเลือกโลโก้แบรนด์');
      }


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
