<?php
namespace App\Models\ProjetsModel;

use \PDO; 

// Je récupère les projets d'une page avec leur créatif associé
function findAll(PDO $connexion, int $page = 1): array {

    $limit = 10;
    $offset = ($page - 1) * $limit;

    $sql = "SELECT projets.*, creatifs.pseudo
            FROM projets
            JOIN creatifs ON projets.creatif = creatifs.id
            ORDER BY projets.id ASC
            LIMIT :limit OFFSET :offset;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->bindValue(':offset', $offset, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}

// Je compte le nombre total de projets
function countAll(PDO $connexion): int {

    $sql = "SELECT COUNT(*) FROM projets;";
    $rs = $connexion->prepare($sql);
    $rs->execute();

    return (int) $rs->fetchColumn();
}

// Je récupère un projet grâce à son identifiant
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

// J'ajoute un nouveau projet dans la base de données
function add(PDO $connexion, string $titre, string $resume, string $texte, string $image, int $creatif): int {

    $sql = "INSERT INTO projets
            (titre, resume, texte, dateCreation, image, creatif)
            VALUES (:titre, :resume, :texte, NOW(), :image, :creatif);";

    $rs = $connexion->prepare($sql);

    $rs->execute([':titre' => $titre, ':resume' => $resume, ':texte' => $texte, ':image' => $image, ':creatif' => $creatif]);

    return (int) $connexion->lastInsertId();
}

// Je modifie un projet existant
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

// Je supprime un projet et ses associations avec les tags
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