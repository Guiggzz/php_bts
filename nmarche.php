<?php

// On souhaite monter un escalier de N 
// marches, avec des déplacements d’un 
// nombre spécifique de marches (ou 
// plusieurs). Développer une fonction qui 
// indique la première solution trouvée 
// qui permet d’arriver exactement en 
// haut (ou une erreur si pas de solution)


function escalier($nbMarches, array $deplacements) {
    $combinaisons = [];
    foreach($deplacements as $d){
        array_push($combinaisons, [$d]);
    }
    echo json_encode($combinaisons), PHP_EOL;
    do{
        $prochaineCombinaison = array_shift($combinaisons);
            if (array_sum($prochaineCombinaison) == $nbMarches){
                return json_encode($prochaineCombinaison);
            }
            else if (array_sum($prochaineCombinaison) > $nbMarches){
                //
            }
            else {
                foreach ($deplacements as $d) {
                    array_push($combinaisons, array_merge($prochaineCombinaison, [$d]));
            }}
    }while(count($combinaisons) > 0);
}


echo json_encode (escalier(1001, [2, 3]));
?>