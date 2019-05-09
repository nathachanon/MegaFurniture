@extends('layouts.layout_brand')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.min.css">
<link href="css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
<body >
  <div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="ibox-content m-b-sm border-bottom">
      <div class="row">
        <h2>จัดการคำสั่งซื้อ</h2><br>
        <div class="col-sm-4">
          <div class="form-group">
            <label class="control-label" for="order_id">Order ID</label>
            <input type="text" id="order_id" onkeyup="searchOrder()" name="order_id" value="" placeholder="Order ID" class="form-control">
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label class="control-label" for="status">สถานะ</label>
            <input type="text" id="status" onkeyup="searchStatus()" name="status" value="" placeholder="Status" class="form-control">
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label class="control-label" for="customer">ชื่อลูกค้า</label>
            <input type="text" id="customer" onkeyup="searchCustomer()" name="customer" value="" placeholder="Customer" class="form-control">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label class="control-label" for="date_added">วันที่ทำรายการ</label>
            <div class="input-group date">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_added" onchange="searchAddDate()" type="text" class="form-control" value="03/04/2014">
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label class="control-label" for="date_modified">วันที่แก้ไข</label>
            <div class="input-group date">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_modified" onchange="searchMoDate()" type="text" class="form-control" value="03/06/2014">
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label class="control-label" for="amount">ราคา(บาท)</label>
            <input type="text" id="amount" onkeyup="searchPrice()" name="amount" value="" placeholder="Amount" class="form-control">
          </div>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox">
          <div class="ibox-content" id="tables">

          </div>
        </div>
      </div>
    </div>


  </div>
</body>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/toastr/toastr.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.all.min.js"></script>
<script src="js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>

<script>
  var s_id = localStorage.getItem("sid");
  var token = localStorage.getItem("user_token");

  getOrder();

  $(document).ready(function() {
    setInterval(function() {
      getOrder()
    }, 5000);
  });

  function createCookie(name,value,second) {
    if (second) {
      var date = new Date();
      date.setTime(date.getTime()+(second*1000));
      var expires = "; expires="+date.toGMTString();
    } else {
      var expires = "";
    }
    document.cookie = name+"="+value+expires+"; path=/";
  }


  $(document).ready(function(){

    $('.dataTables-example').DataTable({
      "searching": false,
      "buttons": false
    });

    $('.footable').footable();

    $('#date_added').datepicker({
      todayBtn: "linked",
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true
    });

    $('#date_modified').datepicker({
      todayBtn: "linked",
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true
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

    window.onload = load();

  });

  function searchOrder(){

    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("order_id");
    filter = input.value.toUpperCase();
    table = document.getElementById("OrderTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }

  }

  function searchCustomer(){

    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("customer");
    filter = input.value.toUpperCase();
    table = document.getElementById("OrderTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }

  }

  function searchPrice(){

    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("amount");
    filter = input.value.toUpperCase();
    table = document.getElementById("OrderTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[3];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }

  }

  function searchAddDate(){

    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("date_added");
    filter = input.value.toUpperCase();
    table = document.getElementById("OrderTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[4];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }

  }

  function searchMoDate(){

    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("date_modified");
    filter = input.value.toUpperCase();
    table = document.getElementById("OrderTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[5];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }

  }

  function searchStatus(){

    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("status");
    filter = input.value.toUpperCase();
    table = document.getElementById("OrderTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[6];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }

  }

  function getOrder(){
    (async () => {
      const rawResponse = await fetch('/api/getOrder', {
        method: 'POST',
        headers: {
          'Authorization':'Bearer '+token,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({"seller_id":s_id})
      });
      const data = await rawResponse.json();
      console.log(data);
      if(data['success'] != null)
      {
        $("#tables").empty();
        $("#tables").append('<table id="OrderTable" class="table table-striped dataTables-example" data-page-size="10">'+
          '<thead>'+
          '<tr>'+
          '<th>Order ID</th>'+
          '<th data-hide="phone">ชื่อลูกค้า</th>'+
          '<th data-hide="phone">ราคา รวมจัดส่ง (บาท)</th>'+
          '<th data-hide="phone">วันที่ทำรายการ</th>'+
          '<th data-hide="phone,tablet">วันที่แก้ไข</th>'+
          '<th data-hide="phone">สถานะ</th>'+
          '<th class="text-right">จัดการ</th>'+
          '</tr>'+
          '</thead>'+
          '<tbody id="orderTable">');
        for(var i = 0 ; i < data['success'].length ; i++){
          $("#orderTable").append('<tr>'+
            '<td>'+data['success'][i]['order_id']+'</td>'+
            '<td>'+data['success'][i]['name']+' '+data['success'][i]['surname']+'</td>'+
            '<td>'+data['success'][i]['total_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'.00</td>'+
            '<td>'+data['success'][i]['created_at']+'</td>'+
            '<td>'+data['success'][i]['updated_at']+'</td>'+
            (data['success'][i]['status'] == 0 ? '<td><span class="label label-primary">รอจ่ายเงิน</span></td>':'')+
            (data['success'][i]['status'] == 1 ? '<td><span class="label label-warning">แจ้งโอนเงินแล้ว</span><button class="btn-white btn btn-xs" onclick="showPayment('+data['success'][i]['order_id']+')">หลักฐานการโอน</button></td>':'')+
            (data['success'][i]['status'] == 2 ? '<td><span class="label label-warning">รอส่งของ</span><button class="btn-white btn btn-xs" onclick="addTracking('+data['success'][i]['order_id']+')">กรอกเลข Tracking</button></td>':'')+
            '<td class="text-right">'+
            '<div class="btn-group">'+
            '<button class="btn-white btn btn-xs" onclick="show_details('+data['success'][i]['order_id']+')" >ดูรายละเอียด</button>'+
            '<button class="btn-white btn btn-xs">แก้ไข</button>'+
            '<button class="btn-white btn btn-xs">ลบ</button>'+
            '</div>'+
            '</td>'+
            '</tr>');
        }

        $("#tables").append('</tbody></table>');
      }else{
        swal({
          title: "Error !",
          text: "เกิดข้อผิดพลาดบางประการ !",
          type: "error"
        });
      }

    })();
  }

  function show_details(order_id){

    (async () => {
      const rawResponse = await fetch('/api/getOrderDetails', {
        method: 'POST',
        headers: {
          'Authorization':'Bearer '+token,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({"order_id": order_id})
      });
      const content = await rawResponse.json();
      if(content['order'] != null){
        console.log(content);
        var swal_html = '<div class="col-lg-12">'+
        '<strong>หมายเลขคำสั่งซื้อ #'+content['order'][0]['order_id']+'</strong><br>'+
        '<div class="contact center-version">'+
        '<a>'+
        '<address class="text-left">'+
        '<strong>ข้อมูลผู้ซื้อ</strong><br>'+
        'ชื่อ-สกุล  : '+content['order'][0]['name']+' '+content['order'][0]['surname']+'<br>'+
        'เบอร์โทร  : '+content['order'][0]['tel']+'<br>'+
        'ราคารวม  : '+content['order'][0]['total_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' บาท<br>'+
        '</address>'+
        '</a>'+
        '<hr>'+
        '<div class="col-lg-12">'+
        '<div class="ibox float-e-margins">'+
        '<div class="ibox-content">'+
        '<table class="table">'+
        '<thead>'+
        '<tr>'+
        '<th class="text-center">รหัสสินค้า (SKU)</th>'+
        '<th class="text-center">ราคาสินค้า (บาท)</th>'+
        '<th class="text-center">จำนวน (ชิ้น)</th>'+
        '<th class="text-center">ที่อยู่ในการจัดส่ง</th>'+
        '<th class="text-center">ประเภทการจัดส่ง</th>'+
        '<th class="text-center">ค่าจัดส่ง (บาท)</th>'+
        '<th class="text-center">ราคาสินค้ารวมค่าจัดส่ง (บาท)</th>'+
        '</tr>'+
        '</thead>'+
        '<tbody id="order_detail_row">'+
        '</tbody>'+
        '</table>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '<div class="contact-box-footer">'+
        '<div class="m-t-xs btn-group"><hr>'+
        'วันเวลาที่สั่งซื้อ : '+content['order'][0]['created_at']+' น. <br>'+
        'อัพเดทสถานะล่าสุด : '+content['order'][0]['updated_at']+' น. <hr>'+
        'สถานะการสั่งซื้อ : '+(content['order'][0]['status'] == 0 ? '<td><span class="label label-primary">รอจ่ายเงิน</span></td>':'')+(content['order'][0]['status'] == 1 ? '<td><span class="label label-warning">มีการแจ้งโอนเงิน</span></td>':'')+''+(content['order'][0]['status'] == 2 ? '<td><span class="label label-warning">รอการส่งของ</span></td>':'')+''+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>';
        Swal.fire({
          width: 1000,
          showConfirmButton: false,
          html:swal_html
        });
        for(i = 0 ; i<content['orderDetail'].length ; i++){
          $("#order_detail_row").append('<tr>'+
            '<td>'+content['orderDetail'][i]['sku']+'</td>'+
            '<td>'+content['orderDetail'][i]['prod_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
            '<td>'+(content['orderDetail'][i]['price']-content['orderDetail'][i]['del_price'])/content['orderDetail'][i]['prod_price']+'</td>'+
            '<td>'+content['orderDetail'][i]['area']+' '+content['orderDetail'][i]['district']+' '+content['orderDetail'][i]['province']+' '+content['orderDetail'][i]['zipcode']+'</td>'+
            '<td>'+content['orderDetail'][i]['deliveryname']+'</td>'+
            '<td>'+content['orderDetail'][i]['del_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
            '<td>'+content['orderDetail'][i]['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
            '</tr>');
        }
        $("#order_detail_row").append('<tr>'+
          '<td></td>'+
          '<td></td>'+
          '<td></td>'+
          '<td></td>'+
          '<td></td>'+
          '<td><a>รวมทั้งหมด</a></td>'+
          '<td><a>'+content['order'][0]['total_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</a></td>'+
          '</tr>');
      }

    })();
  }

  function showPayment(order_id){
    (async () => {
      const rawResponse = await fetch('/api/getPayment', {
        method: 'POST',
        headers: {
          'Authorization':'Bearer '+token,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({"order_id": order_id})
      });
      const content = await rawResponse.json();
      console.log(content);

      var swal_html = '<div id="blueimp-gallery" class="blueimp-gallery">'+
      '<div class="slides"></div>'+
      '<h3 class="title"></h3>'+
      '<a class="prev">‹</a>'+
      '<a class="next">›</a>'+
      '<a class="close">×</a>'+
      '<a class="play-pause"></a>'+
      '<ol class="indicator"></ol>'+
      '</div>'+
      '<div class="col-lg-12">'+
      '<strong>หมายเลขคำสั่งซื้อ #'+order_id+'</strong><br>'+
      '<div class="contact center-version">'+
      '<a>'+
      '<address class="text-center">'+
      '<hr><strong>ข้อมูลบัญชีผู้โอนเงิน</strong><br>'+
      'ชื่อบัญชี  : '+content['success'][0]['buyer_name']+'<br>'+
      'เลขบัญชี  : '+content['success'][0]['buyer_account']+'<br>'+
      'จำนวนเงิน : '+content['success'][0]['buyer_amount'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' บาท<br>'+
      'วันเวลาโอน: '+content['success'][0]['buyer_datetime']+'<br>'+
      '</address>'+
      '</a>'+
      '<hr>'+
      '<a>'+
      '<address class="text-center">'+
      '<strong>โอนเข้าบัญชี</strong><br>'+
      'ธนาคาร  : '+content['success'][0]['bank_name']+'<br>'+
      'ชื่อ-สกุล  : '+content['success'][0]['account_name']+'<br>'+
      'เลขบัญชี  : '+content['success'][0]['bank_account']+'<br>'+
      '</address>'+
      '</a>'+
      '<hr>'+
      '<a href="'+content['success'][0]['transfer_slip']+'" title="กดที่รูปเพื่อดูแบบขยาย" data-gallery=""><img src="'+content['success'][0]['transfer_slip']+'" width="150" height="150"></a>'+
      '<hr>'+
      '<div class="contact-box-footer">'+
      '<div class="m-t-xs btn-group">'+
      'วันเวลาที่สั่งซื้อ  : '+content['order'][0]['created_at']+' น. <br>'+
      'วันเวลาที่โอนเงิน : '+content['success'][0]['buyer_datetime']+' น. <br><br>'+
      '</div>'+
      '</div>'+
      '</div>'+
      '</div>';
      Swal.fire({
        width: 500,
        html:swal_html,
        allowOutsideClick: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยันการโอนเงิน',
        cancelButtonText: 'ไม่พบจำนวนเงิน หรือ เกิดข้อผิดพลาด',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          (async () => {
            const rawResponse = await fetch('/api/changePayment', {
              method: 'POST',
              headers: {
                'Authorization':'Bearer '+token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({"order_id":order_id})
            });
            const data = await rawResponse.json();
            if(data['success'] == 'success'){
              getOrder();
              Swal.fire(
                'เรียบร้อย !',
                'ยืนยันการโอนเงินสำเร็จ',
                'success'
                )
            }else{
              Swal.fire(
                'ผิดพลาด !',
                'เกิดปัญหาบางประการ',
                'error'
                )
            }
          })();
        }else if (result.dismiss) {
          (async () => {
            const rawResponse = await fetch('/api/canclePayment', {
              method: 'POST',
              headers: {
                'Authorization':'Bearer '+token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({"order_id":order_id})
            });
            const data = await rawResponse.json();
            if(data['success'] == 'success'){
              getOrder();
              Swal.fire(
                'ผิดพลาด !',
                'การชำระเงินถูกยกเลิก เนื่องจากเกิดปัญหา เช่น เงินไม่เข้า , ยอดเงินไม่ตรง ',
                'error'
                )
            }else{
              Swal.fire(
                'ผิดพลาด !',
                'เกิดปัญหาบางประการ',
                'error'
                )
            }
          })();
        }
      })
    })();
  }

  function confirmPayment(order_id){
    console.log(order_id);
  }

  function addTracking(order_id){

    (async () => {
      const rawResponse = await fetch('/api/getOrderDetails', {
        method: 'POST',
        headers: {
          'Authorization':'Bearer '+token,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({"order_id": order_id})
      });
      const content = await rawResponse.json();
      if(content['order'] != null){
        console.log(content);
        var swal_html = '<div class="col-lg-12">'+
        '<strong>หมายเลขคำสั่งซื้อ #'+content['order'][0]['order_id']+'</strong><br>'+
        '<div class="contact center-version">'+
        '<a>'+
        '<address class="text-left">'+
        '<strong>ข้อมูลผู้ซื้อ</strong><br>'+
        'ชื่อ-สกุล  : '+content['order'][0]['name']+' '+content['order'][0]['surname']+'<br>'+
        'เบอร์โทร  : '+content['order'][0]['tel']+'<br>'+
        'ราคารวม  : '+content['order'][0]['total_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' บาท<br>'+
        '</address>'+
        '</a>'+
        '<hr>'+
        '<div class="col-lg-12">'+
        '<div class="ibox float-e-margins">'+
        '<div class="ibox-content">'+
        '<table class="table">'+
        '<thead>'+
        '<tr>'+
        '<th class="text-center">รหัสสินค้า (SKU)</th>'+
        '<th class="text-center">ที่อยู่ในการจัดส่ง</th>'+
        '<th class="text-center">ค่าจัดส่ง (บาท)</th>'+
        '<th class="text-center">ราคาสินค้ารวมค่าจัดส่ง (บาท)</th>'+
        '<th class="text-center">ประเภทการจัดส่ง</th>'+
        '<th class="text-center">หมายเลข Tracking</th>'+
        '<th class="text-center">ดำเนินการ</th>'+
        '</tr>'+
        '</thead>'+
        '<tbody id="order_detail_row">'+
        '</tbody>'+
        '</table>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '<div class="contact-box-footer">'+
        '<div class="m-t-xs btn-group"><hr>'+
        'วันเวลาที่สั่งซื้อ : '+content['order'][0]['created_at']+' น. <br>'+
        'อัพเดทสถานะล่าสุด : '+content['order'][0]['updated_at']+' น. <hr>'+
        'สถานะการสั่งซื้อ : '+(content['order'][0]['status'] == 0 ? '<td><span class="label label-primary">รอจ่ายเงิน</span></td>':'')+(content['order'][0]['status'] == 1 ? '<td><span class="label label-warning">มีการแจ้งโอนเงิน</span></td>':'')+''+(content['order'][0]['status'] == 2 ? '<td><span class="label label-warning">ชำระเงินแล้วรอจัดส่ง</span></td>':'')+''+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>';
        Swal.fire({
          width: 1000,
          showConfirmButton: false,
          html:swal_html
        });
        for(i = 0 ; i<content['orderDetail'].length ; i++){
          $("#order_detail_row").append('<tr>'+
            '<td>'+content['orderDetail'][i]['sku']+'</td>'+
            '<td>'+content['orderDetail'][i]['area']+' '+content['orderDetail'][i]['district']+' '+content['orderDetail'][i]['province']+' '+content['orderDetail'][i]['zipcode']+'</td>'+
            '<td>'+content['orderDetail'][i]['del_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
            '<td>'+content['orderDetail'][i]['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
            '<td>'+content['orderDetail'][i]['deliveryname']+'</td>'+
            '<td><input class="form-control" type="text" id="t_'+content['orderDetail'][i]['order_detail_id']+'"></input></td>'+
            '<td><button class="btn btn-w-m btn-primary" id="b_'+content['orderDetail'][i]['order_detail_id']+'" onclick="addTracking_ADD('+order_id+',\'' + content['orderDetail'][i]['order_detail_id'] + '\')">'+
            'ส่ง Tracking</button></td>'+
            '</tr>');
        }

        for(i = 0 ; i<content['tracking'].length ; i++){
          if(content['tracking'][i]['track_number'] != null){
            $("#t_"+content['tracking'][i]['order_detail_id']).val(content['tracking'][i]['track_number']);
            $("#t_"+content['tracking'][i]['order_detail_id']).attr("disabled", true);
            $("#b_"+content['tracking'][i]['order_detail_id']).attr("disabled", true);
          }else{
            $("#t_"+content['tracking'][i]['order_detail_id']).val();
          }
        }
      }

    })();
  }

  function addTracking_ADD(order_id,order_detail_id){
    var tracking_number = $("#t_"+order_detail_id).val();
    if(tracking_number != ''){
      (async () => {
        const rawResponse = await fetch('/api/addTracking', {
          method: 'POST',
          headers: {
            'Authorization':'Bearer '+token,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({"order_detail_id":order_detail_id,"track_number":tracking_number,"status":0})
        });
        const data = await rawResponse.json();
        if(data['success'] == 'success'){
          addTracking(order_id);
          Swal.fire(
            'เรียบร้อย !',
            'ส่งหมายเลข Tracking สำเร็จ',
            'success'
            )
        }else{
          Swal.fire(
            'ผิดพลาด !',
            'เกิดปัญหาบางประการ',
            'error'
            )
        }
      })();
    }
  }
</script>
@endsection
