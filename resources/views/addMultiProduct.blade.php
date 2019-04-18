@extends('layouts.layout_brand')

@section('content')
<body >
  <h2 class="text-head-amt">เพิ่มสินค้า</h2>
    <div class="row mt-mt-mt">
              <div class="col-lg-12">
                  <div class="ibox float-e-margins">


                      <div class="ibox-content b-shadow">
                        <div class="row">
                          <div class="col-sm-6">
                        <div class="addProd-box">
                            <div class="product-desc">
                              <div class="bt-addProd text-head">
                                <button data-toggle="modal" data-target="#myModal" class="btn btn-warning btn-lg " type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">เลือกไฟล์</span></button>
                              </div>
                            </div>

                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="addProd-box-cr">
                            <div class="product-desc">
                                <a href="#" class="product-name"> คุณจะสามารถทำการอัพโหลดสินค้าหลายรายการได้</a>

                                <div class="small m-t-xs">
                                </div>
                                <div class="m-t text-righ">

                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    <!--    <div class="row">
                          <div class="col-sm-6">
                            <div class="addProd-box-cr">
                                <div class="product-desc">
                                    <small class="text-muted">Category</small>
                                    <a href="#" class="product-name"> Product</a>

                                    <div class="small m-t-xs">
                                        Many desktop publishing packages and web page editors now.
                                    </div>
                                    <div class="m-t text-righ">

                                        <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-sm-6">

                            <div class="addProd-box-cr">
                                <div class="product-desc">
                                    <small class="text-muted">Category</small>
                                    <a href="#" class="product-name"> Product</a>

                                    <div class="small m-t-xs">
                                        Many desktop publishing packages and web page editors now.
                                    </div>
                                    <div class="m-t text-righ">

                                        <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                    </div>
                                </div>
                            </div>
                          </div>

                        </div>  -->

                      </div>
                    </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="modal inmodal" id="Delivery" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ตัวเลือกค่าจัดส่ง: ThaiPost - Registered Mail</h4>
                                        </div>
                                        <div class="modal-body">
                                                    <div class="form-group"><label>ค่าจัดส่ง</label> <input id="DHL_input" type="number" placeholder="Enter your price" class="form-control" ></div>
                                                    <label class=""> <div class="icheckbox_square-green" style="position: relative;"><input id="DHL_checkbox" type="checkbox" class="i-checks" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> ฉันครอบคลุมค่าใช้จ่ายในการจัดส่ง </label>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="cancel" type="button" class="btn btn-white" data-dismiss="modal">ยกเลิก</button>
                                            <button id="confirm" type="button" class="btn btn-danger">ตกลงและเปิดใช้งาน</button>
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
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/toastr/toastr.min.js"></script>
<script>
var b_id = localStorage.getItem("b_id");
var token = localStorage.getItem("user_token");
var id;
function sbrand(b_id){
  if(b_id !=0)
  {
    localStorage.setItem("b_id",b_id);
    window.location.replace('/sbrand');
  }
}
var elem = document.querySelector('.js-switch');




</script>
@endsection
