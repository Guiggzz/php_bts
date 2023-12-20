<?php

const MAX_NOMBRE = 2000;
const NOMBRES = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 25, 50, 75, 100];
const OPERATIONS = ['+', '-', '*', '/'];

do {
    echo "Saisissez un nombre entier inférieur ou égal à " . MAX_NOMBRE . " : ";
    $nombreCible = intval(trim(fgets(STDIN)));
    if (!is_int($nombreCible)) {
        echo "ERREUR : Vous devez saisir un nombre entier !" . PHP_EOL;
    } else if ($nombreCible > MAX_NOMBRE) {
        echo "ERREUR : Vous devez saisir un nombre inférieur ou égal à " . MAX_NOMBRE . " !" . PHP_EOL;
    }
} while (!(is_int($nombreCible) && $nombreCible <= MAX_NOMBRE));

$nombres = [];
do {
    $nombres[] = NOMBRES[random_int(0, count(NOMBRES) - 1)];
} while (count($nombres) < 6);
rsort($nombres);
// $nombres = [100, 50, 50, 8, 7, 2];
echo "Tirage : " . implode(', ', $nombres) . PHP_EOL;


function calcul(array $elementsCalcul, $afficher = false): int|float
{
    // echo json_encode($elementsCalcul) . PHP_EOL;

    // Premier chiffre
    $resultat = array_shift($elementsCalcul);
    // Tant qu'il reste des éléments
    while (count($elementsCalcul) > 0) {
        // On sort opérateur + prochain chiffre
        $operateur = array_shift($elementsCalcul);
        $operande = array_shift($elementsCalcul);
        // Calcul
        $newResultat = match ($operateur) {
            '+' => $resultat + $operande,
            '-' => $resultat - $operande,
            '*' => $resultat * $operande,
            '/' => $resultat / $operande,
        };
        if ($afficher) {
            echo "{$resultat}{$operateur}{$operande}={$newResultat}" . PHP_EOL;
        }
        // Affection du nouveau résultat
        $resultat = $newResultat;
    }
    return $resultat;
}

function resoudre(int $objectif, array $nombres, array $elementsCalcul = []): ?array
{
    // Si on a déjà des éléments de calcul et que le résultat est égal à l'objectif, c'est la solution, on la retourne
    if (count($elementsCalcul) > 0 && calcul($elementsCalcul) === $objectif) {
        return $elementsCalcul;
    }
    if (count($elementsCalcul) > 0) {
        // Si on a déjà des éléments de calcul, on choisit un opérateur et un nombre
        foreach (OPERATIONS as $operation) {
            foreach ($nombres as $index => $nombre) {
                // Pas de division par 0 (impossible) ou 1 (inutile)
                if ($operation === '/' && $nombre <= 1) {
                    continue;
                }
                // On copie le tableau de nombres
                $copieNombres = array_values($nombres);
                // On supprime le nombre choisi
                array_splice($copieNombres, $index, 1);
                // On copie le tableau des éléments de calcul
                $copieElementsCalcul = array_values($elementsCalcul);
                // On ajoute opérateur et nombre
                $copieElementsCalcul[] = $operation;
                $copieElementsCalcul[] = $nombre;
                // On tente la résolution avec les nouveaux éléments de calcul et les nombres restants
                $resultat = resoudre($objectif, $copieNombres, $copieElementsCalcul);
                // Si on a trouvé une solution on la retourne
                if ($resultat !== null && calcul($resultat) === $objectif) {
                    return $resultat;
                }
            }
        }
    } else {
        // Si on a aucun élément de calcul, on choisit juste un nombre
        foreach ($nombres as $index => $nombre) {
            // On copie le tableau de nombres
            $copieNombres = array_values($nombres);
            // On supprime le nombre choisi
            array_splice($copieNombres, $index, 1);
            // On copie le tableau des éléments de calcul
            $copieElementsCalcul = array_values($elementsCalcul);
            // On ajoute le nombre
            $copieElementsCalcul[] = $nombre;
            // On tente la résolution avec les nouveaux éléments de calcul et les nombres restants
            $resultat = resoudre($objectif, $copieNombres, $copieElementsCalcul);
            // Si on a trouvé une solution on la retourne
            if ($resultat !== null && calcul($resultat) === $objectif) {
                return $resultat;
            }
        }
    }

    // Si on arrive ici, c'est une impasse
    return null;
}

$resultat = resoudre($nombreCible, $nombres);
if ($resultat === null) {
    echo "Aucune solution trouvée..." . PHP_EOL;
} else {
    echo "Solution trouvée : " . PHP_EOL;
    calcul($resultat, true);
}
