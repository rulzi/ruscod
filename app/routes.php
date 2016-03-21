<?php

$app->mount('/', new Ruscod\Controller\IndexController());
$app->mount('/user', new Ruscod\Controller\UserController());
