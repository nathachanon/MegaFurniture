function getAllProduct(){
  var p_name = getCookie();
  var p_name2 = '%';
  p_name2 += p_name;
  p_name2 += '%';
  $.ajax({
    type: "POST",
    url: "/api/searchResult",
    data: JSON.stringify({
      "product_name": p_name2 }),
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
        var rating;
        var name = data['product'][i]['Name'];
        var price = data['product'][i]['Price'];
        var pic = data['product'][i]['Pic'];
        if(0 < rating_point && rating_point <= 0.5)
        {
          rating =
          '<span class="fa fa-star-half-full"></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>';
        }else if(0.5 < rating_point && rating_point <= 1){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>';
        }else if(1 < rating_point && rating_point <= 1.5){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star-half-full"></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>';
        }else if(1.5 < rating_point && rating_point <= 2){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>';
        }else if(2 < rating_point && rating_point <= 2.5){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star-half-full"></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>';
        }else if(2.5 < rating_point && rating_point <= 3){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>';
        }else if(3 < rating_point && rating_point <= 3.5){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star-half-full"></span>'+
          '<span class="fa fa-star "></span>';
        }else if(3.5 < rating_point && rating_point <= 4){
          rating =
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star checked"></span>'+
          '<span class="fa fa-star "></span>';
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
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>'+
          '<span class="fa fa-star "></span>';
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
         '<a href="#" onclick="addCart(\'' + name + '\','+data['product'][i]['prod_id']+','+price+',\'' + pic + '\')" class="btn btn-xs btn-outline btn-primary"><i class="fa fa-shopping-cart"></i> </a>'+
         '</div>'+
         '<div class="m-t  inline2">'+
         '<a href="#"onclick="alert('+data['product'][i]['prod_id']+');" class="btn btn-xs btn-outline btn-primary"><i class="fa fa-comment"></i> </a>'+
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
console.log(data);

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
  var price = data['product'][i]['Price'];
  var pic = data['product'][i]['Pic'];

  if(0 < rating_point && rating_point <= 0.5)
  {
    rating =
    '<span class="fa fa-star-half-full"></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>';
  }else if(0.5 < rating_point && rating_point <= 1){
    rating =
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>';
  }else if(1 < rating_point && rating_point <= 1.5){
    rating =
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star-half-full"></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>';
  }else if(1.5 < rating_point && rating_point <= 2){
    rating =
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>';
  }else if(2 < rating_point && rating_point <= 2.5){
    rating =
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star-half-full"></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>';
  }else if(2.5 < rating_point && rating_point <= 3){
    rating =
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>';
  }else if(3 < rating_point && rating_point <= 3.5){
    rating =
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star-half-full"></span>'+
    '<span class="fa fa-star "></span>';
  }else if(3.5 < rating_point && rating_point <= 4){
    rating =
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star "></span>';
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
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>';
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
   '<a href="#" onclick="addCart(\'' + name + '\','+data['product'][i]['prod_id']+','+price+',\'' + pic + '\')" class="btn btn-xs btn-outline btn-primary"><i class="fa fa-shopping-cart"></i> </a>'+
   '</div>'+
   '<div class="m-t  inline2">'+
   '<a href="#"onclick="alert('+data['product'][i]['prod_id']+');" class="btn btn-xs btn-outline btn-primary"><i class="fa fa-comment"></i> </a>'+
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
console.log(data);
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
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>';
  }else if(0.5 < rating_point && rating_point <= 1){
    rating =
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>';
  }else if(1 < rating_point && rating_point <= 1.5){
    rating =
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star-half-full"></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>';
  }else if(1.5 < rating_point && rating_point <= 2){
    rating =
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>';
  }else if(2 < rating_point && rating_point <= 2.5){
    rating =
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star-half-full"></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>';
  }else if(2.5 < rating_point && rating_point <= 3){
    rating =
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>';
  }else if(3 < rating_point && rating_point <= 3.5){
    rating =
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star-half-full"></span>'+
    '<span class="fa fa-star "></span>';
  }else if(3.5 < rating_point && rating_point <= 4){
    rating =
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star checked"></span>'+
    '<span class="fa fa-star "></span>';
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
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>'+
    '<span class="fa fa-star "></span>';
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
   '<a href="#" onclick="addCart(\'' + name + '\','+data['product'][i]['prod_id']+','+price+',\'' + pic + '\')" class="btn btn-xs btn-outline btn-primary"><i class="fa fa-shopping-cart"></i> </a>'+
   '</div>'+
   '<div class="m-t  inline2">'+
   '<a href="#"onclick="alert('+data['product'][i]['prod_id']+');" class="btn btn-xs btn-outline btn-primary"><i class="fa fa-comment"></i> </a>'+
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

function getCookie() {
var names = 'searchProduct';
var value = "; " + document.cookie;
var parts = value.split("; " + names + "=");
if (parts.length == 2) return parts.pop().split(";").shift();
}

if(getCookie() != ''){
getAllProduct();
}

function productDetail(prod_id){
createCookie('viewProduct',prod_id,60);
window.location.href = '/productDetail';
}
