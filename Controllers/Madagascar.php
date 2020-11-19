<?php
namespace Controllers;
    
class Madagascar {
    private $all_commune = [];
    private $commune = [];
    private $fokontany = [];

    public function __construct($content) {
        $this->all_commune = $content;
    }
    
    public function getAllcommune() {
        return $this->all_commune;
    }
    
    public function communeNumber() {
        return count($this->all_commune);
    }

    public function getCommuneIdByIndex($index) {
        return $this->all_commune[$index]->_id;
    }

    public function getCommuneNameByIndex($index) {
        return $this->all_commune[$index]->name;
    }

    public function getAllcommuneName() {
        $all_commune_name = [];
        for($i = 0; $i < count($this->all_commune); $i++) {
            array_push($all_commune_id, $this->getCommuneNameByIndex($i));
        }
        return $all_commune_name;
    }

    public function getCommuneFokontanyByIndex($index) {
        return $this->all_commune[$index]->fokontany;
    }

    public function getFonkotanyByCommuneId($id) {
        
        foreach($this->all_commune as $c) {
            if($c->_id === $id) {
                return  $c->fokontany;
            }
        }
        return false;
    }

    public function getFonkontanyById($id) {
        foreach($this->all_commune as $c) {
            foreach($c->fokontany as $f) {
                if($f->_id === $id) {
                    return $f->name;
                }
            }
        }
        return false;
    }

    public function getAllFokontany() {
        $fokontany = [];
        foreach($this->all_commune as $c) {
            for($i = 0; $i < count($c->fokontany); $i++) {
                array_push($fokontany, ['_id' => $c->fokontany[$i]->_id, 'name' => $c->fokontany[$i]->name]);
            }
        }
        return $fokontany;
    }

    public function avgFktnByAllComm() {
        $CommuneCount = count($this->all_commune);
        $fokontanyCount = count($this->getAllFokontany());
        return $fokontanyCount / $CommuneCount;
    }

    public function maxInArray(array $arrayInput, $option = 'ID') {
        if(!empty($arrayInput)) {
            
                $all_max = [0];
                $key_first = array_keys($arrayInput)[0];
                $max = $arrayInput[$key_first];
                foreach($arrayInput as $key => $val) {
                    if($val > $max) {
                    if($option === 'ID') {
                        $m = ['max' => $val, 'name' => $this->getFonkontanyById($key)];
                    } elseif($option === 'NAMED') {
                        $m = ['max' => $val, 'name' => $key];
                    }
                    // if($all_max[0]['max'] === $val ){
                    //     var_dump($all_max);
                    //     $all_max[] = $m;
                    // } else {
                    //     echo $all_max[0]['max'].' '.$val.'<br>';
                    //     $all_max = []; 
                    //     $all_max[] = $m;
                    // }
                    // echo $all_max[0]['max'].' '.$val.'<br>';
                    $all_max = []; 
                    $all_max[] = $m;
                    $max = $val;
                    } elseif($all_max[0]['max'] === $val) {
                    if($option === 'ID') {
                        $m = ['max' => $val, 'name' => $this->getFonkontanyById($key)];
                        } elseif($option === 'NAMED') {
                        $m = ['max' => $val, 'name' => $key];
                        }
                    // var_dump($all_max);
                    $all_max[] = $m;
                    }
                }
                return $all_max;
        } else {
            return false;
        }
    }

    public function FktnMostOccurenceChar() {
        if(isset($_POST['carac'])) {
            $all_fktn = [];
            foreach($this->getAllFokontany() as $fktn) {
                $occ_string = $this->StringCountInString($fktn['name'], $_POST['carac']);
                $all_fktn[$fktn['_id']] = $occ_string;
            }    
            return $this->maxInArray($all_fktn);
        }
    }

    public function StringCountInString($string_init, $string_seek) {
        if(is_string($string_init) && is_string($string_seek)) {
            $init = trim($string_init);
            $seek = htmlentities(trim($string_seek));
            
            $occ = 0;
            $current = 0;
            while(true){
                    //if($current > strlen($word)) break;
                    if(stripos($init, $seek, $current) === false) {
                        break;
                    } else {
                        $occ++;
                        $current = stripos($init, $seek, $current)+1;
                        // var_dump($current);
                    }
            }
            // $occ = preg_match_all('/'.$seek.'/', $init, $match);
            // var_dump($match);
            // var_dump($occ);
            return $occ;    
        } 
        return 'vous devez entre un string comme paramètre';
    }

    public function tallestString(array $string) {
        $all_max = [];
        $max = 0;
        foreach($string as $key => $val) {
            if(strlen($val['name']) > $max) {
                $all_max = [];
                $all_max[] = $val['name'];
                $max = strlen($val['name']);
            } elseif((strlen($val['name']) === $max)) {
                $all_max[] = $val['name'];
            }
        }
        return $all_max;
    }

    public function shortestString(array $fktn) {
        $all_min = [];
        $min = strlen($fktn[0]['name']);
        foreach($fktn as $key => $val) {
            if(strlen($val['name']) < $min) {
                $all_min = [];
                $all_min[] = $val['name'];
                $min = strlen($val['name']);
            } elseif((strlen($val['name']) === $min)) {
                $all_min[] = $val['name'];
            }
        }
        return $all_min;
    }

    public function topInArray(array $arrayInput, $top = 1) {
        arsort($arrayInput);
        $new_array = [];
        $i = 0;
        foreach($arrayInput as $key => $val) {
            if($top === $i) break;

            $new_array[$key] = $val;
            $i++;
        }
        
        return $new_array;
    }

    public function occFktn(array $fktn, $top = 1) {
        $repeated = [];
        $max = [];
        foreach($fktn as $key => $val) {
            if(array_key_exists($val['name'], $repeated)) {
                $repeated[$val['name']]++;
            } else {
                $repeated[$val['name']] = 1;
            }
        }
        $m = max($repeated);
        $max = $this->topInArray($repeated, $top);
        // return '<strong>fokontany le plus repété : </strong>'.array_keys($repeated, $m)[0].' (<strong> repetition : </strong>'.$m.' )';
        return $max;
    }

}