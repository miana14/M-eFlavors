<?php include './vue/vueHead.php'; ?>
<?php include './vue/vueHeader.php'; ?>

<?php if (isset($_SESSION['is_Admin']) && $_SESSION['is_Admin'] == 1) { // verifie si l'utilisateur est admin, alors on affiche?>

    <section>


        <article class="form-creation-recette">
            <h2>Création de Recette</h2>
            <form action="./?action=creationRecette" method="POST" class="form">

                <label for="titre">Titre</label><br>
                <input type="text" id="titre" name="titre" required>
                <br>
                <label for="description">Description</label><br>
                <input type="text" id="description" name="description" required>
                <br>

                <fieldset>
                    <legend>Type de plat</legend>

                    <div id="type_de_plat">
                        <input type="radio" id="entree" name="type_de_plat" value="entree" />
                        <label for="entree">Entrée</label>

                        <input type="radio" id="plat" name="type_de_plat" value="plat" />
                        <label for="plat">Plat</label>

                        <input type="radio" id="dessert" name="type_de_plat" value="dessert" />
                        <label for="dessert">Dessert</label>
                    </div>
                </fieldset><br>
                <fieldset>
                    <legend>Difficulté</legend>

                    <div id="difficulte">
                        <input type="radio" id="facile" name="difficulte" value="facile" checked />
                        <label for="facile">Facile</label>

                        <input type="radio" id="moyen" name="difficulte" value="moyen" />
                        <label for="moyen">Moyen</label>

                        <input type="radio" id="difficile" name="difficulte" value="difficile" />
                        <label for="difficile">Difficile</label>
                    </div>
                </fieldset>
                <br>
                <br>
                <label for="temps">Temps</label><br>
                <input type="text" id="temps" name="temps">
                <br>
                <label for="url_image">Image</label><br>
                <input type="text" id="url_image" name="url_image" placeholder="url de l'image" required>
                <br>
                <label for="ingredient">Ingrédients</label><br>
                <input type="text" id="ingredients" name="ingredient" required>
                <br>
                <label for="etape">Etapes</label><br>
                <textarea id="etape" name="etape" required></textarea>
                <br>
                <br>

                <input type="submit" value="SOUMETTRE" class="form-button" />

            </form>
        </article>
    </section>
<?php } else { // sinon on le renvoie a la page 404
    header("Location: ./?action=404");
} ?>



<?php include './vue/vueFooter.php'; ?>