<?php
/**
 * Created by PhpStorm.
 * User: naing
 * Date: 13/08/14
 * Time: 11:48 AM
 */

namespace application\views;

use application\models;
use application\controllers;

class PersonView {

    final public function render($person, $template){
        if(!empty($person)){
            include_once "./views/Person/".$template."Template.php";
            return;
        }

        header('HTTP/1.0 404 Not Found');
        echo "<h1>Error 404 Not Found</h1>";
        echo "The person that you have requested could not be found.";
        exit();
    }
}



