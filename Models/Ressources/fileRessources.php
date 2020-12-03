<?php
namespace Models\Ressources;

class FileRessources {
    public function getRessource($ressource) {
        if(!empty($ressource)) {
            $content = file_get_contents($ressource);
            $parsed = json_decode($content);
            return $parsed;
        }
    }
}