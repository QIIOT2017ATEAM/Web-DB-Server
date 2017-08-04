<?php
//PHPMailer include slim start
$app->post('/send-email', function () use ($app) {
  include "db_functions.php";
  include '../signup_confirmation/connection/connect.php';
  include '../signup_confirmation/helper/nonce.php';
  include '../signup_confirmation/helper/randomstring.php';

  $user_id = $_POST['user_id'];
  $user_password = $_POST['user_password'];
  $confirm_password = $_POST['confirm_password'];
  $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $user_birthday = $_POST['user_birthday'];

  if(isset($_POST['sign_up_btn']))
  {
    if(empty($user_id) || empty($user_password) || empty($confirm_password) || empty($first_name) || empty($last_name) || empty($user_birthday))
    {
      //$error = "<div class='text-danger'>Please fill out the form!</div>";

      $error = "Please fill out the form!";
      echo("<script>location.replace('../sign_up.php?error=".$error."');</script>");
    }
    else
    {
      $pattren = "/^[a-zA-Z ]+$/";
      if(filter_var($user_id, FILTER_VALIDATE_EMAIL))
      {
        if(strlen($user_password) > 4 && strlen($confirm_password) > 4)
        {
          if($user_password == $confirm_password)
          {
            //echo $user_id;
            $Check_Email = $db->prepare("SELECT user_id FROM User_Data WHERE user_id = :user_id");
            $Check_Email->bindValue(':user_id',$user_id);
            $Check_Email->execute();

            if($Check_Email->rowCount() == 1)
            {
              $error = "Sorry, This E-mail is already exist!";
              echo("<script>location.replace('../sign_up.php?error=".$error."');</script>");
            }
            else
            {
              try
              {

                //모든 조건이 만족됨. 따라서 exit; 하면됨
                $nonce = generateRandomString();
                $Insert_Query = $db->prepare("INSERT INTO User_Data (user_id, user_password, first_name, last_name, user_birthday, nonce, status) VALUES (:user_id, :user_password, :first_name, :last_name, :user_birthday, :nonce, '0')");

                $Insert_Query->bindValue(':user_id',$user_id);
                $Insert_Query->bindValue(':user_password',$hash_password);
                $Insert_Query->bindValue(':first_name',$first_name);
                $Insert_Query->bindValue(':last_name',$last_name);
                $Insert_Query->bindValue(':user_birthday',$user_birthday);
                $Insert_Query->bindValue(':nonce',$nonce);
                $Insert_Query->execute();

                send_code($nonce,$user_id);

                //echo "<script>location.replace('/slim-api/send-email');</script>";
              }
              catch(PDOException $e)
              {
                echo "Sorry" .$e->getMessage();
              }
            }
          }
          else
          {
            $error = "Password is not matched!";
            echo("<script>location.replace('../sign_up.php?error=".$error."');</script>");
          }
        }
        else
        {
          $error = "Your Password is too weak!";
          echo("<script>location.replace('../sign_up.php?error=".$error."');</script>");
        }
      }
      else
      {
        $error = "Your ID(E-mail) is invaild!";
        echo("<script>location.replace('../sign_up.php?error=".$error."');</script>");
      }
    }
  }
});
//PHPMailer include slim end

//PHPMailer include slim start
$app->post('/activation_fail', function () use ($app)
{
  include "db_functions.php";
  include '../signup_confirmation/connection/connect.php';
  include '../signup_confirmation/helper/nonce.php';
  include '../signup_confirmation/helper/randomstring.php';

  $email = $_POST['email'];

  //email 찾기
  $query = "SELECT * FROM User_Data WHERE user_id = :user_id";
  $sth = $db->prepare($query);
  $sth->bindValue(':user_id',$email);
  $sth->execute();

  //결과를 리스트화
  $users = $sth->fetch();

  //이메일이 있다면.
  if(isset($users[0]))
  {
    $nonce = $users['nonce'];
    send_code($nonce,$users['user_id']);
    //echo("<script>location.replace('/activation_check_email.html');</script>");
  }
  //이메일이 없다면.
  else
  {
    //아무것도 없어야 한다. 그래야 error 나옴.
    //echo("<script>location.replace('/activation_check_email.html');</script>");
  }
});
//PHPMailer include slim end

//Login in slim
$app->post('/login', function () use ($app) {
  //session_destroy();
  include "db_functions.php";
  include '../signup_confirmation/connection/connect.php';
  include '../signup_confirmation/helper/nonce.php';
  include '../signup_confirmation/helper/randomstring.php';

  $user_id = $_POST['user_id'];
  $user_password = $_POST['user_password'];

  if(isset($_POST['login_btn']))
  {
    if(empty($user_id) || empty($user_password))
    {
      //$error = "<div class='text-danger'>Please fill out the form!</div>";
      $error = "Please fill out the form!";
      echo("<script>location.replace('../login.php?error=".$error."');</script>");
    }
    else
    {
      //First, Serch ID
      $query = "SELECT * FROM User_Data WHERE user_id = :user_id";
      $sth = $db->prepare($query);
      $sth->bindValue(':user_id',$user_id);
      $sth->execute();

      //결과값을 배열로 가져온다.
      $users = $sth->fetch();
      if(isset($users[0]))
      {
        //password right
        if(password_verify($user_password, $users['user_password']))
        {
          //status == 1\
          if($users['status'] == '1')
          {
            //login success
            session_start();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_password'] = $user_password;
            $_SESSION['first_name'] = $users['first_name'];
            echo("<script>location.replace('../index.php');</script>");
          }
          //status == 0
          else
          {
            //login fail
            echo("<script>location.replace('../activation_fail.php');</script>");
          }
        }
        //password worng
        else
        {
          echo "<script>alert(\"Please check your ID or Password\");</script>";
          echo("<script>location.replace('../login.php');</script>");
        }
      }
      else
      {
        //No ID;
        echo "<script>alert(\"Please check your ID or Password\");</script>";
        echo("<script>location.replace('../login.php');</script>");
      }
    }
  }
});
//Login in slim end

//heroes-as-json start
$app->get('/heroes-as-json', function () use ($app) {
  include "db_functions.php";

  try {
    $sth = $pdo->prepare('SELECT * FROM superheroes');
    $sth->execute();

    $result = $sth->fetchAll();
    /*
    var citymap = {
    chicago: {
    center: {lat: 41.878, lng: -87.629},
    population: 2714856
  },
  */
  if ($result) {
    $person_array = [];
    foreach ($result as $person) {
      //$person_array[] = array($person['codename'] => array("center" => array("lat" => $person['lat'], "lng" => $person['lng']), "population" => "20000000"));
      $person_array[$person['codename']] = array("center" => array(  "lat" => $person['lat'],
      "lng" => $person['lng']),
      "population" => "20");
    }
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setStatus(200);
    return $app->response->write(json_encode($person_array, JSON_NUMERIC_CHECK));
  } else {
    $app->response->setStatus(404);
  }
} catch (Exception $e) {
  $app->response->setStatus(400);
  return $app->response;
}
});
//heroes-as-json end

//air-as-json start
$app->get('/air-as-json', function () use ($app) {
  include "db_functions.php";

  try {
    $sth = $pdo->prepare('SELECT * FROM udoo_data');
    $sth->execute();

    $result = $sth->fetchAll();
    /*
    var citymap = {
    chicago: {
    center: {lat: 41.878, lng: -87.629},
    population: 2714856
  },
  */
  if ($result) {
    $person_array = [];
    foreach ($result as $person) {
      //$person_array[] = array($person['codename'] => array("center" => array("lat" => $person['lat'], "lng" => $person['lng']), "population" => "20000000"));
      $person_array[] = array(
      "lat" => $person['lat'],
      "lng" => $person['lng'],
      "co" => $person['co'],
      "no2" => $person['no2'],
      "so2" => $person['so2'],
      "o3" => $person['o3'],
      "pm25" => $person['pm25'],
      "temperature" => $person['temperature']
    );
  }
  $app->response->headers->set('Content-Type', 'application/json');
  $app->response->setStatus(200);
  return $app->response->write(json_encode($person_array, JSON_NUMERIC_CHECK));
} else {
  $app->response->setStatus(404);
}
} catch (Exception $e) {
  $app->response->setStatus(400);
  return $app->response;
}
});
//air-as-json start

$app->get('/my-map', function () use ($app) {
  // if you want to pass variables to the template, put them in $data.
  // on the template page, you can use $foo
  $data = array('foo'=>'bar');
  $app->render('maps_charts/my-map.phtml', $data);
});

// This is a map of US with 4 red circles. hardcoded cities. does not use json
$app->get('/example-map', function () use ($app) {
  $app->render('maps_charts/example-map.phtml');
});

$app->get('/example-chartt', function () use ($app) {
  $app->render('maps_charts/example-chart.phtml');
});

// this outputs the json for the chart
// creating the json dynamically with database results will be tricky for the rows
$app->get('/chartdata-as-json', function () use ($app) {
  $json = '{
    "cols": [
      {"id":"","label":"year","type":"string"},
      {"id":"","label":"sales","type":"number"},
      {"id":"","label":"expenses","type":"number"}
    ],
    "rows": [
      {"c":[{"v":"2001"},{"v":3},{"v":5}]},
      {"c":[{"v":"2002"},{"v":5},{"v":10}]},
      {"c":[{"v":"2003"},{"v":6},{"v":4}]},
      {"c":[{"v":"2004"},{"v":8},{"v":32}]},
      {"c":[{"v":"2005"},{"v":3},{"v":56}]}
    ]
  }';
  $app->response->headers->set('Content-Type', 'application/json');
  $app->response->setStatus(200);
  return $app->response->write($json);
});

$app->get('/newyork-as-json', function () use ($app) {
  include "db_functions.php";

  try {
    $sth = $pdo->prepare('SELECT *, "100" as s1, 150 as s2, 300 as s3, 133 as s4, 83 as s5, 88 as s6 FROM city limit 4');
    $sth->execute();

    $result = $sth->fetchAll();
    /*
    var citymap = {
    chicago: {
    center: {lat: 41.878, lng: -87.629},
    population: 2714856
  },
  */
  if ($result) {
    $person_array = [];
    foreach ($result as $person) {
      //$person_array[] = array($person['codename'] => array("center" => array("lat" => $person['lat'], "lng" => $person['lng']), "population" => "20000000"));
      $person_array[$person['city'] . " " . $person['id']] =
      array("center" => array("lat" => $person['lat'], "lng" => $person['lng']),
      "population" => "2000",
      "city"=>$person['city'],
      "state"=>$person['state'],
      "s1"=>$person['s1'],
      "s2"=>$person['s2'],
      "s3"=>$person['s3'],
      "s4"=>$person['s4'],
      "s5"=>$person['s5'],
      "s6"=>$person['s6']
    );
  }
  $app->response->headers->set('Content-Type', 'application/json');
  $app->response->setStatus(200);
  return $app->response->write(json_encode($person_array, JSON_NUMERIC_CHECK));
} else {
  $app->response->setStatus(404);
}
} catch (Exception $e) {
  $app->response->setStatus(400);
  return $app->response;
}
});

// shows New York. each marker has an info window that show s2 value
$app->get('/newyork-map', function () use ($app) {
  $app->render('maps_charts/newyork-map.phtml');
});

$app->get('/dynamic-chart', function () use ($app) {
  $app->render('maps_charts/dynamic-chart.phtml');
});

$app->get('/dynamic-chart-s1', function () use ($app) {
  $app->render('maps_charts/dynamic-chart-s1.phtml');
});


$app->get('/dynamic_chart_json', function () use ($app) {
  include "db_functions.php";

  try {
    $sth = $pdo->prepare('SELECT * FROM udoo_data');
    $sth->execute();

    $result = $sth->fetchAll();

    if ($result) {
      // build array for Column labels
      $json_array['cols'] = array(
        array('id'=>'', 'label'=>'date/time', 'type'=>'string'),
        array('id'=>'', 'label'=>'O2', 'type'=>'number'),
        array('id'=>'', 'label'=>'SO2', 'type'=>'number'),
        array('id'=>'', 'label'=>'N', 'type'=>'number'),
        array('id'=>'', 'label'=>'Temp', 'type'=>'number'),
        array('id'=>'', 'label'=>'s5', 'type'=>'number'),
        array('id'=>'', 'label'=>'s6', 'type'=>'number'));

        // loop thru the sensor data and build sensor_array
        foreach ($result as $row) {
          $sensor_array = array();
          $sensor_array[] = array('v'=>$row['datetime']);
          $sensor_array[] = array('v'=>$row['s1']);
          $sensor_array[] = array('v'=>$row['s2']);
          $sensor_array[] = array('v'=>$row['s3']);
          $sensor_array[] = array('v'=>$row['s4']);
          $sensor_array[] = array('v'=>$row['s5']);
          $sensor_array[] = array('v'=>$row['s6']);

          // add current sensor_array line to $rows
          $rows[] = array('c'=>$sensor_array);
        }

        // add $rows to $json_array
        $json_array['rows'] = $rows;

        $app->response->headers->set('Content-Type', 'application/json');
        $app->response->setStatus(200);
        return $app->response->write(json_encode($json_array, JSON_NUMERIC_CHECK));
      }

      else {
        $app->response->setStatus(404);
      }
    } catch (Exception $e) {
      $app->response->setStatus(400);

      return $app->response;
    }
  });

  $app->get('/dynamic_chart_separated_json', function () use ($app) {
    include "db_functions.php";

    try {
      $sth = $pdo->prepare('SELECT * FROM udoo_data');
      $sth->execute();

      $result = $sth->fetchAll();

      if ($result) {
        foreach (array("s1"=>'O2', "s2"=>'N', "s3"=>'PM', "s4"=>'Temperature', "s5"=>'SO2', "s6"=>'XYZ') as $sensor=>$sensor_label) {
          // build array for Column labels
          $json_array['cols'] = array(
            array('id'=>'', 'label'=>'date/time', 'type'=>'string'),
            array('id'=>'', 'label'=>$sensor_label, 'type'=>'number'));

            // loop thru the sensor data and build sensor_array
            foreach ($result as $row) {
              $sensor_array = array();
              $sensor_array[] = array('v'=>$row['datetime']);
              $sensor_array[] = array('v'=>$row[$sensor]);

              // add current sensor_array line to $rows
              $rows[] = array('c'=>$sensor_array);
            }

            // add $rows to $json_array
            $json_array['rows'] = $rows;
            $rows = array();

            $master_array[$sensor][] = $json_array;
          }

          $app->response->headers->set('Content-Type', 'application/json');
          $app->response->setStatus(200);
          return $app->response->write(json_encode($master_array, JSON_NUMERIC_CHECK));        }

          else {
            $app->response->setStatus(404);
          }
        } catch (Exception $e) {
          $app->response->setStatus(400);
          return $app->response;
        }
      });
      $app->get('/denny-map', function ($request, $response) {
        return $this->renderer->render($response, 'denny-map.phtml');
      });

      $app->get('/coffee-map', function ($request, $response) {
        return $this->renderer->render($response, 'coffee-map.phtml');
      });

      $app->get('/super-coffee', function ($request, $response) {
        return $this->renderer->render($response, 'super-coffee.phtml');
      });

      $app->get('/parse-json', function ($request, $response) {
        return $this->renderer->render($response, 'parse-json.phtml');
      });


      //Receive JSON part start>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
      $app->post('/receive-air-data', function () use ($app) {
        include '../signup_confirmation/connection/connect.php';

        $json = $app->request->getBody();
        $json_array = json_decode($json, true);

        foreach ($json_array as $line)
        {
          //echo $line['test'];
          //$test = $line['test'];
          $macaddress = $line['macaddress'];
          $datetime = $line['datetime'];
          $lat = $line['lat'];
          $lng = $line['lng'];
          $co = $line['co'];
          $co2 = $line['co2'];
          $so2 = $line['so2'];
          $o3 = $line['o3'];
          $pm25 = $line['pm25'];
          $temperature = $line['temperature'];
        }

        $Insert_Query = $db->prepare("INSERT INTO udoo_data (macaddress, datetime, lat, lng, co, co2, so2, o3, pm25, temperature)
        VALUES (:macaddress, :datetime, :lat, :lng, :co, :co2, :so2, :o3, :pm25, :temperature)");

        $Insert_Query->bindValue(':macaddress',$macaddress);
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
      });

      $app->post('/receive-heart-data', function () use ($app) {
        include '../signup_confirmation/connection/connect.php';

        $json = $app->request->getBody();
        $json_array = json_decode($json, true);

        foreach ($json_array as $line)
        {
          $macaddress = $line['macaddress'];
          $heartbeatvalue = $line['heartbeatvalue'];
          $insertdate = $line['insertdate'];
          $user_num = $line['user_num'];
        }

        $Insert_Query = $db->prepare("INSERT INTO heartbeat_data (macaddress, heartbeatvalue, insertdate, user_num)
        VALUES (:macaddress, :heartbeatvalue, :insertdate, :user_num)");

        $Insert_Query->bindValue(':macaddress',$macaddress);
        $Insert_Query->bindValue(':heartbeatvalue',$heartbeatvalue);
        $Insert_Query->bindValue(':insertdate',$insertdate);
        $Insert_Query->bindValue(':user_num',$user_num);
        $Insert_Query->execute();
      });


      $app->post('/receive-user-data', function () use ($app) {
        include "db_functions.php";
        include '../signup_confirmation/connection/connect.php';
        include '../signup_confirmation/helper/nonce.php';
        include '../signup_confirmation/helper/randomstring.php';

        $json = $app->request->getBody();
        $json_array = json_decode($json, true);

        foreach ($json_array as $line)
        {
          $user_id = $line['user_id'];
          $user_password = $line['user_password'];
          //$confirm_password = $line['confirm_password'];
          $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
          $first_name = $line['first_name'];
          $last_name = $line['last_name'];
          $user_birthday = $line['user_birthday'];
        }

        $nonce = generateRandomString();
        $Insert_Query = $db->prepare("INSERT INTO User_Data (user_id, user_password, first_name, last_name, user_birthday, nonce, status) VALUES (:user_id, :user_password, :first_name, :last_name, :user_birthday, :nonce, '0')");

        $Insert_Query->bindValue(':user_id',$user_id);
        $Insert_Query->bindValue(':user_password',$hash_password);
        $Insert_Query->bindValue(':first_name',$first_name);
        $Insert_Query->bindValue(':last_name',$last_name);
        $Insert_Query->bindValue(':user_birthday',$user_birthday);
        $Insert_Query->bindValue(':nonce',$nonce);
        $Insert_Query->execute();

        send_code($nonce,$user_id);
        echo $user_id;
        echo $nonce;
      });
      /* 수훈이조 테스트용*/
      $app->post('/receive-user-data2', function () use ($app) {
        include '../signup_confirmation/connection/connect.php';

        $json = $app->request->getBody();
        $json_array = json_decode($json, true);

        foreach ($json_array as $line)
        {
          //echo $line['test'];
          //$test = $line['test'];
          $CO = $line['CO'];
          $O3 = $line['O3'];
          $SO2 = $line['SO2'];
          $PM25 = $line['PM25'];
          $time = $line['time'];
          $type = $line['type'];
          $NO2 = $line['NO2'];

        }

        $Insert_Query = $db->prepare("INSERT INTO shtest (CO, O3, SO2, PM25, time, type, NO2)
        VALUES (:CO, :O3, :SO2, :PM25, :time, :type, :NO2)");

        $Insert_Query->bindValue(':CO',$CO);
        $Insert_Query->bindValue(':O3',$O3);
        $Insert_Query->bindValue(':SO2',$SO2);
        $Insert_Query->bindValue(':PM25',$PM25);
        $Insert_Query->bindValue(':time',$time);
        $Insert_Query->bindValue(':type',$type);
        $Insert_Query->bindValue(':NO2',$NO2);

        $Insert_Query->execute();
      });
