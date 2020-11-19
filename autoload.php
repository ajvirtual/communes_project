<?php

    function require_class($class) {
        require '../'.str_replace('\\', '/', $class).".php";
    }
    spl_autoload_register('require_class');

?>