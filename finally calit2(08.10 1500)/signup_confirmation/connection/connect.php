<?php
try{
        $db = new PDO("mysql:host=127.0.0.1;dbname=teama2017","teama-iot","alpha9374");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
}
catch(PDOException $e){
        echo "Sorry Error: " .$e->getMessage();

}
 ?>
