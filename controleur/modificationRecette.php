<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {

    die('Erreur : '.basename(__FILE__));
}
?>

<?php

require_once './modele/mdl_recettes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre_ = $_POST['titre'];
    $difficulte = $_POST['difficulte'];
    $temps = $_POST['temps'];                       // recuperation des POST
    $type_de_plat_ = $_POST['type_de_plat'];
    $description = $_POST['description'];
    $url_image = $_POST['url_image'];
    $nomIngredient = $_POST['ingredient'];
    $descriptionEtape = $_POST['etape'];
    if (!isset($_SESSION)) {
        session_start();
    }

    $id_recette = $_POST['id_recette'];

    $resultModification = modifierRecette($id_recette,$titre_, $difficulte, $temps, $type_de_plat_, $url_image, $description);


    if ($resultModification == "La modification a réussie !") {         // on verifie si la fonction renvoie la phrase correcte 
        $resultEtape = ajoutEtape($descriptionEtape, $id_recette);      // on ajout par la suite une autre etape
        if ($resultEtape !== "Etape ajoutée avec succès !") {           // on verifie si la fonction renvoie la phrase correcte 
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['msg'] = $resultEtape;
        }

        $ingredients = recupIngredients();
        $id_ingredient = rechercheIdByNomFromIngredients($ingredients, $nomIngredient);

        if ($id_ingredient != false) {
            $resultIngredientRecette = ajoutIngredientDansRecette($id_recette, $id_ingredient); // meme manipulation que pour l'ajout de l'etape
            if ($resultIngredientRecette !== "L'ajout a été fait !") {
                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['msg'] = $resultIngredientRecette;
            }
        }
        header("Location: ./?action=recette&id_recette=" . $id_recette);        // on redirige vers la page avec le bon id recette
    } else {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['msg'] = $resultModification;
    }
}



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
<?php include './vue/vueModificationRecette.php'; ?>