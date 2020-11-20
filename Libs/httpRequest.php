<?php 
namespace Libs;

class HttpRequest {

    public function getDomain() {
        return \parse_url($this->getURI())['scheme'];
    }

    public function getURI() {
        return \htmlentities(trim($_SERVER['REQUEST_URI']));
    }

    public function getData($data) {
        return isset($_GET['data']) ?  \htmlentities(trim($_GET[$data])) : false;
    }

    public function postData($data) {
        return isset($_POST['data']) ?  \htmlentities(trim($_POST[$data])) : false;
    }


}