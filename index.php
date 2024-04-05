<?php

require dirname(__FILE__) . "/controleur/config.php";
require RACINE . "/controleur/route.php";
// require_once RACINE . "/controleur/connexion.php"; // pour pouvoir utiliser isLoggedOn()


if (isset ($_GET["action"])) {
    $action = $_GET["action"];
}

//Ajoute un controleur secondaire ($fichier) en fonction du metier ($action) :
$fichier = routage($action);
require RACINE . "/controleur/" . $fichier;


?>
