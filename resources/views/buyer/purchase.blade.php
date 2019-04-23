@extends('layouts.layout_buyer')

@section('content')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/LR.css">
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
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
    }, 5000);
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
        console.log(content);
        $("#order_list").empty();
        for(i = 0 ; i<content['order_list'].length ; i++){
          $("#order_list").append('<div id="div_order_'+content['order_list'][i]['order_id']+'">'+
            '<small class="pull-right text-navy">วันเวลาที่สั่งซื้อ : '+content['order_list'][i]['created_at']+'</small>'+
            '<a href="#"><h5>OrderID : #'+content['order_list'][i]['order_id']+'</h5></a>'+
            '<div id="order_brand_'+content['order_list'][i]['order_id']+'">'+
            '</div><hr>');
          for(j = 0 ; j<content['brand_list'].length ; j++){
            $("#order_brand_"+content['order_list'][i]['order_id']).append('<div id="div_order_'+content['order_list'][i]['order_id']+'_brand_'+content['brand_list'][j]['brand_id']+'">'+
              'Brand_'+content['brand_list'][j]['brand_id']+
              (content['brand_list'][j]['status'] == 0 ? '<button type="button" onclick="payment('+content['order_list'][i]['order_id']+','+content['brand_list'][j]['brand_id']+','+content['sum'][j]['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+')" class="btn btn-w-m btn-info text-left">OrderID: #'+content['order_list'][i]['order_id']+'B'+content['brand_list'][j]['brand_id']+'&nbsp แจ้งโอนเงิน ที่นี่ จำนวนเงินที่ต้องโอน: '+content['sum'][j]['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' &nbsp&nbsp&nbsp&nbsp&nbsp สถานะ : รอการจ่ายเงิน</button>':'')+
              '</div>');
          }
        }

        for(i = 0 ; i<content['success'].length ; i++){
          $("#div_order_"+content['success'][i]['order_id']+"_brand_"+content['success'][i]['brand_id']).append(content['success'][i]['status'] == 0 ? '<button type="button" class="btn btn-w-m btn-info text-left">Order Detail : #'+content['success'][i]['order_detail_id']+'&nbsp&nbsp&nbsp&nbsp ราคาสินค้ารวมค่าจัดส่ง : '+content['success'][i]['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' บาท &nbsp&nbsp&nbsp&nbsp สถานะ : รอการจ่ายเงิน</button>':''+
            content['success'][i]['status'] == 1 ? '<button type="button" class="btn btn-w-m btn-warning text-left">Order Detail : #'+content['success'][i]['order_detail_id']+'&nbsp&nbsp&nbsp&nbsp ราคาสินค้ารวมค่าจัดส่ง : '+content['success'][i]['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' บาท &nbsp&nbsp&nbsp&nbsp สถานะ : รอการส่งของ</button>':''+
            content['success'][i]['status'] == 2 ? '<button type="button" class="btn btn-w-m btn-warning text-left">Order Detail : #'+content['success'][i]['order_detail_id']+'&nbsp&nbsp&nbsp&nbsp ราคาสินค้ารวมค่าจัดส่ง : '+content['success'][i]['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' บาท &nbsp&nbsp&nbsp&nbsp สถานะ : กำลังส่งของ</button>':''+
            content['success'][i]['status'] == 3 ? '<button type="button" class="btn btn-w-m btn-success text-left">Order Detail : #'+content['success'][i]['order_detail_id']+'&nbsp&nbsp&nbsp&nbsp ราคาสินค้ารวมค่าจัดส่ง : '+content['success'][i]['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' บาท &nbsp&nbsp&nbsp&nbsp สถานะ : ได้รับสินค้าแล้ว</button>':''+
            content['success'][i]['status'] == 4 ? '<button type="button" class="btn btn-w-m btn-danger text-left">Order Detail : #'+content['success'][i]['order_detail_id']+'&nbsp&nbsp&nbsp&nbsp ราคาสินค้ารวมค่าจัดส่ง : '+content['success'][i]['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' บาท &nbsp&nbsp&nbsp&nbsp สถานะ : ยกเลิก</button>':''+
            content['success'][i]['status'] == 5 ? '<button type="button" class="btn btn-w-m btn-default text-left">Order Detail : #'+content['success'][i]['order_detail_id']+'&nbsp&nbsp&nbsp&nbsp ราคาสินค้ารวมค่าจัดส่ง : '+content['success'][i]['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' บาท &nbsp&nbsp&nbsp&nbsp สถานะ : หมดอายุ</button>':'');
        }

      }else{

      }

    })();
  }

  function payment(order_id,brand_id,price){
    (async () => {
      const rawResponse = await fetch('/api/getBank-brand', {
        method: 'POST',
        headers: {
          'Authorization':'Bearer '+b_token,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({"brand_id": brand_id})
      });
      const content = await rawResponse.json();
      if(content['success'] != ''){
        console.log(content);
        Swal.fire({
          title: '<strong>แจ้งโอนเงิน <u>OrderID#'+order_id+' ร้าน: '+brand_id+'</u></strong>',
          html:
          '<select class="form-control m-b" name="bankpay_'+order_id+'_'+brand_id+'" id="bankpay_'+order_id+'_'+brand_id+'" onchange="payselect('+order_id+','+brand_id+','+price+')">'+
          '<option value="0" disabled selected>เลือกธนาคารที่ต้องการแจ้งโอนเงิน</option>'+
          '</select>'+
          '<div id="content_'+order_id+'_'+brand_id+'"></div>',
          showConfirmButton: false,
        });
        for(i=0;i<content['success'].length;i++){
          $("#bankpay_"+order_id+"_"+brand_id).append('<option value="'+content['success'][i]['bankaccount_id']+'">'+content['success'][i]['bank_name']+'</option>');
        }
      }else{
        Swal.fire({
          title: '<strong>ไม่พบบัญชีในการโอน</strong>',
          type:'error',
          showConfirmButton: true,
        });
      }

    })();
  }

  function payselect(order_id,brand_id,price){
    var bankaccountid = $("#bankpay_"+order_id+"_"+brand_id).val();
    (async () => {
      const rawResponse = await fetch('/api/getBank-id', {
        method: 'POST',
        headers: {
          'Authorization':'Bearer '+b_token,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({"bankaccount_id": bankaccountid})
      });
      const content = await rawResponse.json();
      if(content['success'] != ''){
        console.log(content);
        $('#content_'+order_id+'_'+brand_id).empty();
        $('#content_'+order_id+'_'+brand_id).append('<h4 class="text-left">ธนาคาร : '+content['success'][0]['bank_name']+'</h4></br>'+
          '<h4 class="text-left">ชื่อบัญชี : '+content['success'][0]['account_name']+'</h4></br>'+
          '<h4 class="text-left">เลขบัญชี : '+content['success'][0]['bank_account']+'</h4></br>'+
          '<div class="form-group">'+
          '<div class="col-sm-6">'+
          '<h5 class="text-left">จำนวนเงินที่โอน (บาท)</h5><input value="'+price+'" disabled id="pay_amount_'+order_id+'_'+brand_id+'" type="text" class="form-control" placeholder="จำนวนเงินที่โอน" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )">'+
          '</div>'+
          '<div class="col-sm-6">'+
          '<h5 class="text-left">เลขบัญชีที่ใช้โอน (ของผู้ซื้อ)</h5><input id="pay_bankaccount_'+order_id+'_'+brand_id+'" type="text" class="form-control" placeholder="เลขบัญชีที่ใช้โอน" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )">'+
          '</div>'+
          '<div class="col-sm-6">'+
          '<h5 class="text-left">ชื่อบัญชีที่ใช้โอน (ของผู้ซื้อ)</h5><input id="pay_bankname_'+order_id+'_'+brand_id+'" type="text" class="form-control" placeholder="ชื่อบัญชีที่ใช้โอน">'+
          '</div>'+
          '<div class="col-sm-12">'+
          '<h5 class="text-left">วันเวลาที่โอน (ดูที่ใบสลิป หรือ ประวัติการโอน กรุณากรอกให้ตรงตามใบที่โอน)</h5><input id="pay_datetime_'+order_id+'_'+brand_id+'" type="datetime-local" class="form-control">'+
          '</div>'+
          '<button type="button" class="btn btn-w-m btn-primary" onclick="addPayment('+order_id+','+brand_id+','+bankaccountid+')">แจ้งโอนเงิน</button>'+
          '</div>');
      }else{
        Swal.fire({
          title: '<strong>เกิดข้อผิดพลาด</strong>',
          type:'error',
          showConfirmButton: true,
        });
      }

    })();
  }

  function addPayment(order_id,brand_id,bankaccountid){
    var pay_amount = $('#pay_amount_'+order_id+'_'+brand_id).val();
    var pay_bankaccount = $('#pay_bankaccount_'+order_id+'_'+brand_id).val();
    var pay_bankname = $('#pay_bankname_'+order_id+'_'+brand_id).val();
    var pay_datetime = $('#pay_datetime_'+order_id+'_'+brand_id).val();
    if(pay_amount != '' && pay_bankaccount != '' && pay_bankname != '' && pay_datetime != ''){
      console.log("Amount: "+pay_amount);
      console.log("BankAccount: "+pay_bankaccount);
      console.log("BankName: "+pay_bankname);
      console.log("Datetime: "+pay_datetime);
      (async () => {
        const rawResponse = await fetch('/api/payment-Add', {
          method: 'POST',
          headers: {
            'Authorization':'Bearer '+b_token,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({"amount": pay_amount,"BankAccount_id": bankaccountid,"bank_account": pay_bankaccount,"bank_name": pay_bankname,"date_time":pay_datetime,"order_id": order_id,"brand_id": brand_id})
        });
        const content = await rawResponse.json();
        if(content['success'] != ''){
          alert('แจ้งโอนสำเร็จ');
          getOrder();
          Swal.close();
        }else{
          Swal.fire({
            title: '<strong>เกิดข้อผิดพลาด</strong>',
            type:'error',
            showConfirmButton: true,
          });
        }

      })();
    }else{
      alert('กรอกข้อมูลให้ครบ');
    }

  }
</script>

@endsection
