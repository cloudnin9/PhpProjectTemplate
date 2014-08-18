<?php
/**
 * Created by PhpStorm.
 * User: naing
 * Date: 13/08/14
 * Time: 11:48 AM
 */

namespace application\controllers;

use application\models\PersonalInfo;
use application\views\PersonView;

class AboutController {

    public function Index($personIdentifier = ""){
        if($personIdentifier === ""){
            $person = PersonalInfo::Get();
        }
        else{
            $person = PersonalInfo::Get($personIdentifier);
        }

        $personView = new PersonView();
        $personView->render($person, "View");
    }

    public function Boo(){
        echo 'Boo';
    }
}

class TestController {

    public function Index(){
        echo 'Hello from test';
    }
}