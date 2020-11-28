<div class="container-options">
    <div class="content-options">
        <ul class="row m-0" id="options">
            <li><a href="numFktnTot" class="btn btn-warning m-1">fokontany total number</a></li>
            <li><a href="fktnLeastLetter" class="btn btn-warning m-1">fokontany least letter</a></li>
            <li><a href="fktnMostLetter" class="btn btn-warning m-1">fokontany most letter</a></li>
            <li><a href="AvgFktnPerCom" class="btn btn-warning m-1">average of fokontany per communes</a></li>
            <li><a href="TopFktnMostRepeated" class="btn btn-warning m-1">Top fokontany most repeated</a></li>
        </ul>
    </div>
</div>
<div id="result-options">

</div>
<div class="main-container">

            <div class="left-side-stat">
                <?php
                  
                    $l = $mada->FktnMostOccurenceChar();
                    if(isset($_POST['carac']) && !empty($_POST['carac'])) {
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
                ?>
                
            </div><br>
        <?php 
        
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
       
        ?>  
        <div class="main-content">
            <div class="form-container">
                <form action="" method="post">
                    <label for="input">entrer un caractere dont le fonkontany possede le plus </label>
                    <div class="form-inline">
                        <input type="text" id="input" name="carac" autocomplete="off" class="form-control mr-1"> <br>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
   <div>
   </div>