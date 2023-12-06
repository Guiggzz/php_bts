<?php

function genererTableau(int $taille): array
{
    $tableau = range(1, $taille);
    shuffle($tableau);
    return $tableau;
}

function triEchange(array $tableau){
    $n = count($tableau);
    for ($i = 0; $i < $n - 1; $i++) {
        $indiceMin = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            if ($tableau[$j] < $tableau[$indiceMin]) {
                $indiceMin = $j;
            }
        }
        if ($indiceMin !== $i) {
            $temp = $tableau[$i];
            $tableau[$i] = $tableau[$indiceMin];
            $tableau[$indiceMin] = $temp;
        }
    }
    
    return $tableau;
}

function triBulles(array $tableau)
{
}

function triBullesAmeliore(array $tableau)
{
}

function triInsertion(array $tableau)
{
}

echo "Saisissez la taille du tableau : ";
$tailleTableau = intval(trim(fgets(STDIN)));
$tableauAleatoire = genererTableau($tailleTableau);

echo "Tableau généré : " . json_encode($tableauAleatoire) . PHP_EOL;

$algorithmes = [
    'échange'         => "triEchange",
    'bulles'          => "triBulles",
    'bulles amélioré' => "triBullesAmeliore",
    'insertion'       => "triInsertion",
    'natif'           => "sort"
];
foreach ($algorithmes as $name => $function) {
    echo PHP_EOL;
    echo "---------------";
    echo PHP_EOL;
    $start = microtime(true);
    $tableauCopie = $tableauAleatoire; // Copie du tableau initial
    $tableauTrie = $function($tableauCopie);
    $end = microtime(true);
    echo "Tableau trié par $name : " . json_encode($function === 'sort' ? $tableauCopie : $tableauTrie) . PHP_EOL;
    $diff = $end - $start * 1000;
    echo "Durée : " . $diff . " ms" . PHP_EOL;
}
