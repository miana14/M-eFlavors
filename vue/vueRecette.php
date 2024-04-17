<?php include './vue/vueHead.php'; ?>
<?php include './vue/vueHeader.php'; ?>

<?php if (!isset($_SESSION)) {
    session_start();
}

?>


<?php require_once './modele/mdl_recettes.php'; ?>

<?php $id_recette = $_GET['id_recette']; ?>
<?php $recette = recupRecette($id_recette); ?>

<?php if (isset($_SESSION['is_Admin']) && $_SESSION['is_Admin'] == 1) { //verification si l'utilisateur est admin pour pouvoir afficher le bouton pour pouvoir modifier la recette ?>
    <div class="button-modif-recette">
        <?php echo "<a href='./?action=modificationRecette&id_recette=" . $id_recette . "' >Modifier la recette</a>" ?>
    </div>
<?php } ?>

<?php //recuperation de tous les elemments comme le titre, tesmp, difficulte de la recette pour les afficher ?>


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
            <p id="description"><?= $recette['description']; ?></p>
        </div>
    </article>

    <?php //ingredients ?>

    <?php $recupIngredientsRecette = recupIngredientsRecette($_GET['id_recette']); ?>

    <?php //foreach pour recup les ingredients saisis lors de la creation de recettes ?>

    <article class="ingredients">
        <ul>
            <p id="label">Ingrédients :</p>
            <?php foreach ($recupIngredientsRecette as $ingredient) {
                echo "<li>" . $ingredient['nom_'] . ": lipides(" . $ingredient['lipides_'] . ") - glucides(" . $ingredient['glucides'] . ") - fibres(" . $ingredient['fibres'] . ") - proteines(" . $ingredient['proteines'] . ") - calories(" . $ingredient['calories_'] . ")</li>";
                echo "<br>";
            }
            ?>
        </ul>
    </article>

    <?php //etapes ?>

    <?php $recupEtapes = recupEtapes($_GET['id_recette']); ?>
    <?php $compteur = 1; ?>

    <?php //foreach pour recup les etapes saisis lors de la creation de recettes ?>


    <article class="etapes">
        <ul>
            <p id="label">Etapes :</p>
            <?php foreach ($recupEtapes as $etape) {
                echo "<li>" . $compteur . ". " . $etape['description'] . "</li>";
                echo "<br>";
                $compteur++;
            }

            ?>
        </ul>
    </article>

    <?php if (isset($_SESSION['email_user'])) {  // on verifier que il ya bien un utilisateur de connecté pour qu'il puisse ajouter un commentaire?>
        <article class="ajout-commentaire">
            <h4></h4>
            <form action="./?action=ajoutCommentaire&id_recette=<?= $_GET['id_recette'] ?>" method="POST">
                <textarea name="contenu" id="commentaire" cols="100" rows="5" placeholder="Laissez votre commentaire !"
                    required></textarea>
                <button type="submit">

                    Poster

                </button>
            </form>

        <?php } else { // sinon le user pas connecté aura cet affichage ?>
            <div id="bloc-else-connexion">
                <h3>Veuillez vous connecter pour ajouter un commentaire !</h3>
            </div>
        </article>
    <?php } ?>

    <?php $recupCommentaires = recupCommentaires($_GET['id_recette']); // on recupere les commentaires en fonction de l'id de la recette?>


    <article class="coms">
        <?php if (count($recupCommentaires) > 0) {   // s'il ya des commentaires on affiche ?>
            <h2 class="titre-coms">Commentaires</h2>
        <?php } ?>
        <div class="contenu-coms">
            <?php foreach ($recupCommentaires as $commentaire) {            // recuperation grace a un foreach le login et le contenu du commentaire saisi
                echo "<div class=\"bloc-commentaires\">";
                echo "<h3 class=\"auteur-commentaire\"> Auteur : " . $commentaire['login'] . "</h3>";
                echo "<p class=\"texte-commentaire\">" . $commentaire['contenu'] . "</p>";
                echo "</div>";
            }
            ?>
        </div>
    </article>
</section>


<?php include './vue/vueFooter.php'; ?>