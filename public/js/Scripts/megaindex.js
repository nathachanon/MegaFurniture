var b_token = localStorage.getItem("b_token");
var buyer_id = localStorage.getItem("buyer_id");

var jsonCart = [];

var compare_count=0;

ThisBuyer();
getAllProduct();

function getAllProduct(){
  $('#compare').append(compare_count);
  $.ajax({
    type: "GET",
    url: "/api/getProductMain",
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    success: function(data){

      var product_count = data['product_count'];
      if(product_count == 'NULL' || product_count == 0 ){
        $('#p_counts').append('ไม่พบสินค้าที่ต้องการ')
      }else{
        $('#p_counts').append('พบ '+product_count+' รายการ')
      }
      for(var i = 0 ; i < product_count ; i++){
        var rating_point = data['rating'][i]['Rating'];
        var name = data['product'][i]['Name'];
        var price = data['product'][i]['Price']
        var pic = data['product'][i]['Pic'];


        var rating;
        var str = data['product'][i]['Name'];
        if(0 < rating_point && rating_point <= 0.5)
        {
          rating =
          '<span class="fa fa-star-half-full"></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }else if(0.5 < rating_point && rating_point <= 1){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }else if(1 < rating_point && rating_point <= 1.5){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star-half-full"></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }else if(1.5 < rating_point && rating_point <= 2){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }else if(2 < rating_point && rating_point <= 2.5){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star-half-full"></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }else if(2.5 < rating_point && rating_point <= 3){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }else if(3 < rating_point && rating_point <= 3.5){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star-half-full"></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }else if(3.5 < rating_point && rating_point <= 4){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-grey fa-star "></span>';
        }else if(4 < rating_point  && rating_point <= 4.5){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star-half-full"></span>';
        }else if(4.5 < rating_point  && rating_point <= 5){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>';
        }else{
          rating =
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }
        $('#product_list').append('<div class="col-md-3">'+
         '<div class="ibox">'+
         '<div class="ibox-content product-box" >'+
         '<div class="product-imitation-prod" onclick="productDetail('+data['product'][i]['prod_id']+')">'+
         '<img src="'+data['product'][i]['Pic']+'" alt="">'+
         '</div>'+
         '<div class="product-desc">'+
         '<span class="product-price">'+
         data['product'][i]['Price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'฿'+
         '</span>'+
         '<div class="shop_bar"></div><a href="#"> <div class="product-name-a" onclick="productDetail('+data['product'][i]['prod_id']+')">'+
         data['product'][i]['Name']+'</div></a>'+
         '<small class="text-muted">#'+data['product'][i]['Room']+'</small>'+
         '<div class="text-muted m-t-xs cut-str">'+
         data['product'][i]['Description']+
         '</div>'+
         '<div class="fr">'+
         rating+
         '</div>'+
         '<div class="inline2"><div class="m-t inline2">'+
         '<a onclick="addCart(\'' + name + '\','+data['product'][i]['prod_id']+','+price+',\'' + pic + '\')" class="btn btn-xs btn-outline btn-primary"><i class=" prim fa fa-shopping-cart"></i> </a>'+
         '</div>'+
         '<div class="m-t  inline2">'+
         '<a onclick="alert('+data['product'][i]['prod_id']+');" class="btn btn-xs btn-outline btn-primary"><i class="prim fa fa-comment"></i> </a>'+
         '</div>'+
         '<div class="m-t  inline2">'+
         '<a onclick="addCompare(\'' + name + '\','+data['product'][i]['prod_id']+','+price+',\'' + pic + '\');"'+
         ' class="btn btn-xs btn-outline btn-primary"><i class="fa fa-plus-square prim"></i> </a>'+
         '</div></div>'+
         '</div>'+
         '</div>'+
         '</div>'+
         '</div>');
      }
    },
    failure: function(errMsg) {
      alert(errMsg);
    }
  });
}
function productDetail(prod_id){
createCookie('viewProduct',prod_id,60);
window.location.href = '/productDetail';
}

function searchCat(CatProd_name){
$('#product_list').empty();
$('#p_counts').empty();
$.ajax({
type: "POST",
url: "/api/getProductType",
data: JSON.stringify({
"CatProd_name": CatProd_name }),
contentType: "application/json; charset=utf-8",
dataType: "json",
success: function(data){
var product_count = data['product_count'][0]['count'];
if(product_count == 'NULL' || product_count == 0 ){
  $('#p_counts').append('ไม่พบสินค้าที่ต้องการ')
}else{
  $('#p_counts').append('พบ '+product_count+' รายการ')
}
for(var i = 0 ; i < product_count ; i++){
  var rating_point = data['rating'][i]['Rating'];
  var rating;
  var name = data['product'][i]['Name'];
  var price = data['product'][i]['Price']
  var pic = data['product'][i]['Pic'];

  if(0 < rating_point && rating_point <= 0.5)
  {
     rating =
          '<span class="fa fa-star-half-full"></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }else if(0.5 < rating_point && rating_point <= 1){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }else if(1 < rating_point && rating_point <= 1.5){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star-half-full"></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }else if(1.5 < rating_point && rating_point <= 2){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }else if(2 < rating_point && rating_point <= 2.5){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star-half-full"></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }else if(2.5 < rating_point && rating_point <= 3){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }else if(3 < rating_point && rating_point <= 3.5){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star-half-full"></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
        }else if(3.5 < rating_point && rating_point <= 4){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-grey fa-star "></span>';
        }else if(4 < rating_point  && rating_point <= 4.5){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star-half-full"></span>';
        }else if(4.5 < rating_point  && rating_point <= 5){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>';
        }else{
          rating =
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>'+
          '<span class="fa  fa-grey fa-star "></span>';
  }
  $('#product_list').append('<div class="col-md-3">'+
         '<div class="ibox">'+
         '<div class="ibox-content product-box" >'+
         '<div class="product-imitation-prod" onclick="productDetail('+data['product'][i]['prod_id']+')">'+
         '<img src="'+data['product'][i]['Pic']+'" alt="">'+
         '</div>'+
         '<div class="product-desc">'+
         '<span class="product-price">'+
         data['product'][i]['Price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'฿'+
         '</span>'+
         '<div class="shop_bar"></div><a href="#"> <div class="product-name-a" onclick="productDetail('+data['product'][i]['prod_id']+')">'+
         data['product'][i]['Name']+'</div></a>'+
         '<small class="text-muted">#'+data['product'][i]['Room']+'</small>'+
         '<div class="text-muted m-t-xs cut-str">'+
         data['product'][i]['Description']+
         '</div>'+
         '<div class="fr">'+
         rating+
         '</div>'+
         '<div class="inline2"><div class="m-t inline2">'+
         '<a onclick="addCart(\'' + name + '\','+data['product'][i]['prod_id']+','+price+',\'' + pic + '\')" class="btn btn-xs btn-outline btn-primary"><i class=" prim fa fa-shopping-cart"></i> </a>'+
         '</div>'+
         '<div class="m-t  inline2">'+
         '<a onclick="alert('+data['product'][i]['prod_id']+');" class="btn btn-xs btn-outline btn-primary"><i class="prim fa fa-comment"></i> </a>'+
         '</div>'+
         '<div class="m-t  inline2">'+
         '<a onclick="addCompare(\'' + name + '\','+data['product'][i]['prod_id']+','+price+',\'' + pic + '\');"'+
         ' class="btn btn-xs btn-outline btn-primary"><i class="fa fa-plus-square prim"></i> </a>'+
         '</div></div>'+
         '</div>'+
         '</div>'+
         '</div>'+
         '</div>');
}
},
failure: function(errMsg) {
alert(errMsg);
}
});
}

function addCart(prod_name,prod_id,prod_price,prod_pic)
{

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
          const node = document.querySelector("#icon_cart")
          node.classList.add('rubberBand', 'animated')

          function handleAnimationEnd() {
          node.classList.remove('rubberBand', 'animated')
          node.removeEventListener('animationend', handleAnimationEnd)

          if (typeof callback === 'function') callback()
          }
          node.addEventListener('animationend', handleAnimationEnd)
          Swal.fire({
            type: 'success',
            title: 'เพิ่มสินค้าลงตะกร้า เรียบร้อย',
            showConfirmButton: false,
            timer: 1500
          });
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
          $('#allprice').empty();
        }else{
          allprice = data['success'][0]['Price'];
        }
        $('#small_cart_count').empty();
        $("#small_cart_list").empty();
        $('#cart_list').empty();
        $('#cart').empty();
        $('#allprice').empty();
        if(cart_count > 0){
          for(var i = 0 ; i < cart_count ; i++){

            $("#small_cart_list").append('<div>'+
            '<div class="author-name">'+
                    data['ProductInCart'][i]['prod_name']+
                '</div>'+
                '<img width="180" alt="image" class="img-circle" src="'+data['ProductInCart'][i]['pic_url1']+'">'+
                '<div class="chat-message active">'+
                    ''+data['ProductInCart'][i]['prod_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' ฿ จำนวน '+data['ProductInCart'][i]['count']+' ชิ้น'+
                '</div>'+
                '<button type="button" class="btn btn-danger btn-sm btn-block" onclick="deleteProductInCart('+data['ProductInCart'][i]['Prod_id']+','+data['ProductInCart'][i]['prod_price']+')"><i class="fa fa-trash"></i> ลบออกจากตะกร้า</button>'+
            '</div>');

            $('#cart_list').append('<li>'+
            '<div class="dropdown-messages-box">'+
            '<a href="#" class="pull-left">'+
            '<img alt="image" class="img-circle" src="'+data['ProductInCart'][i]['pic_url1']+'">'+
            '</a>'+
            '<div class="media-body">'+
            '<strong>'+data['ProductInCart'][i]['prod_name']+'</strong><br>'+data['ProductInCart'][i]['prod_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'฿ x '+data['ProductInCart'][i]['count']+
            '</div>'+
            '</div>'+
            '<a href="#" onclick="deleteProductInCart('+data['ProductInCart'][i]['Prod_id']+','+data['ProductInCart'][i]['prod_price']+')">ลบ</a></li><br>');

          }
        }
        $('#small_cart_count').append(cart_count);
        $('#cart').append(cart_count);
        $('#allprice').append('฿'+allprice);
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

function addCompare(prod_name,prod_id,prod_price,prod_pic)
{
if(compare_count < 3){
compare_count += 1;

allprice += prod_price;

jsonCart.push({prod_id:prod_id});

$('#compare').empty();

const node = document.querySelector("#icon_compare")
node.classList.add('rubberBand', 'animated')

function handleAnimationEnd() {
node.classList.remove('rubberBand', 'animated')
node.removeEventListener('animationend', handleAnimationEnd)

if (typeof callback === 'function') callback()
}

node.addEventListener('animationend', handleAnimationEnd)

$('#compare_list').append('<li>'+
'<div class="dropdown-messages-box">'+
'<a href="#" class="pull-left">'+
'<img alt="image" class="img-circle" src="'+prod_pic+'">'+
'</a>'+
'<div class="media-body">'+
'<strong>'+prod_name+'</strong><br>'+prod_price+' บาท'+
'</div>'+
'</div>'+
'</li><br>');

$('#compare').append(compare_count);
}else{
alert('สามารถเปรียบเทียบสินค้าได้สูงสุด 3 ชิ้น');
}
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

function deleteProductInCart(prod_id,prod_price){
  $.ajax({
    url: '/api/deleteCart',
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
        const node = document.querySelector("#icon_cart")
        node.classList.add('rubberBand', 'animated')

        function handleAnimationEnd() {
        node.classList.remove('rubberBand', 'animated')
        node.removeEventListener('animationend', handleAnimationEnd)

        if (typeof callback === 'function') callback()
        }
        node.addEventListener('animationend', handleAnimationEnd)
        Swal.fire({
          type: 'success',
          title: 'ลบสินค้าจากตะกร้า เรียบร้อย',
          showConfirmButton: false,
          timer: 1500
        });

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
}

function ThisBuyer(){
  if(b_token == null && buyer_id == null)
  {
    $('#cart').append(0);
  }
  else{
    $("#small_cart").append('<div class="small-chat-box fadeInRight animated">'+
        '<div class="heading" draggable="true">'+
            'สินค้าในตะกร้า'+
        '</div>'+
        '<div class="content" id="small_cart_list">'+
        '</div>'+
        '<div class="form-chat">'+
            '<div class="input-group input-group-sm"><button type="button" class="btn btn-default btn-sm btn-block" id="carts_2" ><i class="fa fa-arrow-right"></i>จัดการตะกร้า</button></div>'+
        '</div>'+
    '</div>'+
    '<div id="small-chat">'+
        '<span class="badge badge-warning pull-right" id="small_cart_count">0</span>'+
        '<a class="open-small-chat">'+
            '<i class="fa fa-shopping-cart"></i>'+
        '</a>'+
    '</div>');
    getCart();
  }
}

$("#carts_2").click(function(){
	window.location.href = "/cart";
});
