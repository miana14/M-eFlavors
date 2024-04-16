<?php include './vue/vueHead.php'; ?>
<?php include './vue/vueHeader.php'; ?>

<?php require_once './modele/mdl_recettes.php'; ?>

<?php $id_recette = $_GET['id_recette']; ?>

<?php if (isset($_SESSION['is_Admin']) && $_SESSION['is_Admin'] == 1) { ?>

<?php $recette = recupRecette($id_recette) ?>

    <section>


        <article class="form-modif-recette">
            <h2>Modification de Recette</h2>
            <form action="./?action=modificationRecette" method="POST" class="form">

                <input type='hidden' name="id_recette" value="<?php echo $id_recette ?>"></input>

                <label for="titre">Titre</label><br>
                <input type="text" id="titre" name="titre" required value="<?php echo $recette['titre_']?>">
                <br>
                <label for="description">Description</label><br>
                <input type="text" id="description" name="description" required value="<?php echo $recette['description']?>">
                <br>

                <fieldset>
                    <legend>Type de plat</legend>

                    <div id="type_de_plat">
                        <input type="radio" id="entree" name="type_de_plat" value="entree" <?php if($recette['type_de_plat_'] == 'entree') echo "checked"?>/>
                        <label for="entree">Entrée</label>

                        <input type="radio" id="plat" name="type_de_plat" value="plat" <?php if($recette['type_de_plat_'] == 'plat') echo "checked"?>/>
                        <label for="plat">Plat</label>

                        <input type="radio" id="dessert" name="type_de_plat" value="dessert" <?php if($recette['type_de_plat_'] == 'dessert') echo "checked"?>/>
                        <label for="dessert">Dessert</label>
                    </div>
                </fieldset><br>
                <fieldset>
                    <legend>Difficulté</legend>

                    <div id="difficulte">
                        <input type="radio" id="facile" name="difficulte" value="facile" checked <?php if($recette['difficulte'] == 'facile') echo "checked"?>/>
                        <label for="facile">Facile</label>

                        <input type="radio" id="moyen" name="difficulte" value="moyen" <?php if($recette['difficulte'] == 'moyen') echo "checked"?>/>
                        <label for="moyen">Moyen</label>

                        <input type="radio" id="difficile" name="difficulte" value="difficile" <?php if($recette['difficulte'] == 'difficile') echo "checked"?>/>
                        <label for="difficile">Difficile</label>
                    </div>
                </fieldset>
                <br>
                <br>
                <label for="temps">Temps</label><br>
                <input type="text" id="temps" name="temps" value="<?php echo $recette['temps']?>">
                <br>
                <label for="url_image">Image</label><br>
                <input type="text" id="url_image" name="url_image" placeholder="url de l'image" required value="<?php echo $recette['url_image']?>">
                <br>
                <label for="ingredient">Ingrédients</label><br>
                <input type="text" id="ingredients" name="ingredient" >
                <br>
                <label for="etape">Etapes</label><br>
                <textarea id="etape" name="etape" ></textarea>
                <br>
                <br>

                <input type="submit" value="SOUMETTRE" class="form-button" />

            </form>
        </article>
    </section>
<?php } else {
    header("Location: ./?action=404");
} ?>