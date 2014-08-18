<?php

/**
 * Created by PhpStorm.
 * User: naing
 * Date: 13/08/14
 * Time: 11:36 AM
 */

namespace application;

//require everything once except for the View Templates
//always used include for View Templates
require_once './models/PersonalInfo.php';
require_once './views/PersonView.php';
require_once './controllers/AboutController.php';
//require_once './controllers/TestController.php';
require_once "./lib/Router.php";
require_once "./lib/Application.php";

use application\lib\Application;

$app = new Application();
$result = $app->run();
if( $result !== true){
    header('HTTP/1.0 500 Internal Server Error');
    echo "<h1>Error 500 Internal Server Error</h1>";
    echo "Oops something went horribly wrong here...";
    echo $result;
    exit();
}