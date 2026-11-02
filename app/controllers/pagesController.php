<?php
namespace App\Controllers\PagesController;

use \PDO;

function homeAction(PDO $connexion) {

    // Je récupère le numéro de page
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

    // Je récupère le nombre total de projets
    include_once '../app/models/projetsModel.php';
    $totalProjets = \App\Models\ProjetsModel\countAll($connexion);

    // Je calcule le nombre de pages
    $nbPages = max(1, (int) ceil($totalProjets / 10));

    // Je vérifie que la page demandée existe
    $page = max(1, min($page, $nbPages));

    // Je récupère les projets de cette page
    $projets = \App\Models\ProjetsModel\findAll($connexion, $page);

    // Je récupère les créatifs pour la sidebar
    include_once '../app/models/creatifsModel.php';
    $creatifs = \App\Models\CreatifsModel\findAll($connexion);

    // Je récupère les tags pour la sidebar
    include_once '../app/models/tagsModel.php';
    $tags = \App\Models\TagsModel\findAll($connexion);

    // Je charge la vue 'home' dans $content
    global $content, $title;
    $title = "HomePage";

    ob_start();
    include '../app/views/pages/home.php';
    $content = ob_get_clean();
}