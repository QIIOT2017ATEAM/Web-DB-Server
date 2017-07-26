<?php session_start(); ?>
<?php
include 'signup_confirmation/connection/connect.php';

//회원가입, 중복체크해야함
        $user_id = $_POST['user_id'];
        $user_password = $_POST['user_password'];
        //$hash_password = password_hash($user_password, PASSWORD_DEFAULT);

        //우선 아이디부터 검색한다.
        $query = "SELECT * FROM User_Data WHERE User_ID = :user_id";
        $sth = $db->prepare($query);
        $sth->bindValue(':user_id',$user_id);
        $sth->execute();

        //결과값을 배열로 가져온다.
        $users = $sth->fetch();
        if(isset($users[0]))
        {
            //echo $users['password'];
            /*
            $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
             Varchar는 45 보다 커야한다 흑흑
            echo $hash_password;
            var_dump(password_verify($user_password, $hash_password));

            echo $users['User_Password'];
            var_dump(password_verify($user_password, $users['User_Password']));
            //true
            */

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
            //echo "No ID";
        }

        //참조 : https://stackoverflow.com/questions/29777684/how-do-i-use-password-hashing-with-pdo-to-make-my-code-more-secure
/*
        //결과값 가져오기
        $num_rows = $sth->fetchColumn();
        if($num_rows !=0)
        {
            echo "Success Login!";
        }
        else
        {
            echo "Login Fail!";
        }
*/
?>
