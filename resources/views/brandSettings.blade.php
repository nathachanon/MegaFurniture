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
.modal-backdrop {
  z-index: 2040 !important;
}
.modal {
  z-index: 2050 !important;
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
      <h2 id="brand_name"></h2>
      <span>จัดการแบรนด์ของคุณได้ง่าย สะดวก รวดเร็ว</span>
    </div>
  </div>
    </div>
<br>
<br>
<div class="row border-bottom2">
  <nav class="navbar navbar-static-top2" role="navigation" style="margin-bottom: 0">
    <ul class="nav navbar-top-links navbar-left">
      <li>
        <a class="mt-sbrand" href="#"><h3>จัดการบัญชีธนาคาร</h3></a>
      </li>
    </ul>
    <ul class="nav navbar-top-links navbar-right">
     <li>
       <a data-toggle="modal" data-target="#myModal4" onclick="emptyModal()"><button  class="btn btn-info" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">เพิ่มบัญชีธนาคาร</span></button></a>
     </li>
     <div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content animated lightSpeedIn">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                     <i class="fa fa-bank modal-icon"></i>
                     <h4 class="modal-title">เพิ่มบัญชีธนาคารที่คุณต้องการ</h4>
                     <small>หลังจากเพิ่ม ให้กดเปิดใช้งานที่หน้าหลัก 1 ธนาคารจะเปิดใช้งานได้แค่บัญชีเดียวเท่านั้น</small>
                 </div>
                 <div class="modal-body">
                   <label class="col-sm-2 control-label">ธนาคาร</label>
                    <select class="form-control m-b" name="bank_account" id="bank_name">
                          <option value="0">เลือกธนาคารที่ต้องการ</option>
                    </select>
                  <label class="col-sm-2 control-label">เลขบัญชี</label>
                    <input type="text" placeholder="กรุณาใส่เลขบัญชี" class="form-control" maxlength="20" minlength="10" id="account_number">
                  <label class="col-sm-2 control-label">ชื่อบัญชี</label>
                    <input type="text" placeholder="กรุณาใส่ชื่อบัญชี" class="form-control" maxlength="50" minlength="10" id="account_name">
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-white" data-dismiss="modal">ปิด</button>
                     <button type="button" class="btn btn-primary" onclick="addBankAccount($('#bank_name').val(),$('#account_number').val(),$('#account_name').val())">เพิ่มธนาคาร</button>
                 </div>
             </div>
         </div>
     </div>
   </ul>

 </nav>
</div>
<div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">

                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                  <th>#</th>
                                  <th data-hide="phone">ชื่อธนาคาร</th>
                                  <th data-hide="phone">ชื่อบัญชี</th>
                                  <th data-hide="phone">เลขบัญชี</th>
                                  <th data-hide="phone">สถานะ</th>
                                  <th class="text-right">ตั้งค่า</th>
                                </tr>
                                </thead>
                                <tbody id="banktable">
                              </tbody>
                           </table>
                      </div>
                   </div>
              </div>
</div>

</body>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/toastr/toastr.min.js"></script>
<script src="layout/js/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
var token = localStorage.getItem("user_token");
var id= localStorage.getItem("sid");
var sid = localStorage.getItem("sid");

getDetails();
getBankName();
getBankAccount();
load();


  function checksession()
  {
    var token = localStorage.getItem("user_token");
    if(token == null)
    {
      alert('กรุณา Login ก่อนเข้าใช้งาน !');
      window.location.replace('/login');
    }
  }
  function checkbrand()
  {
    if(sid == null)
    {
      alert('กรุณาเลือกbrandก่อนเข้าใช้งาน !');
      window.location.replace('/brandSettings');
    }
  }

  function load()
  {
    if(sid != null){


    }else{
      window.location.replace('/profile');
    }

  }

  function addBankAccount(bankname,a_number,a_name){
    if(bankname != 0 & a_number != '' & a_name != ''){
      (async () => {
          const rawResponse = await fetch('/api/addBankAccount', {
            method: 'POST',
            headers: {
              'Authorization':'Bearer '+token,
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({"seller_id": sid,"bank_id": bankname,"bank_account": a_number,"account_name": a_name})
          });
          const content = await rawResponse.json();
          console.log(content);
          if(content['success'] != null){
            alert('เพิ่มบัญชีธนาคาร เรียบร้อย !');
            window.location.replace('/brandSettings');
          }else{
            alert('เกิดข้อผิดพลาด');
          }
        })();
    }else{
      alert("กรุณากรอกข้อมูลให้ครบ !");
    }
  }

  function getBankAccount(){
      (async () => {
          const rawResponse = await fetch('/api/getBankAccount', {
            method: 'POST',
            headers: {
              'Authorization':'Bearer '+token,
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({"seller_id": sid})
          });
          const content = await rawResponse.json();
          console.log(content);
          if(content['success'] != null){
            for(i = 0 ; i<content['success'].length ; i++){
              $("#banktable").append('<tr>'+
                  '<td>'+(i+1)+'</td>'+
                  '<td>'+content['success'][i]['bank_name']+'</td>'+
                  '<td>'+content['success'][i]['account_name']+'</td>'+
                  '<td>'+content['success'][i]['bank_account']+'</td>'+
                  (content['success'][i]['status'] == 0 ? '<td><span class="label label-danger">ไม่ถูกใช้งาน</span></td>':'<td><span class="label label-primary">ถูกใช้งาน</span></td>')+
                  '<td class="text-right">'+
                          '<button class="btn-white btn btn-xs" onclick="changeStatus('+content['success'][i]['bank_id']+','+content['success'][i]['status']+','+content['success'][i]['BankAccount_id']+')">เปลี่ยนสถานะ</button>'+
                          '<button class="btn-white btn btn-xs" onclick="deleteAccount('+content['success'][i]['BankAccount_id']+')">ลบ</button>'+
                  '</td>'+
            '</tr>');
            }
          }else{
            alert('เกิดข้อผิดพลาด');
          }
        })();
  }

  function getBankName(){
    (async () => {
        const rawResponse = await fetch('/api/getBankName', {
          method: 'GET',
          headers: {
            'Authorization':'Bearer '+token,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
        });
        const content = await rawResponse.json();
        if(content['success'] != null){
          console.log(content['success']);
          for(x = 0;x < content['success'].length ; x++){
            $("#bank_name").append('<option value="'+content['success'][x]['bank_id']+'">'+content['success'][x]['bank_name']+'</option>')
          }
        }else{

        }
      })();
  }

function emptyModal(){
  $("#bank_name").val(0);
  $("#account_number").val('');
  $("#account_name").val('');
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

function changeStatus(bank_id,status,BankAccount_id){
  Swal.fire({
    title: 'ยืนยันการเปลี่ยนสถานะบัญชี',
    text: "ธนาคารเดียวกันสามารถใช้งานได้ทีละ 1 บัญชีเท่านั้น",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ตกลง ฉันต้องการเปลี่ยนสถานะ'
  }).then((result) => {
    if (result.value) {
      (async () => {
          const rawResponse = await fetch('/api/changeStatus-Bank', {
            method: 'POST',
            headers: {
              'Authorization':'Bearer '+token,
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({"bank_id": bank_id,"status": status,"BankAccount_id": BankAccount_id})
          });
          const content = await rawResponse.json();
          console.log(content);
          if(content['success'] != null){
            alert('แก้ไขสถานะบัญชี สำเร็จ !');
            window.location.replace('/brandSettings');
          }else{
            alert('เกิดข้อผิดพลาด');
          }
        })();
    }
  });
}

function deleteAccount(BankAccount_id){
  Swal.fire({
    title: 'ยืนยันการลบบัญชี',
    text: "เมื่อถูกลบบัญชีธนาคารจะหายไปจากระบบทันที !",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ตกลง ฉันต้องการลบ'
  }).then((result) => {
    if (result.value) {
      (async () => {
          const rawResponse = await fetch('/api/deletebankAccount', {
            method: 'POST',
            headers: {
              'Authorization':'Bearer '+token,
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({"BankAccount_id": BankAccount_id})
          });
          const content = await rawResponse.json();
          console.log(content);
          if(content['success'] != null){
            alert('ลบบัญชีธนาคาร สำเร็จ !');
            window.location.replace('/brandSettings');
          }else{
            alert('เกิดข้อผิดพลาด');
          }
        })();
    }
  });
}

</script>
@endsection
