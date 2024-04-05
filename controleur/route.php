<?php

$fichier = null;
$action = "default";
function routage($action)
{

    switch ($action) {
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
        default:
            $fichier = "accueil.php";
            break;
    }
    return $fichier;
}

?>