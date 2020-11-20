<div>
        <?php 

        // foreach($mada->FktnMostOccurenceChar() as $key => $val) {
        //     echo $key.' = '.$val.'<br>';
        // }

        $l = $mada->FktnMostOccurenceChar();
        
        echo '<strong>nombre total de tous les fokontany : </strong>'.count($mada->getAllFokontany()).'<br>';
        if(isset($_POST['carac'])) {
            if($mada->FktnMostOccurenceChar()[0]) {
                echo 'nombre : '.count($mada->FktnMostOccurenceChar()).'<br>';

                foreach($mada->FktnMostOccurenceChar() as $key => $val) {
                    echo 'fokontany : '.$val['name'].'<br>';
                    if(strlen($_POST['carac']) === 1) {
                        echo 'occurence du lettre '.$_POST['carac'].' : '.$val['max'].' fois<br>';
                    } else {
                        echo 'occurence du mot '.$_POST['carac'].' : '.$val['max'].' fois<br>';
                    }
                    echo '<hr>';
                }
            } else {
                if(strlen($_POST['carac']) === 1) {
                    echo 'aucun fokontany ne possède cette lettre';
                } elseif(strlen($_POST['carac']) > 1) {
                    echo 'aucun fokontany ne possède ce mot<br>';
                } else {
                    echo 'veuillez saisir quelque chose si vous voulez avoir du resultat<br>';
                }
            }
        }
        
        $all_f = $mada->getAllFokontany();
        // if(count($mada->tallestString($all_f)) > 1) {
        //     echo 'nombre de resultat : '.count($mada->tallestString($all_f)).'<br>';
        //     echo '<strong>les fokontany possedant plus de lettre à Madagascar sont : </strong><br>';     
        // } else {
        //     echo 'nombre de resultat : '.count($mada->tallestString($all_f));
        //     echo '<strong>le fokontany possedant plus de lettre à Madagascar est : </strong>';
        // }
        
        // foreach($mada->tallestString($all_f) as $tf) {
        //     echo $tf.' '.strlen($tf).'<br>';
        // } 

        echo '<strong>le fokontany possedant moins de lettre à Madagascar est : </strong>';
        foreach($mada->shortestString($all_f) as $tf) {
            echo $tf.' ('.strlen($tf).' lettres)<br>';
        } 
        echo 'top '.count($mada->occFktn($all_f, 2)).' des fokontany les plus repétés à Madagascar : <br>';
        foreach($mada->occFktn($all_f, 2) as $key => $val) {
            echo "$key : $val <br>";
        }
        ?>  
    </div>
    <div>
        <form action="" method="post">
            <label for="input">entrer un caractere dont le fonkontany possede le plus </label>
            <input type="text" id="input" name="carac" autocomplete="off"> <br>
            <input type="submit" value="chercher">
        </form>
    </div>
   <div>
    <strong>la moyenne des fonkontany par commune est : </strong><?php echo "<span>".$mada->avgFktnByAllComm()."</span>" ?>
   </div>
    