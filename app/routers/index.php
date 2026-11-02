<?php
// ROUTER PRINCIPAL

// Je vérifie si une route concerne les projets
if (
    isset($_GET['projets']) ||
    isset($_GET['form']) ||
    isset($_GET['insert']) ||
    isset($_GET['edit']) ||
    isset($_GET['update']) ||
    isset($_GET['delete'])
) :
    include_once '../app/routers/projetsRouter.php';

else :
    // Sinon, je charge le router des pages
    include_once '../app/routers/pagesRouter.php';

endif;