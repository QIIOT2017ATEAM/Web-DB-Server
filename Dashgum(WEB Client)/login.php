<?php
include 'signup_confirmation/connection/connect.php';

        $user_id = $_POST['user_id'];
        $user_password = $_POST['user_password'];
        //$hash_password = password_hash($user_password, PASSWORD_DEFAULT);

        $query = "SELECT * FROM User_Data WHERE User_ID = :user_id";
        $sth = $db->prepare($query);
        $sth->bindValue(':user_id',$user_id);
        $sth->execute();

        //결과값을 배열로 가져온다.
        $users = $sth->fetch();
        if(isset($users[0]))
        {

            if(password_verify($user_password, $users['User_Password']))
            {
                //로그인 성공!
                 $_SESSION['user_id'] = $user_id;
                 ?>
                <meta http-equiv="refresh" content="0;url=http://192.168.33.66/index.html">
                <?php
            }
            else
            {
                //비번틀림
                echo "<script>alert(\"Please check your ID or Password\");</script>";
                ?>
                <meta http-equiv="refresh" content="0;url=http://192.168.33.66/login.html">
                <?php
            }
        }
        else
        {
            echo "<script>alert(\"Please check your ID or Password\");</script>";
            ?>
            <meta http-equiv="refresh" content="0;url=http://192.168.33.66/login.html">
            <?php
            //아이디 업슴
        }

?>
