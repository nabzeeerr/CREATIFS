<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// DISPATCHER

// 1. Charger l'initialisation 
require_once '../core/init.php';

// 2. Charger le router
require_once '../app/routers/index.php';

// 3. Charger le template
require_once '../app/views/templates/index.php';