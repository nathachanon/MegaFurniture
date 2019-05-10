@extends('layouts.layout_brand')

@section('content')
<body >

  <div class="row mt-mt">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h3>แก้ไขรูปภาพสินค้า</h3>
          <div class="form-group">
            <img id='spic1' src="#" class="preview" hidden="true" width="250" height="180"></img>
            <label for="catagry_name">ภาพปก</label>
            <input id="file_pic1" type="file" name="pic1" class="form-control" onchange="showpic1(this)">
          </div>
          <div class="form-group">
            <img id='spic2' src="#" class="preview" hidden="true" width="250" height="180"></img>
            <label for="catagry_name">รูปที่ 2</label>
            <input id="file_pic2" type="file" name="pic2" class="form-control" onchange="showpic2(this)">
          </div>
          <div class="form-group">
            <img id='spic3' src="#" class="preview" hidden="true" width="250" height="180"></img>
            <label for="catagry_name">รูปที่ 3</label>
            <input id="file_pic3" type="file" name="pic3" class="form-control" onchange="showpic3(this)">
          </div>
          <div class="form-group">
            <img id='spic4' src="#" class="preview" hidden="true" width="250" height="180"></img>
            <label for="catagry_name">รูปที่ 4</label>
            <input id="file_pic4" type="file" name="pic4" class="form-control" onchange="showpic4(this)">
          </div>
          <div class="form-group">
            <img id='spic5' src="#" class="preview" hidden="true" width="250" height="180"></img>
            <label for="catagry_name">รูปที่ 5</label>
            <input id="file_pic5" type="file" name="pic5" class="form-control" onchange="showpic5(this)">
          </div>
      </div>

      <div class="ibox-content">
        <form method="get" class="form-horizontal">
          <div class="wrapper wrapper-content animated fadeIn">
            <div class="ibox-title"><h3>ข้อมูลทั่วไป</h3></div>
            <div class="ibox-content">

              <div class="form-group"><label class="col-sm-2 control-label">sku (รหัสสินค้า)</label>
                <div class="col-sm-10"><input onkeypress="return (event.charCode != 32 ) && (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 45" onkeyup="sku_count_cal(this)" id="prod_sku" type="text" class="form-control input-lg" maxlength="50"><span class="help-block m-b-none" id="sku_count">0/50</span></div>
              </div>
              <div class="form-group"><label class="col-sm-2 control-label">ชื่อสินค้า</label>
                <div class="col-sm-10"><input onkeyup="name_count_cal(this)" id="prod_name" type="text" class="form-control input-lg"><span class="help-block m-b-none" id="name_count" maxlength="120">0/120</span></div>
              </div>
              <div class="form-group"><label class="col-sm-2 control-label">รายละเอียดสินค้า</label>
                <div class="col-sm-10"><input onkeyup="desc_count_cal(this)" id="prod_desc" type="text" class="form-control input-lg"> <span class="help-block m-b-none" id="desc_count" maxlength="5000">0/5000</span>
                </div>
              </div>
              <div class="form-group"><label class="col-sm-2 control-label ">หมวดหมู่</label>

                <div class="col-sm-10"><select id="optionroom" class="form-control m-b input-lg" name="roomSelect" onchange="roomselect()">
                  <option value="0">เลือกห้องที่ต้องการ</option>
                </select>
              </div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label "></label>
              <div id="CatProduct" class="col-sm-10">
              </div>
            </div>
            <div id="inputs_wlhf" class="form-group"><label class="col-sm-2 control-label "></label>

            </div>
            <div id="inputs_cr" class="form-group"><label class="col-sm-2 control-label "></label>

            </div>
            <div class="hr-line-dashed"></div>
            <div class="ibox-title"><h3>ราคาและคลัง</h3></div>
            <div class="form-group"><label class="col-sm-2 control-label">ราคา</label>
              <div class="col-sm-10">
                <div class="input-group m-b col-md-6"><span class="input-group-addon ">฿</span> <input id="prod_price" type="number" type="text" class="col-md-4 form-control input-lg "></div>
              </div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">คลัง</label>
              <div class="col-sm-10"><input id="prod_qty" type="number" class="form-control input-lg">
              </div>
            </div>
            <div class="hr-line-dashed"></div>


            <div class="ibox-title"><h3>การจัดส่ง</h3></div>
            <div class="form-group"><label class="col-sm-2 control-label">น้ำหนัก(Kg)</label>
              <div class="col-sm-10"><input id="weight" type="number" min="1" max="20" class="form-control input-lg">
              </div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">ค่าจัดส่ง</label>
              <div class="col-sm-10">
                <div class="shipper-card">
                  <div class="row">
                    <div class="col-sm-4 ">
                      <h4 class="mb">DHL </h4>
                      <h4 class="mb">EMS</h4>
                      <h4 class="mb">KERRY</h4>
                      <h4 class="mb">ส่งโดย SB </h4>
                      <h4 class="mb">ผู้ขายทำการจัดส่งให้</h4>
                      <h4 class="mb">ผู้ซื้อไปรับสินค้าเอง</h4>
                    </div>
                    <div class="col-sm-6 text-right">
                      <h4 class="mb tl text-danger">ระบุค่าจัดส่ง &nbsp;&nbsp;<p id="DHL_price" class="in"></p></h4>
                      <h4 class="mb tl text-danger">ระบุค่าจัดส่ง &nbsp;&nbsp;<p id="EMS_price" class="in"></p></h4>
                      <h4 class="mb tl text-danger">ระบุค่าจัดส่ง &nbsp;&nbsp;<p id="KERRY_price" class="in"></p></h4>
                      <h4 class="mb tl text-danger">ระบุค่าจัดส่ง &nbsp;&nbsp;<p id="SB_price"class="in"></p></h4>
                      <h4 class="mb tl text-danger">ระบุค่าจัดส่ง &nbsp;&nbsp;<p id="SELLER_price" class="in"></p></h4>
                      <h4 class="mb tl text-danger">ระบุค่าจัดส่ง &nbsp;&nbsp;<p id="BUYER_price" class="in"></p></h4>
                    </div>
                    <div class="col-sm-2 text-right">

                      <label class="switch delivery-mt">
                        <input id="DHL" type="checkbox">
                        <span class="slider round"></span>
                      </label>
                      <label class="switch delivery-mt">
                        <input id="EMS" type="checkbox">
                        <span class="slider round"></span>
                      </label>
                      <label class="switch delivery-mt">
                        <input id="KERRY" type="checkbox">
                        <span class="slider round"></span>
                      </label>
                      <label class="switch delivery-mt">
                        <input id="SB" type="checkbox">
                        <span class="slider round"></span>
                      </label>
                      <label class="switch delivery-mt">
                        <input id="SELLER" type="checkbox">
                        <span class="slider round"></span>
                      </label>
                      <label class="switch delivery-mt">
                        <input id="BUYER" type="checkbox">
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="form-group"><label class="col-sm-2 control-label">Keyword</label>
              <div class="col-sm-10">
                    <input name='tags' class="form-control input-lg" placeholder='กรุณาใส่ keyword ที่ต้องการ ตามด้วย , หรือ enter' value=''  data-blacklist='' id="tags">
              </div>
            </div>


            <div class="hr-line-dashed"></div>


            <div class="form-group" id="footer" >
              <div class="col-sm-6 col-sm-offset-2">
                <button class="btn btn-info input-lg" type="button" id="publicAdd">บันทึกและเผยแพร่</button>
                <button class="btn btn-warning input-lg" type="button" id="privateAdd">บันทึกและซ่อน</button>
                <button class="btn btn-white input-lg" type="button" id="cancel">ยกเลิก</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal inmodal" id="DHL_d" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content animated bounceInRight">
        <div class="modal-header">
          <h4 class="modal-title">ตัวเลือกค่าจัดส่ง: DHL Express</h4>
        </div>
        <div class="modal-body">
          <div class="form-group"><label>ค่าจัดส่ง</label> <input id="DHL_input" type="number" placeholder="Enter your price" class="form-control" ></div>
          <label class=""> <div class="icheckbox_square-green" style="position: relative;"><input id="DHL_checkbox" type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> ฉันครอบคลุมค่าใช้จ่ายในการจัดส่ง </label>
        </div>
        <div class="modal-footer">
          <button id="cancel" type="button" class="btn btn-white" data-dismiss="modal">ยกเลิก</button>
          <button id="confirmDHL" type="button" class="btn btn-danger">ตกลงและเปิดใช้งาน</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal inmodal" id="EMS_d" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content animated bounceInRight">
        <div class="modal-header">
          <h4 class="modal-title">ตัวเลือกค่าจัดส่ง: EMS</h4>
        </div>
        <div class="modal-body">
          <div class="form-group"><label>ค่าจัดส่ง</label> <input id="EMS_input" type="number" placeholder="Enter your price" class="form-control" ></div>
          <label class=""> <div class="icheckbox_square-green" style="position: relative;"><input id="EMS_checkbox" type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> ฉันครอบคลุมค่าใช้จ่ายในการจัดส่ง </label>
        </div>
        <div class="modal-footer">
          <button id="cancel" type="button" class="btn btn-white" data-dismiss="modal">ยกเลิก</button>
          <button id="confirmEMS" type="button" class="btn btn-danger">ตกลงและเปิดใช้งาน</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal inmodal" id="KERRY_d" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content animated bounceInRight">
        <div class="modal-header">
          <h4 class="modal-title">ตัวเลือกค่าจัดส่ง: KERRY Express</h4>
        </div>
        <div class="modal-body">
          <div class="form-group"><label>ค่าจัดส่ง</label> <input id="KERRY_input" type="number" placeholder="Enter your price" class="form-control" ></div>
          <label class=""> <div class="icheckbox_square-green" style="position: relative;"><input id="KERRY_checkbox" type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> ฉันครอบคลุมค่าใช้จ่ายในการจัดส่ง </label>
        </div>
        <div class="modal-footer">
          <button id="cancel" type="button" class="btn btn-white" data-dismiss="modal">ยกเลิก</button>
          <button id="confirmKERRY" type="button" class="btn btn-danger">ตกลงและเปิดใช้งาน</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal inmodal" id="SB_d" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content animated bounceInRight">
        <div class="modal-header">
          <h4 class="modal-title">ตัวเลือกค่าจัดส่ง: SB</h4>
        </div>
        <div class="modal-body">
          <div class="form-group"><label>ค่าจัดส่ง</label> <input id="SB_input" type="number" placeholder="Enter your price" class="form-control" ></div>
          <label class=""> <div class="icheckbox_square-green" style="position: relative;"><input id="SB_checkbox" type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> ฉันครอบคลุมค่าใช้จ่ายในการจัดส่ง </label>
        </div>
        <div class="modal-footer">
          <button id="cancel" type="button" class="btn btn-white" data-dismiss="modal">ยกเลิก</button>
          <button id="confirmSB" type="button" class="btn btn-danger">ตกลงและเปิดใช้งาน</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal inmodal" id="SELLER_d" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content animated bounceInRight">
        <div class="modal-header">
          <h4 class="modal-title">ตัวเลือกค่าจัดส่ง: ส่งโดยผู้ขาย</h4>
        </div>
        <div class="modal-body">
          <div class="form-group"><label>ค่าจัดส่ง</label> <input id="SELLER_input" type="number" placeholder="Enter your price" class="form-control" ></div>
          <label class=""> <div class="icheckbox_square-green" style="position: relative;"><input id="SELLER_checkbox" type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> ฉันครอบคลุมค่าใช้จ่ายในการจัดส่ง </label>
        </div>
        <div class="modal-footer">
          <button id="cancel" type="button" class="btn btn-white" data-dismiss="modal">ยกเลิก</button>
          <button id="confirmSELLER" type="button" class="btn btn-danger">ตกลงและเปิดใช้งาน</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal inmodal" id="BUYER_d" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content animated bounceInRight">
        <div class="modal-header">
          <h4 class="modal-title">ตัวเลือกค่าจัดส่ง: ผู้ซื้อไปรับสินค้าเอง</h4>
        </div>
        <div class="modal-body">
          <div class="form-group"><label>ค่าจัดส่ง</label> <input id="BUYER_input" type="number" placeholder="Enter your price" class="form-control" ></div>
          <label class=""> <div class="icheckbox_square-green" style="position: relative;"><input id="BUYER_checkbox" type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> ฉันครอบคลุมค่าใช้จ่ายในการจัดส่ง </label>
        </div>
        <div class="modal-footer">
          <button id="cancel" type="button" class="btn btn-white" data-dismiss="modal">ยกเลิก</button>
          <button id="confirmBUYER" type="button" class="btn btn-danger">ตกลงและเปิดใช้งาน</button>
        </div>
      </div>
    </div>
  </div>

  <div id="add">
  </div>
  <div class="wrapper wrapper-content animated fadeInRight">
    <div id="brand" class="row">
    </div>
  </div>


</body>
<script src="js/jquery-2.1.1.js"></script>
<script type="text/javascript"
src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js">
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/toastr/toastr.min.js"></script>
<script>
  var product_ids = 0;
  var pid=0;
  var b_id = localStorage.getItem("b_id");
  var token = localStorage.getItem("user_token");
  var id;
  var valueDHL='';
  var valueEMS='';
  var valueKERRY='';
  var valueSB='';
  var valueSELLER='';
  var valueBUYER='';

  function sku_count_cal(sku){
    var sku_count = sku.value.length;
    $("#sku_count").empty();
    $("#sku_count").append(sku_count+"/50");
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
    var edit = getCookie('edit_prod');
    if(edit != null){
      product_ids = edit;
      $.ajax({
        type: "POST",
        url: "/api/getProductDetails",
        headers: {
          'Authorization':'Bearer '+token,
          'Content-Type':'application/json'
        },
        data: JSON.stringify({
          "Prod_id": edit }),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(data){
          console.log(data);
          $('#optionroom').val(data['catagoies'][0]['CatRoom_id']);
          roomselect();
          $('#prod_sku').val(data['product'][0]['sku']);
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
          //ke
          if(data['keywords'].length != 0){
          var sum_keyword = "";
            for(var x=0;x<data['keywords'].length;x++){
              sum_keyword += data['keywords'][x]['keyword_value'];
              if(x!=data['keywords'].length-1){
              sum_keyword = sum_keyword+',';
            }
            }
          }
            $('#tags').val(sum_keyword);
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
      $("#inputs_wlhf").empty();
      $("#inputs_wlhf").append('<div class="hr-line-dashed"></div><div class="ibox-title"><h3>ขนาด</h3></div>'+
        '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">กว้าง (Cm)</label>'+
        '<div class="col-sm-10"><input type="number" id="SizeProd_width" type="text" placeholder="Enter Product Width" class="form-control input-lg"></div></div>'+
        '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">ยาว (Cm)</label><div class="col-sm-10"><input type="number" id="SizeProd_length" type="text" placeholder="Enter Product Length" class="form-control input-lg"></div></div>'+
        '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">สูง (Cm)</label><div class="col-sm-10"><input type="number" id="SizeProd_height" type="text" placeholder="Enter Product Height" class="form-control input-lg"></div></div>'+
        '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">ฟุต</label><div class="col-sm-10"><input type="number" id="SizeProd_foot" type="text" placeholder="Enter Product Foot" class="form-control input-lg"></div></div>');
      $("#inputs_cr").append('<div class="hr-line-dashed"></div><div class="ibox-title"><h3>สีและวัสดุ</h3></div>'+
        '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">สี</label>'+
        '<div class="col-sm-10"><input id="ColorProd_value" type="text" placeholder="Enter Product Color" class="form-control input-lg"></div></div>'+
        '<div class="form-group animated bounceInRight has-error"><label class="col-sm-2 control-label">วัสดุ (ไม้,ผ้า)</label><div class="col-sm-10"><input id="RM_value" type="text" placeholder="Enter Product Material" class="form-control input-lg"></div></div>');
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
    Dropzone.options.dropzone = {
      autoProcessQueue: false,
      parallelUploads: 5,
      maxFiles:5,
    }
    var v1=0;

    $("#btn1").click(function(){
      if(v1 == 0 ){
        $("#dropzone").hide();
        document.getElementById("btn1").innerHTML = "ต้องการแก้ไขรูปภาพ";
        v1=1;
      }else{
        $("#dropzone").show();
        document.getElementById("btn1").innerHTML = "ไม่ต้องการแก้ไขรูปภาพ";
        v1=0;
      }
    });
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

      if(prod_name != '' && prod_desc != '' && prod_price != '' && prod_qty != '' && SizeProd_width != '' &&
       SizeProd_length != '' && SizeProd_height != '' && SizeProd_foot != '' && ColorProd_value != '' && RM_value != '' && weight != '' && product_ids != '')
      {

        var formData = new FormData();

        formData.append("pic1", document.getElementById("file_pic1").files[0]);
        formData.append("pic2", document.getElementById("file_pic2").files[0]);
        formData.append("pic3", document.getElementById("file_pic3").files[0]);
        formData.append("pic4", document.getElementById("file_pic4").files[0]);
        formData.append("pic5", document.getElementById("file_pic5").files[0]);
        formData.append("Prod_id", product_ids);
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

        for (var i = 0; i < tags.length; i++) {
            formData.append('tags[]', tags[i]);
        }

        $.ajax({
          url: '/api/EditProduct',
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
              alert('แก้ไขสินค้าสำเร็จ !');
              window.location.replace('/product');
            }else{
              alert('ชื่อสินค้าซ้ำ !');
              $('#prod_name').val('');
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
      if(prod_name != '' && prod_desc != '' && prod_price != '' && prod_qty != '' && SizeProd_width != '' &&
       SizeProd_length != '' && SizeProd_height != '' && SizeProd_foot != '' && ColorProd_value != '' && RM_value != '' && weight != '' && product_ids != '')
      {
        var formData = new FormData();

        formData.append("pic1", document.getElementById("file_pic1").files[0]);
        formData.append("pic2", document.getElementById("file_pic2").files[0]);
        formData.append("pic3", document.getElementById("file_pic3").files[0]);
        formData.append("pic4", document.getElementById("file_pic4").files[0]);
        formData.append("pic5", document.getElementById("file_pic5").files[0]);
        formData.append("Prod_id", product_ids);
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
          url: '/api/EditProduct',
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
              alert('แก้ไขสินค้าสำเร็จ !');
              window.location.replace('/product');
            }else{
              alert('ชื่อสินค้าซ้ำ !');
              $('#prod_name').val('');
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


</script>
@endsection
