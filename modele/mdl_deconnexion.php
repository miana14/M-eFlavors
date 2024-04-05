<?php
// Fonction de déconnexion de l'utilisateur
function deconnexionUtilisateur() {
    // Démarrez la session
    session_start();

    // Détruisez toutes les données de session
    $_SESSION = array();

    // Invalidez le cookie de session en le mettant à une date antérieure à l'heure actuelle
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }

    // Détruisez la session
    session_destroy();

    // Redirigez l'utilisateur vers la page de connexion ou une autre page appropriée
    header("Location: ./?action=connexion");
    exit();
}

// Vérifiez si l'action de déconnexion est déclenchée
if ($_GET['action'] === 'deconnexion') {
    // Appeler la fonction de déconnexion
    deconnexionUtilisateur();
}
?>