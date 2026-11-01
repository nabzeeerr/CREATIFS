<div class="row">

    <!-- Colonne principale -->
    <div class="col-lg-8">

        <h1><?php echo $projet['titre']; ?></h1>

        <p class="ct-byline">
            par <a href="#"><?php echo $projet['pseudo']; ?></a>
            · <?php echo $projet['dateCreation']; ?>
        </p>

        <a href="/CREATIFS/public/?edit&id=<?php echo $projet['id']; ?>"
            class="ct-btn ct-btn--primary">
            Éditer le projet
        </a>

        <a href="/CREATIFS/public/?delete&id=<?php echo $projet['id']; ?>"
            class="ct-btn ct-btn--danger"
            onclick="return confirm('Tu es sûr de vouloir supprimer ce projet ?');">
            Supprimer le projet
        </a>

        <div style="margin-top: 1.5rem;"></div>
        <article class="ct-card">
            <div class="row">
                <div class="col-md-6">
                    <img
                        class="img-fluid mb-3 mb-md-0"
                        src="/CREATIFS/template/images/<?php echo $projet['image']; ?>"
                        alt="<?php echo $projet['titre']; ?>"
                    />
                </div>
                <div class="col-md-6">
                    <p class="lead" style="font-weight: 600">
                        <?php echo $projet['resume']; ?>
                    </p>
                    <hr />

                    <p>
                        <?php echo $projet['texte']; ?>
                    </p>

                    <hr />

                    <ul class="ct-tags">
                        <?php foreach ($tagsProjet as $tag) : ?>
                            <li>
                                <a class="ct-tag" href="#">
                                    <?php echo $tag['nom']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
        </article>

    </div>

    <!-- Colonne latérale -->
    <div class="col-lg-4">
        <?php include '../app/views/templates/partials/_aside.php'; ?>
    </div>
</div>