<?php
    
    require_once 'autoload.php';    
    $content = file_get_contents('../communes.json');
    $parsed = json_decode($content);
    // $mada = new \Controllers\Madagascar($parsed);   
  
    $request = $_SERVER['REQUEST_URI'];
    $path = parse_url($request)['path'];
    
    $route = explode('/', $path);
    $valid_menu = ['region', 'district', 'communes', 'fokontany'];
    $controller = isset($route[1]) ? $route[1] : '';
    $action = isset($route[2]) ? $route[2] : '';

    if(in_array($controller, $valid_menu)) {
        $controller_class = "\\Controllers\\".ucfirst($controller)."Controller";
        $c = new $controller_class;
        $method = "execute$action";
        if(is_callable([$controller_class, $method])) {
            $c->$method();
        } else {
            
        }
        ob_start();
         require_once __DIR__."/Views/$controller/$action.php"; // all the valid pages
        $content = ob_get_clean();
    } else {
        ob_start();
        require_once __DIR__."/Views/error/404.html"; // 404 not found
        $content = ob_get_clean();
    }

    require_once __DIR__."/templates/mainLayout.php"; // templates