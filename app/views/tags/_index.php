<!-- Affichage du titre de la section -->
<h5 class="ct-side-card__head">Tags</h5>

<!-- Liste des tags disponibles -->
<div class="ct-side-card__body">
    <ul class="ct-tags">
        <?php foreach($tags as $tag) : ?>
            <li>
                <a class="ct-tag" href="#">
                    <?php echo $tag['nom']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>