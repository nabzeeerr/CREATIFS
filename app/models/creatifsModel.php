<?php
namespace App\Models\CreatifsModel;

use \PDO; 

function findAll(PDO $connexion): array {
    
    $sql = "SELECT creatifs.*, COUNT(projets.id) AS nbProjets
            FROM creatifs
            LEFT JOIN projets ON creatifs.id = projets.creatif
            GROUP BY creatifs.id
            ORDER BY creatifs.id ASC
            LIMIT 4;";
    return $connexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}