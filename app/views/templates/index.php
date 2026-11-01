<!DOCTYPE html>
<html lang="fr">
  <head>
    <?php include_once '../app/views/templates/partials/_head.php'?>
  </head>

  <body>
    <!-- Navigation -->
    <?php include_once '../app/views/templates/partials/_nav.php'?>

    <!-- Bandeau d'intro -->
    <?php if (!isset($_GET['projets'])) : ?>
    <?php include_once '../app/views/templates/partials/_header.php'; ?>
    <?php endif; ?>

    <!-- Contenu -->
    <div class="container ct-content-wrap">
        <?php echo $content; ?>
    </div>

    <!-- Footer -->
    <?php include_once '../app/views/templates/partials/_footer.php'?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
