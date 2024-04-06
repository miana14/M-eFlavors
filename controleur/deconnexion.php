<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
	// Un MVC utilise uniquement ses requêtes depuis le contrôleur principal : index.php
    die('Erreur : '.basename(__FILE__));
}
?>
<?php
if(!isset($_SESSION)){
    session_start(); 
}// Démarrer la session


// Vérifier si une session est active
if (isset($_SESSION['email_user'])) { //TEST DE LA DECONNEXION
    // Supprimer toutes les variables de session
    $_SESSION = array();
    // Détruire la session
    session_destroy();
}

// Rediriger vers la page de connexion ou une autre page appropriée
header("Location: ./?action=default");
exit();

?>
