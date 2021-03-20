<?php

namespace tickerEvents;

require_once __DIR__ . "/../vendor/autoload.php";

//error_reporting(-1);
//ini_set('display_errors', 'On');
error_reporting(E_ERROR | E_PARSE);

$factory = new Factory();
$app = $factory->createApp();
echo $app->run();