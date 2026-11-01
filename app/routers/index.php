<?php
// ROUTER PRINCIPAL

// ROUTE DES PROJETS 
// PATTERN : /?projets
// CTRL : projetsController
// ACTION : indexAction
if (isset($_GET['projets'])) :
    include_once '../app/controllers/projetsController.php';
    \App\Controllers\ProjetsController\indexAction($connexion);


// ROUTE DU FORM 
// PATTERN : /?form
// CTRL : FormController
// ACTION : indexAction
elseif (isset($_GET['form'])) :
    include_once '../app/controllers/projetsController.php';
    \App\Controllers\ProjetsController\addAction($connexion);

// ROUTE PAR DEFAUT
// PATTERN: /
// CTRL: pagesController
// ACTION: homeAction
else : 
    include_once '../app/controllers/pagesController.php';
    \App\Controllers\PagesController\homeAction($connexion);
endif;