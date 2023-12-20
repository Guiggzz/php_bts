<?php

const FACTEUR_TAILLE = 10;
const NB_VALEURS = 5;

function genererTableau(int $taille): array
{
    $tableau = [];
    do {
        $val = random_int(0, $taille * FACTEUR_TAILLE);
        if (!in_array($val, $tableau)) {
            $tableau[] = $val;
        }
    } while (count($tableau) < $taille);
    sort($tableau);
    return $tableau;
}


function rechercheSequentielle(int $nombre, array $tableau)
{
    foreach($tableau as $n){
        if ($n == $nombre){
            return  True;
        }
    }
}

function rechercheDichotomie(int $nombre, array $tableau)
{
    if (count($tableau) === 0) {
        return false;
    }

    $milieu = floor(count($tableau) / 2);

    if ($tableau[$milieu] === $nombre) {
        return true;
    }

    if ($tableau[$milieu] > $nombre) {
        return rechercheDichotomie($nombre, array_slice($tableau, 0, $milieu));
    } else {
        return rechercheDichotomie($nombre, array_slice($tableau, $milieu + 1));
    }
}

echo "Saisissez la taille du tableau : ";
$tailleTableau = intval(trim(fgets(STDIN)));
$tableauAleatoire = genererTableau($tailleTableau);

$valeursTrouvables = [];
$valeursIntrouvables = [];
do {
    $val = random_int(0, $tailleTableau * FACTEUR_TAILLE);
    if (in_array($val, $tableauAleatoire)) {
        $valeursTrouvables[] = $val;
    } else {
        $valeursIntrouvables[] = $val;
    }
    $valeursTrouvables = array_slice($valeursTrouvables, 0, NB_VALEURS);
    $valeursIntrouvables = array_slice($valeursIntrouvables, 0, NB_VALEURS);
} while (
    count($valeursTrouvables) < NB_VALEURS
    || count($valeursIntrouvables) < NB_VALEURS
);

$algorithmes = [
    'sequentielle'   => "rechercheSequentielle",
    'par dichotomie' => "rechercheDichotomie",
    'native'         => "array_search"
];

foreach ($algorithmes as $name => $function) {
    echo '-----------------------' . PHP_EOL;
    echo strtoupper('Recherche ' . $name) . PHP_EOL;
    echo '-----------------------' . PHP_EOL;
    foreach (['valeursTrouvables', 'valeursIntrouvables'] as $listeValeurs) {
        $performances = [];
        foreach ($$listeValeurs as $val) {
            $start = microtime(true);
            $resultat = $function($val, $tableauAleatoire);
            $end = microtime(true);
            $performances[] = round(($end - $start) * 1000000, 3);
        }
        echo $listeValeurs
            . ' : Min=' . min($performances)
            . 'µs ; Max=' . max($performances)
            . 'µs ; Avg=' . round(array_sum($performances) / count($performances), 3) . 'µs'
            . PHP_EOL;
    }
}