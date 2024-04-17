<?php
require_once "bdd.php";

function verifierDonnees($email, $mdp) // fonction pour verifier le mail et le mdp pour établir une sécurité plus robuste
{
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

function inscriptionUser($email, $login, $mdp)
{
    try {
        $mdp_hache = password_hash($mdp, PASSWORD_DEFAULT); // hachage du mdp
        $conn = connexionPDO();

        $sql = "INSERT INTO utilisateurs (adresse_mail_,login ,mdp_)  VALUES (:email,:login,:mdp)"; // insertion du mail, login et du mdp dans la table utilisateurs de la BDD

        $email = htmlspecialchars($email);  // convertion des caractères spéciaux en entites html
        $login = htmlspecialchars($login);

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email); // lie les parametres et evite les injections sql en séparant les données de la requete
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':mdp', $mdp_hache);

        if ($stmt->execute()) {
            return $conn->lastInsertId();  // insertion d'un id pour l'utilisateur
        } else {
            return "Erreur(1) de connexion à la base de données, veuillez contacter le service client";
        }
    } catch (PDOException $e) {
        return "Erreur(2) de connexion à la base de données, veuillez contacter le service client" .$e->getMessage() ;
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }
}
?>