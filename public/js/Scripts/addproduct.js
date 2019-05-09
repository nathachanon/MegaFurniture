var pid=0;
var b_id = localStorage.getItem("b_id");
var token = localStorage.getItem("user_token");
var id;

function sku_count_cal(sku){
  var sku_count = sku.value.length;
  $("#sku_count").empty();
  $("#sku_count").append(sku_count+"/20");
}
function name_count_cal(name){
  var name_count = name.value.length;
  $("#name_count").empty();
  $("#name_count").append(name_count+"/120");
}
function desc_count_cal(desc){
  var desc_count = desc.value.length;
  $("#desc_count").empty();
  $("#desc_count").append(desc_count+"/5000");
}
function sbrand(b_id){
  if(b_id !=0)
  {
    localStorage.setItem("b_id",b_id);
    window.location.replace('/sbrand');
  }
}
var elem = document.querySelector('.js-switch');

function catagoiesRoom()
{
  $.ajax({
    type: 'GET',
    url: '/api/getCatagoiesRoom',
    headers: {
      'Authorization':'Bearer '+ token,
      'Content-Type':'application/json'
    },
    dataType: 'json',
    success: function(data){
      var c_count = data['catRoom_count'];
      for(var i=0 ;i<c_count ;i++){
        $('#optionroom').append('<option value="'+data['CatagoiesRoom'][i]['CatRoom_id']+'">'+data['CatagoiesRoom'][i]['CatRoom_name']+'</option>');
      }
    },error:function(){
      console.error();
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
  catagoiesRoom();
  var copys = getCookie('copy_prod');
  if(copys != null)
  {
    $.ajax({
      type: "POST",
      url: "/api/getProductDetails",
      headers: {
        'Authorization':'Bearer '+token,
        'Content-Type':'application/json'
      },
      data: JSON.stringify({
        "Prod_id": copys }),
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function(data){


        console.log(data);

        $('#optionroom').val(data['catagoies'][0]['CatRoom_id']);
        roomselect();
        $('#prod_name').val(data['product'][0]['prod_name']);
        $('#prod_desc').val(data['product'][0]['prod_desc']);
        $('#prod_price').val(data['product'][0]['prod_price']);
        $('#prod_qty').val(data['product'][0]['qty']);
        $('#weight').val(data['product'][0]['weight']);
        if(data['product_dv'][1]['Price'] != null)
        {
          valueDHL = data['product_dv'][1]['Price'];
          $('#DHL_input').val(data['product_dv'][1]['Price']);
          $('#DHL').attr('checked', true);
          document.getElementById("DHL_price").innerHTML = '('+valueDHL+'฿)';
        }
        if(data['product_dv'][3]['Price'] != null)
        {
          valueEMS = data['product_dv'][3]['Price'];
          $('#EMS_input').val(data['product_dv'][3]['Price']);
          $('#EMS').attr('checked', true);
          document.getElementById("EMS_price").innerHTML = '('+valueEMS+'฿)';
        }
        if(data['product_dv'][0]['Price'] != null)
        {
          valueKERRY = data['product_dv'][0]['Price'];
          $('#KERRY_input').val(data['product_dv'][0]['Price']);
          $('#KERRY').attr('checked', true);
          document.getElementById("KERRY_price").innerHTML = '('+valueKERRY+'฿)';
        }
        if(data['product_dv'][5]['Price'] != null)
        {
          valueSELLER = data['product_dv'][5]['Price'];
          $('#SELLER_input').val(data['product_dv'][5]['Price']);
          $('#SELLER').attr('checked', true);
          document.getElementById("SELLER_price").innerHTML = '('+valueSELLER+'฿)';
        }
        if(data['product_dv'][2]['Price'] != null)
        {
          valueSB = data['product_dv'][2]['Price'];
          $('#SB_input').val(data['product_dv'][2]['Price']);
          $('#SB').attr('checked', true);
          document.getElementById("SB_price").innerHTML = '('+valueSB+'฿)';
        }
        if(data['product_dv'][4]['Price'] != null)
        {
          valueBUYER = data['product_dv'][4]['Price'];
          $('#BUYER_input').val(data['product_dv'][4]['Price']);
          $('#BUYER').attr('checked', true);
          document.getElementById("BUYER_price").innerHTML = '('+valueBUYER+'฿)';
        }
        setTimeout(function() {
          $('#optionproduct').val(data['catagoies'][0]['CatProd_id']);
          prodSelect();
          $('#SizeProd_width').val(data['product_size'][0]['SizeProd_width']);
          $('#SizeProd_length').val(data['product_size'][0]['SizeProd_length']);
          $('#SizeProd_height').val(data['product_size'][0]['SizeProd_height']);
          $('#SizeProd_foot').val(data['product_size'][0]['SizeProd_foot']);
          $('#ColorProd_value').val(data['product_color'][0]['ColorProd_value']);
          $('#RM_value').val(data['product_rm'][0]['RM_value']);
        }, 1000);
      },
      failure: function(errMsg) {
        alert(errMsg);
      }
    });
  }
}

function prodSelect() {
  var catProd_id = $('#optionproduct').val();
  if(catProd_id != 0)
  {
    if(catProd_id == 1){
      $("#inputs_wlhf").empty();
      $("#inputs_cr").empty();
    $("#inputs_wlhf").append('<div class="hr-line-dashed"></div><div class="ibox-title"><h3>ขนาด</h3></div>'+
      '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">กว้าง (Cm)</label>'+
      '<div class="col-sm-10"><input type="number" id="SizeProd_width" type="text" placeholder="Enter Product Width" class="form-control input-lg"></div></div>'+
      '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">ยาว (Cm)</label><div class="col-sm-10"><input type="number" id="SizeProd_length" type="text" placeholder="Enter Product Length" class="form-control input-lg"></div></div>'+
      '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">สูง (Cm)</label><div class="col-sm-10"><input type="number" id="SizeProd_height" type="text" placeholder="Enter Product Height" class="form-control input-lg"></div></div>'+
      '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">ฟุต</label><div class="col-sm-10"><input type="number" id="SizeProd_foot" type="text" placeholder="Enter Product Foot" class="form-control input-lg"></div></div>');
    $("#inputs_cr").append('<div class="hr-line-dashed"></div><div class="ibox-title"><h3>สีและวัสดุ</h3></div>'+
      '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">สี</label>'+
      '<div class="col-sm-10"><input id="ColorProd_value" type="text" placeholder="Enter Product Color" class="form-control input-lg" onkeypress="return (event.charCode != 32 && event.charCode >= 161) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122)"></div></div>'+
      '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">วัสดุ (ไม้,ผ้า)</label><div class="col-sm-10"><input id="RM_value" type="text" placeholder="Enter Product Material" class="form-control input-lg"></div></div>');
  }else{
      $("#inputs_wlhf").empty();
      $("#inputs_cr").empty();
    $("#inputs_wlhf").append('<div class="hr-line-dashed"></div><div class="ibox-title"><h3>ขนาด</h3></div>'+
      '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">กว้าง (Cm)</label>'+
      '<div class="col-sm-10"><input type="number" id="SizeProd_width" type="text" placeholder="Enter Product Width" class="form-control input-lg"></div></div>'+
      '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">ยาว (Cm)</label><div class="col-sm-10"><input type="number" id="SizeProd_length" type="text" placeholder="Enter Product Length" class="form-control input-lg"></div></div>'+
      '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">สูง (Cm)</label><div class="col-sm-10"><input type="number" id="SizeProd_height" type="text" placeholder="Enter Product Height" class="form-control input-lg"></div></div>');
    $("#inputs_cr").append('<div class="hr-line-dashed"></div><div class="ibox-title"><h3>สีและวัสดุ</h3></div>'+
      '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">สี</label>'+
      '<div class="col-sm-10"><input id="ColorProd_value" type="text" placeholder="Enter Product Color" class="form-control input-lg" onkeypress="return (event.charCode != 32 && event.charCode >= 161) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122)"></div></div>'+
      '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">วัสดุ (ไม้,ผ้า)</label><div class="col-sm-10"><input id="RM_value" type="text" placeholder="Enter Product Material" class="form-control input-lg"></div></div>');
  }

  }else{
    $("#inputs_wlhf").empty();
    $("#inputs_cr").empty();
  }
}

function roomselect(){
  var catroom_id = $('#optionroom').val();
  if(catroom_id != 0)
  {
    $("#CatProduct").empty();
    $("#inputs_wlhf").empty();
    $("#inputs_cr").empty();
    $("#CatProduct").append('<select id="optionproduct" class="form-control m-b input-lg" name="CatagoiesProduct" onchange="prodSelect()">'+
      '<option value="0">เลือกประเภทสินค้าที่ต้องการ</option>'+
      '</select>');
    $.ajax({
      url: '/api/getCatagoiesProduct',
      headers: {
        'Authorization':'Bearer '+ token,
        'Content-Type':'application/json'
      },
      method: 'POST',
      data: JSON.stringify({
        "catroom_id": catroom_id }),
      contentType: "application/json; charset=utf-8",
      dataType: 'json',
      success: function(data){
        var c_count = data['catProduct_count'];
        for(var i=0 ;i<c_count ;i++){
          $('#optionproduct').append('<option value="'+data['CatagoiesProduct'][i]['CatProd_id']+'">'+data['CatagoiesProduct'][i]['CatProd_name']+'</option>');
        }
      }
    });
  }else{
    $("#CatProduct").empty();
    $("#inputs_wlhf").empty();
    $("#inputs_cr").empty();
  }
}
function getCookie(name) {
  function escape(s) { return s.replace(/([.*+?\^${}()|\[\]\/\\])/g, '\\$1'); };
  var match = document.cookie.match(RegExp('(?:^|;\\s*)' + escape(name) + '=([^;]*)'));
  return match ? match[1] : null;
}


$(document).ready(function(){
  var valueDHL='';
  var valueEMS='';
  var valueKERRY='';
  var valueSB='';
  var valueSELLER='';
  var valueBUYER='';

  $("#confirmSB").click(function(){
    valueSB = $('#SB_input').val();
    $('#SB_d').modal('hide');
    var checkBoxSB = document.getElementById("SB_checkbox");
    if(checkBoxSB.checked == true)
    {
      $('#SB_input').val(0);
      valueSB = 0;
      $('#SB').attr('checked', true);
      document.getElementById("SB_input").disabled = true;
      document.getElementById("SB_price").innerHTML = '(0฿)';
    }else{
      document.getElementById("SB_input").disabled = false;
      document.getElementById("SB_price").innerHTML = '('+valueSB+'฿)';
    }
  });

  $("#confirmSELLER").click(function(){
    valueSELLER = $('#SELLER_input').val();
    $('#SELLER_d').modal('hide');
    var checkBoxSELLER = document.getElementById("SELLER_checkbox");
    if(checkBoxSELLER.checked == true)
    {
      $('#SELLER_input').val(0);
      valueSELLER = 0;
      $('#SELLER').attr('checked', true);
      document.getElementById("SELLER_input").disabled = true;
      document.getElementById("SELLER_price").innerHTML = '(0฿)';
    }else{
      document.getElementById("SELLER_input").disabled = false;
      document.getElementById("SELLER_price").innerHTML = '('+valueSELLER+'฿)';
    }
  });

  $("#confirmBUYER").click(function(){
    valueBUYER = $('#BUYER_input').val();
    $('#BUYER_d').modal('hide');
    var checkBoxBUYER = document.getElementById("BUYER_checkbox");
    if(checkBoxBUYER.checked == true)
    {
      $('#BUYER_input').val(0);
      valueBUYER = 0;
      $('#BUYER').attr('checked', true);
      document.getElementById("BUYER_input").disabled = true;
      document.getElementById("BUYER_price").innerHTML = '(0฿)';
    }else{
      document.getElementById("BUYER_input").disabled = false;
      document.getElementById("BUYER_price").innerHTML = '('+valueBUYER+'฿)';
    }
    console.log(valueDHL,valueEMS,valueKERRY,valueSB,valueSELLER,valueBUYER);
  });

  $("#confirmKERRY").click(function(){
    valueKERRY = $('#KERRY_input').val();
    $('#KERRY_d').modal('hide');
    var checkBoxKERRY = document.getElementById("KERRY_checkbox");
    if(checkBoxKERRY.checked == true)
    {
      $('#KERRY_input').val(0);
      valueKERRY = 0;
      $('#KERRY').attr('checked', true);
      document.getElementById("KERRY_input").disabled = true;
      document.getElementById("KERRY_price").innerHTML = '(0฿)';
    }else{
      document.getElementById("KERRY_input").disabled = false;
      document.getElementById("KERRY_price").innerHTML = '('+valueKERRY+'฿)';
    }
  });

  $("#confirmEMS").click(function(){
    valueEMS = $('#EMS_input').val();
    $('#EMS_d').modal('hide');
    var checkBoxEMS = document.getElementById("EMS_checkbox");
    if(checkBoxEMS.checked == true)
    {
      $('#EMS_input').val(0);
      valueEMS = 0;
      $('#EMS').attr('checked', true);
      document.getElementById("EMS_input").disabled = true;
      document.getElementById("EMS_price").innerHTML = '(0฿)';
    }else{
      document.getElementById("EMS_input").disabled = false;
      document.getElementById("EMS_price").innerHTML = '('+valueEMS+'฿)';
    }
  });

  $("#confirmDHL").click(function(){
    valueDHL = $('#DHL_input').val();
    $('#DHL_d').modal('hide');
    var checkBoxDHL = document.getElementById("DHL_checkbox");
    if(checkBoxDHL.checked == true)
    {
      $('#DHL_input').val(0);
      valueDHL = 0;
      $('#DHL').attr('checked', true);
      document.getElementById("DHL_input").disabled = true;
      document.getElementById("DHL_price").innerHTML = '(0฿)';
    }else{
      document.getElementById("DHL_input").disabled = false;
      document.getElementById("DHL_price").innerHTML = '('+valueDHL+'฿)';
    }
  });

  $("#DHL").change(function() {
    if(this.checked) {
      $('#DHL_d').modal('show');
    }else{
      valueDHL ='';
      $('#DHL_input').val('');
      document.getElementById("DHL_input").disabled = false;
    }
  });
  $("#EMS").change(function() {
    if(this.checked) {
      $('#EMS_d').modal('show');
    }else{
      valueEMS ='';
      $('#EMS_input').val('');
      document.getElementById("EMS_input").disabled = false;
    }
  });
  $("#KERRY").change(function() {
    if(this.checked) {
      $('#KERRY_d').modal('show');
    }else{
      valueKERRY ='';
      $('#KERRY_input').val('');
      document.getElementById("KERRY_input").disabled = false;
    }
  });
  $("#SB").change(function() {
    if(this.checked) {
      $('#SB_d').modal('show');
    }else{
      valueSB ='';
      $('#SB_input').val('');
      document.getElementById("SB_input").disabled = false;
    }
  });
  $("#SELLER").change(function() {
    if(this.checked) {
      $('#SELLER_d').modal('show');
    }else{
      valueSELLER ='';
      $('#SELLER_input').val('');
      document.getElementById("SELLER_input").disabled = false;
    }
  });
  $("#BUYER").change(function() {
    if(this.checked) {
      $('#BUYER_d').modal('show');
    }else{
      valueBUYER ='';
      $('#BUYER_input').val('');
      document.getElementById("BUYER_input").disabled = false;
    }
  });

  $('#DHL_d').on('hidden.bs.modal', function (e) {
    if(valueDHL == null)
    {
      $('#DHL_input').val('');
      $('#DHL').attr('checked', false);
    }
  });

  $('#EMS_d').on('hidden.bs.modal', function (e) {
    if(valueEMS == null)
    {
      $('#EMS_input').val('');
      $('#EMS').attr('checked', false);
    }
  });

  $('#KERRY_d').on('hidden.bs.modal', function (e) {
    if(valueKERRY == null)
    {
      $('#KERRY_input').val('');
      $('#KERRY').attr('checked', false);
    }
  });

  $('#SB_d').on('hidden.bs.modal', function (e) {
    if(valueSB == null)
    {
      $('#SB_input').val('');
      $('#SB').attr('checked', false);
    }
  });

  $('#SELLER_d').on('hidden.bs.modal', function (e) {
    if(valueSELLER == null)
    {
      $('#SELLE_input').val('');
      $('#SELLE').attr('checked', false);
    }
  });

  $('#BUYER_d').on('hidden.bs.modal', function (e) {
    if(valueBUYER == null)
    {
      $('#BUYER_input').val('');
      $('#BUYER').attr('checked', false);
    }
  });

  $("#privateAdd").click(function(){
    var CatProd_id = document.getElementById("optionproduct").value;
    var token = localStorage.getItem("user_token");
    var prod_name = $('#prod_name').val();
    var prod_desc = $('#prod_desc').val();
    var prod_price = $('#prod_price').val();
    var prod_qty = $('#prod_qty').val();
    var prod_sku = $('#prod_sku').val();
    var SizeProd_width = $('#SizeProd_width').val();
    var SizeProd_length = $('#SizeProd_length').val();
    var SizeProd_height = $('#SizeProd_height').val();
    var SizeProd_foot = $('#SizeProd_foot').val();
    var ColorProd_value = $('#ColorProd_value').val();
    var RM_value = $('#RM_value').val();
    var weight = $('#weight').val();
    var tags = $('#tags').val().split(",");
    if($('#SizeProd_foot').val() == undefined){
      SizeProd_foot = '';
    }

    if(prod_name != '' && prod_desc != '' && prod_price != '' && prod_qty != '' && SizeProd_width != '' &&
     SizeProd_length != '' && SizeProd_height != '' && ColorProd_value != '' && RM_value != '' && weight != '')
    {
     var formData = new FormData();

     formData.append("pic1", document.getElementById("file_pic1").files[0]);
     formData.append("pic2", document.getElementById("file_pic2").files[0]);
     formData.append("pic3", document.getElementById("file_pic3").files[0]);
     formData.append("pic4", document.getElementById("file_pic4").files[0]);
     formData.append("pic5", document.getElementById("file_pic5").files[0]);
     formData.append("CatProd_id", CatProd_id);
     formData.append("brand_id", b_id);
     formData.append("sku", prod_sku);
     formData.append("qty", prod_qty);
     formData.append("prod_name", prod_name);
     formData.append("prod_desc", prod_desc);
     formData.append("prod_price", prod_price);
     formData.append("SizeProd_width", SizeProd_width);
     formData.append("SizeProd_length", SizeProd_length);
     formData.append("SizeProd_height", SizeProd_height);
     formData.append("SizeProd_foot", SizeProd_foot);
     formData.append("ColorProd_value", ColorProd_value);
     formData.append("weight", weight);
     formData.append("RM_value", RM_value);
     formData.append("ems", valueEMS);
     formData.append("dhl", valueDHL);
     formData.append("kerry", valueKERRY);
     formData.append("sb", valueSB);
     formData.append("seller", valueSELLER);
     formData.append("buyer", valueBUYER);
     formData.append("status", 0);
     formData.append("show", 1);
     formData.append("tags",tags);

     $.ajax({
       url: '/api/AddProduct',
       headers: {
         'Authorization':'Bearer '+token,
       },
       method: 'POST',
       data: formData,
       contentType: false,
       processData: false,
       dataType: 'json',
       success: function(data){
         if(data['success'] != null)
         {
           alert('เพิ่มสินค้าสำเร็จ !');
           window.location.replace('/product');
         }else if(data['sku_error'] != null){
           alert('SKU นี้ถูกใช้งานแล้ว กรุณาเปลี่ยนใหม่!');
           $('#prod_sku').val('');
         }
       }
     });

   }else{
     alert('กรอกข้อมูลให้ครบ');
   }

 });

  $("#publicAdd").click(function(){
    var CatProd_id = document.getElementById("optionproduct").value;
    var token = localStorage.getItem("user_token");
    var prod_name = $('#prod_name').val();
    var prod_desc = $('#prod_desc').val();
    var prod_price = $('#prod_price').val();
    var prod_qty = $('#prod_qty').val();
    var prod_sku = $('#prod_sku').val();
    var SizeProd_width = $('#SizeProd_width').val();
    var SizeProd_length = $('#SizeProd_length').val();
    var SizeProd_height = $('#SizeProd_height').val();
    var SizeProd_foot = $('#SizeProd_foot').val();
    var ColorProd_value = $('#ColorProd_value').val();
    var RM_value = $('#RM_value').val();
    var weight = $('#weight').val();
    var tags = $('#tags').val().split(",");
    if($('#SizeProd_foot').val() == undefined){
      SizeProd_foot = '';
    }

    if(prod_name != '' && prod_desc != '' && prod_price != '' && prod_qty != '' && SizeProd_width != '' &&
     SizeProd_length != '' && SizeProd_height != '' && ColorProd_value != '' && RM_value != '' && weight != '')
    {

     var formData = new FormData();

     formData.append("pic1", document.getElementById("file_pic1").files[0]);
     formData.append("pic2", document.getElementById("file_pic2").files[0]);
     formData.append("pic3", document.getElementById("file_pic3").files[0]);
     formData.append("pic4", document.getElementById("file_pic4").files[0]);
     formData.append("pic5", document.getElementById("file_pic5").files[0]);
     formData.append("CatProd_id", CatProd_id);
     formData.append("brand_id", b_id);
     formData.append("sku", prod_sku);
     formData.append("qty", prod_qty);
     formData.append("prod_name", prod_name);
     formData.append("prod_desc", prod_desc);
     formData.append("prod_price", prod_price);
     formData.append("SizeProd_width", SizeProd_width);
     formData.append("SizeProd_length", SizeProd_length);
     formData.append("SizeProd_height", SizeProd_height);
     formData.append("SizeProd_foot", SizeProd_foot);
     formData.append("ColorProd_value", ColorProd_value);
     formData.append("weight", weight);
     formData.append("RM_value", RM_value);
     formData.append("ems", valueEMS);
     formData.append("dhl", valueDHL);
     formData.append("kerry", valueKERRY);
     formData.append("sb", valueSB);
     formData.append("seller", valueSELLER);
     formData.append("buyer", valueBUYER);
     formData.append("status", 0);
     formData.append("show", 0);


for (var i = 0; i < tags.length; i++) {
    formData.append('tags[]', tags[i]);
}

     $.ajax({
       url: '/api/AddProduct',
       headers: {
         'Authorization':'Bearer '+token,
       },
       method: 'POST',
       data: formData,
       contentType: false,
       processData: false,
       dataType: 'json',
       success: function(data){
         if(data['success'] != null)
         {
           alert('เพิ่มสินค้าสำเร็จ !');
           window.location.replace('/product');
         }else if(data['sku_error'] != null){
           alert('SKU นี้ถูกใช้งานแล้ว กรุณาเปลี่ยนใหม่!');
           $('#prod_sku').val('');
         }
       }
     });

   }else{
     alert('กรอกข้อมูลให้ครบ');
   }

 });



  $("#cancel").click(function(){
    window.location.replace('/product');
  });

  window.onload = load();
});

function showpic1(input) {
$('#i1').remove(".fa");
$('#is1').removeClass("i-size");
$('#spic1').attr('hidden',false);
if (input.files && input.files[0]) {
 var reader = new FileReader();
 reader.onload = function (e) {
   $('#spic1')
   .attr('src', e.target.result);
 };
 reader.readAsDataURL(input.files[0]);
}
}

function showpic2(input) {
$('#i2').remove(".fa");
$('#is2').removeClass("i-size");
$('#spic2').attr('hidden',false);
if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload = function (e) {
    $('#spic2')
    .attr('src', e.target.result);
  };
  reader.readAsDataURL(input.files[0]);
}
}
function showpic3(input) {
$('#i3').remove(".fa");
$('#is3').removeClass("i-size");
$('#spic3').attr('hidden',false);
if (input.files && input.files[0]) {
 var reader = new FileReader();
 reader.onload = function (e) {
   $('#spic3')
   .attr('src', e.target.result);
 };
 reader.readAsDataURL(input.files[0]);
}
}
function showpic4(input) {
$('#i4').remove(".fa");
$('#is4').removeClass("i-size");
$('#spic4').attr('hidden',false);
if (input.files && input.files[0]) {
 var reader = new FileReader();
 reader.onload = function (e) {
   $('#spic4')
   .attr('src', e.target.result);
 };
 reader.readAsDataURL(input.files[0]);
}
}
function showpic5(input) {
$('#i5').remove(".fa");
$('#is5').removeClass("i-size");
$('#spic5').attr('hidden',false);
if (input.files && input.files[0]) {
 var reader = new FileReader();
 reader.onload = function (e) {
   $('#spic5')
   .attr('src', e.target.result);
 };
 reader.readAsDataURL(input.files[0]);
}
}
