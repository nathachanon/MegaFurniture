@extends('layouts.layout_buyer')

@section('content')
<hr>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row ibox-m">
        <div class="col-md-9">

            <div class="ibox-content">
                <div class="ibox-title">
                    <span class="pull-right">สินค้าในตะกร้า (<strong id="product_list_count"></strong>) รายการ</span>

                </div>
                <div id="product_list">

                </div>

              <div class="ibox-content">

                    <button class="btn btn-primary pull-right" onclick="checkout()"><i class="fa fa fa-shopping-cart"></i> สั่งซื้อ</button>
                    <button class="btn btn-white" id="goshop"><i class="fa fa-arrow-left"></i> กลับไปช๊อบปิ้งต่อ</button>

                </div>
            </div>

        </div>
    </div>






        </div>


<script src="js/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="layout/js/jquery-3.3.1.min.js"></script>
<script>
var b_token = localStorage.getItem("b_token");
var buyer_id = localStorage.getItem("buyer_id");
var jsonDelivery = [];
var jsonOrder = [];
var prod_id_list = [];
check_user();
getAddress();
  $("#nav-buyer").append('<div class="cart-page-logo__page-name">ตะกร้า</div>');

	function check_user(){

		if(b_token == null && buyer_id == null){
			window.location.replace('/');
		}else{
      getCart();
    }

	}

  function getCart(){
    $.ajax({
      url: '/api/getCart',
      headers: {
        'Authorization':'Bearer '+b_token,
        'Content-Type':'application/json'
      },
      method: 'POST',
      data: JSON.stringify({ "buyer_id":buyer_id }),
      contentType: "application/json; charset=utf-8",
      dataType: 'json',
      success: function(data){
        console.log(data);
        $("#product_list_count").empty();
        $("#product_list").empty();
        $("#total").empty();
        if(data['success'] != null)
        {
          var cart_count;
          var allprice;

          if(data['success'][0]['NumOfProduct'] == null){
            cart_count = 0;
          }else{
            cart_count = data['success'][0]['NumOfProduct'];
          }

          if(data['success'][0]['Price'] == null){
            allprice = 0;
          }else{
            allprice = data['success'][0]['Price'];
          }
          $("#product_list_count").append(cart_count);
          if(cart_count > 0){
            for(var i = 0 ; i < data['Brand'].length ; i++){
              $("#product_list").append('<div id="div_'+data['Brand'][i]['brand_name']+'"><a href="#"><p class="small">'+
                  'สินค้าจากร้าน : '+data['Brand'][i]['brand_name']+
            '</p></a></div>');
            }
            for(var i = 0 ; i < cart_count ; i++){
              prod_id_list.push(data['ProductInCart'][i]['Prod_id']);
            $('#div_'+data['ProductInCart'][i]['brand_name']+'').append('<div class="ibox-content-cart" id="ibox_'+data['ProductInCart'][i]['Prod_id']+'">'+
                '<div class="table-responsive">'+
                    '<table class="table shoping-cart-table">'+
                        '<tbody>'+
                        '<tr>'+
                            '<td width="100">'+
                                '<div class="cart-product-imitation"><img src="'+data['ProductInCart'][i]['pic_url1']+'" alt="" width="150">'+
                                '</div>'+
                            '</td>'+
                            '<td class="desc">'+
                                '<h4>'+
                                '<a href="#" class="text-navy">'+
                                    data['ProductInCart'][i]['prod_name']+
                                '</a>'+
                                ''+
                                '</h4>'+

                                '<div class="m-t-sm"><label class="col-sm-6 control-label">ที่อยู่ในการจัดส่ง</label>'+
                                    '<div class="col-sm-8"><select onchange="address_change('+data['ProductInCart'][i]['Prod_id']+')" id="address_list_'+data['ProductInCart'][i]['Prod_id']+'" class="form-control " name="address_list_'+data['ProductInCart'][i]['Prod_id']+'">'+
                                      '<option value="0">เลือกที่อยู่ในการจัดส่ง</option>'+
                                      '</select>'+
                                    '</div>'+
                                  '</div>'+
                                '<div class="m-t-sm"><label class="col-sm-6 control-label">ส่งโดย</label>'+
                                    '<div class="col-sm-8"><select disabled onchange="delivery_change(this,'+data['ProductInCart'][i]['Prod_id']+','+data['ProductInCart'][i]['prod_price']*data['ProductInCart'][i]['count']+')" id="delivery_option_'+data['ProductInCart'][i]['Prod_id']+'"class="form-control " name="delivery_option_'+data['ProductInCart'][i]['Prod_id']+'">'+
                                      '<option value="999">เลือกประเภทการจัดส่ง</option>'+
                                      '</select>'+
                                    '</div>'+
                                  '</div>'+
                                  '<h4 id="delivery_detail_'+data['ProductInCart'][i]['Prod_id']+'">'+
                                  '</h4>'+
                                '<div class="m-t-sm">'+
                                    '<a href="#" onclick="deleteProductInCart('+data['ProductInCart'][i]['Prod_id']+','+data['ProductInCart'][i]['prod_price']+')" class="text-muted"><i class="fa fa-trash"></i> ลบสินค้า</a>'+
                                '</div>'+
                            '</td>'+
                            '<td>'+
                                'ราคาต่อชิ้น '+data['ProductInCart'][i]['prod_price']+' บาท'+
                            '</td>'+
                            '<td width="100">'+
                                '<a onclick="addCart('+data['ProductInCart'][i]['Prod_id']+','+data['ProductInCart'][i]['prod_price']+')"><i class="fa fa-plus"></i></a>'+
                                '<input id="product_count_'+data['ProductInCart'][i]['Prod_id']+'" type="number" class="form-control" placeholder="1" min="1" max="20" value="'+data['ProductInCart'][i]['count']+'" disabled>'+
                                '<a onclick="decrease('+data['ProductInCart'][i]['Prod_id']+','+data['ProductInCart'][i]['prod_price']+','+data['ProductInCart'][i]['count']+')"><i class="fa fa-minus"></i></a>'+
                            '</td>'+
                            '<td>'+
                                '<h4>'+
                                    '฿'+data['ProductInCart'][i]['prod_price']*data['ProductInCart'][i]['count']+
                                '</h4>'+
                            '</td>'+
                        '</tr>'+
                        '</tbody>'+
                    '</table>'+
                '</div>'+
            '</div>');
          }

            for(var x = 0 ; x < data['Delivery'].length ; x++){
              if(data['Delivery'][x]['price'] != null)
              {
                $('#delivery_option_'+data['Delivery'][x]['Prod_id']+'').append('<option value="'+data['Delivery'][x]['del_price_id']+','+data['Delivery'][x]['price']+','+data['Delivery'][x]['deliveryname']+'">'+data['Delivery'][x]['deliveryname']+'  '+data['Delivery'][x]['price']+'</option>');
              }
            }
          }

        }else{
          swal({
            title: "Error !",
            text: "เกิดข้อผิดพลาดบางประการ !",
            type: "error"
          });
        }
      }
    });
  }

  $("#goshop").click(function (){
    window.location.href = "/";
  });

  function addCart(prod_id,prod_price){
    if(b_token == null && buyer_id == null)
    {
      Swal.fire({
        title: 'เกิดข้อผิดพลาดบางอย่าง !',
        text: "กรุณา Login ก่อนเพิ่มสินค้าลงตะกร้า !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Login',
        cancelButtonText: 'Register',
      }).then((result) => {
        if (result.value) {
          window.location.href = ('/loginBuyer');
        }else{
          window.location.href = ('/registerBuyer');
        }
      });

    }else{

      $.ajax({
        url: '/api/addCart',
        headers: {
          'Authorization':'Bearer '+b_token,
          'Content-Type':'application/json'
        },
        method: 'POST',
        data: JSON.stringify({ "buyer_id":buyer_id,"prod_id":prod_id,"prod_price":prod_price }),
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function(data){
          if(data['success'] != null)
          {
            findAndRemove(jsonDelivery, ["prod_id"], prod_id);
            findAndRemove(jsonOrder, ["prod_id"], prod_id);
            getCartByID(prod_id);
          }else{
            swal({
              title: "Error !",
              text: "เกิดข้อผิดพลาดบางประการ !",
              type: "error"
            });
          }
        }
      });
    }
  }

  function decrease(prod_id,prod_price,count){
    if(count == 1){
      Swal.fire({
        title: "คุณแน่ใจหรือไม่ !",
        text: "สินค้าชิ้นสุดท้าย จะถูกลบออกจากตะกร้า !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ลบออกจากตะกร้า'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: '/api/decrease',
            headers: {
              'Authorization':'Bearer '+b_token,
              'Content-Type':'application/json'
            },
            method: 'POST',
            data: JSON.stringify({ "buyer_id":buyer_id,"prod_id":prod_id,"prod_price":prod_price }),
            contentType: "application/json; charset=utf-8",
            dataType: 'json',
            success: function(data){
              if(data['success'] != null)
              {
                findAndRemove(jsonDelivery, ["prod_id"], prod_id);
                findAndRemove(jsonOrder, ["prod_id"], prod_id);
                prod_id_list = [];
                prod_id_list = jQuery.grep(prod_id_list, function(value) {
                  return value != prod_id;
                });
                Swal.fire({
                  type: 'success',
                  title: 'ลบสินค้าออกจากตะกร้า เรียบร้อย',
                  showConfirmButton: false,
                  timer: 1500
                });
                getAddress();
                getCart();
              }else{
                swal({
                  title: "Error !",
                  text: "เกิดข้อผิดพลาดบางประการ !",
                  type: "error"
                });
              }
            }
          });
        }});
    }else{
      $.ajax({
        url: '/api/decrease',
        headers: {
          'Authorization':'Bearer '+b_token,
          'Content-Type':'application/json'
        },
        method: 'POST',
        data: JSON.stringify({ "buyer_id":buyer_id,"prod_id":prod_id,"prod_price":prod_price }),
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function(data){
          if(data['success'] != null)
          {
            findAndRemove(jsonDelivery, ["prod_id"], prod_id);
            findAndRemove(jsonOrder, ["prod_id"], prod_id);
            getCartByID(prod_id);
          }else{
            Swal.fire({
              type: 'success',
              title: 'ลบสินค้าออกจากตะกร้า เรียบร้อย',
              showConfirmButton: false,
              timer: 1500
            });
          }
        }
      });
    }
  }

  function deleteProductInCart(prod_id,prod_price){
    Swal.fire({
      title: "คุณแน่ใจหรือไม่ !",
      text: "สินค้า จะถูกลบออกจากตะกร้า !",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ลบออกจากตะกร้า'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: '/api/decrease',
          headers: {
            'Authorization':'Bearer '+b_token,
            'Content-Type':'application/json'
          },
          method: 'POST',
          data: JSON.stringify({ "buyer_id":buyer_id,"prod_id":prod_id,"prod_price":prod_price }),
          contentType: "application/json; charset=utf-8",
          dataType: 'json',
          success: function(data){
            if(data['success'] != null)
            {
              findAndRemove(jsonDelivery, ["prod_id"], prod_id);
              findAndRemove(jsonOrder, ["prod_id"], prod_id);
              prod_id_list = [];
              prod_id_list = jQuery.grep(prod_id_list, function(value) {
                return value != prod_id;
              });
              Swal.fire({
                type: 'success',
                title: 'ลบสินค้าออกจากตะกร้า เรียบร้อย',
                showConfirmButton: false,
                timer: 1500
              });
              getAddress();
              getCart();
            }else{
              swal({
                title: "Error !",
                text: "เกิดข้อผิดพลาดบางประการ !",
                type: "error"
              });
            }
          }
        });
      }});
  }

  function checkout(){
    var select_0=0;
    console.log(prod_id_list);
    for(var i = 0 ; i < prod_id_list.length ; i++){
      if($('#delivery_option_'+prod_id_list[i]+'').val() != 999){

        productList = {}
        productList ["prod_id"] = prod_id_list[i];
        findAndRemove(jsonDelivery, ["prod_id"], prod_id_list[i]);

        jsonDelivery.push(productList);
      }else{
        findAndRemove(jsonDelivery, ["prod_id"], prod_id_list[i]);
      }
    }

    console.log(jsonOrder);


    if(jsonDelivery.length == prod_id_list.length){

      var swalPrice=0;

      for(i = 0; i<jsonOrder.length; i++){
        swalPrice += jsonOrder[i]['price'];
      }
      Swal.fire({
        title: 'ยืนยันการสั่งซื้อ',
        html: "กรุณาตรวจสอบรายการสินค้าทั้งหมด ก่อนกดสั่งซื้อ<br />ราคาสินค้าทั้งหมด รวมค่าจัดส่ง : "+swalPrice+" บาท",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ตกลง ฉันต้องการสั่งซื้อ'
      }).then((result) => {
        if (result.value) {

          $.ajax({
            url: '/api/createOrder',
            headers: {
              'Authorization':'Bearer '+b_token,
              'Content-Type':'application/json'
            },
            method: 'POST',
            data: JSON.stringify({ "buyer_id":buyer_id,"order_list":jsonOrder }),
            contentType: "application/json; charset=utf-8",
            dataType: 'json',
            success: function(data){
              if(data['success'] != null)
              {
                Swal.fire({
                  type: 'success',
                  title: 'เพิ่มสินค้าลงตะกร้า เรียบร้อย',
                  showConfirmButton: false,
                  timer: 1500
                });
                window.location.replace('/');
              }else{
                swal({
                  title: "Error !",
                  text: "เกิดข้อผิดพลาดบางประการ !",
                  type: "error"
                });
              }
            }
          });

        }
      });
    }else{
      Swal.fire({
        type: 'error',
        title: 'กรุณาเลือกการจัดส่งให้ครบ ',
        showConfirmButton: false,
        timer: 1500
      });
    }
  }

  function findAndRemove(array, property, value) {
  array.forEach(function(result, index) {
    if(result[property] === value) {
      array.splice(index, 1);
    }
  });
}

  function delivery_change(source,prod_id,prod_price){
    if($(source).val() != 999){
      var del_price_id = source.value.split(',')[0].trim();
      var del_price = source.value.split(',')[1].trim();
      var del_name = source.value.split(',')[2].trim();
      del_price_id = parseInt(del_price_id, 10)
      del_price = parseInt(del_price, 10)
      var allprice = prod_price+del_price;
      $('#delivery_detail_'+prod_id+'').empty();
      $('#delivery_detail_'+prod_id+'').append('ราคาสินค้า : '+prod_price+' จัดส่งโดย : '+del_name+ ' ค่าจัดส่ง : '+del_price +' รวมราคา : '+ allprice +' บาท');

        orderList = {}
        orderList ["prod_id"] = prod_id;
        orderList ["price"] = allprice;
        orderList ["del_price_id"] = del_price_id;
        orderList ["add_id"] = $("#address_list_"+prod_id).val();

        findAndRemove(jsonOrder, ["prod_id"], prod_id);

        jsonOrder.push(orderList);
    }else{
      $('#delivery_detail_'+prod_id+'').empty();
    }
  }

  function getCartByID(prod_id){
    $.ajax({
      url: '/api/getCart',
      headers: {
        'Authorization':'Bearer '+b_token,
        'Content-Type':'application/json'
      },
      method: 'POST',
      data: JSON.stringify({ "buyer_id":buyer_id }),
      contentType: "application/json; charset=utf-8",
      dataType: 'json',
      success: function(data){
        console.log(data);
        $("#total").empty();
        if(data['success'] != null)
        {
          getAddress();
          address_change(prod_id);
          var cart_count;
          var allprice;

          if(data['success'][0]['NumOfProduct'] == null){
            cart_count = 0;
          }else{
            cart_count = data['success'][0]['NumOfProduct'];
          }

          if(data['success'][0]['Price'] == null){
            allprice = 0;
          }else{
            allprice = data['success'][0]['Price'];
          }
          if(cart_count > 0){
            for(var i = 0 ; i < cart_count ; i++){
            if(data['ProductInCart'][i]['Prod_id'] == prod_id){
              $('#ibox_'+data['ProductInCart'][i]['Prod_id']+'').empty();
              $('#ibox_'+data['ProductInCart'][i]['Prod_id']+'').append('<div class="table-responsive">'+
                    '<table class="table shoping-cart-table">'+
                        '<tbody>'+
                        '<tr>'+
                            '<td width="100">'+
                                '<div class="cart-product-imitation"><img src="'+data['ProductInCart'][i]['pic_url1']+'" alt="" width="150">'+
                                '</div>'+
                            '</td>'+
                            '<td class="desc">'+
                                '<h4>'+
                                '<a href="#" class="text-navy">'+
                                    data['ProductInCart'][i]['prod_name']+
                                '</a>'+
                                ''+
                                '</h4>'+

                                '<div class="m-t-sm"><label class="col-sm-6 control-label">ที่อยู่ในการจัดส่ง</label>'+
                                    '<div class="col-sm-8"><select onchange="address_change('+data['ProductInCart'][i]['Prod_id']+')" id="address_list_'+data['ProductInCart'][i]['Prod_id']+'" class="form-control " name="address_list_'+data['ProductInCart'][i]['Prod_id']+'">'+
                                      '<option value="0">เลือกที่อยู่ในการจัดส่ง</option>'+
                                      '</select>'+
                                    '</div>'+
                                  '</div>'+
                                '<div class="m-t-sm"><label class="col-sm-6 control-label">ส่งโดย</label>'+
                                    '<div class="col-sm-8"><select disabled onchange="delivery_change(this,'+data['ProductInCart'][i]['Prod_id']+','+data['ProductInCart'][i]['prod_price']*data['ProductInCart'][i]['count']+')" id="delivery_option_'+data['ProductInCart'][i]['Prod_id']+'"class="form-control " name="delivery_option_'+data['ProductInCart'][i]['Prod_id']+'">'+
                                      '<option value="999">เลือกประเภทการจัดส่ง</option>'+
                                      '</select>'+
                                    '</div>'+
                                  '</div>'+
                                  '<h4 id="delivery_detail_'+data['ProductInCart'][i]['Prod_id']+'">'+
                                  '</h4>'+
                                '<div class="m-t-sm">'+
                                    '<a href="#" onclick="deleteProductInCart('+data['ProductInCart'][i]['Prod_id']+','+data['ProductInCart'][i]['prod_price']+')" class="text-muted"><i class="fa fa-trash"></i> ลบสินค้า</a>'+
                                '</div>'+
                            '</td>'+
                            '<td>'+
                                'ราคาต่อชิ้น '+data['ProductInCart'][i]['prod_price']+' บาท'+
                            '</td>'+
                            '<td width="100">'+
                                '<a onclick="addCart('+data['ProductInCart'][i]['Prod_id']+','+data['ProductInCart'][i]['prod_price']+')"><i class="fa fa-plus"></i></a>'+
                                '<input id="product_count_'+data['ProductInCart'][i]['Prod_id']+'" type="number" class="form-control" placeholder="1" min="1" max="20" value="'+data['ProductInCart'][i]['count']+'" disabled>'+
                                '<a onclick="decrease('+data['ProductInCart'][i]['Prod_id']+','+data['ProductInCart'][i]['prod_price']+','+data['ProductInCart'][i]['count']+')"><i class="fa fa-minus"></i></a>'+
                            '</td>'+
                            '<td>'+
                                '<h4>'+
                                    '฿'+data['ProductInCart'][i]['prod_price']*data['ProductInCart'][i]['count']+
                                '</h4>'+
                            '</td>'+
                        '</tr>'+
                        '</tbody>'+
                    '</table>'+

            '</div>');
            }
          }
          for(var x = 0 ; x < data['Delivery'].length ; x++){
            if(data['Delivery'][x]['price'] != null && data['Delivery'][x]['Prod_id'] == prod_id)
            {
              $('#delivery_option_'+data['Delivery'][x]['Prod_id']+'').append('<option value="'+data['Delivery'][x]['del_price_id']+','+data['Delivery'][x]['price']+','+data['Delivery'][x]['deliveryname']+'">'+data['Delivery'][x]['deliveryname']+'  '+data['Delivery'][x]['price']+'</option>');
            }
          }
          }

        }else{
          swal({
            title: "Error !",
            text: "เกิดข้อผิดพลาดบางประการ !",
            type: "error"
          });
        }
      }
    });
  }

  function getAddress(){
    (async () => {
    const rawResponse = await fetch('/api/getAddress', {
      method: 'POST',
      headers: {
        'Authorization':'Bearer '+b_token,
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({"buyer_id":buyer_id})
    });
    const content = await rawResponse.json();
    if(content['success'] != ''){
      console.log(content['success']);
      for(a = 0; a<prod_id_list.length ; a++){
        $("#address_list_"+prod_id_list[a]).empty();
        $("#address_list_"+prod_id_list[a]).append('<option value="0">เลือกที่อยู่ในการจัดส่ง</option>');
        for(i = 0; i<content['success'].length ; i++){
          $("#address_list_"+prod_id_list[a]).append('<option value="'+content['success'][i]['Add_id']+'">'+content['success'][i]['province']+' '+content['success'][i]['district']+' '+content['success'][i]['zipcode']+' '+content['success'][i]['area']+'</option>');
        }
    }
    }else{
      Swal.fire({
        type: 'warning',
        title: 'กรุณาเพิ่มที่อยู่ก่อน !',
        showConfirmButton: false,
        timer: 1500
      });
    }
  })();
  }

  function address_change(Prod_id)
  {
    var address = $("#address_change_"+Prod_id).val();

    if(address != 0){
      $("#delivery_option_"+Prod_id).prop('disabled', false);
    }else{
      $("#address_list_"+Prod_id).val(0);
      $("#delivery_option_"+Prod_id).prop('disabled', true);
    }

  }
</script>
@endsection
