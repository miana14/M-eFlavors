<?php include './vue/vueHead.php'; ?>
<?php include './vue/vueHeader.php'; ?>

<?php if (!isset($_SESSION)) {
    session_start();
}
?>

<?php require_once './modele/mdl_recettes.php'; ?>


<?php $recette = recupRecette($_GET['id_recette']); ?>

<section>
    <article class="info-recette">
        <ul>
            <li id="difficulte">
                Difficulté : <?= $recette['difficulte']; ?>
            </li>
            <li id="temps">
                Durée : <?= $recette['temps']; ?>
            </li>
            <li id="type_de_plat">
                Type de plat : <?= $recette['type_de_plat_']; ?>
            </li>
        </ul>
    </article>


    <article class="description-recette">
        <div id="img">
            <img src="<?= $recette['url_image']; ?>" alt="<?php ?>">
        </div>
        <div class="contenu">
            <h1 id="titre_recette"><?= $recette['titre_']; ?></h1>
            <p id="auteur"><?= $recette['login']; ?></p>
            <p id="description"><?= $recette['description']; ?></p>
        </div>
    </article>

    <!--  ingredients   -->

    <?php $recupIngredientsRecette = recupIngredientsRecette($_GET['id_recette']); ?>

    <article class="ingredients">
        <ul>
            <p id="label">Ingrédients :</p>
            <?php foreach ($recupIngredientsRecette as $ingredient) {
                echo "<li>" . $ingredient['nom_'] . " " . $ingredient['lipides_'] . " " . $ingredient['glucides'] . " " . $ingredient['fibres'] . " " . $ingredient['proteines'] . " " . $ingredient['calories_'] . "</li>";
            }
            ?>
        </ul>
    </article>

    <!--  etapes   -->

    <?php $recupEtapes = recupEtapes($_GET['id_recette']); ?>
    <?php $compteur = 1; ?>


    <article class="etapes">
        <ul>
            <p id="label">Etapes :</p>
            <?php foreach ($recupEtapes as $etape) {
                echo "<li>" . $compteur . ". " . $etape['description'] . "</li>";
                $compteur++;
            }

            ?>
        </ul>
    </article>

    <?php if (isset($_SESSION['email_user'])) { ?>
        <article class="ajout-commentaire">
            <h4></h4>
            <form action="./?action=recette&id_recette=" method="POST">
                <textarea name="contenu" id="commentaire" cols="100" rows="5"></textarea>
                <button type="submit">
                    
                        Poster
                  
                </button>
            </form>
            <?php // recup du login user correspondant à l'id_recette   ?>
            <p>
                <?php // recup du commentaire correpondant a l'id_utilisateur en lien avec l'id_recette  ?>
            </p>

        <?php } else { ?>
            <div id="bloc-else-connexion">
                <h3>Veuillez vous connecter pour ajouter un commentaire !</h3>
            </div>
        </article>
    <?php } ?>

    <?php $recupCommentaires = recupCommentaires($_GET['id_recette']); ?>

    <article class="commentaires">
            <?php foreach ($recupCommentaires as $commentaire) {
                echo "<h3 class=\"auteur-commentaire\">" . $commentaire['login'] . "</h3>";
                echo "<p class=\"texte-commentaire\">" . $commentaire['contenu'] . "</p>";
            }

            ?>
    </article>
</section>


<?php include './vue/vueFooter.php'; ?>