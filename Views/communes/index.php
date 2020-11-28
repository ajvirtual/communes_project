<h1 style="text-align:center">tous les communes de Madagascar</h1>
<div class="commune-container">
    <div class="left-side-stat">
        <ul>
            <li>
            <?php
               if(isset($all_communes)) {
                   echo '<span>nombre total de tous les communes : </span>'.count($all_communes).'<br>';
               } 
            ?>
            </li>
        </ul>
    </div>
    
<table>
        <thead>
            <td>commune id</td>
            <td>commune name</td>
            <td>fokontany</td>
        </thead>
        <tbody>
            <?php 
                for($i = 0; $i < count($all_communes); $i++) {
                    echo "<tr>
                            <td>".$mada->getCommuneIdByIndex($i)."</td>
                            <td>
                                <h2>".$mada->getCommuneNameByIndex($i)."</h2>
                                <h4>nombres des fokontany : ".count($mada->getCommuneFokontanyByIndex($i))."</h4>
                            </td>
                            <td>
                            ";
                    for($j = 0; $j < count($mada->getCommuneFokontanyByIndex($i)); $j++) {
                    echo " 
                            <div class='fokontany-container'>
                                <div class='f_id'>
                                    <span class='f_label'>fokontany id :  </span><span> ".$mada->getCommuneFokontanyByIndex($i)[$j]->_id."</span>
                                </div>
                                <div class='f_name'>
                                    <span class='f_label'>fokontany name :  </span><span> ".$mada->getCommuneFokontanyByIndex($i)[$j]->name."</span>
                                </div>
                            </div>
                            <hr>
                        ";
                    }
                    echo "
                              </td>
                          </tr>";
                }
            ?>    
        </tbody>
    </table>
</div>