<?php
/**
 * Created by PhpStorm.
 * User: naing
 * Date: 13/08/14
 * Time: 1:44 PM
 */
namespace application\lib;

use application\controllers\AboutController;
use application\controllers\TestController;

class Router {

    public function __construct(){}

    public function routeGetRequest($controllerName,$actionName, $args){

        if(!isset($controllerName)){

            header('HTTP/1.0 404 Not Found');
            echo "<h1>Error 404 Not Found</h1>";
            echo "The resource that you have requested could not be found.";
            return;
        }

        if(!isset($actionName)){
            $actionName = "Index";
        }

        $controller = ControllerFactory::CreateController($controllerName);

        try
        {
            if(!isset($args) || is_null($args)){
                ActionInvoker::InvokeActionNoParam($actionName,$controller);
            }else{
                ActionInvoker::InvokeAction($actionName,$controller, $args);
            }
        }
        catch (\Exception $ex){

            header('HTTP/1.0 404 Not Found');
            echo "<h1>Error 404 Not Found</h1>";
            echo "The resource that you have requested could not be found.Error details: {$ex->getMessage()}";

            //throw new \BadFunctionCallException($ex->getMessage());
        }
    }

    public function routePostRequest(){}
}

class ControllerFactory{

    public static function CreateController($controllerName){

        if(strcasecmp($controllerName,'about') == 0){
            return new AboutController();
        }

        //$controllerType = "controllers\\".$controllerName."Controller";
        //$controllerType = $controllerName."Controller";
        //echo $controllerName;
        //$controllerType = new TestController();
        return new TestController();
        //return new controllers\TestController();
        //return new $controllerType();
    }
}

class ActionInvoker{

    public static function InvokeAction($actionName, $controller, $actionArgs){

        if( ($controller instanceof AboutController) && (strcasecmp($actionName,'') != 0)){
            if(strcasecmp($actionName,'Index') == 0){

                $person = null;

                $argsExpressions = explode('&', $actionArgs);

                if(!empty($argsExpressions)){
                    $argExpression = explode('=', $argsExpressions[0]);
                }else{
                    $argExpression = explode('=', $actionArgs);
                }

                //extract($actionArgs, EXTR_PREFIX_ALL, 'frmget');

                if(strcasecmp($argExpression[0], 'person') == 0){
                    $person = $argExpression[1];
                }

                $controller->$actionName($person);
            }
        }
    }

    public static function InvokeActionNoParam($actionName, $controller){
        $controller->$actionName();
    }
}