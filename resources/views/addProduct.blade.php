@extends('layouts.layout_brand')

@section('content')

<head>
  <meta charset="utf-8">
  <title>Tagify - demo</title>
  <meta name="description" content="Converts HTML input/textarea into Tags component">
  <meta name="author" content="Yair Even-Or">

  <link rel="stylesheet" href="dist/tagify.css">
  <link href="css/imgStyle_addProd.css" rel="stylesheet">
  <script src="dist/tagify.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="dist/jQuery.tagify.min.js"></script>

</head>
<body >
<div class="row border-bottom2">
    <nav class="navbar navbar-static-top2" role="navigation" style="margin-bottom: 0">
      <ul class="nav navbar-top-links navbar-left">
        <li>
         <h2 style="padding-left: 20px;">เพิ่มสินค้า</h2> 
        </li>


      </ul>
      <ul class="nav navbar-top-links navbar-right">
        <li>
         <a href="product"><button  class="btn btn-info  " type="button"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;<span class="bold">ย้อนกลับ</span></button></a>
       </li>
     </ul>
   </nav>
 </div>

  <div class="row mt-mt">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h3>แก้ไขรูปภาพสินค้า</h3>
          
            <div class="cen">
              <div class="upload-btn-wrapper">                    
                <div id="is1" class="btn-pic i-size">
                  <div id="i1" class="fa fa-picture-o"></div>
                  <img id='spic1' src="#" hidden="true" class="add-pic"></img>
                </div>
                <input id="file_pic1" type="file" name="pic1"  onchange="showpic1(this)">
                <p class="p-mt">ภาพปก<p>
                </div>

                <div class="upload-btn-wrapper">                    
                  <div id="is2" class="btn-pic i-size">
                    <div id="i2" class="fa fa-picture-o"></div>
                    <img id='spic2' src="#" hidden="true" class="add-pic"></img>
                  </div>
                  <input id="file_pic2" type="file" name="pic2"  onchange="showpic2(this)">
                  <p class="p-mt">ภาพ1<p>
                  </div>

                  <div class="upload-btn-wrapper">                    
                    <div id="is3" class="btn-pic i-size">
                      <div id="i3" class="fa fa-picture-o"></div>
                      <img id='spic3' src="#" hidden="true" class="add-pic"></img>
                    </div>
                    <input id="file_pic3" type="file" name="pic3"  onchange="showpic3(this)">
                    <p class="p-mt">ภาพ2<p>
                    </div>

                    <div class="upload-btn-wrapper">                    
                      <div id="is4" class="btn-pic i-size">
                        <div id="i4" class="fa fa-picture-o"></div>
                        <img id='spic4' src="#" hidden="true" class="add-pic"></img>
                      </div>
                      <input id="file_pic4" type="file" name="pic4"  onchange="showpic4(this)">
                      <p class="p-mt">ภาพ3<p>
                      </div>

                      <div class="upload-btn-wrapper">                    
                        <div id="is5" class="btn-pic i-size">
                          <div id="i5" class="fa fa-picture-o"></div>
                          <img id='spic5' src="#" hidden="true" class="add-pic"></img>
                        </div>
                        <input id="file_pic5" type="file" name="pic5"  onchange="showpic5(this)">
                        <p class="p-mt">ภาพ4<p>
                        </div>

                      </div>
                       <div class="hr-line-dashed"></div>
                    </div>

                

                    <div class="ibox-content">
                      <form method="get" class="form-horizontal">
                        <div class="wrapper wrapper-content animated fadeIn">
                          <div class="ibox-title"><h3>ข้อมูลทั่วไป</h3></div>
                          <div class="ibox-content">
                            <div class="form-group"><label class="col-sm-2 control-label">sku (รหัสสินค้า)</label>
                              <div class="col-sm-10"><input onkeypress="return (event.charCode != 32 ) && (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 45" onkeyup="sku_count_cal(this)" id="prod_sku" type="text" class="form-control input-lg" maxlength="20"><span class="help-block m-b-none" id="sku_count">0/20</span></div>
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
                            <div class="col-sm-10"><input id="prod_qty" name="prod_qty" type="number" class="form-control input-lg">
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
                                  <div class="col-sm-2 gird text-right">

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
                          <div class="hr-line-dashed"></div>
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
              </div>
              <div class="hr-line-dashed"></div>
              <div class="form-group"><label class="col-sm-2 control-label">เลือกห้องที่สามารถจัดวางสินค้าได้เพิ่มเติม</label>
                <div class="col-sm-10">
                    <button  type="button" class="btn btn-primary btn-rounded" id="optionroom_1" >ห้องนอน</button>
                    <button type="button" class="btn btn-primary btn-rounded" id="optionroom_2" href="#">ห้องนั่งเล่น</button>
                    <button type="button" class="btn btn-primary btn-rounded" id="optionroom_3" href="#">ห้องทำงาน</button>
                </div>
              </div>
              <div class="form-group"><label class="col-sm-2 control-label">Keyword</label>
                <div class="col-sm-10">
                      <input name='tags' class="form-control input-lg" placeholder='กรุณาใส่ keyword ที่ต้องการ ตามด้วย , หรือ enter' value=''  data-blacklist='' id="tags">
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
              </div>
            </div>

            <div id="add">
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
              <div id="brand" class="row">
              </div>
            </div>


          </body>
          <script src="layout/js/jquery-3.3.1.min.js"></script>
          <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js">
            <script src="js/bootstrap.min.js"></script>
            <script src="js/Scripts/addproduct.js"></script>
            <script src="js/plugins/toastr/toastr.min.js"></script>

            <script>
              function tags(value){
                var obj = JSON.parse(value);

                console.log(obj);
              }
            </script>

            @endsection
