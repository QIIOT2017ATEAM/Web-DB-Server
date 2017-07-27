<?php
include 'signup_confirmation/connection/connect.php';

$nonce = $_GET['nonce'];
echo $nonce;

$query = "SELECT * FROM User_Data WHERE nonce = :nonce";
$sth = $db->prepare($query);
$sth->bindValue(':nonce',$nonce);
$sth->execute();

$users = $sth->fetch();
if(isset($users[0]))
{
    //status 변경
    $status_query = "UPDATE User_Data SET status='1' WHERE nonce = :nonce";
    $status_sth = $db->prepare($status_query);
    $status_sth->bindValue(':nonce',$nonce);
    $status_sth->execute();
    echo "Success";

    echo("<script>location.replace('./activation_success.html');</script>"); 
}
else
{
    echo "Fail";

    echo("<script>location.replace('./activation_fail.html');</script>"); 
}

?>