<?php
    header("Content-Type: text/html;charset=UTF-8");
    $conn = mysqli_connect("127.0.0.1","teama-iot","alpha9374","teama2017");
    $data_stream = "'".$_POST['Data1']."','".$_POST['Data2']."','".$_POST['Data3']."'";
    $query = "insert into jsy(Data1,Data2,Data3) values (".$data_stream.")";
    $result = mysqli_query($conn, $query);
     
    if($result)
      echo "1";
    else
      echo "-1";
     
    mysqli_close($conn);
    //출처: http://twinw.tistory.com/29 [흰고래의꿈]
?>