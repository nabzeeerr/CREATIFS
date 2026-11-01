<?php
// ROUTER PRINCIPAL

// ROUTE PAR DEFAUT
// PATTERN: /
// CTRL: pagesController
// ACTION: homeAction
include_once '../app/controllers/pagesController.php';
\App\Controllers\PagesController\homeAction($connexion);