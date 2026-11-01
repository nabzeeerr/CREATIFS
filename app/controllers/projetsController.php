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

function addAction(PDO $connexion) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        include_once '../app/models/projetsModel.php';

        $titre = $_POST['titre'];
        $resume = $_POST['resume'];
        $texte = $_POST['texte'];
        $creatif = (int) $_POST['creatif'];

        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            echo "Erreur lors de l'envoi de l'image.";
            exit;
        }

        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = uniqid() . '.' . $extension;

        $type = $_FILES['image']['type'];

        if (in_array($type, ['image/jpeg', 'image/png', 'image/webp'])) {

            $destination = '../template/images/' . $image;

            move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        } 
        else {
            echo "Le fichier envoyé n'est pas une image.";
            exit;
        }

        $id = \App\Models\ProjetsModel\add($connexion, $titre, $resume, $texte, $image, $creatif);

        include_once '../app/models/tagsModel.php';

        $tagsSelectionnes = $_POST['tags'] ?? [];

        \App\Models\TagsModel\addTagsToProjet($connexion, $id, $tagsSelectionnes);

        header('Location: ?projets&id=' . $id);
        exit;
    }
    global $content, $title;

    $title = "Ajouter un projet";

    include_once '../app/models/creatifsModel.php';
    $creatifs = \App\Models\CreatifsModel\findAll($connexion);

    include_once '../app/models/tagsModel.php';
    $tags = \App\Models\TagsModel\findAll($connexion);

    ob_start();
    include '../app/views/projets/form.php';
    $content = ob_get_clean();
}

function editAction(PDO $connexion) {

    include_once '../app/models/projetsModel.php';
    
    $id = (int) $_GET['id'];
    
    $projet = \App\Models\ProjetsModel\findOneById($connexion, $id);
    
    if (!$projet) {
        echo "Projet introuvable.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $titre = $_POST['titre'];
        $resume = $_POST['resume'];
        $texte = $_POST['texte'];
        $creatif = (int) $_POST['creatif'];

        $image = $projet['image'];
        
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {

            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $image = uniqid() . '.' . $extension;

            $type = $_FILES['image']['type'];

            if (in_array($type, ['image/jpeg', 'image/png', 'image/webp'])) {

                $destination = '../template/images/' . $image;

                move_uploaded_file($_FILES['image']['tmp_name'], $destination);

            } else {
                echo "Le fichier envoyé n'est pas une image.";
                exit;
            }
        }
        \App\Models\ProjetsModel\update($connexion, $id, $titre, $resume, $texte, $image, $creatif);

        $tagsSelectionnes = $_POST['tags'] ?? [];

        include_once '../app/models/tagsModel.php';

        \App\Models\TagsModel\updateTagsForProjet($connexion, $id, $tagsSelectionnes);

        header('Location: ?projets&id=' . $id);
        exit;
    }

    include_once '../app/models/creatifsModel.php';
    $creatifs = \App\Models\CreatifsModel\findAll($connexion);

    include_once '../app/models/tagsModel.php';
    $tags = \App\Models\TagsModel\findAll($connexion);

    $tagsProjet = \App\Models\TagsModel\findAllByProjet($connexion, $id);
    global $content, $title;

    $title = "Modifier le projet";

    ob_start();
    include '../app/views/projets/form.php';
    $content = ob_get_clean();
}