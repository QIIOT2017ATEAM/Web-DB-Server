<?php
//회원가입, 중복체크해야함
$dbh = new PDO('mysql:host=localhost;dbname=opentutorials', 'root', '12345678', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        $user_id = $_POST['user_id'];
        $user_password = $_POST['user_password'];
        $sth = $dbh->prepare("INSERT INTO User_Data (User_ID, User_Password, created) VALUES (:user_id, :user_password, now())");
        $sth->bindValue(':user_id',$user_id);
        $sth->bindValue(':user_password',$user_password);
        $sth->execute();
?>