<?php

require_once __DIR__.'/../vendor/autoload.php'; 

$dotenv = new \Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();

$app = new Silex\Application(); 

$app = require __DIR__ . '/../app/app.php';
require __DIR__ . '/../app/routes.php';

$app->run();