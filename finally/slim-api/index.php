<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->config(array(
    'debug' => true,
    'templates.path' => '../templates'
));
$settingValue = $app->config('templates.path'); //returns "../templates"

// Register routes
// separate route files based on content
$routeFiles = (array) glob('routes/*.php');
foreach($routeFiles as $routeFile) {
    require __DIR__ . "/" . $routeFile;
}

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

/* Android will request heart rate information, so let's do an example of selecting
and returning json data
*/
$app->get('/formation', function () use ($app) {
    echo "<form method='post' action='reception?id=mike'>\n";
    echo "<input type='text' name='foo' value='bar'>\n";
    echo "<input type='submit'>\n";
    echo "</form>\n";
    exit;
});

$app->post('/reception', function () use ($app) {
print_r($_POST);
print_r($_GET);
exit;
});

$app->get('/simple', function () use ($app) {
    include "db_functions.php";
    try {
        $sth = $pdo->prepare("SELECT name, lat, lng, insert_date, tth
            FROM pokemon
            ORDER BY insert_date desc
            LIMIT 5");

        $sth->execute();

        $result = $sth->fetchAll();

        if ($result) {
            // slim php style
            $app->response->headers->set('Content-Type', 'application/json');
            return $app->response->write(json_encode($result));

            // regular php style
            /*
            header("Content-type:application/json");
            echo json_encode($result);
            exit;
            */
        }
    } catch (Exception $e) {
        return $app->response->setStatus(400);
    }
}); 

$app->get('/simple/:name', function ($name) use ($app) {
    include "db_functions.php";
    try {
        $sth = $pdo->prepare("SELECT name, lat, lng, insert_date, tth
            FROM pokemon
            WHERE name = :pokemon
            ORDER BY insert_date desc
            LIMIT 5");

        $sth->bindValue(':pokemon', $name, PDO::PARAM_STR);
        $sth->execute();

        $result = $sth->fetchAll();

        if ($result) {
            // slim php style
            $app->response->headers->set('Content-Type', 'application/json');
            return $app->response->write(json_encode($result));

            // regular php style
            /*
            header("Content-type:application/json");
            echo json_encode($result);
            exit;
            */
        }
    } catch (Exception $e) {
        return $app->response->setStatus(400);
    }
}); 

$app->get('/distance/:location/:radius', function ($location, $radius) use ($app) {
    // if radius not integer, return 400 error
    if (!filter_var($radius, FILTER_VALIDATE_INT)) {
        http_response_code(400);
        exit;
    }

    include "db_functions.php";

    switch ($location) {
        case 'ucsd':
            $lat = 32.8801;
            $lng = -117.2340;
            break;
    }

    try {
        $sth = $pdo->prepare("SELECT name, lat, lng,
        (
            6371 *
            acos(
                cos( radians( :lat ) ) *
                cos( radians( `lat` ) ) *
                cos(
                    radians( `lng` ) - radians( :lng )
                ) +
                sin(radians(:lat)) *
                sin(radians(`lat`))
            )
                ) `distance`
            FROM pokemon
            HAVING `distance` < :radius
            ORDER BY `distance`
            LIMIT 725");

        $sth->bindParam(':lat', $lat);
        $sth->bindParam(':lng', $lng);
        $sth->bindParam(':radius', $radius);

        $sth->execute();

        $result = $sth->fetchAll();

        if ($result) {
            $app->response->headers->set('Content-Type', 'application/json');
            return $app->response->write(json_encode($result));

        }
    } catch (Exception $e) {
        return $app->response->setStatus(400, $e->getMessage());
    }
}); 

$app->post('/receive-user-data', function () use ($app) {
    $json = $app->request->getBody();

    var_dump($json);
    exit;

    $json_array = json_decode($json, true);
//var_dump($json_array);

$sth = $pdo->prepare("INSERT INTO aqi_data (temp, no2, pm25) values (:temp, :no2, :pm25)");

foreach ($json_array as $line) {
    $sth->bindValue(':temp', $line['temp'], PDO::PARAM_INT);
    $sth->bindValue(':no2', $line['no2'], PDO::PARAM_INT);
    $sth->bindValue(':pm25', $line['pm25'], PDO::PARAM_INT);

    $sth->execute();
}

    // send back a 200 status for success
    // your code should process the data, insert into database, etc ...
    http_response_code(200);
    $app->response->headers->set('Content-Type', 'application/json');
    return $app->response->write(json_encode(array("status"=>"success")));
}); 

$app->post('/saveupload', function () use ($app) {
    $new_name = str_replace(".csv", "-" . time() . ".csv", $_FILES["file"]['name']);
    move_uploaded_file($_FILES["file"]["tmp_name"], "/tmp/" . $new_name);

    http_response_code(200);
    $app->response->headers->set('Content-Type', 'application/json');
    return $app->response->write(json_encode(array("status"=>"success", "path"=>"/tmp/$new_name")));

});

// This mail test works 
$app->posr('/newmail', function () use ($app) {
        //function send_code($nonce,$user_id){
        //require 'signup_confirmation/PHPMailer/PHPMailerAutoload.php';
    
    include 'signup_confirmation/connection/connect.php';
    include 'signup_confirmation/helper/nonce.php';
    include 'signup_confirmation/helper/randomstring.php';
    
    $mail = new PHPMailer;

    //$mail->SMTPDebug = 2;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'rudtn521@gmail.com';                 // SMTP username
    $mail->Password = 'gkdlfn~521';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('rudtn521@gmail.com', 'Ann');
    $mail->addAddress($user_id);
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Confirmation Code';
    //http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'

    $mail->Body    = "http://192.168.33.66/activation.php?&nonce=".$nonce."";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } 
    else 
    {
        echo 'Message has been sent';
    }
//}
        /*
        $id = 'michiu@ucsd.edu';

        $mail = new \PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        //$mail->SMTPDebug = 2;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "rudtn521@gmail.com";

        //Password to use for SMTP authentication
        $mail->Password = "gkdlfn~521";

        $mail->setFrom('rudtn521@gmail.com', 'Ann');
        $mail->addAddress($id);
        $mail->addReplyTo('no-reply@example.com', 'Example.com');

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Confirmation Code';
        $mail->Body    = "http://192.168.33.66/activation.php?&nonce=".$nonce."";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
/*
        if(!$mail->send()) {
            $this->flash("error", "We're having trouble with our mail servers at the moment.  Please try again later, or contact us directly by phone.");
            error_log('Mailer Error: ' . $mail->errorMessage());
            $this->halt(500);
        }
*/        
});

$app->run();
