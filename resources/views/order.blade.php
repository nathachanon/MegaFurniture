@extends('layouts.layout_brand')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.min.css">
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


<script>
  var b_id = localStorage.getItem("b_id");
  var token = localStorage.getItem("user_token");

  getOrder();

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
    body: JSON.stringify({"brand_id":b_id})
  });
  const data = await rawResponse.json();
  if(data['success'] != null)
  {
    $("#tables").append('<table id="OrderTable" class="table table-striped dataTables-example" data-page-size="10">'+
        '<thead>'+
        '<tr>'+
            '<th>Order ID</th>'+
            '<th data-hide="phone">ชื่อลูกค้า</th>'+
            '<th data-hide="phone">รหัสสินค้า</th>'+
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
            '<td>'+data['success'][i]['order_detail_id']+'</td>'+
            '<td>'+data['success'][i]['name']+' '+data['success'][i]['surname']+'</td>'+
            '<td>'+data['success'][i]['prod_id']+'</td>'+
            '<td>'+data['success'][i]['price']+'.00</td>'+
            '<td>'+data['success'][i]['created_at']+'</td>'+
            '<td>'+data['success'][i]['updated_at']+'</td>'+
            (data['success'][i]['status'] == 0 ? '<td><span class="label label-primary">รอจ่ายเงิน</span></td>':'')+
            '<td class="text-right">'+
                '<div class="btn-group">'+
                    '<button class="btn-white btn btn-xs" onclick="show_details('+data['success'][i]['order_id']+','+data['success'][i]['prod_id']+')" >ดูรายละเอียด</button>'+
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

  function show_details(order_id,prod_id){

        (async () => {
      const rawResponse = await fetch('/api/getOrderDetails', {
        method: 'POST',
        headers: {
          'Authorization':'Bearer '+token,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({"order_id": order_id, "prod_id": prod_id})
      });
      const content = await rawResponse.json();
      if(content[0] != null){
        var swal_html = '<div class="col-lg-12">'+
                '<strong>หมายเลขคำสั่งซื้อ #'+content[0]['order_detail_id']+'</strong><br>'+
                '<div class="contact center-version">'+
                    '<a href="#">'+
                        '<img width="80" height="80" alt="image" class="img-circle" src="'+content[0]['pic_url1']+'">'+
                        '<h3 class="m-b-xs"><strong>'+content[0]['prod_name']+'</strong></h3>'+
                      '<address class="m-t-md">'+
                            '<strong>ข้อมูลผู้ซื้อ</strong><br>'+
                            'ชื่อ-สกุล  : '+content[0]['name']+' '+content[0]['surname']+'<br>'+
                            'จัดส่งโดย  : '+content[0]['deliveryname']+'<br>'+
                            'ราคาสินค้า  : '+content[0]['prod_price']+'<br>'+
                            'จำนวน  : '+(content[0]['price']-content[0]['delivery_price'])/content[0]['prod_price']+' ชิ้น<br>'+
                            'ค่าจัดส่ง  : '+content[0]['delivery_price']+'<br>'+
                            'ราคารวม  : '+content[0]['price']+'<br>'+
                        '</address>'+
                    '</a>'+
                    '<div class="contact-box-footer">'+
                        '<div class="m-t-xs btn-group">'+
                            'วันเวลาที่สั่งซื้อ : '+content[0]['created_at']+' น. <br>'+
                            'อัพเดทสถานะล่าสุด : '+content[0]['updated_at']+' น. <br><br>'+
                            'สถานะการสั่งซื้อ : <td><span class="label label-primary">รอจ่ายเงิน</span></td>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>';
        Swal.fire({
          width: 300,
          showConfirmButton: false,
          html:swal_html
        });
      }

    })();
  }
</script>
@endsection
