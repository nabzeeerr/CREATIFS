<?php
namespace Core\Helpers;

// Je raccourcis un texte s'il dépasse la longueur maximale
function truncate(string $string, int $lg_max = 100): string {

    if (strlen($string) > $lg_max) :

        // Je coupe le texte à la longueur maximale
        $string = substr($string, 0, $lg_max);

        // Je récupère la position du dernier espace
        $last_space = strrpos($string, " ");

        // Je coupe le texte au dernier espace pour éviter de couper un mot
        $string = substr($string, 0, $last_space);

        // Je retire la ponctuation à la fin du texte
        $string = rtrim($string, ".,;:!?");

        // J'ajoute trois points à la fin du texte raccourci
        return $string . "...";

    endif;

    return $string;
}
    
// Je transforme un texte en slug pour les URL
function slugify(string $string): string {

    // Je convertis le texte en minuscules
    $string = strtolower($string);

    // Je remplace les espaces et certains signes par des tirets
    $string = str_replace(
        [' ', '.', '!', '?', "'", ';'],
        '-',
        $string
    );

    // Je remplace les caractères accentués par leur équivalent sans accent
    $string = str_replace(
        ['é', 'è', 'ê', 'à', 'ç', 'â'],
        ['e', 'e', 'e', 'a', 'c', 'a'],
        $string
    );

    return $string;
}

// Je formate une date en français sans afficher l'heure
function formatDate(string $date): string {

    // Je définis les noms des mois en français
    $mois = [
        1 => 'janvier',
        2 => 'février',
        3 => 'mars',
        4 => 'avril',
        5 => 'mai',
        6 => 'juin',
        7 => 'juillet',
        8 => 'août',
        9 => 'septembre',
        10 => 'octobre',
        11 => 'novembre',
        12 => 'décembre'
    ];

    // Je convertis la date en timestamp
    $timestamp = strtotime($date);

    
    return date('j', $timestamp) . ' '
        . $mois[(int) date('n', $timestamp)] . ' '
        . date('Y', $timestamp);
}

?>

