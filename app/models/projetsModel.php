<?php
namespace App\Models\ProjetsModel;

use \PDO; 

function findAll(PDO $connexion, int $limit = 10): array {
    
    $sql = "SELECT projets.*, creatifs.pseudo
            FROM projets
            JOIN creatifs ON projets.creatif = creatifs.id
            ORDER BY projets.id ASC
            LIMIT :limit;";
    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->execute();
    
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}

function findOneById(PDO $connexion, int $id): array|false {

    $sql = "SELECT projets.*, creatifs.pseudo
            FROM projets
            JOIN creatifs ON projets.creatif = creatifs.id
            WHERE projets.id = :id;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetch(PDO::FETCH_ASSOC);
}