<?php 
// ROUTER DES PROJETS

// ROUTE DES PROJETS
// PATTERN : /projects/id/slug.html
// CTRL : projetsController
// ACTION : indexAction
if (isset($_GET['projets']) && isset($_GET['id'])) :
    include_once '../app/controllers/projetsController.php';
    \App\Controllers\ProjetsController\indexAction($connexion);

// ROUTE DU FORMULAIRE D'AJOUT
// PATTERN : /projects/add/form.html
// CTRL : projetsController
// ACTION : addAction
elseif (isset($_GET['form'])) :
    include_once '../app/controllers/projetsController.php';
    \App\Controllers\ProjetsController\addAction($connexion);

// ROUTE D'INSERTION
// PATTERN : /projects/add/insert.html
// CTRL : projetsController
// ACTION : insertAction
elseif (isset($_GET['insert'])) :
    include_once '../app/controllers/projetsController.php';
    \App\Controllers\ProjetsController\insertAction($connexion);

// ROUTE DU FORMULAIRE DE MODIFICATION
// PATTERN : /projects/id/slug/edit/form.html
// CTRL : projetsController
// ACTION : editAction
elseif (isset($_GET['edit']) && isset($_GET['id'])) :
    include_once '../app/controllers/projetsController.php';
    \App\Controllers\ProjetsController\editAction($connexion);

// ROUTE DE MISE À JOUR
// PATTERN : /projects/id/slug/edit/update.html
// CTRL : projetsController
// ACTION : updateAction
elseif (isset($_GET['update']) && isset($_GET['id'])) :
    include_once '../app/controllers/projetsController.php';
    \App\Controllers\ProjetsController\updateAction($connexion);

// ROUTE DE SUPPRESSION
// PATTERN : /projects/delete/id/slug.html
// CTRL : projetsController
// ACTION : deleteAction
elseif (isset($_GET['delete']) && isset($_GET['id'])) :
    include_once '../app/controllers/projetsController.php';
    \App\Controllers\ProjetsController\deleteAction($connexion);

else :
    echo "Route de projet introuvable.";
endif;