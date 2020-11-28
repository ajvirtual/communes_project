<?php
namespace Controllers;
use Libs\HttpRequest;

class MainController {
    protected  $controller, $action;

    public function __construct($controller, $action)
    {
        $this->controller = $controller;
        $this->action = $action;
    }
    
    public function render($vars) {
        $request = new HttpRequest();
        \extract($vars);
        ob_start();
        require_once dirname(__DIR__).'/Views/'.$this->controller.'/'.$this->action.'.php'; // all the valid pages
       $content = ob_get_clean();
       require_once dirname(__DIR__)."/templates/mainLayout.php"; // templates   
    }
}