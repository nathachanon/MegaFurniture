
var compare_count = 0;
getAllProduct();

function getAllProduct() {
  $('#compare').append(compare_count);
  $.ajax({
      type: "GET",
      url: "/api/getProductMain",
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function (data) {
          var product_count = data['product_count'];
          if (product_count == 'NULL' || product_count == 0) {
              $('#p_counts').append('ไม่พบสินค้าที่ต้องการ')
          } else {
              $('#p_counts').append('พบ ' + product_count + ' รายการ')
          }
          for (var i = 0; i < product_count; i++) {
              var rating_point = data['rating'][i]['Rating'];
              var name = data['product'][i]['Name'];
              var price = data['product'][i]['Price']
              var pic = data['product'][i]['Pic'];


              var rating;
              var str = data['product'][i]['Name'];
              if (0 < rating_point && rating_point <= 0.5) {
                  rating =
                      '<span class="fas fa-star-half-alt"></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>';
              } else if (0.5 < rating_point && rating_point <= 1) {
                  rating =
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>';
              } else if (1 < rating_point && rating_point <= 1.5) {
                  rating =
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fas fa-star-half-alt"></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>';
              } else if (1.5 < rating_point && rating_point <= 2) {
                  rating =
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>';
              } else if (2 < rating_point && rating_point <= 2.5) {
                  rating =
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fas fa-star-half-alt"></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>';
              } else if (2.5 < rating_point && rating_point <= 3) {
                  rating =
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>';
              } else if (3 < rating_point && rating_point <= 3.5) {
                  rating =
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fas fa-star-half-alt"></span>' +
                      '<span class="fa  fa-grey fa-star "></span>';
              } else if (3.5 < rating_point && rating_point <= 4) {
                  rating =
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-grey fa-star "></span>';
              } else if (4 < rating_point && rating_point <= 4.5) {
                  rating =
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fas fa-star-half-alt"></span>';
              } else if (4.5 < rating_point && rating_point <= 5) {
                  rating =
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>' +
                      '<span class="fa fa-star checked"></span>';
              } else {
                  rating =
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>' +
                      '<span class="fa  fa-grey fa-star "></span>';
              }
              $('#product_list').append('<div class="col-md-3">' +
                  '<div class="ibox">' +
                  '<div class="ibox-content product-box" >' +
                  '<div class="product-imitation-prod" onclick="productDetail(' + data['product'][i]['prod_id'] + ')">' +
                  '<img src="' + data['product'][i]['Pic'] + '" alt="">' +
                  '</div>' +
                  '<div class="product-desc">' +
                  '<span class="product-price">' +
                  data['product'][i]['Price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '฿' +
                  '</span>' +
                  '<div class="shop_bar"></div><a href="#"> <div class="product-name-a" onclick="productDetail(' + data['product'][i]['prod_id'] + ')">' +
                  data['product'][i]['Name'] + '</div></a>' +
                  '<small class="text-muted">#' + data['product'][i]['Room'] + '</small>' +
                  '<div class="text-muted m-t-xs cut-str">' +
                  data['product'][i]['Description'] +
                  '</div>' +
                  '<div class="fr">' +
                  rating +
                  '</div>' +
                  '<div class="inline2"><div class="m-t inline2">' +
                  '<a onclick="addCart(\'' + name + '\',' + data['product'][i]['prod_id'] + ',' + price + ',\'' + pic + '\')" class="btn btn-xs btn-outline btn-primary"><i class=" prim fa fa-shopping-cart"></i> </a>' +
                  '</div>' +
                  '<div class="m-t  inline2">' +
                  '<a onclick="addCompare(\'' + name + '\',' + data['product'][i]['prod_id'] + ',' + price + ',\'' + pic + '\');"' +
                  ' class="btn btn-xs btn-outline btn-primary b-hov"><i class="fa fa-plus-square prim"></i> </a>' +
                  '</div></div>' +
                  '</div>' +
                  '</div>' +
                  '</div>' +
                  '</div>');
          }
      },
      failure: function (errMsg) {
          alert(errMsg);
      }
  });
}