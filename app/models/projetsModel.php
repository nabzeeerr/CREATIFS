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

function add(PDO $connexion, string $titre, string $resume, string $texte, string $image, int $creatif): int {

    $sql = "INSERT INTO projets
            (titre, resume, texte, dateCreation, image, creatif)
            VALUES (:titre, :resume, :texte, NOW(), :image, :creatif);";

    $rs = $connexion->prepare($sql);

    $rs->execute([':titre' => $titre, ':resume' => $resume, ':texte' => $texte, ':image' => $image, ':creatif' => $creatif]);

    return (int) $connexion->lastInsertId();
}

function update(PDO $connexion, int $id, string $titre, string $resume, string $texte, string $image, int $creatif): void {

    $sql = "UPDATE projets
            SET titre = :titre,
                resume = :resume,
                texte = :texte,
                image = :image,
                creatif = :creatif
            WHERE id = :id;";

    $rs = $connexion->prepare($sql);

    $rs->execute([':titre' => $titre, ':resume' => $resume, ':texte' => $texte, ':image' => $image, ':creatif' => $creatif, ':id' => $id]);
}

function delete(PDO $connexion, int $id): void {

    // Supprimer les associations avec les tags
    $sql = "DELETE FROM projets_has_tags WHERE projet = :id;";
    $rs = $connexion->prepare($sql);
    $rs->execute([':id' => $id]);

    // Supprimer le projet
    $sql = "DELETE FROM projets WHERE id = :id;";
    $rs = $connexion->prepare($sql);
    $rs->execute([':id' => $id]);
}