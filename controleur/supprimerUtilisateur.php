<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    
    die('Erreur : ' . basename(__FILE__));
}

?>


<?php require_once './modele/mdl_profil.php';


if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_utilisateur = $_POST['id_utilisateur']; // on recupere l'id de l'utilisateur

    $supprimer = supprimerUtilisateur($id_utilisateur); 

    
    if ($supprimer == "Utilisateur " . $id_utilisateur . " a été supprimé.") { // on verifie si ça revoie le bon return de la fonction supprimerUtilisateur
        header("Location: ./?action=admin");
    } else {
        $_SESSION['msg'] = $supprimer;
    }
}
?>


<?php
include './vue/vueAdmin.php';
?>