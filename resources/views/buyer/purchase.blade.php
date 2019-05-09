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
      console.log(content);
      if(content['success'] != ''){
        $("#order_list").empty();
        for(i = 0 ; i<content['order_list'].length ; i++){
          $("#order_list").append('<div id="div_order_'+content['order_list'][i]['order_id']+'">'+
            '<small class="pull-right text-navy">วันเวลาที่สั่งซื้อ : '+content['order_list'][i]['created_at']+'</small>'+
            '<a href="#"><h5>OrderID : #'+content['order_list'][i]['order_id']+'</h5></a>'+
            '<div id="order_list_'+content['order_list'][i]['order_id']+'">'+
            '</div><hr>');
        }

        for(j = 0 ; j<content['order_list'].length ; j++){
          $("#order_list_"+content['order_list'][j]['order_id']).append('<div id="div_order_'+content['order_list'][j]['order_id']+'">'+
            (content['order_list'][j]['status'] == 0 ? '<button type="button" onclick="payment('+content['order_list'][j]['order_id']+','+content['order_list'][j]['id']+','+content['order_list'][j]['total_price']+')" class="btn btn-w-m btn-info text-left">OrderID: #'+content['order_list'][j]['order_id']+'&nbsp แจ้งโอนเงิน ที่นี่ จำนวนเงินที่ต้องโอน: '+content['order_list'][j]['total_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' บาท &nbsp&nbsp&nbsp สถานะ : รอการจ่ายเงิน</button>':'')+
            (content['order_list'][j]['status'] == 1 ? '<button onclick="orderDetail('+content['order_list'][j]['order_id']+')" type="button" class="btn btn-w-m btn-warning text-left">OrderID: #'+content['order_list'][j]['order_id']+'&nbsp เมื่อผู้ขายยืนยันแล้วระบบจะอัพเดทให้อัตโนมัติ &nbsp&nbsp&nbsp สถานะ : รอตรวจสอบการชำระเงิน</button>':'')+
            (content['order_list'][j]['status'] == 2 ? '<button onclick="orderDetail('+content['order_list'][j]['order_id']+')" type="button" class="btn btn-w-m btn-warning text-left">OrderID: #'+content['order_list'][j]['order_id']+'&nbsp ดูรายละเอียดหมายเลข Tracking &nbsp&nbsp&nbsp สถานะ : กำลังส่งของ</button>':'')+
            (content['order_list'][j]['status'] == 3 ? '<button onclick="orderDetail('+content['order_list'][j]['order_id']+')" type="button" class="btn btn-w-m btn-success text-left">OrderID: #'+content['order_list'][j]['order_id']+'&nbsp ได้รับสินค้าแล้วรอการรีวิว &nbsp&nbsp&nbsp สถานะ : ได้รับสินค้าแล้ว</button>':'')+
            (content['order_list'][j]['status'] == 4 ? '<button onclick="orderDetail('+content['order_list'][j]['order_id']+')" type="button" class="btn btn-w-m btn-danger text-left">OrderID: #'+content['order_list'][j]['order_id']+'&nbsp คำสั่งซื้อถูกยกเลิก &nbsp&nbsp&nbsp สถานะ : ยกเลิก</button>':'')+
            (content['order_list'][j]['status'] == 5 ? '<button onclick="orderDetail('+content['order_list'][j]['order_id']+')" type="button" class="btn btn-w-m btn-default text-left">OrderID: #'+content['order_list'][j]['order_id']+'&nbsp หมดเวลาชำระเงิน &nbsp&nbsp&nbsp สถานะ : เกินกำหนดเวลาชำระเงิน</button>':'')+
            '</div>');  
        }

      }else{

      }

    })();
  }

  function payment(order_id,seller_id,price){
    (async () => {
      const rawResponse = await fetch('/api/getBank-brand', {
        method: 'POST',
        headers: {
          'Authorization':'Bearer '+b_token,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({"seller_id": seller_id})
      });
      const content = await rawResponse.json();
      console.log(content);
      if(content['success'] != ''){
        Swal.fire({
          title: '<strong>แจ้งโอนเงิน <u>OrderID#'+order_id+' ร้าน: '+seller_id+'</u></strong>',
          html:
          '<select class="form-control m-b" name="bankpay_'+order_id+'_'+seller_id+'" id="bankpay_'+order_id+'_'+seller_id+'" onchange="payselect('+order_id+','+seller_id+','+price+')">'+
          '<option value="0" disabled selected>เลือกธนาคารที่ต้องการแจ้งโอนเงิน</option>'+
          '</select>'+
          '<div id="content_'+order_id+'_'+seller_id+'"></div>',
          showConfirmButton: false,
        });
        for(i=0;i<content['success'].length;i++){
          $("#bankpay_"+order_id+"_"+seller_id).append('<option value="'+content['success'][i]['bankaccount_id']+'">'+content['success'][i]['bank_name']+'</option>');
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

  function payselect(order_id,seller_id,price){
    var bankaccountid = $("#bankpay_"+order_id+"_"+seller_id).val();
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
      console.log(content);
      if(content['success'] != ''){
        $('#content_'+order_id+'_'+seller_id).empty();
        $('#content_'+order_id+'_'+seller_id).append('<h4 class="text-left">ธนาคาร : '+content['success'][0]['bank_name']+'</h4></br>'+
          '<h4 class="text-left">ชื่อบัญชี : '+content['success'][0]['account_name']+'</h4></br>'+
          '<h4 class="text-left">เลขบัญชี : '+content['success'][0]['bank_account']+'</h4></br>'+
          '<div class="form-group">'+
          '<div class="col-sm-6">'+
          '<h5 class="text-left">จำนวนเงินที่โอน (บาท)</h5><input value="'+price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'" disabled id="pay_amount_'+order_id+'_'+seller_id+'" type="text" class="form-control" placeholder="จำนวนเงินที่โอน">'+
          '</div>'+
          '<div class="col-sm-6">'+
          '<h5 class="text-left">เลขบัญชีที่ใช้โอน (ของผู้ซื้อ)</h5><input id="pay_bankaccount_'+order_id+'_'+seller_id+'" type="text" class="form-control" placeholder="เลขบัญชีที่ใช้โอน" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )">'+
          '</div>'+
          '<div class="col-sm-6">'+
          '<h5 class="text-left">ชื่อบัญชีที่ใช้โอน (ของผู้ซื้อ)</h5><input id="pay_bankname_'+order_id+'_'+seller_id+'" type="text" class="form-control" placeholder="ชื่อบัญชีที่ใช้โอน">'+
          '</div>'+
          '<div class="col-sm-12">'+
          '<h5 class="text-left">วันเวลาที่โอน (ดูที่ใบสลิป หรือ ประวัติการโอน กรุณากรอกให้ตรงตามใบที่โอน)</h5><input id="pay_datetime_'+order_id+'_'+seller_id+'" type="datetime-local" class="form-control">'+
          '</div>'+
          '<div class="col-sm-12">'+
          '<h5 class="text-left" for="catagry_name">แนบสลิปการโอนเงิน</h5>'+
          '<input id="sl" type="file" name="sl" class="form-control" >'+
          '</div>'+
          '<button type="button" class="btn btn-w-m btn-primary" onclick="addPayment('+order_id+','+seller_id+','+bankaccountid+')">แจ้งโอนเงิน</button>'+
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

  function addPayment(order_id,seller_id,bankaccountid){
    var sl = document.getElementById("sl").files[0]
    var pay_amount = $('#pay_amount_'+order_id+'_'+seller_id).val();
    var pay_bankaccount = $('#pay_bankaccount_'+order_id+'_'+seller_id).val();
    var pay_bankname = $('#pay_bankname_'+order_id+'_'+seller_id).val();
    var pay_datetime = $('#pay_datetime_'+order_id+'_'+seller_id).val();
    if(sl != undefined){
      if(pay_amount != '' && pay_bankaccount != '' && pay_bankname != '' && pay_datetime != ''){
        var formData = new FormData();

        formData.append("sl", document.getElementById("sl").files[0]);
        formData.append("amount", pay_amount);
        formData.append("BankAccount_id", bankaccountid);
        formData.append("bank_account", pay_bankaccount);
        formData.append("bank_name", pay_bankname);
        formData.append("date_time", pay_datetime);
        formData.append("order_id", order_id);
        formData.append("seller_id", seller_id);

        $.ajax({
         url: '/api/payment-Add',
         headers: {
           'Authorization':'Bearer '+b_token,
         },
         method: 'POST',
         data: formData,
         contentType: false,
         processData: false,
         dataType: 'json',
         success: function(data){
           if(data['success'] != null)
           {
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
        }
      });
      }else{
        alert('กรอกข้อมูลให้ครบ');
      }
    }else{
      alert('กรุณาแนบสลิปการโอนเงิน ก่อน !');
    }

  }

  function orderDetail(order_id){
    (async () => {
      const rawResponse = await fetch('/api/orderbuyer', {
        method: 'POST',
        headers: {
          'Authorization':'Bearer '+b_token,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({"order_id": order_id})
      });
      const content = await rawResponse.json();
      if(content['orderDetail'] != null){
        console.log(content);
        var swal_html = '<div class="col-lg-12">'+
        '<strong>หมายเลขคำสั่งซื้อ #'+order_id+'</strong><br>'+
        '<div class="contact center-version">'+
        '<a>'+
        '<address class="text-left">'+
        '<strong>ข้อมูลการสั่งซื้อ</strong><br>'+
        '</address>'+
        '</a>'+
        '<div class="col-lg-12">'+
        '<div class="ibox float-e-margins">'+
        '<div class="ibox-content">'+
        '<table class="table">'+
        '<thead>'+
        '<tr>'+
        '<th class="text-center small">รหัสสินค้า (SKU)</th>'+
        '<th class="text-center small">ราคาสินค้ารวมค่าจัดส่ง (บาท)</th>'+
        '<th class="text-center small">ส่งโดย</th>'+
        '<th class="text-center small">หมายเลข Tracking</th>'+
        '</tr>'+
        '</thead>'+
        '<tbody id="order_detail_row">'+
        '</tbody>'+
        '</table>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '<div class="contact-box-footer">'+
        '<div class="m-t-xs btn-group">'+
        'วันเวลาที่สั่งซื้อ :  '+content['order'][0]['created_at']+'น. <br>'+
        'อัพเดทสถานะล่าสุด : '+content['order'][0]['updated_at']+' น. '+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>';
        Swal.fire({
          width: 800,
          showConfirmButton: false,
          html:swal_html
        });

        for(i = 0 ; i<content['orderDetail'].length ; i++){
          $("#order_detail_row").append('<tr>'+
            '<td class="text-left small">'+content['orderDetail'][i]['sku']+'</td>'+
            '<td class="text-left small">'+content['orderDetail'][i]['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
            '<td class="text-center small">'+content['orderDetail'][i]['deliveryname']+'</td>'+
            '<td class="text-center small"><input id="'+content['orderDetail'][i]['order_detail_id']+'" class="form-control"type="text" value="" disabled></input></td>'+
            '</tr>');
        }
        if(content['orderDetail'].length > 1){
          $("#order_detail_row").append('<tr>'+
            '<td><a>รวมทั้งหมด</a></td>'+
            '<td><a>'+content['order'][0]['total_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' บาท</a></td>'+
            '</tr>');
        }

        for(i = 0 ; i<content['tracking'].length ; i++){
          var tracking_number = '';
          if(content['tracking'][i]['track_number'] == null){
            tracking_number = "กำลังรอ Tracking Number";
          }else{
            tracking_number = content['tracking'][i]['track_number'];
          }
          
          $("#"+content['tracking'][i]['order_detail_id']).val(tracking_number);
        }
      }

    })();

  }
</script>

@endsection
