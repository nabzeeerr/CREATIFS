<div class="container" style="margin-top: 2.5rem">
    <div class="row">
        <!-- Colonne principale -->
        <div class="col-lg-8 py-3">
            <h1 class="mb-4"> 
                <?php echo isset($projet) ? "Modifier un projet" : "Ajouter un projet"; ?>
            </h1>
            <form
                action=""
                method="post"
                enctype="multipart/form-data"
                class="ct-form-card"
            >
                <label for="titre">Titre du projet</label>
                <input 
                    type="text" 
                    name="titre" id="titre" 
                    class="form-control"
                    placeholder="Ex : Frange Kamikaze"
                    value="<?php echo isset($projet) ? $projet['titre'] : ''; ?>" 
                />
                <label for="resume">Résumé</label>
                <textarea 
                    id="resume" 
                    name="resume" 
                    class="form-control" 
                    rows="2"
                    maxlength="255"
                    placeholder="Une phrase d'accroche..."><?php echo isset($projet) ? $projet['resume'] : ''; ?>
                </textarea>

                <label for="texte">Description</label>
                <textarea 
                    id="texte" 
                    name="texte" 
                    class="form-control" 
                    rows="5"
                    placeholder="Racontez l'histoire de ce projet..."><?php echo isset($projet) ? $projet['texte'] : ''; ?>
                </textarea>

                <label for="image">Photo du résultat</label>
                <div class="ct-dropzone">
                    ✂️ Choisissez une image
                    <input
                        type="file"
                        class="form-control-file"
                        id="image"
                        name="image"
                    />
                </div>

                <label for="creatif">Créa'tif</label>
                <select id="creatif" name="creatif" class="form-control">
                    <?php foreach ($creatifs as $creatif) : ?>
                        <option value="<?php echo $creatif['id']; ?>"
                            <?php echo (isset($projet) && $projet['creatif'] == $creatif['id']) ? 'selected' : ''; ?>>
                            <?php echo $creatif['pseudo']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>
                    Tags
                    <span style="font-weight: 400; font-size: 0.8rem; color: #4a3a5a">
                        (facultatif)
                    </span>
                </label>

                <div class="ct-tag-choice">
                    <?php foreach ($tags as $tag) : ?>
                        <label>
                            <input type="checkbox" name="tags[]" value="<?php echo $tag['id']; ?>"
                                <?php
                                    if (isset($projet)) :
                                        foreach ($tagsProjet as $tagProjet) :
                                            if ($tagProjet['id'] == $tag['id']) :
                                                echo 'checked';
                                            endif;
                                        endforeach;
                                    endif;
                                ?>
                            />
                            <?php echo $tag['nom']; ?>
                        </label>
                    <?php endforeach; ?>
                </div>

                <div>
                    <input
                        class="ct-btn ct-btn--primary"
                        type="submit"
                        value="Enregistrer"
                    />
                    <input
                        class="ct-btn ct-btn--ghost"
                        type="reset"
                        value="Réinitialiser"
                    />
                </div>
            </form>

        </div>

        <!-- Colonne latérale -->
        <div class="col-lg-4">
            <?php include '../app/views/templates/partials/_aside.php'; ?>
        </div>

    </div>
</div>
