<?php
require_once "bdd.php"; 

// Fonction pour connecter l'utilisateur
function connexionUser($email, $mdp) {
    try {
        $conn = connexionPDO();

        // Préparez la requête SQL pour vérifier les informations de connexion
        $sql = "SELECT mdp_ FROM utilisateurs WHERE adresse_mail_ = :email";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Vérifiez si l'utilisateur existe dans la base de données
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $mot_de_passe_hache = $row['mdp_'];

            if (password_verify($mdp, $mot_de_passe_hache)) {
                session_start();
                return "Le mot de passe est valide !";
            } else {
                return "Mot de passe incorrect.";
            }
        } else {
            return "Identifiant incorrect.";
        }
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    // Appeler la fonction pour connecter l'utilisateur
    $message = connexionUser($email, $mdp);
    echo $message;
}
?>