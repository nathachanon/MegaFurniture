<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Profile Seller : SB MarketPlace</title>
  <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

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

        <li class='active'>
          <a href="profile"><i class="fa fa-users"></i> <span class="nav-label">Profile</span></a>
        </li>
         <li id="brand-nav" >
          <a href="brand"><i class="fa fa-users"></i> <span class="nav-label">Brand</span></a>
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
        <strong>Copyright</strong> SB MarketPlact © 2019
      </div>
    </div>

  </div>
</div>


<!-- Mainly scripts -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>
<script>
  $(document).ready(function () {
    $('.i-checks').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
    });
  });
</script>
</body>
</html>
