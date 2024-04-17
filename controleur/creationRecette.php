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
    $description = $_POST['description'];       // récupération des post 
    $url_image = $_POST['url_image'];
    $nomIngredient = $_POST['ingredient'];
    $descriptionEtape = $_POST['etape'];
    if (!isset($_SESSION)) {
        session_start();
    }

    $resultCreation = ajoutRecette($titre_, $difficulte, $temps, $type_de_plat_, $url_image, $description);


    if (is_numeric($resultCreation)) {                                      // si $resultCreation est numérique et contient l'id de la recette
        $resultEtape = ajoutEtape($descriptionEtape, $resultCreation);      // on fait l'ajout de l'etape
        if ($resultEtape !== "Etape ajoutée avec succès !") {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['msg'] = $resultEtape;
        }

        $ingredients = recupIngredients();      // on recupere les ingredients dans la BDD
        $id_ingredient = rechercheIdByNomFromIngredients($ingredients, $nomIngredient);  // recupere la fonction qui permet de faire la recherche des ingredients via leur id 

        if ($id_ingredient != false) {      // si l'id ingredient est vrai 
            $resultIngredientRecette = ajoutIngredientDansRecette($resultCreation, $id_ingredient);         
            if ($resultIngredientRecette !== "L'ajout a été fait !") {      // on fait l'ajout de l'ingredient
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['msg'] = $resultIngredientRecette;
            }
        }
        header("Location: ./?action=recette&id_recette=" . $resultCreation); // redirige vers l'id de la recette
    } else {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['msg'] = $resultCreation;
    }
}



?>

<?php

// rechercher l'id d'un ingredient a partir de son nom dans la BDD
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




<?php include './vue/vueCreationRecette.php'; ?>