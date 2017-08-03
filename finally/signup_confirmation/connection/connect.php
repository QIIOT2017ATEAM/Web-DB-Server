<?php

try{
        $db = new PDO("mysql:host=localhost;dbname=A-Database","root","12345678");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
}
catch(PDOException $e){
        echo "Sorry Error: " .$e->getMessage();

}
 ?>
