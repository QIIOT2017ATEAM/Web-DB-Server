<?php
include 'signup_confirmation/helper/function.php';
include 'signup_confirmation/connection/connect.php';
if(isset($_POST['create_account'])){
    $error = '';
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);
    $gender = trim($_POST['gender']);
    if(empty($first_name) || empty($last_name) || empty($email) || empty($password)
    || empty($confirm) || empty($gender)) {
      $error = "<div class='text-danger'>Please fill out the form!</div>";
    }else{
        $pattren = "/^[a-zA-Z ]+$/";
        if(preg_match($pattren, $first_name)){
          if(preg_match($pattren, $last_name)){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
              if(strlen($password) > 4 && strlen($confirm) >4){
                if($password == $confirm){
                  $Check_Email = $db->prepare("SELECT email FROM users WHERE email = ?"
                );
                  $Check_Email->execute([$email]);
                  if($Check_Email->rowCount() == 1){
                    $error = "<div class='text-danger'>Sorry this email is already
                      exist!</div>";
                  }else{
                    $code = rand();
                    $status = 0;
                    try{
                    $Insert_Query = $db->prepare("INSERT INTO users(
                      first_name,last_name,email,password,gender,code,status)
                      VALUES(?,?,?,?,?,?,?)");
                    $Insert_Query->execute([$first_name,$last_name,$email,
                      password_hash($password,PASSWORD_DEFAULT),$gender,$code,
                      $status]);
                    send_code($code,$email);
                  }
                  catch(PDOException $e){
                      echo "Sorry" .$e->getMessage();
                  }
                  }
                }else{
                  $error = "<div class='text-danger'>Password is not matched</div>";
                }
              }else {
                  $error = "<div class='text-danger'>Your Password is too weak!</div>";
              }
            }else{
            $error = "<div class='text-danger'>Your Email is invaild!</div>";
            }
          }else{
            $error = "<div class='text-danger'>Last name must be character!</div>";
          }
        }else{
            $error = "<div class='text-danger'>First name must be character!</div>";
        }
    }
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Signup Confirmation</title>
<link rel="stylesheet" href="signup_confirmation/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="signup_confirmation/bootstrap/css/custom.css">
</head>
<body>
  <div class="container" style="margin-top: 50px;">
    <div class="row">
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
              <span>Create User Account</span>
              <span class="glyphicon glyphicon-pencil c-pencil pull-right"></span>
          </div><!-- end panel-heading-->
          <div class="panel-body">
              <form action="" method="POST">
              <div class="form-group">
                  <?php if(isset($error)): echo $error; endif; ?>
              </div><!-- end form-group -->
                  <div class="form-group">
                      <input type="text" name="first_name" class="form-control"
                      placeholder="Enter First Name..."  value="<?php if(isset($first_name))
                      : echo $first_name; endif;?>">
                  </div><!-- end form-group-->
                  <div class="form-group">
                      <input type="text" name="last_name" class="form-control"
                      placeholder="Enter Last Name..." value="<?php if(isset($last_name))
                      : echo $last_name; endif;?>">
                  </div><!-- end form-group-->
                  <div class="form-group">
                      <input type="text" name="email" class="form-control"
                      placeholder="Enter Email..." value="<?php if(isset($email))
                      : echo $email; endif;?>">
                  </div><!-- end form-group-->
                  <div class="form-group">
                      <input type="password" name="password" class="form-control"
                      placeholder="Choose Your Password..." value="<?php if(isset($password))
                      : echo $password; endif;?>">
                  </div><!-- end form-group-->
                  <div class="form-group">
                      <input type="password" name="confirm" class="form-control"
                      placeholder="Confirm Password" value="<?php if(isset($confirm))
                      : echo $confirm; endif;?>">
                  </div><!-- end form-group-->
                  <div class="form-group">
                      <select name="gender" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                  </div><!-- end form-group-->
                  <div class="form-group">
                        <input type="submit" name="create_account" class="btn
                        btn-success btn-block" value="Create Account">
                  </div><!-- end form-group-->
              </form><!--end form-->
          </div><!-- end panel-body-->
        </div><!--end panel-default-->
      </div><!--end col-md-4 -->
    </div><!-- end container-->
  </div><!-- end container-->

<script type="text/javascript" src="signup_confirmation/bootstrap/js/jquery.min.js"></script>
<script type="text/javascript" src="signup_confirmation/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
