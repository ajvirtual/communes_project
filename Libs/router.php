<?php
namespace Libs;
use Libs\HttpRequest;

class Router {
    private $controller, $action;

    public function __construct(HttpRequest $request) {
        $this->parse($request);
    }

    public function parse(HttpRequest $request) {
        $url = $request->getURI();

        $path = parse_url($url)['path'];
        $route = explode('/', $path);
        
        $this->controller = isset($route[1]) ? $route[1] : null;
        $this->action = isset($route[2]) ? $route[2] : null; 
        
        return;
    }   

    /**
     * Get the value of controller
     */ 
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the value of controller
     *
     * @return  self
     */ 
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get the value of action
     */ 
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the value of action
     *
     * @return  self
     */ 
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }
}