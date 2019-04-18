@extends('layouts.layout_brand')

@section('content')

<head>
 
  <!-- Sweet Alert -->
  <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
  <!-- FooTable -->
  <link href="css/plugins/footable/footable.core.css" rel="stylesheet">
</head>
<body >
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <div class="row border-bottom2">
    <nav class="navbar navbar-static-top2" role="navigation" style="margin-bottom: 0">
      <ul class="nav navbar-top-links navbar-left">
        <li>
          <a class="mt-sbrand" href="#"><h3 id="product_counts"></h3> </a>

      </ul>
      <ul class="nav navbar-top-links navbar-right">
        <li>
         <a href="addProduct"><button  class="btn btn-primary  " type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">เพิ่มสินค้า</span></button></a>
       </li>
       <li>
         <a href="addProducts"><button  class="btn btn-warning  " type="button"><i class="fa fa-table"></i>&nbsp;&nbsp;<span class="bold">เพิ่มสินค้า Excel</span></button></a>
       </li>
       <li>
         <a href="addDetail"><button  class="btn btn-danger  " type="button"><i class="fa fa-sliders"></i>&nbsp;&nbsp;<span class="bold">สินค้าที่รอการตั้งค่า</span></button></a>
       </li>


     </ul>

   </nav>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight ecommerce">
  <div class="row">

    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-content">
            <h2>จัดการสินค้า</h2><br>


         <nav class="navbar navbar-static-top2" role="navigation" style="margin-bottom: 0">
          <ul class="nav navbar-top-links navbar-left">
            <li>
               <li>
              <button  class="btn btn-primary" type="button" onclick="editGroup(prod_array)"><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;<span class="bold">แก้ไขหลายชิ้น</span></button>
            </li>
          
            </li>
          </ul>
          <ul class="nav navbar-top-links navbar-right">
        
           <li>
               <li>
              <button id="showall" onclick="fillter_product('show_all')" class="btn btn-default active" type="button" ><i class="far fa-list-alt"></i></i>&nbsp;&nbsp;<span class="bold">ทั้งหมด</span></button>
            </li>
              <li>
              <button id="sell" onclick="fillter_product('show_sell')"  class="btn btn-default " type="button" ><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;<span class="bold">วางขาย</span></button>
            </li>
              <li>
              <button id="unsell" onclick="fillter_product('show_unsell')" class="btn btn-default" type="button" ><i class="fas fa-cart-arrow-down"></i>&nbsp;&nbsp;<span class="bold">ไม่วางขาย</span></button>
            </li>
           </li>


         </ul>

       </nav>


       <div class="form-group">
                <div class="col-sm-4">
                  <label class="control-label" for="sku_fillter">ค้นหาด้วย SKU</label>
                  <input type="text" id="sku_fillter" onkeyup="sku_fillters()" name="sku_fillter" value="" placeholder="ค้นหา..." class="form-control">
              </div>
                <div class="col-sm-4">
                  <label class="control-label" for="name_fillter">ค้นหาด้วยชื่อสินค้า</label>
                  <input type="text" id="name_fillter" onkeyup="name_fillters()" name="name_fillter" value="" placeholder="ค้นหา..." class="form-control">
              </div>
              <div class="col-sm-4">
                <label class="control-label" for="color_fillter">ค้นหาด้วยสี</label>
                <input type="text" id="color_fillter" onkeyup="color_fillters()" name="color_fillter" value="" placeholder="ค้นหา..." class="form-control">
            </div>
          </div>
          <br><br><br><hr>
      <div id="table">
      </div>
    </div>
  </div>
</div>
</div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal_header_title">แก้ไขสินค้าหลายชิ้น</h4>
      </div>
      <div class="modal-body" id="model_body">
      </div>
    </div>
  </div>
</div>


<!-- Modal SKU -->
<div class="modal fade" id="skuModal" tabindex="-1" role="dialog" aria-labelledby="skuModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal_header_title">แก้ไข SKU</h4>
      </div>
      <div class="modal-body" id="model_body">
        <div class="form-group"><label>รหัสสินค้าที่ต้องการ (SKU)</label> <input maxlength="20" onkeypress="return (event.charCode != 32 ) && (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 45" type="text" placeholder="Enter product sku" id="prod_sku" class="form-control" name="prod_sku" autocomplete="off"></div>
        <div><button id="btn_sku_save" class="btn btn-sm btn-primary m-t-n-xs" type="button"><strong>บันทึก</strong></button></div>
      </div>
    </div>
  </div>
</div>

</body>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/toastr/toastr.min.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>

<!-- Jquery Validate -->
<script src="js/plugins/validate/jquery.validate.min.js"></script>

<!-- Sweet alert -->
<script src="js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Script -->
<script src="js/Scripts/product.js"></script>
@endsection
