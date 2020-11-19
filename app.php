<?php
    require_once 'autoload.php';    
    $content = file_get_contents('../communes.json');
    $parsed = json_decode($content);
    $mada = new \Controllers\Madagascar($parsed);      
?>