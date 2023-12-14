<?php

function nbchiffre($nombre){
    if ($nombre < 10){
        return 1;
    } else {
        return 1 + nbchiffre(intdiv($nombre, 10));
    }
}

echo nbchiffre(125) . PHP_EOL;

function puissance($nb, $puiss){
    if ($puiss < 1){
        return 1;
    } else {
        return $nb * puissance($nb, $puiss - 1);
    }
}

echo puissance(2, 2);

?>
