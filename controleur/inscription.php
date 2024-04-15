<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // Un MVC utilise uniquement ses requêtes depuis le contrôleur principal : index.php
    die('Erreur : ' . basename(__FILE__));
}
?>

<?php require_once './modele/mdl_inscription.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $login = $_POST['login'];
    // 1- verifier si les données sont bonnes 
    $resultVerification = verifierDonnees($email, $mdp);

    if (empty($resultVerification)) {
        // 2- effectuer l'inscription car les données sont vérifiées
        $resultInscription = inscriptionUser($email, $login, $mdp);
        if (is_numeric($resultInscription)) {
            if (!isset($_SESSION)) {
                session_start();
            }
            //3- redirection car l'inscription a marchée
            $_SESSION['id_utilisateur'] = $resultInscription;
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['email_user'] = $_POST['email'];
            $_SESSION ['is_Admin'] = 0 ;
            header("Location: ./?action=default");
        } else {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['msg'] = $resultInscription;
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


<?php include './vue/vueInscription.php'; ?>