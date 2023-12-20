<?php

function nbchiffre($nombre){
    if ($nombre < 10){
        return 1;
    } else {
        return 1 + nbchiffre(intdiv($nombre, 10));
    }
}

echo nbchiffre(125).PHP_EOL;

function puissance($nb, $puiss){
    if ($puiss < 1){
        return 1;
    } else {
        return $nb * puissance($nb, $puiss - 1);
    }
}

echo puissance(2, 2).PHP_EOL;

function fibobo($n){
    if ($n <= 1) {
        return $n;
    } else {
        return fibobo($n - 1) + fibobo($n - 2);
    }
}

function fibofas($n, &$memo = []) {
    if ($n <= 1) {
        return $n;
    } elseif (array_key_exists($n, $memo)) {
        return $memo[$n];
    } else {
        $memo[$n] = fibofas($n - 1, $memo) + fibofas($n - 2, $memo);
        return $memo[$n];
    }
}

echo fibobo(4) .PHP_EOL ;
echo fibofas(50) .PHP_EOL;
?>