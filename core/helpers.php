<?php
namespace Core\Helpers;

function truncate (string $string, int $lg_max = 100) : string {

    if (strlen($string) > $lg_max) :
        $string = substr($string, 0, $lg_max);
        $last_space = strrpos($string, " ");
        return substr($string, 0, $last_space)."...";
    endif;
    return $string;
}
    
function slugify(string $string): string {

    $string = strtolower($string);

    $string = str_replace(
        [' ', '.', '!', '?', "'", ';'],
        '-',
        $string
    );

    $string = str_replace(
        ['é', 'è', 'ê', 'à', 'ç', 'â'],
        ['e', 'e', 'e', 'a', 'c', 'a'],
        $string
    );

    return $string;
}

?>
