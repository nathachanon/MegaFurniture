<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Brand : MEGA Furniture</title>
  <link href="../css/plugins/slick/slick.css" rel="stylesheet">
  <link href="../css/plugins/slick/slick-theme.css" rel="stylesheet">
  <link href="../css/plugins/footable/footable.core.css" rel="stylesheet">
  <link href="../css/plugins/dataTables/datatables.min.css" rel="stylesheet">
  <link href="../css/plugins/toastr/toastr.min.css" rel="stylesheet">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="../css/plugins/iCheck/custom.css" rel="stylesheet">
  <link href="../css/plugins/dropzone/basic.css" rel="stylesheet">
  <link href="../css/plugins/dropzone/dropzone.css" rel="stylesheet">
  <link href="../css/plugins/switchery/switchery.css" rel="stylesheet">
  <link href="../css/plugins/datapicker/datepicker3.css" rel="stylesheet">
  <link href="../css/animate.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.min.css">
  <link href="../css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

 <link href="../css/plugins/summernote/summernote.css" rel="stylesheet">
 <link href="../css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
  <style>

  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
   -webkit-appearance: none;
   -moz-appearance: none;
   appearance: none;
   margin: 0;
 }
</style>
</head>

<body class="pace-done body-small"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>

<div id="wrapper">

  <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
      <ul class="nav metismenu" id="side-menu">
        <li class="nav-header">
          <div class="dropdown profile-element"> <span>
            <div id="img" class="text-head">

            </div>
          </span>
          <a  href="#">
            <span class="clear"> <span class="block m-t-xs"><strong id='nn'class="font-bold"></strong>
            </span> <span class="text-muted text-xs block ">Admin</span> </span> </a>

          </div>
          <div class="logo-element">
            IN+
          </div>

        </li>
        <li>
          <a href="promotion"><i class="fa fa-users"></i> <span class="nav-label"> โปรโมชัน</span></a>
        </li>
         <li id="brand-nav" >
          <a href="event"><i class="fa fa-users"></i> <span class="nav-label">กิจกรรม</span></a>
        </li>
      </ul>

    </div>
  </nav>
  <div id="page-wrapper" class="bg-white" style="min-height: 697px;">
    <div class="row border-bottom">
      <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
          <a class="navbar-minimalize minimalize-styl-2 btn btn-mega " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
          <li>
            <span id='welcomes' class="m-r-sm text-muted welcome-message"></span>
          </li>

          <li>
            <a id='logout'>
              <i id="i-logout" class="fas fa-sign-out-alt"></i> ออกจากระบบ
            </a>
          </li>
        </ul>

      </nav>
    </div>
    @yield('content')
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
      </div>
    </div>
  </div>
</div>

</body>
<!-- Mainly scripts -->
<script src="../js/jquery-2.1.1.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- FooTable -->
<script src="../js/plugins/footable/footable.all.min.js"></script>
<script src="../js/plugins/dataTables/datatables.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="../js/inspinia.js"></script>
<script src="../js/plugins/pace/pace.min.js"></script>

<!-- iCheck -->
<script src="../js/plugins/iCheck/icheck.min.js"></script>

<!-- Data picker -->
<script src="../js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- DROPZONE -->
<script src="../js/plugins/dropzone/dropzone.js"></script>

<!-- iCheck -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.33.1/dist/sweetalert2.all.min.js"></script>


<script src="../js/plugins/iCheck/icheck.min.js"></script>
<script src="../js/plugins/footable/footable.all.min.js"></script>
<script src="../js/plugins/slick/slick.min.js"></script>


<!-- SUMMERNOTE -->
<script src="../js/plugins/summernote/summernote_edit.min.js"></script>
<script>
  $(document).ready(function () {
    $('.i-checks').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
    });
  });




       $('.product-images').slick({
                  dots: true
              });
              $('.footable').footable();

  function getDetails(){
  $.ajax({
    url: '/api/getDetailsSell',
    headers: {
        'Authorization':'Bearer '+token,
        'Content-Type':'application/json'
    },
    method: 'GET',
    dataType: 'json',
    success: function(data){
        var id = data['seller']['id'];
       var name = data['seller']['name'];
       var surname = data['seller']['surname'];
       var email = data['seller']['email'];
       var img = data['seller']['avatar'];
       document.getElementById("welcomes").innerHTML = 'ยินดีต้อนรับคุณ : '+name+' '+surname;
       document.getElementById("nn").innerHTML = ' '+name+' '+surname;
       $('#img').append('<img  alt="image" class="img-circle img-48" src="'+img+'" />');

    }
  });
}




  function checksession()
  {
    var token = localStorage.getItem("a_token");
    if(token == null)
    {
      alert('กรุณา Login ก่อนเข้าใช้งาน !');
      window.location.replace('/admin');
    }
  }
  function load()
  {
    checksession();
  }
  var admin_token = localStorage.getItem("a_token");
  $("#logout").click(function(){
    $.ajax({
      url: '/api/logoutAdmin',
      headers: {
        'Authorization':'Bearer '+admin_token,
        'Content-Type':'application/json'
      },
      method: 'GET',
      dataType: 'json',
      success: function(data){
        console.log(data);
        console.log("logout");
        alert("ออกจากระบบแล้ว !");
        localStorage.removeItem("a_token");
        localStorage.removeItem("username");
        localStorage.removeItem("admin_id");
        window.location.replace('/admin');
      }
    });
  });


  window.onload = load;

</script>
</body>
</html>
