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

  <div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
      <div class="col-lg-12">

        <div class="ibox product-detail">
          <div class="ibox-content">

            <div class="row">
              <div class="col-md-7">


                 <div class="product-images">

                                   <div>
                                      <div class="image-imitation" id="img1">
                                      </div>
                                  </div>
                                  <div>
                                      <div class="image-imitation" id="img2">
                                      </div>
                                  </div>
                                  <div>
                                      <div class="image-imitation" id="img3">
                                      </div>
                                  </div>
                                  <div>
                                      <div class="image-imitation" id="img4">
                                      </div>
                                  </div>
                                  <div>
                                      <div class="image-imitation" id="img5">
                                      </div>
                                  </div>


                               </div>

              </div>
              <div class="col-md-5">

                <h2 class="font-bold m-b-xs" id="prod_name">
                </h2>

                <hr>

                <h4>รายละเอียดสินค้า</h4>

                <div class=" text-muted des-bt" id="prod_desc">
                </div>
                <div class="row deriery-mt">
                  <div class="col-sm-5">

                    <dt>วัสดุ</dt>
                    <dt>สี</dt>
                    <dt>ขนาด กว้าง x ยาว x สูง</dt>
                    <dt>ขนาด ฟุต</dt>
                    <dt>จำนวนคงเหลือ</dt>



                  </div>
                  <div class="col-sm-7">
                    <dd id="prod_mat"></dd>
                    <dd id="prod_color"></dd>
                    <dd id="prod_size"></dd>
                    <dd id="prod_foot"></dd>
                    <dd id="prod_qty"></dd>

                  </div>                             

                </div>

                <hr>
                <div class="m-t-md ">
                  <h2 class="font-bold product-main-price price-color" id="prod_price"></h2>
                </div>

                <div>
                  <div class="btn-group">
                  </div>
                </div>



              </div>
            </div>

          </div>
        </div>

      </div>
    </div>




  </div>

</body>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
  var b_id = localStorage.getItem("b_id");
  var token = localStorage.getItem("user_token");
  var id;
  function getCookie() {
    var names = 'view_id';
    var value = "; " + document.cookie;
    var parts = value.split("; " + names + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
  }

  function productDetail(){
    var product_id = getCookie();
    $.ajax({
      type: "POST",
      url: "/api/getProductDetails",
      headers: {
        'Authorization':'Bearer '+token,
        'Content-Type':'application/json'
      },
      data: JSON.stringify({
        "Prod_id": product_id }),
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function(data){
        console.log(data);
        var price = data['product'][0]['prod_price'];

if(data['product_pic'] != 0)
      {
        if(data['product_pic'][0]['pic_url1'] != null){
          $('#img1').append('<img src="'+data['product_pic'][0]['pic_url1']+'" width="100%" height="300">');
        }
        if(data['product_pic'][0]['pic_url2'] != null){
          $('#img2').append('<img src="'+data['product_pic'][0]['pic_url2']+'" width="100%" height="300">');
        }
        if(data['product_pic'][0]['pic_url3'] != null){
          $('#img3').append('<img src="'+data['product_pic'][0]['pic_url3']+'" width="100%" height="300">');
        }
        if(data['product_pic'][0]['pic_url4'] != null){
          $('#img4').append('<img src="'+data['product_pic'][0]['pic_url4']+'" width="100%" height="300">');
        }
        if(data['product_pic'][0]['pic_url5'] != null){
          $('#img5').append('<img src="'+data['product_pic'][0]['pic_url5']+'" width="100%" height="300">');
        }
      }



      //รายละเอียดสินค้า
      document.getElementById("prod_name").innerHTML = data['product'][0]['prod_name'];
      document.getElementById("prod_desc").innerHTML = data['product'][0]['prod_desc'];
      document.getElementById("prod_price").innerHTML = price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' บาท';
      document.getElementById("prod_qty").innerHTML = data['product'][0]['qty'] + ' ชิ้น';
      document.getElementById("prod_color").innerHTML = data['product_color'][0]['ColorProd_value'];
      document.getElementById("prod_mat").innerHTML = data['product_rm'][0]['RM_value'];
      document.getElementById("prod_size").innerHTML = data['product_size'][0]['SizeProd_width'] +' x '+ data['product_size'][0]['SizeProd_length'] +' x '+ data['product_size'][0]['SizeProd_height'];
      document.getElementById("prod_foot").innerHTML = data['product_size'][0]['SizeProd_foot']+' ฟุต';
    },
    failure: function(errMsg) {
      alert(errMsg);
    }
  });
  }



  $(document).ready(function(){
    function checksession()
    {
      var token = localStorage.getItem("user_token");
      if(token == null)
      {
        alert('กรุณา Login ก่อนเข้าใช้งาน !');
        window.location.replace('/login');
      }
      if(getCookie() == null){
        alert('ไม่พบสินค้านี้ !');
        window.location.replace('/product');
      }
    }

    function load()
    {
      getDetails();
      checksession();
      productDetail();
    }

    window.onload = load();

  });
</script>
@endsection
