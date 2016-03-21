<?php

use Silex\Application;
use League\Plates\Engine;
use Ruscod\League\Plates\EngineFactory;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\MonologServiceProvider;

$app = new Application();
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'    => getenv('DB_DRIVER'),
        'host'      => getenv('DB_HOST'),
        'dbname'    => getenv('DB_NAME'),
        'user'      => getenv('DB_USER'),
        'password'  => getenv('DB_PASSWORD'),
        'charset'   => 'utf8',
    ),
));
$app->register(new ServiceControllerServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new SwiftmailerServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/development.log',
));

//templates engine
$app['plates'] = new League\Plates\Engine( __DIR__ . '/../templates');
$app['plates']->loadExtension(new EngineFactory($app));

$app['debug'] = true;

return $app;