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
      <form class="form-login" action="/slim-api/password_change" method="POST">
        <h2 class="form-login-heading">User check</h2>
        <div class="login-wrap">
          <?php if(isset($error)) : echo '<span style="color:red;text-align:center;">'.$error.'</span>'; endif; ?>
          <input type="text" name="user_id" class="form-control" placeholder="User ID" autofocus>
          <br>
          <input type="password" name="user_password" class="form-control" placeholder="Password">
          <hr>
          <input type="password" name="change_password1" class="form-control" placeholder="Password to change">
          <br>
          <input type="password" name="change_password2" class="form-control" placeholder="Confirm Password">
          <hr>
          <button name = "password_change_btn" class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> Change Password</button>
          <button class="btn btn-theme btn-block" type="button" onClick="location.href='index.php';">CANCEL</button>
        </div>
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
