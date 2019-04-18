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
      <ul class="nav navbar-top-links navbar-right">
        <li>
         <a href="product"><button  class="btn btn-info  " type="button"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;<span class="bold">ย้อนกลับ</span></button></a>
       </li>
     </ul>
   </nav>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight ecommerce">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
             <a class="mt-sbrand" href="#"><h3 id="product_counts">สินค้าที่รอการตั้งค่า</h3> </a>
          <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
            <thead>
              <tr>

                <th data-toggle="true">ชื่อสินค้า</th>
                <th data-hide="phone">รายละเอียด</th>
                <th data-hide="phone">ราคา</th>
                <th data-hide="phone">สถานะ</th>
                <th class="text-right" data-sort-ignore="true">Action</th>

              </tr>
            </thead>
            <tbody id="t_body">
            </tbody>
          </table>

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

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>

<script>
  var b_id = localStorage.getItem("b_id");
  var token = localStorage.getItem("user_token");
  var id;
  function uppicProduct(Prod_id){
    document.cookie = "product_id="+Prod_id;
    window.location.replace('/addPic');
  }
  function DeleteProd(Prod_id)
  {
    $.ajax({
      url: '/api/DeleteProduct',
      headers: {
        'Authorization':'Bearer '+token,
        'Content-Type':'application/json'
      },
      method: 'POST',
      data: JSON.stringify({ "Prod_id":Prod_id }),
      contentType: "application/json; charset=utf-8",
      dataType: 'json',
      success: function(data){
        if(data['success'] != null)
        {
          alert('ลบสินค้าสำเร็จ !');
          window.location.replace('/product');
        }else{
          alert('เกิดข้อผิดพลาด !');
        }
      }
    });
  }

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


    function getProduct(){
      $.ajax({
        type: "POST",
        url: "/api/sbrands",
        headers: {
          'Authorization':'Bearer '+token,
          'Content-Type':'application/json'
        },
        data: JSON.stringify({
          "brand_id": b_id }),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(data){
          console.log(data);
          document.title = JSON.stringify(data['brand_name'][0]['brand_name']).replace(/['"]+/g, '')+' : Brand';
          var p_count = data['product_count'];
          if(p_count == null)
          {
            p_count = 0;
          }
          document.getElementById("product_counts").innerHTML = "พบสินค้า "+p_count+" รายการ";
          for(var i=0 ;i<p_count ;i++){
            var status = '<span class="label label-danger">ยังไม่ขาย</span>';
            $('#t_body').append(
              '<tr>'+
              '<td>'+data['product'][i]['prod_name']+'</td>'+
              '<td>'+data['product'][i]['prod_desc']+'</td>'+
              '<td>'+data['product'][i]['prod_price']+'</td>'+
              '<td>'+
              status
              +'</td>'+
              '<td class="text-right">'+
              '<div class="btn-group">'+
              '<button class="btn-white btn btn-xs" onclick="uppicProduct ('+data['product'][i]['Prod_id']+')">เพิ่มรูป</button>'+
              '<button class="btn-white btn btn-xs" onclick="DeleteProd ('+data['product'][i]['Prod_id']+')">Delete</button>'+
              '</div>'+
              '</td>'+
              '</tr>');
          }
        }
        ,
        failure: function(errMsg) {
          alert(errMsg);
        }
      });
    }
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
      getProduct();
    }

    window.onload = load();

  });
</script>
@endsection
