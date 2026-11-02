<?php
namespace App\Models\CreatifsModel;

use \PDO;

function findAll(PDO $connexion, int $limit = 4): array {

    // Je récupère les créatifs avec le nombre de projets associés
    $sql = "SELECT creatifs.*, COUNT(projets.id) AS nbProjets
            FROM creatifs
            LEFT JOIN projets ON creatifs.id = projets.creatif
            GROUP BY creatifs.id
            ORDER BY creatifs.id ASC
            LIMIT :limit;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}