<?php

// On souhaite monter un escalier de N 
// marches, avec des déplacements d’un 
// nombre spécifique de marches (ou 
// plusieurs). Développer une fonction qui 
// indique la première solution trouvée 
// qui permet d’arriver exactement en 
// haut (ou une erreur si pas de solution)


function escalier($n, $deplacements) {
    $combinaisons = [];
    foreach($deplacements as $d){
        array_push($combinaisons, [$d]);
    }
    echo json_encode($combinaisons), PHP_EOL;
    do{
        

    }while(true);
}


echo escalier(11, [2, 3])
?>