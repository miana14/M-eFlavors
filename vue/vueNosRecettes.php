<?php include './vue/vueHead.php'; ?>
<?php include './vue/vueHeader.php'; ?>

<?php require_once './modele/mdl_recettes.php'; ?>

<?php 
$recettes = recupRecettes();
foreach ($recettes as $recette) {
        echo"<div>";
        echo"<div>";
        echo"<h2>". $recette['titre_'] ."</h2>";
        echo"<p>". $recette['login'] ." </p>";
        echo"<img  src='". $recette['url_image'] ."'>";
        echo"<a href='./?action=recette&id_recette=". $recette['id_recette'] ."'>Voir la recette</a>";
        echo"</div>";
        echo"</div>";
}
?>

<?php include './vue/vueFooter.php'; ?>