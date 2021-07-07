<?php
namespace Controllers;
use Libs\Router;
use Libs\HttpRequest;
use Controllers\Madagascar;
use Controllers\MainController;
use Models\Ressources\FileRessources;

class CommunesController extends MainController {
    protected $communes;

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        }

    public function executeIndex(HttpRequest $request) {
        $ressource = new FileRessources();
        $this->communes = $ressource->getRessource('../Models/Ressources/communes.json');
        $mada = new Madagascar($this->communes);
        $all_communes = $mada->getAllCommune();
        $css = 'commune.css';
        return $this->render(\compact('all_communes', 'mada', 'css'));
    }
}