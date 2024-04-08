<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
	// Un MVC utilise uniquement ses requêtes depuis le contrôleur principal : index.php
    die('Erreur : '.basename(__FILE__));
}

// header ("Location: ?action=default"); 
?>

<?php 
require_once './modele/mdl_connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $result = connexionUser($email,$mdp);

    if ($result == "Le mot de passe est valide !") { 
        if(!isset($_SESSION)){
            session_start(); 
       }
        $_SESSION['email_user'] = $_POST['email'];
        header("Location: ./?action=default");
        // Redirection vers la page d'accueil si la connexion réussit
    } else {
        // Redirection vers la page de connexion avec un message d'erreur si la connexion échoue
        if(!isset($_SESSION)){
             session_start(); 
        }
        $_SESSION['msg'] = $result;
    } 
}
?>

<?php include './vue/vueConnexion.php'; ?>

