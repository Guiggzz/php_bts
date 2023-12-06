<?php
//Afficher les 100 premières valeurs de la suite de Fibonacci à l’aide d’un tableau

function fibonacci($n) {
    if ($n == 0) {
        return 0;
    } else if ($n == 1) {
        return 1;
    } else {
        $fibonacciArray = array(0, 1);
        for ($i = 2; $i <= $n; $i++) {
            $fibonacciArray[$i] = $fibonacciArray[$i - 1] + $fibonacciArray[$i - 2];
        }
        return $fibonacciArray[$n];
    }
}

// Exemple d'utilisation :
$n = 10; // Remplacez ceci par le numéro du terme de Fibonacci que vous souhaitez obtenir
$resultat = fibonacci($n);
echo "Le terme numéro $n de la suite de Fibonacci est : $resultat";

?>