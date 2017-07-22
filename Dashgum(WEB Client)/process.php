<?php
//호스트 네임
$mysql_hostname = 'localhost';
//서버 사용자 계정 이름
$mysql_username = 'root';
//서버 사용자 계정 비밀번호
$mysql_password = '12345678';
//사용할 데이터베이스 이름 선언
$mysql_database = 'opentutorials'; //기존 PHP에서 데이터베이스 선택은 mysql_select_db('opentutorials');
//포트넘버와 사용할 언어
$mysql_port = '3306';
$mysql_charset = 'utf8';

//$host = 'localhost';
//$id = "root";
//$password = '12345678';
// PHP Connect : mysql_connect('localhost', 'root', '12345678');
// PDO Connect 시작
$dsn = 'mysql:host='.$mysql_hostname.';dbname='.$mysql_database.';port='.$mysql_port.';charset='.$mysql_charset;
try
{
    //connect 시도, 실패시 catch로 간다.
	$connect = new PDO( $dsn, $mysql_username, $mysql_password );
}
catch ( PDOException $e )
{
    //connect 실패시 $e의 에러메세지를 출력
	echo 'Connect failed : ' . $e->getMessage() . '<br>';
	return false;
}
//***PDO Connect 끝


//INSERT INTO topic (title, description, created) VALUES ('"<div class="mysql_r"></div>eal_escape_string($_POST['title'])."', '".mysql_real_escape_string($_POST['description'])."', now())
        //$page = $pdo->quote($_GET['title']);

        // 변수선언. 이 부분은 PHP와 다를 바 없다.
        $user_id = $_POST['user_id'];    
        $user_password = $_POST['user_password'];

        //2. 변수를 colon(:)붙여서 사용
        $query = "INSERT INTO User_Data (User_ID, User_Password, created) VALUES (:user_id, :user_password, now())";
        // $query문 끝의 now()는 데이터베이스의 시간을 입력하게 하려고 넣은것이다. 서버의 시간을 넣고싶다면 $now_value = time();을 사용하면 된다.
        //Prepare 해준다.
        $sth = $connect->prepare($query);
       
        //위의 $query에서 변수 처리 해 준 부분을 집어 넣어준다.
        $sth->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $sth->bindValue(':user_password', $user_password, PDO::PARAM_STR);
        $sth->execute();

        
//
switch($_POST['mode'])
{
    case 'insert':
        //INSERT INTO topic (title, description, created) VALUES ('"<div class="mysql_r"></div>eal_escape_string($_POST['title'])."', '".mysql_real_escape_string($_POST['description'])."', now())
        //$page = $pdo->quote($_GET['title']);

        // 변수선언. 이 부분은 PHP와 다를 바 없다.
        $user_id = $_POST['user_id'];    
        $user_password = $_POST['user_password'];

        //2. 변수를 colon(:)붙여서 사용
        $query = "INSERT INTO User_Data (User_ID, User_Password, created) VALUES (:user_id, :user_password, now())";
        // $query문 끝의 now()는 데이터베이스의 시간을 입력하게 하려고 넣은것이다. 서버의 시간을 넣고싶다면 $now_value = time();을 사용하면 된다.
        //Prepare 해준다.
        $sth = $connect->prepare($query);
       
        //위의 $query에서 변수 처리 해 준 부분을 집어 넣어준다.
        $sth->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $sth->bindValue(':user_password', $user_password, PDO::PARAM_STR);
        $sth->execute();

        //PDO에서 아래의 query는 데이터베이스에서 값을 받을때만 쓴다. 회원가입처럼 INSERT INTO 하는 경우는 보통 $sth->execute();로 쿼리문이 끝나게 된다.
        //$result = $connect->query($query) or die($connect->errorInfo());
        //header("Location: list.php"); 


        //기존의 소스(PHP)
        //case 'insert':
        //$result = mysql_query("INSERT INTO topic (title, description, created) VALUES ('".mysql_real_escape_string($_POST['title'])."', '".mysql_real_escape_string($_POST['description'])."', now())");
        //header("Location: list.php"); 
        //break;
    case 'delete':
        mysql_query('DELETE FROM topic WHERE id = '.mysql_real_escape_string($_POST['id']));
        header("Location: list.php"); 
        break;
    case 'modify':
        mysql_query('UPDATE topic SET title = "'.mysql_real_escape_string($_POST['title']).'", description = "'.mysql_real_escape_string($_POST['description']).'" WHERE id = '.mysql_real_escape_string($_POST['id']));
        header("Location: list.php?id={$_POST['id']}");
        break;
}
?>