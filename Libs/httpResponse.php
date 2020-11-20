<?php 
namespace Libs\httpResponse;

class httpResponse {

    public function setHeader($header) {
        return header($header);
    }

    public function redirect($page) {
        return $this->setHeader("location: $page");
    }

    public function redirect404() {
        return $this->redirect(__DIR__.'/Views/error/404.html');
    }

    public function json($data) {
        $this->setHeader('Content-Type: application/json');
        return json_encode($data);
    }

}