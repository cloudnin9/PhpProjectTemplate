<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 15/08/14
 * Time: 10:21 AM
 */

namespace application\lib;


class Application{

    protected function printRequestAndRouteInfo(){

        echo print_r($_GET, true)."<br>";
        //echo print_r($_POST, true)."<br>";
        //echo print_r($_REQUEST, true)."<br>";
        echo print_r($_SERVER['REQUEST_URI'], true)."<br>";
        echo print_r(parse_url($_SERVER['REQUEST_URI']), true);
        //echo print_r($_SERVER['QUERY_STRING'], true)."<br>";
    }

    public function run(){

        try{
            //$this->printRequestAndRouteInfo();

            $queryParams = parse_url($_SERVER['REQUEST_URI']);

            $queryString = null;

            if(isset($queryParams['query'])){
                $queryString = $queryParams['query'];
            }
            $rout = new Router();

            $controller = null;
            if(isset($_GET['_CONTROLLER'])){
                $controller = $_GET['_CONTROLLER'];
            }

            $action = null;
            if(isset($_GET['_ACTION'])){
                $action = $_GET['_ACTION'];
            }

            if(!empty($_GET)){

                //may be check for authentication/authorization here
                $rout->routeGetRequest($controller, $action, $queryString);
                return true;
            }

            if(!empty($_POST)){
                $rout = new Router();
                //may be check for authentication/authorization and anti-forgery tokens here
                $rout->routePostRequest();
                return true;
            }


            IF(!isset($_SERVER['REQUEST_URI']) ||
                strcasecmp($_SERVER['REQUEST_URI'], "/") == 0 ||
                strcasecmp($_SERVER['REQUEST_URI'], "/Index.php") == 0 ||
                strcasecmp($_SERVER['REQUEST_URI'], "/Project/") == 0 ||
                strcasecmp($_SERVER['REQUEST_URI'], "/Project/Index.php") == 0){

                /** @noinspection PhpIncludeInspection */
                include_once 'IndexTemplate.php';
                return true;
            }
        }
        catch(\Exception $e){
            return $e->getMessage();
        }

        return false;
    }
}