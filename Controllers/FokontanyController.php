<?php 
namespace Controllers;

use Controllers\Madagascar;

class FokontanyController extends MainController{
    protected $communes, $mada;

    public function executeIndex() {
        $mada = new Madagascar();
        $css = 'fokontany.css';
        $js = 'fokontany.js';
        return $this->render(\compact('mada', 'css', 'js'));
    }

    public function executeNumFktnTot() {
        $mada = new Madagascar();
        $res = "<div><h5>nombre total de tous les fonkontany</h5><div>".count($mada->getAllFokontany())."</div></div>";
        echo $res;
    }

    public function executeFktnLeastLetter() {
        $mada = new Madagascar();
        $all_f = $mada->getAllFokontany();
        \ob_start();
        echo '<h5>le fokontany possedant moins de lettre à Madagascar est : </h5>';
        foreach($mada->shortestString($all_f) as $tf) {
             echo '<strong>'.$tf.' ('.strlen($tf).' lettres)</strong><br>';
        } 
        $res = \ob_get_clean();
        echo $res;
    }

    public function executeFktnMostLetter() {
        $mada = new Madagascar();
        $all_f = $mada->getAllFokontany();
        \ob_start();
        echo '<h5>les fokontany possedant le plus de lettre à Madagascar ( nombres : '.count($mada->tallestString($all_f)).') </h5>';
        foreach($mada->tallestString($all_f) as $tf) {
            echo '<strong>'.$tf.' ('.strlen($tf).' lettres)</strong><br>';
        } 
        $res = \ob_get_clean();
        echo $res;
        return;
    }

    public function executeAvgFktnPerCom() {
        $mada = new Madagascar();
        \ob_start();
        echo '<h5>la moyenne des fonkontany par commune </h5>
            <h3>'.$mada->avgFktnByAllComm().'</h3>';
        return;
    }

    public function executeTopFktnMostRepeated() {
        $mada = new Madagascar();
        $all_f = $mada->getAllFokontany();
        echo '
            <form action="" method="post" id="topForm">
                <label for="top">top</label>
                <input type="number" id="top" name="top">
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form> 
        ';

        if(isset($_POST['top']) && !empty($_POST['top'])) {
            echo '<h5>
            top '.$_POST['top'].' des fokontany les plus repétés à Madagascar </h5>';
            foreach($mada->occFktn($all_f, (int) $_POST['top']) as $key => $val) {
                echo "$key : $val <br>";
            }
        }
    }
}