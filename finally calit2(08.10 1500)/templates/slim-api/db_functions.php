<?php

$config['db']['host']   = "localhost";
$config['db']['user']   = "teama-iot";
$config['db']['pass']   = "alpha9374";
$config['db']['dbname'] = "teama2017";

$pdo = new PDO("mysql:host=" . $config['db']['host'] . ";dbname=" . $config['db']['dbname'],
        $config['db']['user'], $config['db']['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
