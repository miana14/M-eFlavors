<?php include './vue/vueHead.php'; ?>
<?php include './vue/vueHeader.php'; ?>

<?php require_once './modele/mdl_recettes.php'; ?>

<?php $recette = recupRecette($_GET['id_recette']); ?>

<section>
    <article class="info-recette">
        <ul>
            <li id="difficulte">
                <?= $recette['difficulte']; ?>
            </li>
            <li id="temps">
                <?= $recette['temps']; ?>
            </li>
            <li id="type_de_plat">
                <?= $recette['type_de_plat_']; ?>
            </li>
        </ul>
    </article>


    <article class="description-recette">
        <div id="img">
            <img src="<?php ?>" alt="<?php ?>">
        </div>
        <div>
            <h1 id="titre_recette"></h1>
            <p id="auteur"></p>
            <p id="description"></p>
        </div>
    </article>

    <!--  ingredients   -->

    <?php $recupIngredientsRecette = recupIngredientsRecette($_GET['id_recette']); ?>

    <article class="ingredients">
        <ul class="afficher les numeros en css">
            <?php foreach ($recupIngredientsRecette as $ingredient) {
                echo "<li>" . $ingredient['nom_'] . " " . $ingredient['lipides_'] . " " . $ingredient['glucides'] . " " . $ingredient['fibres'] . " " . $ingredient['proteines'] . " " . $ingredient['calories_'] . "</li>"; // . " " .
            }
            ?>
        </ul>
    </article>

    <!--  etapes   -->

    <?php $recupEtapes = recupEtapes($_GET['id_recette']); ?>


    <article class="etapes">
        <ol class="afficher les numeros en css">
            <?php foreach ($recupEtapes as $etape) {
                echo "<li>" . $etape['description'] . "</li>";
            }

            ?>
        </ol>
    </article>


    <article class="ajout-commentaire">
        <!-- ajout de la partie commentaire, visible seulement par les utilisateurs inscrits -->
        <h4>
            <?php // recup du login user correspondant à l'id_recette    ?>
        </h4>
        <p>
            <?php // recup du commentaire correpondant a l'id_utilisateur en lien avec l'id_recette    ?>
        </p>
    </article>


    <article class="commentaires">
        <ul>
            <?php // le foreach avec les li correspondant aux quantités de commentaires existants   ?>
        </ul>
    </article>
</section>


<?php include './vue/vueFooter.php'; ?>