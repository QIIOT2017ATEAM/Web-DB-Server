<?php 

//PHPMailer include slim
$app->post('/send-email', function () use ($app) {
    include "db_functions.php";
    include '../signup_confirmation/connection/connect.php';
    include '../signup_confirmation/helper/nonce.php';
    include '../signup_confirmation/helper/randomstring.php';
    
    $user_id = $_POST['user_id'];
	$user_password = $_POST['user_password'];
	$confirm_password = $_POST['confirm_password'];
	$hash_password = password_hash($user_password, PASSWORD_DEFAULT);
	$user_name = $_POST['user_name'];
	$user_birthday = $_POST['user_birthday'];

if(isset($_POST['sign_up_btn']))
{
	if(empty($user_id) || empty($user_password) || empty($confirm_password) || empty($user_name) || empty($user_birthday))
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
					$Check_Email = $db->prepare("SELECT User_ID FROM User_Data WHERE User_ID = :user_id");
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
							$Insert_Query = $db->prepare("INSERT INTO User_Data (User_ID, User_Password, User_Name, User_Birthday, nonce, status) VALUES (:user_id, :user_password, :user_name, :user_birthday, :nonce, '0')");

	        				$Insert_Query->bindValue(':user_id',$user_id);
    	    				$Insert_Query->bindValue(':user_password',$hash_password);
        					$Insert_Query->bindValue(':user_name',$user_name);
        					$Insert_Query->bindValue(':user_birthday',$user_birthday);
							$Insert_Query->bindValue(':nonce',$nonce);
        					$Insert_Query->execute();

							//아래 send_code는 Link가 되어야한다. 해당 부분 구현해야함.
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
                                                            "population" => "10");
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

$app->get('/air-as-json', function () use ($app) {
    include "db_functions.php";

    try {
        $sth = $pdo->prepare('SELECT * FROM airdata');
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
                $person_array[$person['Air_ID']] = array("center" => array( "population" => $person['data'], 
                                                                            "lat" => $person['lat'], 
                                                                             "lng" => $person['lng']));
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
