<?php
require_once "bdd.php";
?>


<?php 
function recupProfil(){

    try {
        $conn = connexionPDO();
        $adresse_mail_auteur = $_SESSION['email_user'];

        $sql = "SELECT adresse_mail_,login,mdp_,genre,age,niveau  FROM utilisateurs WHERE id_utilisateur = :id_utilisateur";
        $stmtRecupProfil = $conn->prepare($sql);        

        $stmtRecupProfil->bindParam(':adresse_mail_auteur', $adresse_mail_auteur);

        if ( $stmtRecupProfil->execute()) {
            $recupProfil =  $stmtRecupProfil->fetchAll();
            return $recupProfil;
        } else {
            return "Erreur : " . $sql . "<br>" .  $stmtRecupProfil->errorInfo()[2];
        }

    } catch (PDOException $e) {
        return "Erreur de connexion à la base de données, veuillez contacter le service client" . $e->getMessage();
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }
}



function modifierProfil($adresse_mail_,$login,$mdp_,$genre,$age,$niveau)
{

    try {
        $conn = connexionPDO();


        $sql = "UPDATE adresse_mail_,login,mdp_,genre,age,niveau  FROM utilisateurs WHERE id_utilisateur = ";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute()) {
            $recettes = $stmt->fetchAll();
            return $recettes;
        } else {
            return "Erreur : " . $sql . "<br>" . $stmt->errorInfo()[2];
        }

    } catch (PDOException $e) {
        return "Erreur de connexion à la base de données, veuillez contacter le service client" . $e->getMessage();
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }
}





?>