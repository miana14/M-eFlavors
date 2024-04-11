<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
	// Un MVC utilise uniquement ses requêtes depuis le contrôleur principal : index.php
    die('Erreur : '.basename(__FILE__));
}

?>

<?php require_once './modele/mdl_profil.php';
require_once './modele/mdl_inscription.php';

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adresse_mail_ = $_POST['email'];
    $login = $_POST['login'];
    $mdp_ = $_POST['mdp'];
    $genre = $_POST['genre'];
    $age = $_POST['age'];
    $niveau = $_POST['niv'];
    $id_utilisateur = $_SESSION['id_utilisateur'];
    // 1- verifier si les données sont bonnes 
    $resultVerification = verifierDonnees($adresse_mail_, $mdp_);

    if (empty($resultVerification)) {
        // 2- effectuer l'inscription car les données sont vérifiées
        $resultModificationProfil =  modifierProfil($adresse_mail_,$login,$mdp_,$genre,$age,$niveau, $id_utilisateur);
        if ($resultModificationProfil == "Modifications apportées !") {
            if (!isset($_SESSION)) {
                session_start();
            }
            //3- redirection car l'inscription a marchée
            $_SESSION['email_user'] = $_POST['email'];
            header("Location: ./?action=profil");
        } else {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['msg'] = $resultModificationProfil;
        }

    } else {
        // Rester sur la page d'inscription si jamais on a des erreurs, et les elles sont affichées par la suite
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['msg_mdp'] = $resultVerification;
    }
}

?>


<?php include './vue/vueProfil.php'; ?>