<!-- Contenu -->
<div class="container ct-content-wrap">
    <div class="row">        
        <!-- Colonne principale -->
        <div class="col-lg-8">
            <!-- Projet 1 — extrait = résumé (champ `resume`) tronqué par truncate(100) -->
            <?php foreach($projets as $projet) : ?>
                <article class="ct-card">
                    <div class="row">
                    <div class="col-md-4">
                        <a href="projet.html">
                        <img class="img-fluid mb-3 mb-md-0" src="../template/images/<?php echo $projet['image'];?>" alt="<?php echo $projet['titre'];?>" />
                        </a>
                    </div>
                    <div class="col-md-8">
                        <h3><a href="projet.html"><?php echo $projet['titre'];?></a></h3>
                        <p class="ct-byline">par <a href="#"><?php echo $projet['pseudo']; ?></a> · <?php echo $projet['dateCreation']; ?></p>
                        <p>
                            <?php echo \Core\Helpers\truncate($projet['resume']);?>
                        </p>
                        <a class="ct-btn ct-btn--primary ct-btn--sm" href="projet.html">Voir le projet</a>
                    </div>
                    </div>
                </article>
            <?php endforeach; ?>

                
            <!-- Pagination : 10 projets par page -->
            <nav aria-label="Navigation entre les pages de projets">
            <ul class="pagination ct-pagination" style="justify-content: center">
                <li class="page-item">
                <a class="page-link" href="#">Précédent</a>
                </li>
                <li class="page-item active">
                <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                <a class="page-link" href="#">Suivant</a>
                </li>
            </ul>
            </nav>
        </div>

        <!-- Colonne latérale -->
        <div class="col-lg-4">
            <?php include '../app/views/templates/partials/_aside.php'; ?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->