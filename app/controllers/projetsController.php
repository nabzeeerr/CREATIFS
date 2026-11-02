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

    // Je récupère les créatifs pour la sidebar
    include_once '../app/models/creatifsModel.php';
    $creatifs = \App\Models\CreatifsModel\findAll($connexion);

    // Je récupère tous les tags pour la sidebar
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

    // Je récupère les créatifs pour le formulaire
    include_once '../app/models/creatifsModel.php';
    $creatifs = \App\Models\CreatifsModel\findAll($connexion);

    // Je récupère les tags pour le formulaire
    include_once '../app/models/tagsModel.php';
    $tags = \App\Models\TagsModel\findAll($connexion);

    // Je charge le formulaire d'ajout
    global $content, $title;
    $title = "Ajouter un projet";

    ob_start();
    include '../app/views/projets/form.php';
    $content = ob_get_clean();
}

function insertAction(PDO $connexion) {

    include_once '../app/models/projetsModel.php';

    // Je récupère les données envoyées par le formulaire
    $titre = $_POST['titre'];
    $resume = $_POST['resume'];
    $texte = $_POST['texte'];
    $creatif = (int) $_POST['creatif'];

    // Je vérifie si une image a été envoyée
    if (
        !isset($_FILES['image']) ||
        $_FILES['image']['error'] !== UPLOAD_ERR_OK
    ) {
        echo "Une image est obligatoire.";
        exit;
    }

    // Je récupère l'extension du fichier envoyé
    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    // Je génère un nom unique pour l'image
    $image = uniqid() . '.' . $extension;

    $type = $_FILES['image']['type'];

    // Je vérifie que le format de l'image est autorisé
    if (in_array($type, ['image/jpeg', 'image/png', 'image/webp'])) {

        $destination = '../template/images/' . $image;

        // Je déplace l'image dans le dossier prévu
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);

    } else {
        echo "Le fichier envoyé n'est pas une image.";
        exit;
    }

    // J'enregistre le nouveau projet
    $id = \App\Models\ProjetsModel\add($connexion, $titre, $resume, $texte, $image, $creatif);

    include_once '../app/models/tagsModel.php';

    $tagsSelectionnes = $_POST['tags'] ?? [];

    // J'associe les tags sélectionnés au projet
    \App\Models\TagsModel\addTagsToProjet($connexion, $id, $tagsSelectionnes);

    // Je redirige vers la page d'accueil
    header('Location: /CREATIFS/public/');
    exit;
}

function editAction(PDO $connexion) {

    include_once '../app/models/projetsModel.php';

    $id = (int) $_GET['id'];

    // Je récupère le projet à modifier
    $projet = \App\Models\ProjetsModel\findOneById($connexion, $id);

    if (!$projet) {
        echo "Projet introuvable.";
        exit;
    }

    // Je récupère les créatifs et les tags pour le formulaire
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

function updateAction(PDO $connexion) {

    include_once '../app/models/projetsModel.php';

    $id = (int) $_GET['id'];

    $projet = \App\Models\ProjetsModel\findOneById($connexion, $id);

    if (!$projet) {
        echo "Projet introuvable.";
        exit;
    }

    // Je récupère les données envoyées par le formulaire
    $titre = $_POST['titre'];
    $resume = $_POST['resume'];
    $texte = $_POST['texte'];
    $creatif = (int) $_POST['creatif'];

    // Je conserve l'ancienne image si aucune nouvelle n'est envoyée
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

    // Je mets à jour le projet
    \App\Models\ProjetsModel\update($connexion, $id, $titre, $resume, $texte, $image, $creatif);

    include_once '../app/models/tagsModel.php';

    $tagsSelectionnes = $_POST['tags'] ?? [];

    // Je mets à jour les tags associés au projet
    \App\Models\TagsModel\updateTagsForProjet($connexion, $id, $tagsSelectionnes);

    // Je redirige vers la page du projet
    header('Location: /CREATIFS/public/projects/' . $id . '/' . \Core\Helpers\slugify($titre) . '.html');
    exit;
}

function deleteAction(PDO $connexion) {

    include_once '../app/models/projetsModel.php';

    $id = (int) $_GET['id'];

    // Je supprime le projet
    \App\Models\ProjetsModel\delete($connexion, $id);

    // Je redirige vers la page d'accueil
    header('Location: /CREATIFS/public/');
    exit;
}