<?php
namespace App\Controllers\PagesController; 

use \PDO;

function homeAction (PDO $connexion) {

    // Je vais dmd des données aux modeles 
    include_once '../app/models/projetsModel.php';
    $projets = \App\Models\ProjetsModel\findAll($connexion);

    include_once '../app/models/creatifsModel.php';
    $creatifs = \App\Models\CreatifsModel\findAll($connexion);

    include_once '../app/models/tagsModel.php';
    $tags = \App\Models\TagsModel\findAll($connexion);

    // Je charge la vue 'home' dans $content
    global $content, $title;
    $title = "HomePage"; 
    ob_start();
    include '../app/views/pages/home.php';
    $content = ob_get_clean();
}