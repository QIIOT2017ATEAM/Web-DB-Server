<?php
//회원가입, 중복체크해야함
$dbh = new PDO('mysql:host=localhost;dbname=opentutorials', 'root', '12345678', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        $user_id = $_POST['user_id'];
        $user_password = $_POST['user_password'];

        //쿼리 지정
        $query = "SELECT COUNT(*) FROM User_Data WHERE User_ID = :user_id AND User_Password=:user_password";
        //쿼리 준비
        $sth = $dbh->prepare($query);
        //쿼리 변수넣기
        $sth->bindValue(':user_id',$user_id);
        $sth->bindValue(':user_password',$user_password);
        //쿼리 실행
        $sth->execute();

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

?>