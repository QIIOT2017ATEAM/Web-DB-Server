<?php

$config['db']['host']   = "localhost";
$config['db']['user']   = "root";
$config['db']['pass']   = "12345678";
$config['db']['dbname'] = "pogo";

$pdo = new PDO("mysql:host=" . $config['db']['host'] . ";dbname=" . $config['db']['dbname'],
        $config['db']['user'], $config['db']['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
