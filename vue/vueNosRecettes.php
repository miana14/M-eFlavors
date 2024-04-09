<?php include './vue/vueHead.php'; ?>
<?php include './vue/vueHeader.php'; ?>

<?php require_once './modele/mdl_recettes.php'; ?>

<section class="nos_recettes">
        <?php
        $recettes = recupRecettes();
        foreach ($recettes as $recette) {
                echo "<article class=\"card\">";
                echo "<div class=\"card-recette\">";
                echo "<img  src='" . $recette['url_image'] . "'>";
                echo "<div class=\"card-body\">";
                echo "<h2 class=\"card-title\">" . $recette['titre_'] . "</h2>";
                echo "<p class=\"card-texte\">" . $recette['login'] . " </p>";
                echo "</div>";
                echo "<a class=\"card-lien\" href='./?action=recette&id_recette=" . $recette['id_recette'] . "'>Voir la recette</a>";
                echo "</div>";
                echo "</article>";
        }
        ?>
</section>

<?php include './vue/vueFooter.php'; ?>