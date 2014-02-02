<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

// definitions

// Routing
$app->get('/', function () {

    return "Coin Test";
});

$app->run();