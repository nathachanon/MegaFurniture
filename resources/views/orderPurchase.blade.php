@extends('layouts.layout_brand')

@section('content')
<body >
  <div class="row border-bottom2">
    <nav class="navbar navbar-static-top2" role="navigation" style="margin-bottom: 0">
      <ul class="nav navbar-top-links navbar-left">
        <li>
          <a class="mt-sbrand" href="#"><h3 id="product_counts"></h3> </a>
        </li>

      </ul>

    </nav>
  </div>
  <div class="wrapper wrapper-content animated fadeInRight ecommerce">
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox">
          <div class="ibox-content">

            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
              <thead>
                <tr>

                  <th data-toggle="true">Order ID</th>

                  <th data-hide="phone">Buyer ID</th>
                  <th data-hide="phone">วันที่แจ้งโอน</th>
                  <th data-hide="phone">จำนวนเงิน(บาท)</th>
                  <th class="text-right" data-sort-ignore="true">Action</th>

                </tr>
              </thead>
              <tbody id="t_body">
                <tr>
                  <td>#O142588</td>
                  <td>B775466</td>
                  <td>18 มีนาคม 2562</td>
                  <td>2450.0</td>
                  <td class="text-right">
                    <div class="btn-group">
                      <button class="btn-white btn btn-xs" onclick="confirmPayment('vei27113@zoqqa.com','O142588')">ยืนยันการโอนเงิน</button>
                      <button class="btn-white btn btn-xs" onclick="">ลบ</button>

                    </div>
                  </td>
                </tr>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="modal inmodal" id="Tracking" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content animated bounceInRight">
        <div class="modal-header">
          <h4 class="modal-title" id="titlepayment">Email ผู้แจ้งโอน : </h4>
          <h5  id="ordertitle">OrderID : </h5>
          <h5 id="titlepayment">ชื่อผู้ซื้อ : ธนาคาร คำเงิน</h5>
          <img src="https://f.ptcdn.info/650/037/000/ny8bp73dp2RePCW0h9R-o.jpg" alt="Italian Trulli">
        </div>
        <div class="modal-body">
          <div class="form-group"><label>เลข Tracking</label> <input id="trackingID" type="text" placeholder="Enter your Tracking Number" class="form-control" ></div>
        </div>
        <div class="modal-footer">
          <button id="cancel" type="button" class="btn btn-white" data-dismiss="modal">ยกเลิก</button>
          <button id="confirmPAY" type="button" class="btn btn-danger">ยืนยันการชำระเงินและส่งอีเมล</button>
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

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>

<script>
  var b_id = localStorage.getItem("b_id");
  var token = localStorage.getItem("user_token");
  var id;
  var mail;
  var orderids;

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

  function confirmPayment(email,ourderid) {
    mail = email;
    orderids = "Order ID : "+ourderid;
    document.getElementById("titlepayment").innerHTML = "Email ผู้แจ้งโอน : "+email;
    document.getElementById("ordertitle").innerHTML = "OrderID : "+ourderid;
    $('#Tracking').modal('show');
  }

  $('#confirmPAY').click(function(){
    var trackingIDs = $('#trackingID').val();
    if(trackingIDs != ''){
      var trackingID = 'หมายเลข Tracking : '+trackingIDs;
      $.ajax({
        url: '/api/sendEmail',
        headers: {
          'Authorization':'Bearer '+token,
          'Content-Type':'application/json'
        },
        method: 'POST',
        data: JSON.stringify({
         "email":mail,
         "tracking":trackingID,
         "orderid":orderids 
       }),
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function(data){
          if(data['success'] != null)
          {
            alert('ส่ง Email แจ้งผู้ซื้อแล้ว ! !');
            window.location.replace('/orderPurchase');
          }else{
            alert('เกิดข้อผิดพลาด !');
          }
        }
      });
    }else{
      alert('กรอกเลข Tracking ก่อนบันทึก');
    }
  });


  $(document).ready(function(){
 

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
</script>
@endsection
