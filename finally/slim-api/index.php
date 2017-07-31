<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

/* Android will request heart rate information, so let's do an example of selecting
and returning json data
*/

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


$app->run();
