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
                                  <div class="user_icon"><img src="layout/images/user.svg" alt=""></div><a href="#" id="name"></a><hr>
                                  <button type="button" class="btn btn-outline btn-info" onclick="window.location.href = '/account';">แก้ไขข้อมูล</button>
                                  <button type="button" class="btn btn-outline btn-info" onclick="window.location.href = '/address';">จัดการที่อยู่</button>
                                  <button type="button" class="btn btn-w-m btn-info"><i class="fa fa-check"></i>&nbsp;การสั่งซื้อ</button>
                                </div>
                                <div class="clearfix visible-xs">
                                </div>

                                <div class="col-sm-6" id="order_list">
                                  <div>รายการสั่งซื้อของฉัน</div><hr>
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

    $("#nav-buyer").append('<div class="cart-page-logo__page-name">คำสั่งซื้อ</div>');

var b_token = localStorage.getItem("b_token");
var buyer_id = localStorage.getItem("buyer_id");
check_user();
getOrder();
getDetailsBuyer();

$(document).ready(function() {
  setInterval(function() {
    getOrder()
  }, 3000);
});

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
      $('#name').html(content['name']+' '+content['surname']);
    })();
  }

  function getOrder(){
    (async () => {
        const rawResponse = await fetch('/api/getOrder-buyer', {
          method: 'POST',
          headers: {
            'Authorization':'Bearer '+b_token,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({"buyer_id": buyer_id})
        });
        const content = await rawResponse.json();
        if(content['success'] != ''){
          $("#order_list").empty();
          for(i = 0 ; i<content['order_list'].length ; i++){
            $("#order_list").append('<div id="div_order_'+content['order_list'][i]['order_id']+'">'+
              '<small class="pull-right text-navy">วันเวลาที่สั่งซื้อ : '+content['order_list'][i]['created_at']+'</small>'+
              '<a href="#"><h5>OrderID : #'+content['order_list'][i]['order_id']+'</h5></a>'+
            '</div><hr>');
          }
          for(i = 0 ; i<content['success'].length ; i++){
            $("#div_order_"+content['success'][i]['order_id']).append(content['success'][i]['status'] == 0 ? '<button type="button" class="btn btn-w-m btn-info text-left">Order Detail : #'+content['success'][i]['order_detail_id']+'&nbsp&nbsp&nbsp&nbsp ราคาสินค้ารวมค่าจัดส่ง : '+content['success'][i]['price']+' บาท &nbsp&nbsp&nbsp&nbsp สถานะ : รอการจ่ายเงิน</button>':''+
            content['success'][i]['status'] == 1 ? '<button type="button" class="btn btn-w-m btn-warning text-left">Order Detail : #'+content['success'][i]['order_detail_id']+'&nbsp&nbsp&nbsp&nbsp ราคาสินค้ารวมค่าจัดส่ง : '+content['success'][i]['price']+' บาท &nbsp&nbsp&nbsp&nbsp สถานะ : รอการส่งของ</button>':''+
            content['success'][i]['status'] == 2 ? '<button type="button" class="btn btn-w-m btn-warning text-left">Order Detail : #'+content['success'][i]['order_detail_id']+'&nbsp&nbsp&nbsp&nbsp ราคาสินค้ารวมค่าจัดส่ง : '+content['success'][i]['price']+' บาท &nbsp&nbsp&nbsp&nbsp สถานะ : กำลังส่งของ</button>':''+
            content['success'][i]['status'] == 3 ? '<button type="button" class="btn btn-w-m btn-success text-left">Order Detail : #'+content['success'][i]['order_detail_id']+'&nbsp&nbsp&nbsp&nbsp ราคาสินค้ารวมค่าจัดส่ง : '+content['success'][i]['price']+' บาท &nbsp&nbsp&nbsp&nbsp สถานะ : ได้รับสินค้าแล้ว</button>':''+
            content['success'][i]['status'] == 4 ? '<button type="button" class="btn btn-w-m btn-danger text-left">Order Detail : #'+content['success'][i]['order_detail_id']+'&nbsp&nbsp&nbsp&nbsp ราคาสินค้ารวมค่าจัดส่ง : '+content['success'][i]['price']+' บาท &nbsp&nbsp&nbsp&nbsp สถานะ : ยกเลิก</button>':''+
            content['success'][i]['status'] == 5 ? '<button type="button" class="btn btn-w-m btn-default text-left">Order Detail : #'+content['success'][i]['order_detail_id']+'&nbsp&nbsp&nbsp&nbsp ราคาสินค้ารวมค่าจัดส่ง : '+content['success'][i]['price']+' บาท &nbsp&nbsp&nbsp&nbsp สถานะ : หมดอายุ</button>':'');
          }
        }else{
          
        }

      })();
  }


</script>
@endsection
