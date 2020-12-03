<?php

use Controllers\CommunesController;

require_once 'Libs/autoload.php'; 
    class App {
        public function run() {
            $content = file_get_contents('../Models/Ressources/communes.json');
            $parsed = json_decode($content);
            // $mada = new \Controllers\Madagascar($parsed);
            $route = ['region', 'district', 'communes', 'fokontany']; 
            $request = new Libs\HttpRequest();
            $router = new Libs\Router($request);
            $controller = $router->getController();
            $action = $router->getAction();
           if(isset($controller) && !empty($controller)) {
            if(in_array($controller, $route)) {
                $controller_class = "\\Controllers\\".ucfirst($controller)."Controller";
                $c = new $controller_class($controller, $action);
                $method = "execute$action";
                if(is_callable([$controller_class, $method])) {
                    $c->$method($request);
                }
            } else {
                ob_start();
                require_once __DIR__."/Views/error/404.html"; // 404 not found
                $content = ob_get_clean();
            }  
           } else {
                $c = new CommunesController('communes', 'index');
                $c->executeIndex($request);
           }
        }
    }
    
