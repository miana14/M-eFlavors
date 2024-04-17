<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {

    die('Erreur : '.basename(__FILE__));
}

?>

<?php 
require_once './modele/mdl_connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") { // récupération des données POST
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $result = connexionUser($email,$mdp);

    
    // on teste les return

    if ($result == "Mot de passe incorrect." || $result == "Identifiant incorrect." || $result == "Erreur de connexion à la base de données, veuillez contacter le service client") { 
        if (!isset($_SESSION)){
            session_start(); 
       }
       $_SESSION['msg'] = $result;
        // Redirection vers la page de connexion avec un message d'erreur si la connexion échoue
    } else {
        // Redirection vers la page d'accueil si la connexion réussit
        if (!isset($_SESSION)){
            session_start();
       }
       $_SESSION['id_utilisateur'] = $result['id_utilisateur'];
        $_SESSION['email_user'] = $_POST['email'];
        $_SESSION['login'] = $result['login'];
        $_SESSION['is_Admin'] = $result['is_Admin'];                // mise en place de la session avec la récupération des post
       header("Location: ./?action=default");
    } 
    
}
?>

<?php include './vue/vueConnexion.php'; ?>

