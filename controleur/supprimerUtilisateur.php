<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // Un MVC utilise uniquement ses requêtes depuis le contrôleur principal : index.php
    die('Erreur : ' . basename(__FILE__));
}

?>


<?php require_once './modele/mdl_profil.php';


if (!isset($_SESSION)) {
    session_start();
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $adresse_mail_ = $_POST['email'];
//     $login = $_POST['login'];
//     $mdp_ = $_POST['mdp'];
//     $genre = $_POST['genre'];
//     $age = $_POST['age'];
//     $niveau = $_POST['niv'];
//     $id_utilisateur = $_SESSION['id_utilisateur'];

// }
?>




<?php
include './vue/vueAdmin.php';
?>