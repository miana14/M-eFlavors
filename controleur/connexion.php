<?php
/**
*	Controleur secondaire : connexion 
*/
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
	// Un MVC utilise uniquement ses requêtes depuis le contrôleur principal : index.php
    die('Erreur : '.basename(__FILE__));
}

// header ("Location: ?action=default"); 

?>
<?php 
include './modele/mdl_connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    if ($result) {
        // Redirection vers la page d'accueil si la connexion réussit
        header("Location: accueil.php");
        exit();
    } else {
        // Redirection vers la page de connexion avec un message d'erreur si la connexion échoue
        header("Location: connexion.php?erreur=1");
        exit();
    }
}?>
<?php include './vue/vueConnexion.php'; ?>
