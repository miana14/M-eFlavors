<?php
require_once "bdd.php";

// Récupérez les données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $login = $_POST['login'];

    function verifierDonnees($email, $mdp) {
        $erreurs = [];
        // Vérifier l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs[] = "L'adresse e-mail n'est pas valide.";
        }
        // Vérifier le mot de passe
        if (strlen($mdp) < 8) {
            $erreurs[] = "Le mot de passe doit contenir au moins 8 caractères.";
        }
        if (!preg_match("/[0-9]+/", $mdp)) {
            $erreurs[] = "Le mot de passe doit contenir au moins un chiffre.";
        }
        if (!preg_match("/[a-zA-Z]+/", $mdp)) {
            $erreurs[] = "Le mot de passe doit contenir au moins une lettre.";
        }
        if (!preg_match("/[!@#\$%\^&\*\(\)_\-\+=\{\}\[\];:\",<>\.\?\|]/", $mdp)) {
            $erreurs[] = "Le mot de passe doit contenir au moins un caractère spécial.";
        }

        return $erreurs;
    }
    // Appliquer les vérifications
    $erreurs = verifierDonnees($email, $mdp);

    // Si des erreurs sont détectées, afficher les messages d'erreur correspondants
    if (!empty($erreurs)) {
        foreach ($erreurs as $erreur) {
            echo $erreur . "<br>";
        }
        exit;
    }

    $email = htmlspecialchars($email);
    $login = htmlspecialchars($login);

    try {
        $mdp_hache = password_hash($mdp, PASSWORD_DEFAULT);
        $conn = connexionPDO();

        $sql = "INSERT INTO utilisateurs (adresse_mail_,login ,mdp_)
                VALUES (:email,:login,:mdp)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':mdp', $mdp_hache);

        if ($stmt->execute()) {
            echo "Inscription réussie !";
            if(!isset($_SESSION)){
                session_start(); 
           }
            exit();
        } else {
            echo "Erreur : " . $sql . "<br>" . $stmt->errorInfo()[2];
        }

        $conn = null;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>