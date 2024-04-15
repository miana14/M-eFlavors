<?php

$fichier = null;
$action = "default";
function routage($action)
{

    switch ($action) {
        case "admin":
            $fichier = "admin.php";
            break;
        case "supprimerUtilisateur":
            $fichier = "supprimerUtilisateur.php";
            break;
        case "connexion":
            $fichier = "connexion.php";
            break;
        case "inscription":
            $fichier = "inscription.php";
            break;
        case "profil":
            $fichier = "profil.php";
            break;
        case "deconnexion":
            $fichier = "deconnexion.php";
            break;
        case "presentation":
            $fichier = "presentation.php";
            break;
        case "recettes":
            $fichier = "nosRecettes.php";
            break;
        case "recette":
            $fichier = "recette.php";
            break;
        case "creationRecette":
            $fichier = "creationRecette.php";
            break;
        case "modificationRecette":
            $fichier = "modificationRecette.php";
            break;
        case "ajoutCommentaire":
            $fichier = "ajoutCommentaireRecette.php";
            break;
        case "forum":
            $fichier = "forum.php";
            break;
        case "contact":
            $fichier = "contact.php";
            break;
        case "mentions":
            $fichier = "mentions.php";
            break;
        case "politiques":
            $fichier = "politiques.php";
            break;
        case "404":
            $fichier = "404.php";
            break;
        default:
            $fichier = "accueil.php";
            break;
    }
    return $fichier;
}

?>