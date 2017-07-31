<?php
    include 'signup_confirmation/connection/connect.php';
    include 'signup_confirmation/helper/nonce.php';

    //email 다시 받음
    $email = $_POST['email'];
    echo isset($email);

    //email 찾기
    $query = "SELECT * FROM User_Data WHERE User_ID = :user_id";
    $sth = $db->prepare($query);
    $sth->bindValue(':user_id',$email);
    $sth->execute();

    //결과를 리스트화
    $users = $sth->fetch();

    //이메일이 있다면.
    if(isset($users[0]))
    {
        $nonce = $users['nonce'];
        send_code($nonce,$users['User_ID']);
        echo("<script>location.replace('./activation_fail_resend_mail.html');</script>"); 
    }
    //이메일이 없다면.
    else
    {
        //echo("<script>location.replace('./activation_success.html');</script>");
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

            <title>Active ID Success</title>

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
              <form class="form-login" action="./activation_fail.php" method="POST">
		        <h2 class="form-login-heading">Error</h2>
		        <div class="login-wrap">
                    <!--Your account could not be activated. Please check the link that was emailed.-->
                    <h4 class="form-login-heading"style="text-align:center">Check This:</h4>
                    <h4 class="form-login-heading"style="text-align:center">1)Account could not be activated.</h4>
                    <h4 class="form-login-heading"style="text-align:center">Check the link that was emailed.</h4>
                    <h4 class="form-login-heading"style="text-align:center">2)Can't Find your ID(E-mail)</h4>
                    <br>
								<!--로그인 버튼 누르는 곳 -->
                    <button class="btn btn-theme btn-block" type="button" onClick="location.href='index.html';">Back to Main</button>
                    <hr>
                    <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Didn't you get email?</a>

		                </span>
					</label>

                    <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Didn't you get email?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to receive your link.</p>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                  <button class="btn btn-theme" type="submit">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
                                 
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