
<link href="css/bootstrap.min.css" rel="stylesheet">




<style>

/*popup*/

body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 43%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>




<style>
td,th{
    text-align: center;
    vertical-align: middle;
}

.comparePic {
width: 150px;
height: 150px;
}
</style>
<script src="js/plugins/js-cookie-master/js.cookie.js"></script>
<script>


function addCompare(Product_id) {
  console.log(Product_id.value);


  if(!Cookies.get('cookie_P_1') || Cookies.get('cookie_P_1') === 'undefined' ){
    Cookies.set("cookie_P_1",Product_id.value, { expires : 1 });
  }else if (!Cookies.get('cookie_P_2')  || Cookies.get('cookie_P_1') === 'undefined')  {
    Cookies.set("cookie_P_2",Product_id.value, { expires : 1 });
  }else if (!Cookies.get('cookie_P_3')  || Cookies.get('cookie_P_1') === 'undefined')  {
    Cookies.set("cookie_P_3",Product_id.value, { expires : 1 });
  }else{alert("เปรียบเทียบพร้อมกันได้มากสุด 3 สินค้า");}

  }
  function removeCookie() {
    Cookies.remove('cookie_P_1');
    Cookies.remove('cookie_P_2');
    Cookies.remove('cookie_P_3');
    location.reload();
    }


</script>
<body >


<div id='product'></div>





เลือกเพื่อเปรียบเทียบ
<br>
<button  onclick="removeCookie()">ล้างคุกกี้</button>
<br>
<button id="compare" >เปรียบเทียบสินค้า</button>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div id="modal-content"class="modal-content">
    <span id="close"class="close">&times;</span>
    <div id="compareList"></div>
  </div>

</div>

</body>
<script src="js/jquery-2.1.1.js"></script>
<script>

$("#close").click(function(){  modal.style.display = "none";
console.log("ID");
});
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  console.log("CLASS");
  modal.style.display = "none";

}



// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script type="text/javascript">

$(document).ready(function(){

  $("#compare").click(function(){
    console.log('P3 = '+Cookies.get('cookie_P_3'));
    if(Cookies.get('cookie_P_1') && Cookies.get('cookie_P_2') ) {
    modal.style.display = "block";
    compareProduct();
  }else{
    modal.style.display = "none";
    alert("กรุณาเลือกสินค้าอย่างน้อย2ชิ้นเพื่อเปรียบเทียบ");}
  });


  function getProduct()
  {


      $.ajax({

        url: "/api/getProduct",
        headers: {
          'Content-Type':'application/json'
        },
        contentType: "application/json; charset=utf-8",
        method: 'POST',
        dataType: "json",
        success: function(data){
          var p_count = data['product_count'];
          for(var i=0 ;i<p_count ;i++){
            $('#product').append('<div class="col-md-3">'+
              '<div class="ibox" style="border-style: outset;" align="center">'+
              '<div class="ibox-content product-box animated fadeInLeft">'+
              '<div class="product-imitation">'+
              '<img src="'+data['product'][i]['pic_url1']+'" class ="comparePic"></img>'+
              '</div>'+
              '<div class="product-desc">'+
              '<a onclick="" href="product" class="product-name">'+data['product'][i]['prod_name']+'</a>'+
              '<div class="small m-t-xs">'+
              'ราคา : '+data['product'][i]['prod_price']+' บาท'+
              '</div>'+
              '<div class="small m-t-xs" >'+
              '<button style="margin-left:0px;" value="'+data['product'][i]['Prod_id']+'" onclick="addCompare(this)" >เปรียบเทียบ</button>'+
              '</div>'+
              '</div>'+
              '</div>'+
              '</div>'+
              '</div>');
          }



        }
        ,
        failure: function(errMsg) {
          alert(errMsg);
        }
      });




  }

  function removeCompare(Product_id) {

    console.log("removeCompare");
      for(i=1;i<4;i++){
        console.log(Product_id.value);
        console.log("removeCompare_for");
        console.log("i = "+i);

    if(Product_id.value == Cookies.get('cookie_P_'+i)){
      Cookies.remove('cookie_P_'+i);
      console.log("removeCompare_remove");
    }

    if(!Cookies.get('cookie_P_'+i)){
      var x;
      if(i != 3){

      x = i+1;

    Cookies.set("cookie_P_"+i,Cookies.get('cookie_P_'+x), { expires : 1 });
    Cookies.remove('cookie_P_'+x);
  }
    }
                           }

  //location.reload();
  //modal.style.display = "none";
  //modal.style.display = "block";
  $("#myModal" ).load(window.location.href + " #myModal" );
compareProduct();

      }



  function load()
  {
getProduct();




  }

  window.onload = load();
});

function removeCompare(Product_id) {

  console.log("removeCompare");
    for(i=1;i<4;i++){
      console.log(Product_id.value);
      console.log("removeCompare_for");
      console.log("i = "+i);

  if(Product_id.value == Cookies.get('cookie_P_'+i)){
    Cookies.remove('cookie_P_'+i);
    console.log("removeCompare_remove");
  }

  if(!Cookies.get('cookie_P_'+i)){
    var x;
    if(i != 3){

    x = i+1;
if(Cookies.get('cookie_P_'+x)){
  Cookies.set("cookie_P_"+i,Cookies.get('cookie_P_'+x), { expires : 1 });
}
  Cookies.remove('cookie_P_'+x);
}
  }
                         }

//location.reload();
//modal.style.display = "none";
//modal.style.display = "block";


$("#myModal" ).load(window.location.href + " #modal-content" );
compareProduct();

    }

    function compareProduct(){
      var token = localStorage.getItem("user_token");
      var cookie_P_1 = Cookies.get('cookie_P_1');
      var cookie_P_2 = Cookies.get('cookie_P_2');
      if(!Cookies.get('cookie_P_3') || !Cookies.get('cookie_P_3') === undefined) {
        var cookie_P_3 = null;


      }else{
        var cookie_P_3 = Cookies.get('cookie_P_3');
      console.log('P3 = '+cookie_P_3)
    }
      $.ajax({
        url: '/api/compareProduct',
        headers: {
          'Content-Type':'application/json'
        },
        data: JSON.stringify({
          "compare_P_1": cookie_P_1 ,
          "compare_P_2": cookie_P_2 ,
          "compare_P_3": cookie_P_3 ,
        }),
        method: 'POST',
        dataType: 'json',
        success: function(data){

          if(Cookies.get('cookie_P_3')) {

            var product_3_pic = data['product_3'][0]['pic_url1'];
            var product_3_name = data['product_3'][0]['prod_name'];
            var prod_3_desc = data['product_3'][0]['prod_desc'];
            var product_3_width = data['product_3'][0]['SizeProd_width'];
            var product_3_length = data['product_3'][0]['SizeProd_length']
            var product_3_height = data['product_3'][0]['SizeProd_height'];
            var product_3_foot = data['product_3'][0]['SizeProd_foot'];
            var product_3_rm = data['product_3'][0]['RM_value'];
            var product_3_color = data['product_3'][0]['ColorProd_value'];
            var product_3_price = data['product_3'][0]['prod_price'];
            var product_3_id = data['product_3'][0]['Prod_id'];
          }else{
            var product_3_pic = "";
            var product_3_name = "";
            var prod_3_desc = "";
            var product_3_width = "";
            var product_3_length = "";
            var product_3_height = "";
            var product_3_foot = "";
            var product_3_rm = "";
            var product_3_color = "";
            var product_3_price = "";
            var product_3_id = "";
      }





          console.log(data['product_1'][0]['prod_name']);
          $('#compareList').empty();
          $('#compareList').append(
          '<table align="center">'+
          '<tr>'+
            '<th></th>'+
            '<th>สินค้า1</th>'+
            '<th>สินค้า2</th>'+
            '<th class="compare_P_3">สินค้า3</th>'+
            '</tr>'+
          '<tr>'+
          '<tr>'+
            '<th></th>'+
            '<th><button style="margin-left:100px;" value="'+data['product_1'][0]['Prod_id']+'" onclick="removeCompare(this)">ปิด</button></th>'+
            '<th><button style="margin-left:100px;"value="'+data['product_2'][0]['Prod_id']+'" onclick="removeCompare(this)">ปิด</button></th>'+
            '<th class="compare_P_3"><button style="margin-left:100px;"value="'+product_3_id+'" onclick="removeCompare(this)">ปิด</button></th>'+
            '</tr>'+
          '<tr>'+
            '<th>รูปสินค้า</th>'+
            '<td ><img class="comparePic" src="'+data['product_1'][0]['pic_url1']+'"></img></td>'+
            '<td ><img class="comparePic" src="'+data['product_2'][0]['pic_url1']+'"></img></td>'+
            '<td class="compare_P_3"><img class="comparePic" src="'+product_3_pic+'"></img></td>'+
            '</tr>'+
          '<tr>'+
            '<th>ชื่อสินค้า</th>'+
            '<td >'+data['product_1'][0]['prod_name']+'</td>'+
            '<td >'+data['product_2'][0]['prod_name']+'</td>'+
            '<td class="compare_P_3">'+product_3_name+'</td>'+
          '</tr>'+
          '<th>รายละเอียดสินค้า</th>'+
          '<td >'+data['product_1'][0]['prod_desc']+'</td>'+
          '<td >'+data['product_2'][0]['prod_desc']+'</td>'+
          '<td class="compare_P_3">'+prod_3_desc+'</td>'+
        '</tr>'+
          '<tr>'+
            '<th style="width:auto;">ขนาด(กว้าง x ยาว x สูง)</th>'+
            '<td >'+data['product_1'][0]['SizeProd_width']+' x  '+data['product_1'][0]['SizeProd_length']+' x  '+data['product_1'][0]['SizeProd_height']+'</td>'+
            '<td >'+data['product_2'][0]['SizeProd_width']+' x  '+data['product_2'][0]['SizeProd_length']+' x  '+data['product_2'][0]['SizeProd_height']+'</td>'+
            '<td class="compare_P_3">'+product_3_width+' x  '+product_3_length+' x  '+product_3_height+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>ขนาด(ฟุต)</th>'+
            '<td >'+data['product_1'][0]['SizeProd_foot']+'</td>'+
            '<td >'+data['product_2'][0]['SizeProd_foot']+'</td>'+
            '<td class="compare_P_3">'+product_3_foot+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>วัสดุ</th>'+
            '<td >'+data['product_1'][0]['RM_value']+'</td>'+
            '<td >'+data['product_2'][0]['RM_value']+'</td>'+
            '<td class="compare_P_3">'+product_3_rm+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>สี</th>'+
            '<td >'+data['product_1'][0]['ColorProd_value']+'</td>'+
            '<td >'+data['product_2'][0]['ColorProd_value']+'</td>'+
            '<td class="compare_P_3">'+product_3_color+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>ราคา</th>'+
            '<td >'+data['product_1'][0]['prod_price']+'</td>'+
            '<td >'+data['product_2'][0]['prod_price']+'</td>'+
            '<td class="compare_P_3">'+product_3_price+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th>คะแนน</th>'+
            '<td >'+'5.0'+'</td>'+
            '<td >'+'5.0'+'</td>'+
            '<td class="compare_P_3">'+'5.0'+'</td>'+
          '</tr>'+
          '<tr>'+
            '<th></th>'+
            '<td ><button style="margin-left:10px;">เพิ่มสินค้าใส่ตะกร้า</button></td>'+
            '<td ><button style="margin-left:10px;">เพิ่มสินค้าใส่ตะกร้า</button></td>'+
            '<td class="compare_P_3"><button style="margin-left:10px;">เพิ่มสินค้าใส่ตะกร้า</button></td>'+
          '</tr>'+
          '</table>');
            if(!cookie_P_3) {
              $(".compare_P_3").hide();

            }else{  }

       }
     });
    }
</script>
