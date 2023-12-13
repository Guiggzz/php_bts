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
        for ($j = $i + 1; $j < $n; $j++) {
            if ($tableau[$i] > $tableau[$j]) {
                $temp = $tableau[$i];
                $tableau[$i] = $tableau[$j];
                $tableau[$j] = $temp;
            }
            }
        }
    
    return $tableau;
}

function triBulles(array $tableau)
{
    $n = count($tableau);
    $test_parcours = true;

    do {
        $test_parcours = false;

        for ($i = 0; $i < $n - 1; $i++) {
            if ($tableau[$i] > $tableau[$i + 1]) {
                $temp = $tableau[$i];
                $tableau[$i] = $tableau[$i + 1];
                $tableau[$i + 1] = $temp;

                $test_parcours = true;
            }
        }
    } while ($test_parcours);

    return $tableau;
}


function triBullesAmeliore(array $tableau)
{
    $n = count($tableau);
    $test_parcours = true;

    while ($test_parcours) {
        $test_parcours = false;

        for ($i = 0; $i < $n - 1; $i++) {
            if ($tableau[$i] > $tableau[$i + 1]) {
                list($tableau[$i], $tableau[$i + 1]) = array($tableau[$i + 1], $tableau[$i]);
                $test_parcours = true;
            }
        }
        $n--;
    }

    return $tableau;
}


function triInsertion($tableau) {
    $n = count($tableau);
    
    for ($i = 1; $i < $n; $i++) {
        $cle = $tableau[$i];
        $j = $i - 1;
        
        while ($j >= 0 && $tableau[$j] > $cle) {
            $tableau[$j + 1] = $tableau[$j];
            $j = $j - 1;
        }
        
        $tableau[$j + 1] = $cle;
    }
    
    return $tableau;
}

echo "Saisissez la taille du tableau : ";
$tailleTableau = intval(trim(fgets(STDIN)));
$tableauAleatoire = genererTableau($tailleTableau);

#echo "Tableau généré : " . json_encode($tableauAleatoire) . PHP_EOL;

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
    echo "Tableau trié par $name : " ;#. json_encode($function === 'sort' ? $tableauCopie : $tableauTrie) . PHP_EOL;
    $diff = ($end - $start) * 1000;
    echo "Durée : " . $diff . " ms" . PHP_EOL;
}
