<?php
//회원가입, 중복체크해야함
$dbh = new PDO('mysql:host=localhost;dbname=signup_confirm', 'root', '12345678', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        $user_id = $_POST['user_id'];
        $user_password = $_POST['user_password'];
        //$hash_password = password_hash($user_password, PASSWORD_DEFAULT);

        //우선 아이디부터 검색한다.
        $query = "SELECT * FROM users WHERE email = :user_id";
        $sth = $dbh->prepare($query);
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
            if(password_verify($user_password, $users['password']))
            {
                //로그인 성공!
                echo "Success Login!!";
            }
            else
            {
                //비번틀림
                echo "Login Fail!!";
            }
        }
        else
        {
            //아이디 업슴
            echo "No ID";
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