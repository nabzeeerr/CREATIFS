<?php
namespace App\Models\TagsModel;

use \PDO;

// Je récupère tous les tags
function findAll(PDO $connexion): array {

    $sql = "SELECT *
            FROM tags
            ORDER BY nom DESC;";
    return $connexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

// Je récupère les tags associés à un projet
function findAllByProjet(PDO $connexion, int $idProjet): array {

    $sql = "SELECT tags.*
            FROM tags
            JOIN projets_has_tags ON tags.id = projets_has_tags.tag
            WHERE projets_has_tags.projet = :idProjet
            ORDER BY tags.nom ASC;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':idProjet', $idProjet, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}

// J'associe les tags sélectionnés à un projet
function addTagsToProjet(PDO $connexion, int $idProjet, array $tags): void {

    $sql = "INSERT INTO projets_has_tags (projet, tag)
            VALUES (:projet, :tag);";

    $rs = $connexion->prepare($sql);

    foreach ($tags as $tag) {
        $rs->execute([':projet' => $idProjet, ':tag' => (int) $tag]);
    }
}

// Je remplace les tags associés à un projet
function updateTagsForProjet(PDO $connexion, int $idProjet, array $tags): void {

    $sql = "DELETE FROM projets_has_tags WHERE projet = :projet";
    $rs = $connexion->prepare($sql);
    $rs->execute([':projet' => $idProjet]);

    addTagsToProjet($connexion, $idProjet, $tags);
}