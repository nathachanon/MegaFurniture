<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Brand : MEGA Furniture</title>
  <link href="css/plugins/slick/slick.css" rel="stylesheet">
  <link href="css/plugins/slick/slick-theme.css" rel="stylesheet">
  <link href="css/plugins/footable/footable.core.css" rel="stylesheet">
  <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
  <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
  <link href="css/plugins/dropzone/basic.css" rel="stylesheet">
  <link href="css/plugins/dropzone/dropzone.css" rel="stylesheet">
  <link href="css/plugins/switchery/switchery.css" rel="stylesheet">
  <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">


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
            </span> <span class="text-muted text-xs block ">seller</span> </span> </a>

          </div>
          <div class="logo-element">
            IN+
          </div>

        </li>
        <li>
          <a href="profile"><i class="fa fa-users"></i> <span class="nav-label">Profile</span></a>
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
              <i class="fa fa-sign-out"></i> Log out
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
    <div class="footer">
      <div>
        <strong>Copyright</strong> MEGA Furniture © 2019
      </div>
    </div>

  </div>
</div>




</body>
<!-- Mainly scripts -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>
<script src="js/plugins/dataTables/datatables.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- DROPZONE -->
<script src="js/plugins/dropzone/dropzone.js"></script>

<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>
<script src="js/plugins/footable/footable.all.min.js"></script>
<script src="js/plugins/slick/slick.min.js"></script>
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

$("#logout").click(function(){
    var token = localStorage.getItem("user_token");
    $.ajax({
      url: '/api/logoutSell',
      headers: {
        'Authorization':'Bearer '+token,
        'Content-Type':'application/json'
      },
      method: 'GET',
      dataType: 'json',
      success: function(data){
        alert("ออกจากระบบแล้ว !");
        document.cookie = 'b_id=; Max-Age=-99999999;';
        document.cookie = 'product_id=; Max-Age=-99999999;';
        document.cookie = 'view_id=; Max-Age=-99999999;';
        localStorage.removeItem("b_id");

        localStorage.removeItem("user_token");
        window.location.replace('/login');
      }
    });
  });
</script>
</body>
</html>
