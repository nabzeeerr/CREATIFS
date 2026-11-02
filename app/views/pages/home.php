<!-- Contenu -->
<div class="container ct-content-wrap">
    <div class="row">        
        <!-- Colonne principale -->
        <div class="col-lg-8">
            <!-- Affichage des projets -->
            <?php foreach($projets as $projet) : ?>
                <article class="ct-card">
                    <div class="row">
                        <!-- Affichage des infos du projet -->
                        <div class="col-md-4">
                            <a href="projects/<?php echo $projet['id']; ?>/<?php echo \Core\Helpers\slugify($projet['titre']); ?>.html">
                            <img class="img-fluid mb-3 mb-md-0" src="/CREATIFS/template/images/<?php echo $projet['image'];?>" alt="<?php echo $projet['titre'];?>" />
                            </a>
                        </div>
                        <div class="col-md-8">
                            <h3><a href="projects/<?php echo $projet['id']; ?>/<?php echo \Core\Helpers\slugify($projet['titre']); ?>.html"><?php echo $projet['titre'];?></a></h3>
                            <p class="ct-byline">par <a href="#"><?php echo $projet['pseudo']; ?></a> · <?php echo \Core\Helpers\formatDate($projet['dateCreation']); ?></p>
                            <p>
                                <?php echo \Core\Helpers\truncate($projet['resume']);?>
                            </p>
                            <a class="ct-btn ct-btn--primary ct-btn--sm" href="projects/<?php echo $projet['id']; ?>/<?php echo \Core\Helpers\slugify($projet['titre']); ?>.html">Voir le projet</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>

                
            <!-- Affichage de la pagination -->
            <nav aria-label="Navigation entre les pages de projets">
                <ul class="pagination ct-pagination" style="justify-content: center">

                    <?php if ($page > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page - 1; ?>">Précédent</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $nbPages; $i++) : ?>
                        <li class="page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $nbPages) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>">Suivant</a>
                        </li>
                    <?php endif; ?>
                    
                </ul>
            </nav>
        </div>

        <!-- Affichage de la sidebar -->
        <div class="col-lg-4">
            <?php include '../app/views/templates/partials/_aside.php'; ?>
        </div>
    </div>
</div>
