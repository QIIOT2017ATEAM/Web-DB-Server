<?php
include 'signup_confirmation/helper/function.php';
$db = new PDO('mysql:host=localhost;dbname=A-Database', 'root', '12345678', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

if(isset($_POST['sign_up_btn']))
{
	$error = '';
	$user_id = trim($_POST['user_id']);
	$user_password = trim($_POST['user_password']);
	$confirm_password = trim($_POST['confirm_password']);
	$hash_password = password_hash($user_password, PASSWORD_DEFAULT);
	$user_name = trim($_POST['user_name']);
	$user_birthday = trim($_POST['user_birthday']);
	if(empty($user_id) || empty($user_password) || empty($confirm_password) || empty($user_name) || empty($user_birthday))
	{
		$error = "<div class='text-danger'>Please fill out the form!</div>";
	}
	else
	{
		$pattren = "/^[a-zA-Z ]+$/";
		if(filter_var($user_id, FILTER_VALIDATE_EMAIL))
		{
			if(strlen($user_password) > 4 && strlen($confirm_password) > 4)
			{
				if($user_password == $confirm_password)
				{
					//echo $user_id;
					$Check_Email = $db->prepare("SELECT User_ID FROM User_Data WHERE User_ID = :user_id");
					$Check_Email->bindValue(':user_id',$user_id);
					$Check_Email->execute();

					if($Check_Email->rowCount() == 1)
					{
                    	$error = "<div class='text-danger'>Sorry, This E-mail is already exist!</div>";
                  	}
					else
					{
						try
						{
							$Insert_Query = $db->prepare("INSERT INTO User_Data (User_ID, User_Password, User_Name, User_Birthday) VALUES (:user_id, :user_password, :user_name, :user_birthday)");

	        				$Insert_Query->bindValue(':user_id',$user_id);
    	    				$Insert_Query->bindValue(':user_password',$hash_password);
        					$Insert_Query->bindValue(':user_name',$user_name);
        					$Insert_Query->bindValue(':user_birthday',$user_birthday);
        					$Insert_Query->execute();

							//아래 send_code는 Link가 되어야한다. 해당 부분 구현해야함.
							send_code($code,$user_id);
							//가입성공 화면전환할것.
						}
						catch(PDOException $e)
						{
                      		echo "Sorry" .$e->getMessage();
                  		}
					}
				}
				else
				{
					"<div class='text-danger'>Password is not matched!</div>";
				}
			}
			else
			{	
				$error = "<div class='text-danger'>Your Password is too weak!</div>";
			}
		}
		else
		{
			$error = "<div class='text-danger'>Your ID(E-mail) is invaild!</div>";
		}
	}
}

/*
회원가입, 중복체크해야함
 기존 회원가입 코드
$dbh = new PDO('mysql:host=localhost;dbname=opentutorials', 'root', '12345678', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        echo $user_id = $_POST['user_id'];
        echo $user_password = $_POST['user_password'];
        echo $hash_password = password_hash($user_password, PASSWORD_DEFAULT);        
        echo $user_name = $_POST['user_name'];
        echo $user_age = $_POST['user_age'];
        
        $sth = $dbh->prepare("INSERT INTO User_Data (User_ID, User_Password, User_Name, User_Age, created) VALUES (:user_id, :user_password, :user_name, :user_age, now())");
        
        $sth->bindValue(':user_id',$user_id);
        $sth->bindValue(':user_password',$hash_password);
        $sth->bindValue(':user_name',$user_name);
        $sth->bindValue(':user_age',$user_age);
        $sth->execute();
*/
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>DASHGUM - Bootstrap Admin Template</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
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

	  <div id="sign_up-page">
	  	<div class="container">
	  	
		      <form name = "user_login" class="form-sign_up" action="" method="POST">
		        <h2 class="form-sign_up-heading">register id now</h2>
		        <div class="sign_up-wrap">
					<?php if(isset($error)) : echo $error; endif; ?>
		            <input type="text" name="user_id" class="form-control" placeholder="Enter ID(E-mail)..." 
							value = "<?php if(isset($user_id)) : echo $user_id; endif;?>" autofocus>
					<br>
		            <input type="password" name="user_password" class="form-control" placeholder="Enter Password..."
							value = "<?php if(isset($user_password)) : echo $user_password; endif;?>">
					<b4> Password is least 4 characters in length.</b4>
					<br>
					<input type="password" name = "confirm_password" class="form-control" placeholder="Enter Confirm Password..."
							value = "<?php if(isset($confirm_password)) : echo $confirm_password; endif;?>">
					<br>
		            <input type="text" name="user_name" class="form-control" placeholder="Enter Name..."
							value = "<?php if(isset($user_name)) : echo $user_name; endif;?>">
					<br>
					<input type="text" name="user_birthday" class="form-control" placeholder="Enter Birthday..."
							value = "<?php if(isset($user_birthday)) : echo $user_birthday; endif;?>">
					<b4> Birthday is "0000-00-00"</b4>
								<!--여기 아래에 회원가입 정보를 보낼 쿼리문을 넣던가, 아니면 다른 html 혹은 php 창을 만든 뒤 창을 바꿔준다. -->
		            <button name = "sign_up_btn" class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN UP</button>
		        </div>
		
		          <!-- Modal 아래는 Forgot Password?를 누르면 나오는 창이다.-->
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
		                          <button class="btn btn-theme" type="button">Submit</button>
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
