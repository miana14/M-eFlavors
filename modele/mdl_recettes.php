<?php
require_once "bdd.php";

// reecrire les erreurs et les tester ============================================================= A FAIRE =======================


/* ====================================================== RECETTES ================================================================= */

// Fonction pour recuperer les recettes
function recupRecettes()
{

    try {
        $conn = connexionPDO();

        // recup l'auteur, le titre, image
        $sql = "SELECT id_recette, titre_ , url_image, login FROM fiche_recette INNER JOIN utilisateurs ON fiche_recette.id_utilisateur = utlisateur.id_utilisateur";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute()) {
            //2.3.1 Récupération de la ligne de résultat de l'execution de la requête
            $recettes = $stmt->fetchAll();
            //2.3.2 Envoie du résultat pour le traitement de la vue
            return $recettes;
        } else {
            //2.3.3 Dans le cas ou on a une erreur SQL on remonte un message d'erreur
            return "Erreur : " . $sql . "<br>" . $stmt->errorInfo()[2];
        }

    } catch (PDOException $e) {
        return "Erreur de connexion à la base de données, veuillez contacter le service client";
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }
}


// fonction pour recuperer UNE recette
function recupRecette($id_recette)
{
    try {
        $conn = connexionPDO();

        // recup l'auteur, le titre, image
        $sql = "SELECT titre_ , difficulte, temps, type_de_plat_, url_image, description, login FROM fiche_recette INNER JOIN utilisateurs ON fiche_recette.id_utilisateur = utlisateur.id_utilisateur";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute()) {
            //2.3.1 Récupération de la ligne de résultat de l'execution de la requête
            $recette = $stmt->fetch();
            //2.3.2 Envoie du résultat pour le traitement de la vue
            return $recette;
        } else {
            //2.3.3 Dans le cas ou on a une erreur SQL on remonte un message d'erreur
            return "Erreur : " . $sql . "<br>" . $stmt->errorInfo()[2];
        }

    } catch (PDOException $e) {
        return "Erreur de connexion à la base de données, veuillez contacter le service client";
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }
}

// ajouter une nouvelle recette
function ajoutRecette($titre_, $difficulte, $temps, $type_de_plat_, $url_image, $description, $adresse_mail_auteur)
{

    try {
        // 1- Connexion à la base de données
        $conn = connexionPDO();

        // 2- Récupération de id_utilisateur en fonction de l'email fourni par la session

        //2.1 Définition de la requête SQL a éxécuter
        $sqlUtilisateur = "SELECT id_utilisateur FROM utilisateurs WHERE adresse_mail_ = :adresse_mail_auteur";
        //2.2 Préparation de l'objet de connexion a la base de donnée utilisant la requête sql définie précedement
        $stmtUtilisateur = $conn->prepare($sqlUtilisateur);

        //2.3 Complète la requête SQL avec les données à injecter
        $stmtUtilisateur->bindParam(':adresse_mail_auteur', $adresse_mail_auteur);

        //2.4 Execution de la requête SQL
        if ($stmtUtilisateur->execute()) {
            //2.4.1 Récupération de la ligne de résultat de l'execution de la requête
            $row = $stmtUtilisateur->fetch();
            //2.4.2 Récupération de la colonne id_utilisateur de la ligne récupérée précedemment
            $idUtilisateur = $row['id_utilisateur'];
        } else {
            //2.4.3 Dans le cas ou on a une erreur SQL on remonte un message d'erreur
            return "Erreur : " . $sqlUtilisateur . "<br>" . $stmtUtilisateur->errorInfo()[2];
        }

        // 2.5 Test si il y a bien un utilisateur
        if ($idUtilisateur == NULL) {
            //2.5.1 Dans le cas ou l'utilisateur n'existe pas on renvoie un message d'erreur
            return "Erreur : l'utilisateur n'a pas été trouvé en base de données";
        }

        //3-Sauvegarde de la recette en base de donnée

        //3.1
        $sqlAjout = "INSERT INTO fiche_recette (titre_, difficulte, temps, type_de_plat_, url_image, description, id_utilisateur )
                VALUES (:titre_, :difficulte, :temps, :type_de_plat_, :url_image, :description, :id_utilisateur)";
        //3.2
        $stmtAjout = $conn->prepare($sqlAjout);

        //3.3 Liaison des paramètres
        $stmtAjout->bindParam(':titre_', $titre_);
        $stmtAjout->bindParam(':difficulte', $difficulte);
        $stmtAjout->bindParam(':temps', $temps);
        $stmtAjout->bindParam(':type_de_plat_', $type_de_plat_);
        $stmtAjout->bindParam(':url_image', $url_image);
        $stmtAjout->bindParam(':description', $description);
        $stmtAjout->bindParam(':id_utilisateur', $idUtilisateur);

        //3.4 Exécutez la requête SQL
        if ($stmtAjout->execute()) {
            return "Recette ajoutée avec succès !";
        } else {
            return "L'ajout de la recette a échouée";
        }
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }

}

/* ====================================================== INGREDIENTS ================================================================= */




/* ====================================================== ETAPES ================================================================= */

// recupère les étapes pour une recette donnée
function recupEtapes($id_recette)
{
    try {
        $conn = connexionPDO();

        // recup l'auteur, le titre, image
        $sql = "SELECT description FROM etapes WHERE id_recette=:id_recette";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id_recette', $id_recette);

        if ($stmt->execute()) {
            //2.3.1 Récupération de la ligne de résultat de l'execution de la requête
            $etapes = $stmt->fetchAll();
            //2.3.2 Envoie du résultat pour le traitement de la vue
            return $etapes;
        } else {
            //2.3.3 Dans le cas ou on a une erreur SQL on remonte un message d'erreur
            return "Erreur : " . $sql . "<br>" . $stmt->errorInfo()[2];
        }

    } catch (PDOException $e) {
        return "Erreur de connexion à la base de données, veuillez contacter le service client";
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }
}

// on ajoute une étape en BDD
function ajoutEtape($description, $id_recette)
{

    try {
        // 1- Connexion à la base de données
        $conn = connexionPDO();

        //2-Sauvegarde du commentaire en base de données

        //2.1
        $sqlAjout = "INSERT INTO etapes (description, id_recette)
                VALUES (:description, :id_recette)";
        //2.2
        $stmtAjout = $conn->prepare($sqlAjout);

        //2.2 Liaison des paramètres
        $stmtAjout->bindParam(':description', $description);
        $stmtAjout->bindParam(':id_recette', $id_recette);
        
        //2.4 Exécutez la requête SQL
        if ($stmtAjout->execute()) {
            return "Etape ajoutée avec succès !";
        } else {
            return "L'ajout de l'étape a échouée"; // erreur fonctionnelle , plutot reliée à la requête 
        }
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage(); // erreur technique , plutot reliée à la rBDD
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }
}

/* ====================================================== COMMENTAIRES ================================================================= */

// recupération des commentaires correspondant à la recette donnée
function recupCommentaires($id_recette)
{
    try {
        $conn = connexionPDO();

        // recup l'auteur, le titre, image
        $sql = "SELECT contenu, login FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur=utilisateurs.id_utilisateur WHERE id_recette=:id_recette";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id_recette', $id_recette);

        if ($stmt->execute()) {
            //2.3.1 Récupération de la ligne de résultat de l'execution de la requête
            $commentaires = $stmt->fetchAll();
            //2.3.2 Envoie du résultat pour le traitement de la vue
            return $commentaires;
        } else {
            //2.3.3 Dans le cas ou on a une erreur SQL on remonte un message d'erreur
            return "Erreur : " . $sql . "<br>" . $stmt->errorInfo()[2];
        }

    } catch (PDOException $e) {
        return "Erreur de connexion à la base de données, veuillez contacter le service client";
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }
}

// fonction pour ajouter un commentaire en BDD si jamais l'utilisateur est connecté (conditionné à un POST)
function ajoutCommentaire($contenu, $id_recette, $adresse_mail_auteur)
{

    try {
        // 1- Connexion à la base de données
        $conn = connexionPDO();

        // 2- Récupération de id_utilisateur en fonction de l'email fourni par la session

        //2.1 Définition de la requête SQL a éxécuter
        $sqlUtilisateur = "SELECT id_utilisateur FROM utilisateurs WHERE adresse_mail_ = :adresse_mail_auteur";
        //2.2 Préparation de l'objet de connexion a la base de donnée utilisant la requête sql définie précedement
        $stmtUtilisateur = $conn->prepare($sqlUtilisateur);

        //2.3 Complète la requête SQL avec les données à injecter
        $stmtUtilisateur->bindParam(':adresse_mail_auteur', $adresse_mail_auteur);

        //2.4 Execution de la requête SQL
        if ($stmtUtilisateur->execute()) {
            //2.4.1 Récupération de la ligne de résultat de l'execution de la requête
            $row = $stmtUtilisateur->fetch();
            //2.4.2 Récupération de la colonne id_utilisateur de la ligne récupérée précedemment
            $idUtilisateur = $row['id_utilisateur'];
        } else {
            //2.4.3 Dans le cas ou on a une erreur SQL on remonte un message d'erreur
            return "Erreur : " . $sqlUtilisateur . "<br>" . $stmtUtilisateur->errorInfo()[2];
        }

        // 2.5 Test si il y a bien un utilisateur
        if ($idUtilisateur == NULL) {
            //2.5.1 Dans le cas ou l'utilisateur n'existe pas on renvoie un message d'erreur
            return "Erreur : l'utilisateur n'a pas été trouvé en base de données";
        }

        //3-Sauvegarde du commentaire en base de données

        //3.1
        $sqlAjout = "INSERT INTO commentaires (contenu, id_recette, id_utilisateur )
                VALUES (:contenu, :id_recette, :id_utilisateur)";
        //3.2
        $stmtAjout = $conn->prepare($sqlAjout);

        //3.3 Liaison des paramètres
        $stmtAjout->bindParam(':contenu', $contenu);
        $stmtAjout->bindParam(':id_recette', $id_recette);
        $stmtAjout->bindParam(':id_utilisateur', $idUtilisateur);

        //3.4 Exécutez la requête SQL
        if ($stmtAjout->execute()) {
            return "Commentaire ajouté avec succès !";
        } else {
            return "L'ajout du commentaire a échoué";
        }
    } catch (PDOException $e) {
        return "Erreur : " . $e->getMessage();
    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }

}
?>