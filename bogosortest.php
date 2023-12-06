<?php
function bogoSort($array) {
    while (!isSorted($array)) {
        shuffle($array);
    }
    return $array;
}

function isSorted($array) {
    $length = count($array);
    for ($i = 0; $i < $length - 1; $i++) {
        if ($array[$i] > $array[$i + 1]) {
            return false;
        }
    }
    return true;
}

$array = [5, 2, 9, 1, 5, 84, 84 ,4 ,4 ,4 ,9, 6,8, 5 ,4, 5, 7, 8, 6, 3, 1, 100, 8, 9 ,7];
echo "Array avant le tri : ";
print_r($array);

$arrayTrié = bogoSort($array);
echo "Array après le tri : ";
print_r($arrayTrié);
?>