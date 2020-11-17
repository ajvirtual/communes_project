<?php
    require_once 'madaClass.php';

    $content = file_get_contents('communes.json');
    $parsed = json_decode($content);

    $mada = new Madagascar($parsed);
    
    // $_id = [];
    // $name = [];
    // $fokontany = [];

    // foreach($parsed as $c) {
    //     array_push($_id, $c->_id);
    //     array_push($name, $c->name);
    //     array_push($fokontany, $c->fokontany);
    // }
    // // print_r($_id);
    // // echo '<br>';
    // // echo '<br>';

    // // print_r($name);
    // // echo '<br>';
    // // echo '<br>';
    // // print_r($fokontany);

    // // moyenne 
    
    // $FonkontanyParCom = [];
    // $fonkontanyRepeat = [];
    // foreach($parsed as $c) {
    //     // array_push($_id, $c->_id);
    //     // array_push($name, $c->name);
    //     // array_push($fokontany, $c->fokontany);
    //     $f = (array) $c->fokontany;
    //     $fonkontany = [];
    //     $num = 0;
    //     foreach($f as $index => $fs) {
    //         // if(in_array($fs->name, $FonkontanyParCom)) {
    //         //     array_splice($f, $index);
    //         //     // $fonkontanyRepeat[$fs->name] += 1;
    //         // } else {
    //         //     array_push($FonkontanyParCom, $fs->name);
    //         // }
    //         array_push($FonkontanyParCom, $fs->name);
    //     }   
    // }

    // $maxf = max($fonkontanyRepeat);
    // echo $maxf;

    // $numCommune = count($parsed);
    // $numFonkontanyParCom = count($FonkontanyParCom);
    // $moyenne = $numFonkontanyParCom / $numCommune;
    // // moyenne
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>communes</title>
</head>
<body>
    <h2></h2>
    <div>
        <?php 

        // foreach($mada->FktnMostOccurenceChar() as $key => $val) {
        //     echo $key.' = '.$val.'<br>';
        // }

        $l = $mada->FktnMostOccurenceChar();
        echo '<strong>nombre total de tous les communes : </strong>'.count($mada->getAllCommune()).'<br>';
        echo '<strong>nombre total de tous les fokontany : </strong>'.count($mada->getAllFokontany()).'<br>';
        if($mada->FktnMostOccurenceChar()[0]) {
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
            } else {
                echo 'aucun fokontany ne possède ce mot';
            }
        }
        
        $all_f = $mada->getAllFokontany();
            // echo '<strong>le fokontany possedant plus de lettre à Madagascar est : </strong>';
            // foreach($mada->tallestString($all_f) as $tf) {
            //     echo $tf.' '.strlen($tf).'<br>';
            // } 

        echo '<strong>le fokontany possedant moins de lettre à Madagascar est : </strong>';
        foreach($mada->shortestString($all_f) as $tf) {
            echo $tf.' ('.strlen($tf).' lettres)<br>';
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
    <table>
        <thead>
            <td>id</td>
            <td>name</td>
            <td>fokontany</td>
        </thead>
        <tbody>
            <?php 
                // for($i = 0; $i < count($mada->getAllcommune()); $i++) {
                //     echo "<tr>
                //             <td>".$mada->getCommuneIdByIndex($i)."</td>
                //             <td>".$mada->getCommuneNameByIndex($i)."</td>
                //             <td>
                //             ";
                //     for($j = 0; $j < count($mada->getCommuneFokontanyByIndex($i)); $j++) {
                //     echo " 
                //             <div class='fokontany-container'>
                //                 <div class='f_id'>
                //                     <span class='f_label'>fokontany id :  </span><span> ".$mada->getCommuneFokontanyByIndex($i)[$j]->_id."</span>
                //                 </div>
                //                 <div class='f_name'>
                //                     <span class='f_label'>fokontany name :  </span><span> ".$mada->getCommuneFokontanyByIndex($i)[$j]->name."</span>
                //                 </div>
                //             </div>
                //             <hr>
                //         ";
                //     }
                //     echo "
                //               </td>
                //           </tr>";
                // }
            ?>    
        </tbody>
    </table>
</body>
</html>