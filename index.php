<?php

require dirname(__FILE__) . "/controleur/config.php";
require RACINE . "/controleur/route.php";


if (isset ($_GET["action"])) {
    $action = $_GET["action"];
}

$fichier = routage($action);
require RACINE . "/controleur/" . $fichier;


?>
