<?php
// ROUTER DES PAGES

// ROUTE DE LA PAGE D'ACCUEIL
// PATTERN : /
// CTRL : pagesController
// ACTION : homeAction
include_once '../app/controllers/pagesController.php';
\App\Controllers\PagesController\homeAction($connexion);