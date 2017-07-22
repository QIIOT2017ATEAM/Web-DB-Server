<?php
//회원가입, 중복체크해야함
$dbh = new PDO('mysql:host=localhost;dbname=opentutorials', 'root', '12345678', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        $user_id = $_POST['user_id'];
        $user_password = $_POST['user_password'];
        $user_name = $_POST['user_name'];
        $user_age = $_POST['user_age'];
        var_dump($user_name);
        $sth = $dbh->prepare("INSERT INTO User_Data (User_ID, User_Password, User_Name, User_Age, created) VALUES (:user_id, :user_password, :user_name, :user_age, now())");
        $sth->bindValue(':user_id',$user_id);
        $sth->bindValue(':user_password',$user_password);
        $sth->bindValue(':user_name',$user_name);
        $sth->bindValue(':user_age',$user_age);
        $sth->execute();
?>