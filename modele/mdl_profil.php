<?php
require_once "bdd.php";
?>


<?php
function recupProfil($id_utilisateur)
{

    try {
        $conn = connexionPDO();


        $sql = "SELECT adresse_mail_,login,mdp_,genre,age,niveau  FROM utilisateurs WHERE id_utilisateur = :id_utilisateur";
        $stmtRecupProfil = $conn->prepare($sql);

        $stmtRecupProfil->bindParam(':id_utilisateur', $id_utilisateur);

        if ($stmtRecupProfil->execute()) {
            $recupProfil = $stmtRecupProfil->fetch();
            return $recupProfil;
        } else {
            return "Erreur : " . $sql . "<br>" . $stmtRecupProfil->errorInfo()[2];
        }

    } catch (PDOException $e) {
        return "Erreur de connexion à la base de données, veuillez contacter le service client" . $e->getMessage();
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }
}



function modifierProfil($adresse_mail_, $login, $mdp_, $genre, $age, $niveau, $id_utilisateur)
{

    try {
        $mdp_hache = password_hash($mdp_, PASSWORD_DEFAULT);
        $conn = connexionPDO();


        $sql = "UPDATE utilisateurs SET adresse_mail_ = :adresse_mail_, login = :login, mdp_ = :mdp_, genre = :genre, age = :age, niveau = :niveau  
        WHERE id_utilisateur = :id_utilisateur";

        $adresse_mail_ = htmlspecialchars($adresse_mail_);
        $login = htmlspecialchars($login);

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':adresse_mail_', $adresse_mail_);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':mdp_', $mdp_hache);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':niveau', $niveau);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);

        if ($stmt->execute()) {
            return "Modifications apportées !";
        } else {
            return "Erreur(1) de connexion à la base de données, veuillez contacter le service client";
        }

    } catch (PDOException $e) {
        if($e->getCode() == "23000"){
            return "Email déjà utilisé, veuillez en renseigner un autre.";
        }
        return "Erreur(2) de connexion à la base de données, veuillez contacter le service client";
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }
}

function supprimerUtilisateur($id_utilisateur){

    try {
        $conn = connexionPDO();


        $sql = "DELETE FROM utilisateurs WHERE id_utilisateur = :id_utilisateur";
        $stmtsupprProfils = $conn->prepare($sql);

        $stmtsupprProfils->bindParam(':id_utilisateur', $id_utilisateur);

        if ($stmtsupprProfils->execute()) {
            return "Utilisateur " . $id_utilisateur . " a été supprimé.";
        } else {
            return "Erreur(1) de connexion à la base de données, veuillez contacter le service client";
        }

    } catch (PDOException $e) {
        return "Erreur(2) de connexion à la base de données, veuillez contacter le service client" . $e->getMessage();
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    } 
}

function recupProfils()
{

    try {
        $conn = connexionPDO();


        $sql = "SELECT id_utilisateur, adresse_mail_,login ,is_Admin FROM utilisateurs";
        $stmtRecupProfils = $conn->prepare($sql);


        if ($stmtRecupProfils->execute()) {
            $recupProfils = $stmtRecupProfils->fetchAll();
            return $recupProfils;
        } else {
            return "Erreur : " . $sql . "<br>" . $stmtRecupProfils->errorInfo()[2];
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

