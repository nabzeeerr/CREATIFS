<?php
namespace App\Models\ProjetsModel;

use \PDO; 

function findAll(PDO $connexion): array {
    
    $sql = "SELECT projets.*, creatifs.pseudo
            FROM projets
            JOIN creatifs ON projets.creatif = creatifs.id
            ORDER BY projets.dateCreation DESC
            LIMIT 10;";
    return $connexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}