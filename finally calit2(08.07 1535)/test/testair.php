<?php
    include '../signup_confirmation/connection/connect.php';

    $json = $app->request->getBody();
    var_dump($json);

/*
    $MACaddress = $_POST['MACaddress'];
    $datetime = $_POST['datetime'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $co = $_POST['co'];
    $co2 = $_POST['co2'];
    $so2 = $_POST['so2'];
    $o3 = $_POST['o3'];
    $pm25 = $_POST['pm25'];
    $temperature = $_POST['temperature'];

    $Insert_Query = $db->prepare("INSERT INTO udoo_data (MACaddress, datetime, lat, lng, co, co2, so2, o3, pm25, temperature) 
    VALUES (:MACaddress, :datetime, :lat, :lng, :co, :co2, :so2, :o3, :pm25, :temperature)");

    $Insert_Query->bindValue(':MACaddress',$MACaddress);
    $Insert_Query->bindValue(':datetime',$datetime);
    $Insert_Query->bindValue(':lat',$lat);
    $Insert_Query->bindValue(':lng',$lng);
    $Insert_Query->bindValue(':co',$co);
    $Insert_Query->bindValue(':co2',$co2);
    $Insert_Query->bindValue(':so2',$so2);
    $Insert_Query->bindValue(':o3',$o3);
    $Insert_Query->bindValue(':pm25',$pm25);
    $Insert_Query->bindValue(':temperature',$temperature);
    $Insert_Query->execute();
    */
?>