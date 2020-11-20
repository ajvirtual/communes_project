<?php 
namespace Controllers;

use Controllers\Madagascar;
use Controllers\MainController;
use Models\Ressources\FileRessources;

class FokontanyController extends MainController{
    protected $communes;
    public function executeIndex() {
        $ressource = new FileRessources();
        $this->communes = $ressource->getRessource('communes');
        $mada = new Madagascar($this->communes);
        return $this->render(\compact('mada'));
    }
}