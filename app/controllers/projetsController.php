<?php
namespace App\Controllers\ProjetsController;

use \PDO;

function indexAction(PDO $connexion) {

    // Je demande le projet au modèle
    include_once '../app/models/projetsModel.php';

    $id = (int) $_GET['id'];

    $projet = \App\Models\ProjetsModel\findOneById($connexion, $id);

    // Je charge la vue du projet
    global $content, $title;

    $title = $projet ? $projet['titre'] : "Projet introuvable";

    include_once '../app/models/creatifsModel.php';
    $creatifs = \App\Models\CreatifsModel\findAll($connexion);

    include_once '../app/models/tagsModel.php';
    // Tous les tags pour la sidebar
    $tags = \App\Models\TagsModel\findAll($connexion);

    // Tags associés au projet
    $tagsProjet = \App\Models\TagsModel\findAllByProjet($connexion, $id);

    ob_start();
    include '../app/views/projets/index.php';
    $content = ob_get_clean();
}