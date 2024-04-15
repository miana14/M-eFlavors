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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_utilisateur = $_POST['id_utilisateur'];

    $supprimer = supprimerUtilisateur($id_utilisateur);

    var_dump($supprimer);
    
    if ($supprimer == "Utilisateur " . $id_utilisateur . " a été supprimé.") {
        header("Location: ./?action=admin");
    } else {
        $_SESSION['msg'] = $supprimer;
    }
}
?>


<?php
include './vue/vueAdmin.php';
?>