@extends('layouts.layout_buyer')

@section('content')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/LR.css">
              <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-xs-6 col-sm-2">
                                  <div class="user_icon"><img src="layout/images/user.svg" alt=""></div><a href="#" id="name"></a><hr>
                                  <button type="button" class="btn btn-w-m btn-info"><i class="fa fa-check"></i>&nbsp;แก้ไขข้อมูล</button>
                                  <button type="button" class="btn btn-outline btn-info" onclick="window.location.href = '/address';">จัดการที่อยู่</button>
                                  <button type="button" class="btn btn-outline btn-info" onclick="window.location.href = '/purchase';">การสั่งซื้อ</button>
                                </div>
                                <div class="clearfix visible-xs">
                                </div>

                                <div class="col-sm-6">
                                  <strong>ข้อมูลของฉัน</strong><hr>
                                    <div class="form-group">
                                      <label for="buyer_email">Email : <a href="#" id="email"></a></label>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-6 control-label">เบอร์โทรศัพท์ (ที่สามารถติดต่อได้)</label>
                                          <input type="text" id="buyer_tel" class="form-control" data-mask="(999) 999-9999" placeholder="">
                                    </div>
                                    <div class="center-on-page ">
                                      <h5 for="sex">เพศ</h5>
                                      <input type="radio" name="sex" id="sex_m" value="ชาย" />
                                      <label style="padding-left: 30px;" class="lb" for="sex_m">ชาย</label>
                                      <input type="radio" name="sex" id="sex_f" value="หญิง" />
                                      <label style="padding-left: 30px;" class="lb" for="sex_f">หญิง</label>
                                    </div>
                                    <div class="form-group" id="data_1">
                                        <label class="font-noraml">วันเกิด</label>
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="birthday">
                                        </div>
                                    </div>
                                    <a href="#" class="pm btn" id="save">บันทึก</a>
                                </div>
                                <div class="col-sm-2">
                                </div>
                            </div>
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
var b_token = localStorage.getItem("b_token");
var buyer_id = localStorage.getItem("buyer_id");
check_user();
getDetailsBuyer();
  $("#nav-buyer").append('<div class="cart-page-logo__page-name">บัญชีผู้ใช้</div>');

function check_user(){

  if(b_token != null && buyer_id != null){

  }else{
    window.location.replace('/');
  }

}

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
      if(content['sex'] == 'ชาย'){
        $('#sex_m').prop('checked', true);
      }else{
        $('#sex_f').prop('checked', true);
      }
      $('#buyer_tel').val(content['tel']);
      $('#email').html(content['email']);
      $('#name').html(content['name']+' '+content['surname']);
      document.getElementById("birthday").value = content['birthday'];

    })();
  }

  $('#save').click(function(){
    var tel = $('#buyer_tel').val();
    var birthday = $("#birthday").val();
    var sex;
    var m = document.getElementById("sex_m")
    var f = document.getElementById("sex_f")
    if(m.checked == true){
      sex = "ชาย"
    }else if(f.checked == true){
      sex = "หญิง"
    }else{
      sex = null;
    }

    if(tel != '' && sex != '' && birthday != ''){
      (async () => {
          const rawResponse = await fetch('/api/updateBuyer', {
            method: 'POST',
            headers: {
              'Authorization':'Bearer '+b_token,
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({"buyer_id": buyer_id, "tel": tel, "sex": sex, "birthday": birthday})
          });
          const content = await rawResponse.json();
          if(content['message'] == "Update Success!"){
            Swal.fire({
              type: 'success',
              title: 'อัพเดทข้อมูล เรียบร้อย',
              showConfirmButton: false,
              timer: 1500
            });
            getDetailsBuyer()
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
      Swal.fire({
        type: 'error',
        title: 'กรอกข้อมูลให้ครบก่อน บันทึก !',
        showConfirmButton: false,
        timer: 1500
      });
    }
  });

        $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "yyyy-mm-dd"
            });

</script>
@endsection
