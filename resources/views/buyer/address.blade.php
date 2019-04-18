@extends('layouts.layout_buyer')

@section('content')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/LR.css">
<hr>
              <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-xs-6 col-sm-2">
                                  <div class="row">
                                    <div class="user_icon"><img src="layout/images/user.svg" alt=""></div><a href="#" id="name"></a><hr>
                                    <hr><button type="button" class="btn btn-outline btn-info" onclick="window.location.href = '/account';">แก้ไขข้อมูล</button>
                                    <button type="button" class="btn btn-w-m btn-info"><i class="fa fa-check"></i>&nbsp;จัดการที่อยู่</button>
                                    <button type="button" class="btn btn-outline btn-info" onclick="window.location.href = '/purchase';">การสั่งซื้อ</button>
                                  </div>
                                </div>
                                <div class="clearfix visible-xs">
                                </div>

                                <div class="col-sm-6">
                                  <div class="row">
                                    <div class="col-md-9"><strong>ที่อยู่ของฉัน</strong></div>
                                    <div class="col-md-3"><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModal4" onclick="empty()"><i class="fa fa-plus"></i>&nbsp;เพิ่มที่อยู่</button></div>
                                </div><hr>
                                <div id="address_list">

                                </div>
                                </div>
                                <div class="col-sm-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content animated lightSpeedIn">
                          <div class="modal-header">
                              <h4 class="modal-title">เพิ่มที่อยู่</h4>
                          </div>
                          <div class="modal-body">
                             <select class="form-control m-b" name="province" id="province">
                                   <option value="0">เลือกจังหวัด</option>
                             </select>
                             <select class="form-control m-b" name="district" id="district" disabled>
                                   <option value="0">เลือก เขต / อำเภอ</option>
                             </select>
                             <select class="form-control m-b" name="zip_code" id="zip_code" disabled>
                                   <option value="0">รหัสไปรษณีย์</option>
                             </select>
                               <input class="form-control m-b" name="area" type="text" placeholder="บ้านเลขที่ / อาคาร / หมู่บ้าน ..." id="area">
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-white" data-dismiss="modal">ยกเลิก</button>
                              <button type="button" class="btn btn-primary" onclick="addAddress($('#province').val(),$('#district').val(),$('#zip_code').val(),$('#area').val())">ยืนยัน</button>
                          </div>
                      </div>
                  </div>
              </div>
<script src="js/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="layout/js/jquery-3.3.1.min.js"></script>
<script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- Script -->
<script src="js/Scripts/megaindex.js"></script>

<!-- Data picker -->
   <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<script>
    $("#nav-buyer").append('<div class="cart-page-logo__page-name">ที่อยู่</div>');

var b_token = localStorage.getItem("b_token");
var buyer_id = localStorage.getItem("buyer_id");
var province = [];
var district = [];
var zip_code = [];

check_user();
getAddress();
getDetailsBuyer();

function empty(){
  $("#province").val(0);
  $("#zip_code").val(0);
  $("#district").val(0);
  $("#district").empty();
  $("#zip_code").empty();
  $("#district").append('<option value="0">เลือก เขต / อำเภอ</option>');
  $("#zip_code").append('<option value="0">รหัสไปรษณีย์</option>');
  $("#zip_code").prop('disabled', true);
  $("#district").prop('disabled', true);
}

$("#district").change(function(){
  if($("#district").val() != 0){
    (async () => {
      const rawResponse = await fetch('/js/mapID.json', {
        method: 'GET',
      });
      const content = await rawResponse.json();
        zip_code = [];
      for(var k in content[$("#province").val()][$("#district").val()]) zip_code.push(k);

      $("#zip_code").empty();
      $("#zip_code").append('<option value="0">รหัสไปรษณีย์</option>');
      $("#zip_code").val(0);

      for(i = 0 ; i < zip_code.length ; i++){
        $("#zip_code").append('<option value="'+content[$("#province").val()][$("#district").val()][i]+'">'+content[$("#province").val()][$("#district").val()][i]+'</option>');
      }
     
      })();

    $("#zip_code").prop('disabled', false);

  }else{
    $("#zip_code").empty();
    $("#zip_code").append('<option value="0">รหัสไปรษณีย์</option>');
    $("#zip_code").val(0);
    $("#zip_code").prop('disabled', true);

  }
});

$("#province").change(function(){
  if($("#province").val() != 0){
    (async () => {
      const rawResponse = await fetch('/js/mapID.json', {
        method: 'GET',
      });
      const content = await rawResponse.json();
        district = [];
      for(var k in content[$("#province").val()]) district.push(k);

      $("#zip_code").empty();
      $("#zip_code").append('<option value="0">รหัสไปรษณีย์</option>');
      $("#zip_code").val(0);
      $("#zip_code").prop('disabled', true);
      $("#district").empty();
      $("#district").append('<option value="0">เลือก เขต / อำเภอ</option>');
      $("#district").val(0);

      for(i = 0 ; i < district.length ; i++){
        $("#district").append('<option value="'+district[i]+'">'+district[i]+'</option>');
      }

      })();

    $("#district").prop('disabled', false);

  }else{
    $("#district").empty();
    $("#district").append('<option value="0">เลือก เขต / อำเภอ</option>');
    $("#district").val(0);
    $("#district").prop('disabled', true);
    $("#zip_code").empty();
    $("#zip_code").append('<option value="0">รหัสไปรษณีย์</option>');
    $("#zip_code").val(0);
    $("#zip_code").prop('disabled', true);

  }
});

function getDetailsBuyer(){
  (async () => {
    const rawResponse = await fetch('/api/getDetailsBuyer', {
      method: 'GET',
      headers: {
        'Authorization':'Bearer '+b_token,
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
    });
    const content = await rawResponse.json();

      $('#name').html(content['name']+' '+content['surname']);

    })();
  }


(async () => {
  const rawResponse = await fetch('/js/mapID.json', {
    method: 'GET',
  });
  const content = await rawResponse.json();

    for(var k in content) province.push(k);

    for(i = 0 ; i < province.length ; i++){
      $("#province").append('<option value="'+province[i]+'">'+province[i]+'</option>');
    }

  })();


function check_user(){

  if(b_token != null && buyer_id != null){

  }else{
    window.location.replace('/');
  }

}

function addAddress(province,district,zip_code,area){

  if(province != '' && district != '' && zip_code != '' && area != ''){
    (async () => {
    const rawResponse = await fetch('/api/addAddress', {
      method: 'POST',
      headers: {
        'Authorization':'Bearer '+b_token,
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({"province": province, "district": district, "zipcode": zip_code, "area": area , "buyer_id":buyer_id})
    });
    const content = await rawResponse.json();
    if(content['success'] != ''){
      alert('เพิ่มที่อยู่เรียบร้อย !');
      window.location.replace('/address');
    }else{
      Swal.fire({
        type: 'warning',
        title: 'เกิดปัญหาบางอย่าง !',
        showConfirmButton: false,
        timer: 1500
      });
    }
  })();

}else{
  alert('กรุณากรอกข้อมูลให้ครบ');
}
}

function getAddress(){
  (async () => {
  const rawResponse = await fetch('/api/getAddress', {
    method: 'POST',
    headers: {
      'Authorization':'Bearer '+b_token,
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({"buyer_id":buyer_id})
  });
  const content = await rawResponse.json();
  if(content['success'] != ''){
    for(i = 0; i<content['success'].length ; i++){
      $("#address_list").append('<div class="row">'+
        '<div class="chat-element col-md-8">'+
            '<div class="media-body ">'+
                '<p class="m-b-xs">'+
                    content['success'][i]['province']+
                '</p>'+
                '<p class="m-b-xs">'+
                    content['success'][i]['district']+
                '</p>'+
                '<p class="m-b-xs">'+
                    'รหัสไปรษณีย์ : '+content['success'][i]['zipcode']+
                '</p>'+
                '<p class="m-b-xs">'+
                    'ข้อมูลที่อยู่ :'+content['success'][i]['area']+
                '</p>'+
            '</div>'+
        '</div>'+
        '<div class="col-md-4"><button class="btn btn-danger" type="button" onclick="deleteAddress('+content['success'][i]['Add_id']+')">ลบ</button><button class="btn btn-warning" type="button" disabled>ตั้งเป็นค่าเริ่มต้น</button></div>'+
      '</div><hr>');
    }
  }else{

  }
})();
}

function deleteAddress(add_id){
  Swal.fire({
    title: 'ยืนยันการลบที่อยู่',
    text: "เมื่อถูกลบที่อยู่จะหายไปจากระบบทันที !",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ตกลง ฉันต้องการลบ'
  }).then((result) => {
    if (result.value) {
      (async () => {
          const rawResponse = await fetch('/api/deleteAddress', {
            method: 'POST',
            headers: {
              'Authorization':'Bearer '+b_token,
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({"add_id": add_id})
          });
          const content = await rawResponse.json();
          console.log(content);
          if(content['success'] != null){
            alert('ลบที่อยู่ สำเร็จ !');
            window.location.replace('/address');
          }else{
            alert('เกิดข้อผิดพลาด');
          }
        })();
    }
  });
}

</script>
@endsection
