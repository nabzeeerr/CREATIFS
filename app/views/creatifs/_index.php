<!-- Creatifs side -->
<h5 class="ct-side-card__head">Les créa'tifs</h5>
<div class="ct-side-card__body">
    <ul class="ct-creatif-list">
        <?php foreach($creatifs as $creatif) : ?>
            <li>
                <img class="ct-avatar" src="../template/images/<?php echo $creatif['image'];?>" alt="" />
                <a href="#"><?php echo $creatif['pseudo'];?></a>
                <span class="ct-count"><?php echo $creatif['nbProjets']; ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>