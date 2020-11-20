<?php
namespace Models\Ressources;

class FileRessources {
    public function getRessource($ressource) {
        if(!empty($ressource)) {
            if($ressource === 'communes') {
                $content = file_get_contents(dirname(dirname(__DIR__)).'/'.$ressource.'.json');
                $parsed = json_decode($content);
                return $parsed;
            }
        }
    }
}