<?php if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // Un MVC utilise uniquement ses requêtes depuis le contrôleur principal : index.php
    die('Erreur : ' . basename(__FILE__));
} ?>


<?php

require_once './modele/mdl_recettes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre_ = $_POST['titre'];
    $difficulte = $_POST['difficulte'];
    $temps = $_POST['temps'];
    $type_de_plat_ = $_POST['type_de_plat'];
    $description = $_POST['description'];
    $url_image = $_POST['url_image'];
    $nomIngredient = $_POST['ingredient'];
    $descriptionEtape = $_POST['etape'];
    if (!isset($_SESSION)) {
        session_start();
    }
    $adresse_mail_auteur = $_SESSION['email_user'];

    $resultCreation = ajoutRecette($titre_, $difficulte, $temps, $type_de_plat_, $url_image, $description, $adresse_mail_auteur);

    // var_dump($resultCreation);

    if (is_numeric($resultCreation)) {
        $resultEtape = ajoutEtape($descriptionEtape, $resultCreation);
        if ($resultEtape !== "Etape ajoutée avec succès !") {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['msg'] = $resultEtape;
        }

        $ingredients = recupIngredients();
        $id_ingredient = rechercheIdByNomFromIngredients($ingredients, $nomIngredient);

        if ($id_ingredient != false) {
            $resultIngredientRecette = ajoutIngredientDansRecette($resultCreation, $id_ingredient);
            if ($resultIngredientRecette !== "L'ajout a été fait !") {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['msg'] = $resultIngredientRecette;
            }
        }
        header("Location: ./?action=recette&id_recette=" . $resultCreation);
    } else {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['msg'] = $resultCreation;
    }
}



?>

<?php

// rechercher l'id d'un ingredient a partir de son nom 
function rechercheIdByNomFromIngredients($ingredients, $nomIngredient)
{
    foreach ($ingredients as $ingredient) {
        if ($ingredient['nom_'] == $nomIngredient) {
            return $ingredient['id_ingredient'];
        }
    }
    return false;
}


?>




<?php //include './vue/vueCreationRecette.php'; ?>