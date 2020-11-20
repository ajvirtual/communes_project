<?php
namespace Controllers;
use Controllers\Madagascar;
use Models\Ressources\FileRessources;

class CommunesController extends Madagascar {
    protected $communes;
    public function __construct()
    {
        parent::__construct($this->communes);
    }
    public function executeIndex() {
        $ressource = new FileRessources();
        $this->communes = $ressource->getRessource('communes');
        $all_communes = $this->getAllCommune();
        
    }
}