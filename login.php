<?php
error_reporting(0);
include 'signup_confirmation/connection/connect.php';
include 'signup_confirmation/helper/nonce.php';
include 'signup_confirmation/helper/randomstring.php';

$error = $_GET["error"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

  <title>login</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <!--external css-->
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/style-responsive.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>

  <!-- **********************************************************************************************************************************************************
  MAIN CONTENT
  *********************************************************************************************************************************************************** -->

  <div id="login-page">
    <div class="container">
      <form class="form-login" action="/slim-api/login" method="POST">
        <h2 class="form-login-heading">Login ID</h2>
        <div class="login-wrap">
          <?php if(isset($error)) : echo '<span style="color:red;text-align:center;">'.$error.'</span>'; endif; ?>
          <input type="text" name="user_id" class="form-control" placeholder="User ID" autofocus>
          <br>
          <input type="password" name="user_password" class="form-control" placeholder="Password">
          <label class="checkbox">
            <span class="pull-right">
              <a data-toggle="modal" href="login.php#myModal">forgot password?</a>
            </span>
          </label>
          <!--로그인 버튼 누르는 곳 -->
          <button name = "login_btn" class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
          <button class="btn btn-theme btn-block" type="button" onClick="location.href='index.php';">CANCEL</button>
          <hr>

          <div class="registration">
            Don't have an account yet?<br/>
            <a class="" href="sign_up.php">
              Create an account
            </a>
          </div>

        </div>

        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forgot Password ?</h4>
              </div>
              <div class="modal-body">
                <p>Enter your e-mail address below to reset your password.</p>
                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

              </div>
              <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                <button name = "forgot_password_btn" class="btn btn-theme" type="submit">Submit</button>
              </div>
            </div>
          </div>
        </div>
        <!-- modal -->

      </form>
      
    </div>
  </div>

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
  <script>
  $.backstretch("assets/img/login-bg.jpg", {speed: 500});
  </script>


</body>
</html>
