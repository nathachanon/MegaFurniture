var b_id = localStorage.getItem("b_id");
var token = localStorage.getItem("user_token");
var id;
var filltertype = 'show_all';

function viewProduct(Prod_id){
  document.cookie = "view_id="+Prod_id;
  window.location.replace('/viewProduct');
}

function changeProduct(Prod_id,status)
{
  $.ajax({
    url: '/api/statusProduct',
    headers: {
      'Authorization':'Bearer '+token,
      'Content-Type':'application/json'
    },
    method: 'POST',
    data: JSON.stringify({ "Prod_id":Prod_id,"status":status }),
    contentType: "application/json; charset=utf-8",
    dataType: 'json',
    success: function(data){
      if(data['success'] != null)
      {
        switch (filltertype) {
          case 'show_all':
             getProduct();
          break;
          case 'show_sell':
          getProduct_FILLTER(0);
          break;
          case 'show_unsell':
          getProduct_FILLTER(1);
          break;
        }
        swal({
          title: "Success !",
          button: false,
          timer: 1500,
          icon: "success",
          text: "เปลี่ยนสถานะสินค้าสำเร็จ !",
        });
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
        switch (filltertype) {
          case 'show_all':
          getProduct();
          break;
          case 'show_sell':
          getProduct_FILLTER(0);
          break;
          case 'show_unsell':
          getProduct_FILLTER(1);
          break;
        }
        swal({
          title: "Success !",
          button: false,
          timer: 1500,
          icon: "success",
          text: "ลบสินค้าสำเร็จ !",
        });
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

function copyProduct(Prod_id){
  createCookie('copy_prod',Prod_id,10);
  window.location.replace('/addProduct');
}

function editProduct(Prod_id){
  createCookie('edit_prod',Prod_id,10);
  window.location.replace('/editProduct');
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

function getProduct(){
  $.ajax({
    type: "POST",
    url: "/api/sbrand",
    headers: {
      'Authorization':'Bearer '+token,
      'Content-Type':'application/json'
    },
    data: JSON.stringify({
      "brand_id": b_id }),
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    success: function(data){
      document.title = JSON.stringify(data['brand_name'][0]['brand_name']).replace(/['"]+/g, '')+' : Brand';
      var p_count = data['product_count'];
      if(p_count == null)
      {
        p_count = 0;
      }
      document.getElementById("product_counts").innerHTML = "พบสินค้า "+p_count+" รายการ";
      $('#table').empty();
      $("#table").append('<table id="tblEntAttributes" class="table table-striped dataTables-example" data-page-size="10" data-filter=#filter>'+
        '<thead>'+
        '<tr>'+
        '<th class="text-left" data-sort-ignore="true" id="selectall"><div class="checkbox checkbox-success"><input name="select-all" id="select-all" type="checkbox" onchange="selectalls(this)"><label for="checkAll" id="all">(0)</label></div></th>'+
        '<th data-toggle="true">SKU(รหัสสินค้า)</th>'+
        '<th data-toggle="true">ชื่อสินค้า</th>'+
        '<th data-hide="phone">สี</th>'+
        '<th data-hide="phone">จำนวนคงเหลือ</th>'+
        '<th data-hide="phone">ขายไปแล้ว</th>'+
        '<th data-hide="phone">ราคา</th>'+
        '<th data-hide="phone">สถานะ</th>'+
        '<th class="text-right" data-sort-ignore="true">Action</th>'+
        '</tr>'+
        '</thead>'+
        '<tbody id="t_body">'+
        '</tbody>'
        );
      $("#select-all").prop('checked',false);
      prod_array = [];
      for(var i=0 ;i<p_count ;i++){
        var status = '<span class="label label-info">กำลังขาย</span>';
        var sku = 'ยังไม่ได้กำหนด';
        if(data['product'][i]['show'] == "0"){
        }else{
          status = '<span class="label label-danger">ยังไม่ขาย</span>';
        }
        if(data['product'][i]['sku'] != undefined){
          sku = data['product'][i]['sku'];
        }
        $('#tblEntAttributes tbody').append(
          '<tr id="tr_'+data['product'][i]['Prod_id']+'">'+
          '<td>'+
          '<div class="checkbox checkbox-success">'+
          '<input id="checkbox_'+data['product'][i]['Prod_id']+'" type="checkbox" value="'+data['product'][i]['Prod_id']+'" onchange="editGroupADD(this,'+data['product'][i]['Prod_id']+');"><label for="checkbox_'+data['product'][i]['Prod_id']+'"></label>'+
          '</div>'+
          '</td>'+
          '<td>'+sku+'</td>'+
          '<td style="width:290px;">'+data['product'][i]['prod_name']+'</td>'+
          '<td>'+data['product'][i]['ColorProd_value']+'</td>'+
          '<td>'+data['product'][i]['qty']+'</td>'+
          '<td>'+
          '0'+
          '</td>'+
          '<td>'+data['product'][i]['prod_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
          '<td>'+
          status
          +'</td>'+
          '<td class="text-right">'+
          '<div class="tooltip-demo">'+
          '<a data-toggle="tooltip" data-placement="top" title="แก้ไข SKU" onclick="skuChange ('+data['product'][i]['Prod_id']+',\'' + sku + '\')"><i class="fas fa-list-ol i-prod"></i></a>'+

          '<a  data-toggle="tooltip" data-placement="top" title="เปลี่ยนสถานะ" onclick="changeProduct ('+data['product'][i]['Prod_id']+','+data['product'][i]['show']+')"><i class="fas fa-toggle-on i-prod"></i></a>'+

          '<a  data-toggle="tooltip" data-placement="top" title="แก้ไข" onclick="editProduct ('+data['product'][i]['Prod_id']+')"><i class="fas fa-pen i-prod"></i></a>'+
          '<a  data-toggle="tooltip" data-placement="top" title="คัดลอก" onclick="copyProduct ('+data['product'][i]['Prod_id']+')"><i class="far fa-copy i-prod"></i></a>'+

          '<a  data-toggle="tooltip" data-placement="top" title="ลบ" onclick="DeleteProd ('+data['product'][i]['Prod_id']+')"><i class="far fa-trash-alt i-prod"></i></a>'+

          '</div>'+
          '</td>'+
          '</tr>'
          );
      }
      $("#table").append('</table>');
      $('.dataTables-example').DataTable({
        "searching": false,
        "buttons": false
      });
      $('.footable').footable();
    }
    ,
    failure: function(errMsg) {
      alert(errMsg);
    }
  });
}

function getProduct_BY_ID(Prod_id){
  var p = ""+Prod_id;
  $.ajax({
    type: "POST",
    url: "/api/sbrand",
    headers: {
      'Authorization':'Bearer '+token,
      'Content-Type':'application/json'
    },
    data: JSON.stringify({
      "brand_id": b_id }),
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    success: function(data){
      prod_array.splice($.inArray(p, prod_array),1);
      $("#all").text("("+prod_array.length+")");
      document.title = JSON.stringify(data['brand_name'][0]['brand_name']).replace(/['"]+/g, '')+' : Brand';
      var p_count = data['product_count'];
      if(p_count == null)
      {
        p_count = 0;
      }
      document.getElementById("product_counts").innerHTML = "พบสินค้า "+p_count+" รายการ";
      for(var i=0 ;i<p_count ;i++){
        var status = '<span class="label label-info">กำลังขาย</span>';
        var sku = 'ยังไม่ได้กำหนด';
        if(data['product'][i]['show'] == "0"){
        }else{
          status = '<span class="label label-danger">ยังไม่ขาย</span>';
        }
        if(data['product'][i]['sku'] != undefined){
          sku = data['product'][i]['sku'];
        }
        if(data['product'][i]['Prod_id'] == Prod_id){
          $('#tr_'+Prod_id).empty();
          $('#tr_'+Prod_id).append(
            '<td>'+
            '<div class="checkbox checkbox-success">'+
            '<input id="checkbox_'+data['product'][i]['Prod_id']+'" type="checkbox" value="'+data['product'][i]['Prod_id']+'" onchange="editGroupADD(this,'+data['product'][i]['Prod_id']+');"><label for="checkbox_'+data['product'][i]['Prod_id']+'"></label>'+
            '</div>'+
            '</td>'+
            '<td>'+sku+'</td>'+
            '<td style="width:290px;>'+data['product'][i]['prod_name']+'</td>'+
            '<td>'+data['product'][i]['ColorProd_value']+'</td>'+
            '<td>'+data['product'][i]['qty']+'</td>'+
            '<td>'+
            '0'+
            '</td>'+
            '<td>'+data['product'][i]['prod_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
            '<td>'+
            status
            +'</td>'+
            '<td class="text-right">'+
            '<div class="tooltip-demo">'+
            '<a data-toggle="tooltip" data-placement="top" title="แก้ไข SKU" onclick="skuChange ('+data['product'][i]['Prod_id']+',\'' + sku + '\')"><i class="fas fa-list-ol i-prod"></i></a>'+

            '<a  data-toggle="tooltip" data-placement="top" title="เปลี่ยนสถานะ" onclick="changeProduct ('+data['product'][i]['Prod_id']+','+data['product'][i]['show']+')"><i class="fas fa-toggle-on i-prod"></i></a>'+

            '<a  data-toggle="tooltip" data-placement="top" title="แก้ไข" onclick="editProduct ('+data['product'][i]['Prod_id']+')"><i class="fas fa-pen i-prod"></i></a>'+
            '<a  data-toggle="tooltip" data-placement="top" title="คัดลอก" onclick="copyProduct ('+data['product'][i]['Prod_id']+')"><i class="far fa-copy i-prod"></i></a>'+

            '<a  data-toggle="tooltip" data-placement="top" title="ลบ" onclick="DeleteProd ('+data['product'][i]['Prod_id']+')"><i class="far fa-trash-alt i-prod"></i></a>'+

            '</div>'+
            '</td>');
        }
        $("#table").append('</table>');
        $('.dataTables-example').DataTable({
          "searching": false,
          "buttons": false
        });
        $('.footable').footable();
      }
    }
    ,
    failure: function(errMsg) {
      alert(errMsg);
    }
  });
}


$(document).ready(function(){
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
      swal({
        title: "Error !",
        text: "กรุณา Login ก่อนเข้าใช้งาน !",
        type: "error"
      });
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

var prod_array = [];

function editGroupADD(source,prod_id){

  if(source.checked == true){
    prod_array.push(""+prod_id);
  }else{
    prod_array.splice($.inArray(prod_id, prod_array),1);
  }
  $("#all").text("("+prod_array.length+")");
}

function editGroup(prodlist){

  if(prodlist.length <= 1){
    alert('สามารถแก้ไขสินค้าตั้งแต่ 2 ชิ้นขึ้นไป');
  }else{
    $("#ModelSKU").empty();
    $("#model_body").empty();
    $("#modal_header_title").empty();
    $("#modal_header_title").text('แก้ไขสินค้าหลายชิ้น');
    $("#model_body").append('<button  class="btn btn-primary" type="button" onclick="groupchangeStatus(prod_array)"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">เปลี่ยนสถานะ</span></button>&nbsp;&nbsp;'+
      '<button  class="btn btn-primary" type="button" onclick="groupchangePrice(prod_array)"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">เปลี่ยนราคา</span></button>&nbsp;&nbsp;'+
      '<button  class="btn btn-primary" type="button" onclick="groupchangeColor(prod_array)"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">เปลี่ยนสี</span></button>&nbsp;&nbsp;'+
      '<button  class="btn btn-primary" type="button" onclick="groupchangeQty(prod_array)"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">เปลี่ยนจำนวนคงเหลือ</span></button>&nbsp;&nbsp;'+
      '<br></br><button  class="btn btn-danger" type="button" onclick="groupchangeDelete(prod_array)"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">ลบสินค้า</span></button>'
      );
    $('#exampleModal').modal('show');
  }
}

function groupchangeStatus(prodlist){
  $("#model_body").empty();
  $("#modal_header_title").empty();
  $("#modal_header_title").text('แก้ไขสินค้าหลายชิ้น [สถานะ]');
  $("#model_body").append('<button class="btn btn-danger" type="button" onclick="groupchangeStatus_change(prod_array,1)"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">ยังไม่วางขาย</span></button>&nbsp;&nbsp;'+
    '<button class="btn btn-primary" type="button" onclick="groupchangeStatus_change(prod_array,0)"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">กำลังขาย</span></button>');
}

function groupchangePrice(prodlist){
  $("#model_body").empty();
  $("#modal_header_title").empty();
  $("#modal_header_title").text('แก้ไขสินค้าหลายชิ้น [ราคา]');
  $("#model_body").append(
    '<form role="form" id="form">'+
    '<div class="form-group"><label>ราคา (เปลี่ยนทุกสินค้าที่เลือก)</label> <input type="number" placeholder="Enter price" id="edit_price" class="form-control" name="prod_price" autocomplete="off"></div>'+
    '<div><button onclick="btn_price_save(prod_array)" class="btn btn-sm btn-primary m-t-n-xs" type="button"><strong>บันทึก</strong></button></div>'+
    '</form>'
    );
}

function groupchangeColor(prodlist){
  $("#model_body").empty();
  $("#modal_header_title").empty();
  $("#modal_header_title").text('แก้ไขสินค้าหลายชิ้น [สี]');
  $("#model_body").append(
    '<form role="form" id="form">'+
    '<div class="form-group"><label>สี (เปลี่ยนทุกสินค้าที่เลือก)</label> <input type="text" onkeypress="return (event.charCode != 32 && event.charCode >= 161) || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122)" placeholder="Enter color" id="edit_color" class="form-control" name="prod_color" autocomplete="off"></div>'+
    '<div><button onclick="btn_color_save(prod_array)" class="btn btn-sm btn-primary m-t-n-xs" type="button"><strong>บันทึก</strong></button></div>'+
    '</form>'
    );
}

function groupchangeQty(prodlist){
  $("#model_body").empty();
  $("#modal_header_title").empty();
  $("#modal_header_title").text('แก้ไขสินค้าหลายชิ้น [จำนวนคงเหลือ]');
  $("#model_body").append(
    '<form role="form" id="form">'+
    '<div class="form-group"><label>จำนวนคงเหลือ (เปลี่ยนทุกสินค้าที่เลือก)</label> <input type="number" placeholder="Enter quantity" id="edit_qty" class="form-control" name="prod_qty" autocomplete="off"></div>'+
    '<div><button onclick="btn_qty_save(prod_array)" class="btn btn-sm btn-primary m-t-n-xs" type="button"><strong>บันทึก</strong></button></div>'+
    '</form>'
    );
}

function groupchangeStatus_change(prodlist,status){
  $.ajax({
    url: '/api/changegroup-Status',
    headers: {
      'Authorization':'Bearer '+token,
      'Content-Type':'application/json'
    },
    method: 'POST',
    data: JSON.stringify({ "length":prodlist.length,"status":status,"prodlist":prodlist }),
    contentType: "application/json; charset=utf-8",
    dataType: 'json',
    success: function(data){
      if(data['success'] != null)
      {
        $('#exampleModal').modal('hide');
        $("#model_body").empty();
        switch (filltertype) {
          case 'show_all':
          getProduct();
          break;
          case 'show_sell':
          getProduct_FILLTER(0);
          break;
          case 'show_unsell':
          getProduct_FILLTER(1);
          break;
        }
        swal("ChangeStatus !", "สินค้าที่คุณเลือกถูกเปลี่ยนสถานะแล้ว !", "success");
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

function groupchangeDelete(prodlist,status){
  $('#exampleModal').modal('hide');
  $("#model_body").empty();
    $.ajax({
      url: '/api/changegroup-Delete',
      headers: {
        'Authorization':'Bearer '+token,
        'Content-Type':'application/json'
      },
      method: 'POST',
      data: JSON.stringify({ "length":prodlist.length,"prodlist":prodlist }),
      contentType: "application/json; charset=utf-8",
      dataType: 'json',
      success: function(data){
        if(data['success'] != null)
        {
          $('#exampleModal').modal('hide');
          $("#model_body").empty();
          switch (filltertype) {
            case 'show_all':
            getProduct();
            break;
            case 'show_sell':
            getProduct_FILLTER(0);
            break;
            case 'show_unsell':
            getProduct_FILLTER(1);
            break;
          }
          swal("Deleted !", "สินค้าที่คุณเลือกถูกลบออกจากร้านแล้ว !", "success");
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

function selectalls(source){
  if(source.checked) {
    prod_array = [];
    $(':checkbox').each(function() {
      this.checked = true;
      prod_array.push(this.value);
    });
    prod_array.splice($.inArray("on", prod_array),1);
  } else {
    $(':checkbox').each(function() {
      this.checked = false;
    });
    prod_array = [];
  }
  $("#all").text("("+prod_array.length+")");
}

function btn_price_save(prodlist){

  var edit_price = $("#edit_price").val();

  if(edit_price != 0){
    $.ajax({
      url: '/api/changegroup-Price',
      headers: {
        'Authorization':'Bearer '+token,
        'Content-Type':'application/json'
      },
      method: 'POST',
      data: JSON.stringify({ "length":prodlist.length,"prod_price":edit_price,"prodlist":prodlist }),
      contentType: "application/json; charset=utf-8",
      dataType: 'json',
      success: function(data){
        if(data['success'] != null)
        {
          $('#exampleModal').modal('hide');
          $("#model_body").empty();
          switch (filltertype) {
            case 'show_all':
               getProduct();
            break;
            case 'show_sell':
            getProduct_FILLTER(0);
            break;
            case 'show_unsell':
            getProduct_FILLTER(1);
            break;
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
  }else{
    swal({
      title: "Error !",
      text: "กรุณาใส่ราคาที่ต้องการ !",
      type: "error"
    });
  }

}

function btn_color_save(prodlist){

  var edit_color = $("#edit_color").val();

  if(edit_color != ''){
    $.ajax({
      url: '/api/changegroup-Color',
      headers: {
        'Authorization':'Bearer '+token,
        'Content-Type':'application/json'
      },
      method: 'POST',
      data: JSON.stringify({ "length":prodlist.length,"prod_color":edit_color,"prodlist":prodlist }),
      contentType: "application/json; charset=utf-8",
      dataType: 'json',
      success: function(data){
        if(data['success'] != null)
        {
          $('#exampleModal').modal('hide');
          $("#model_body").empty();
          switch (filltertype) {
            case 'show_all':
               getProduct();
            break;
            case 'show_sell':
            getProduct_FILLTER(0);
            break;
            case 'show_unsell':
            getProduct_FILLTER(1);
            break;
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
  }else{
    swal({
      title: "Error !",
      text: "กรุณาใส่สีที่ต้องการ !",
      type: "error"
    });
  }

}

function btn_qty_save(prodlist){

  var edit_qty = $("#edit_qty").val();

  if(edit_qty != 0){
    $.ajax({
      url: '/api/changegroup-Qty',
      headers: {
        'Authorization':'Bearer '+token,
        'Content-Type':'application/json'
      },
      method: 'POST',
      data: JSON.stringify({ "length":prodlist.length,"prod_qty":edit_qty,"prodlist":prodlist }),
      contentType: "application/json; charset=utf-8",
      dataType: 'json',
      success: function(data){
        if(data['success'] != null)
        {
          $('#exampleModal').modal('hide');
          $("#model_body").empty();
          switch (filltertype) {
            case 'show_all':
               getProduct();
            break;
            case 'show_sell':
            getProduct_FILLTER(0);
            break;
            case 'show_unsell':
            getProduct_FILLTER(1);
            break;
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
  }else{
    swal({
      title: "Error !",
      text: "กรุณาใส่จำนวนคงเหลือที่ต้องการ !",
      type: "error"
    });
  }

}

function getProduct_FILLTER(status_show){
  $.ajax({
    type: "POST",
    url: "/api/sbrand",
    headers: {
      'Authorization':'Bearer '+token,
      'Content-Type':'application/json'
    },
    data: JSON.stringify({
      "brand_id": b_id }),
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    success: function(data){
      document.title = JSON.stringify(data['brand_name'][0]['brand_name']).replace(/['"]+/g, '')+' : Brand';
      var p_count = data['product_count'];
      if(p_count == null)
      {
        p_count = 0;
      }
      $('#table').empty();
      $("#table").append('<table id="tblEntAttributes" class="table table-striped dataTables-example" data-page-size="10" data-filter=#filter>'+
        '<thead>'+
        '<tr>'+
        '<th class="text-left" data-sort-ignore="true" id="selectall"><div class="checkbox checkbox-success"><input name="select-all" id="select-all" type="checkbox" onchange="selectalls(this)"><label for="checkAll" id="all">(0)</label></div></th>'+
        '<th data-toggle="true">SKU(รหัสสินค้า)</th>'+
        '<th data-toggle="true">ชื่อสินค้า</th>'+
        '<th data-hide="phone">สี</th>'+
        '<th data-hide="phone">จำนวนคงเหลือ</th>'+
        '<th data-hide="phone">ขายไปแล้ว</th>'+
        '<th data-hide="phone">ราคา</th>'+
        '<th data-hide="phone">สถานะ</th>'+
        '<th class="text-right" data-sort-ignore="true">Action</th>'+
        '</tr>'+
        '</thead>'+
        '<tbody id="t_body">'+
        '</tbody>'
        );
      $("#select-all").prop('checked',false);
      prod_array = [];
      var p_counter = 0;
      for(var i=0 ;i<p_count ;i++){
        if(data['product'][i]['show'] == status_show){
          p_counter += 1;
          var status = '<span class="label label-info">กำลังขาย</span>';
          var sku = 'ยังไม่ได้กำหนด';
          if(data['product'][i]['show'] == "0"){
          }else{
            status = '<span class="label label-danger">ยังไม่ขาย</span>';
          }
          if(data['product'][i]['sku'] != undefined){
            sku = data['product'][i]['sku'];
          }
          $('#tblEntAttributes tbody').append(
            '<tr id="tr_'+data['product'][i]['Prod_id']+'">'+
            '<td>'+
            '<div class="checkbox checkbox-success">'+
            '<input id="checkbox_'+data['product'][i]['Prod_id']+'" type="checkbox" value="'+data['product'][i]['Prod_id']+'" onchange="editGroupADD(this,'+data['product'][i]['Prod_id']+');"><label for="checkbox_'+data['product'][i]['Prod_id']+'"></label>'+
            '</div>'+
            '</td>'+
            '<td>'+sku+'</td>'+
            '<td style="width:290px;">'+data['product'][i]['prod_name']+'</td>'+
            '<td>'+data['product'][i]['ColorProd_value']+'</td>'+
            '<td>'+data['product'][i]['qty']+'</td>'+
            '<td>'+
            '0'+
            '</td>'+
            '<td>'+data['product'][i]['prod_price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
            '<td>'+
            status
            +'</td>'+
            '<td class="text-right">'+
            '<div class="tooltip-demo">'+
            '<a data-toggle="tooltip" data-placement="top" title="แก้ไข SKU" onclick="skuChange ('+data['product'][i]['Prod_id']+',\'' + sku + '\')"><i class="fas fa-list-ol i-prod"></i></a>'+

            '<a  data-toggle="tooltip" data-placement="top" title="เปลี่ยนสถานะ" onclick="changeProduct ('+data['product'][i]['Prod_id']+','+data['product'][i]['show']+')"><i class="fas fa-toggle-on i-prod"></i></a>'+

            '<a  data-toggle="tooltip" data-placement="top" title="แก้ไข" onclick="editProduct ('+data['product'][i]['Prod_id']+')"><i class="fas fa-pen i-prod"></i></a>'+
            '<a  data-toggle="tooltip" data-placement="top" title="คัดลอก" onclick="copyProduct ('+data['product'][i]['Prod_id']+')"><i class="far fa-copy i-prod"></i></a>'+

            '<a  data-toggle="tooltip" data-placement="top" title="ลบ" onclick="DeleteProd ('+data['product'][i]['Prod_id']+')"><i class="far fa-trash-alt i-prod"></i></a>'+


            '</div>'+
            '</td>'+
            '</tr>'
            );
        }
      }
      document.getElementById("product_counts").innerHTML = "พบสินค้า "+p_counter+" รายการ";
      $("#table").append('</table>');
      $('.dataTables-example').DataTable({
        "searching": false,
        "buttons": false
      });
      $('.footable').footable();
    }
    ,
    failure: function(errMsg) {
      alert(errMsg);
    }
  });
}
var sku_pid = 0;

function skuChange(prod_id,prod_sku){
  $("#ModelSKU").empty();
  $("#ModelSKU").append('<div class="modal fade" id="skuModal" tabindex="-1" role="dialog" aria-labelledby="skuModal">'+
    '<div class="modal-dialog" role="document">'+
      '<div class="modal-content">'+
        '<div class="modal-header">'+
          '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
          '<h4 class="modal-title" id="modal_header_title">แก้ไข SKU</h4>'+
        '</div>'+
        '<div class="modal-body" id="model_body">'+
          '<div class="form-group"><label>รหัสสินค้าที่ต้องการ (SKU)</label> <input maxlength="20" onkeypress="return (event.charCode != 32 ) && (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 45" type="text" placeholder="Enter product sku" id="prod_sku" class="form-control" name="prod_sku" autocomplete="off"></div>'+
          '<div><button id="btn_sku_save" class="btn btn-sm btn-primary m-t-n-xs" type="button"><strong>บันทึก</strong></button></div>'+
        '</div>'+
      '</div>'+
    '</div>'+
  '</div>');

  sku_pid = prod_id;
  $("#prod_sku").val('');
  $('#skuModal').modal('show');
  $("#prod_sku").val(prod_sku);
  if(prod_sku == "ยังไม่ได้กำหนด"){
    $("#prod_sku").val('');
  }
  var osku = prod_sku;
  $('#btn_sku_save').click(function(){
    var prod_sku = $("#prod_sku").val();
    if(prod_sku == osku){
      swal({
        title: "เกิดข้อผิดพลาด !",
        text: "SKU ที่กรอกเหมือนกับที่ใช้งานอยู่ !",
        type: "error"
      });
    }else{
      if(prod_sku != ''){
      $.ajax({
        url: '/api/change-Sku',
        headers: {
          'Authorization':'Bearer '+token,
          'Content-Type':'application/json'
        },
        method: 'POST',
        data: JSON.stringify({ "prod_sku":prod_sku,"prod_id":sku_pid }),
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function(data){
          if(data['success'] != null)
          {
            $('#skuModal').modal('hide');
            switch (filltertype) {
              case 'show_all':
                 getProduct();
              break;
              case 'show_sell':
              getProduct_FILLTER(0);
              break;
              case 'show_unsell':
              getProduct_FILLTER(1);
              break;
            }
            swal({
              title: "Success !",
              button: false,
              timer: 1500,
              icon: "success",
              text: "แก้ไข รหัสสินค้า (SKU) สำเร็จ !",
            });
          }else if(data['sku_error'] != null){
            swal({
              title: "เกิดข้อผิดพลาด !",
              text: "SKU นี้ถูกใช้งานแล้วกรุณากรอกใหม่ !",
              type: "error"
            });
            $("#prod_sku").val('');
          }
        }
      });
    }else{
      swal({
        title: "Error !",
        text: "กรุณาใส่ SKU ที่ต้องการ !",
        type: "error"
      });
    }
    }
  });
}

function name_fillters(){

  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("name_fillter");
  filter = input.value.toUpperCase();
  table = document.getElementById("tblEntAttributes");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
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

function sku_fillters(){

  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("sku_fillter");
  filter = input.value.toUpperCase();
  table = document.getElementById("tblEntAttributes");
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

function color_fillters(){

  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("color_fillter");
  filter = input.value.toUpperCase();
  table = document.getElementById("tblEntAttributes");
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

function fillter_product(type){
  switch (type) {
    case 'show_all':
    $("#showall").addClass( "active" );
    $("#sell").removeClass( "active" );
    $("#unsell").removeClass( "active" );
    filltertype = 'show_all';
    getProduct();
    break;
    case 'show_sell':
    $("#sell").addClass( "active" );
    $("#unsell").removeClass( "active" );
    $("#showall").removeClass( "active" );
    filltertype = 'show_sell';
    getProduct_FILLTER(0);
    break;
    case 'show_unsell':
    $("#unsell").addClass( "active" );
    $("#sell").removeClass( "active" );
    $("#showall").removeClass( "active" );
    filltertype = 'show_unsell';
    getProduct_FILLTER(1);
    break;
  };
}
