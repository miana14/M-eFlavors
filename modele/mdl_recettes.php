<?php
require_once "bdd.php";

// reecrire les erreurs et les tester ============================================================= A FAIRE =======================


/* ====================================================== RECETTES ================================================================= */

// Fonction pour recuperer les recettes
function recupRecettes()
{

    try {
        $conn = connexionPDO();


        $sql = "SELECT id_recette, titre_ , url_image, login FROM fiche_recette INNER JOIN utilisateurs ON fiche_recette.id_utilisateur = utilisateurs.id_utilisateur";
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


// fonction pour recuperer UNE recette
function recupRecette($id_recette)
{
    try {
        $conn = connexionPDO();


        $sql = "SELECT titre_ , difficulte, temps, type_de_plat_, url_image, description, login FROM fiche_recette INNER JOIN utilisateurs ON fiche_recette.id_utilisateur = utilisateurs.id_utilisateur WHERE id_recette = :id_recette";
        $stmtRecup = $conn->prepare($sql);

        $stmtRecup->bindParam(':id_recette', $id_recette);

        if ($stmtRecup->execute()) {
            $recette = $stmtRecup->fetch();
            return $recette;
        } else {
            return "Erreur : " . $sql . "<br>" . $stmtRecup->errorInfo()[2];
        }

    } catch (PDOException $e) {
        return "Erreur de connexion à la base de données, veuillez contacter le service client" . $e->getMessage();
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

        
        $sqlAjout = "INSERT INTO fiche_recette (titre_, difficulte, temps, type_de_plat_, url_image, description, id_utilisateur )
                VALUES (:titre_, :difficulte, :temps, :type_de_plat_, :url_image, :description, :id_utilisateur)";

        $stmtAjout = $conn->prepare($sqlAjout);

        $stmtAjout->bindParam(':titre_', $titre_);
        $stmtAjout->bindParam(':difficulte', $difficulte);
        $stmtAjout->bindParam(':temps', $temps);
        $stmtAjout->bindParam(':type_de_plat_', $type_de_plat_);
        $stmtAjout->bindParam(':url_image', $url_image);
        $stmtAjout->bindParam(':description', $description);
        $stmtAjout->bindParam(':id_utilisateur', $idUtilisateur);

        //3.4 Exécutez la requête SQL
        if ($stmtAjout->execute()) {
            return $conn->lastInsertId();
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

// recuperer tous les ingredients
function recupIngredients()
{
    try {
        $conn = connexionPDO();
        // recup toutes les infos de tous les ingredients
        $sql = "SELECT * FROM ingredients";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute()) {
            $ingredients = $stmt->fetchAll();
            return $ingredients;
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


/* ====================================================== COMPOSER(le lien entre la recette et l'ingredient) ================================================================= */

// ajouter un ingredient à la suite, dans une creation de recette (via la table composer)
function ajoutIngredientDansRecette($id_recette, $id_ingredient)
{

    try {
        $conn = connexionPDO();
        $sql = "INSERT INTO composer (id_recette, id_ingredient) VALUES (:id_recette,:id_ingredient)";
        $stmtAjoutIngredientRecette = $conn->prepare($sql);

        $stmtAjoutIngredientRecette->bindParam(":id_recette", $id_recette);
        $stmtAjoutIngredientRecette->bindParam(":id_ingredient", $id_ingredient);

        if ($stmtAjoutIngredientRecette->execute()) {
            return "L'ajout a été fait !";
        } else {
            return "L'ajout a échoué.";
        }
    } catch (PDOException $e) {

        return "Erreur de connexion à la base de données, veuillez contacter le service client" . $e->getMessage();

    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }
}

// recuperer le nom des ingredients utilisés dans la recette
function recupIngredientsRecette($id_recette)
{

    try {
        $conn = connexionPDO();
        $sql = "SELECT nom_, lipides_, glucides, fibres, proteines, calories_ FROM composer INNER JOIN ingredients ON ingredients.id_ingredient=composer.id_ingredient WHERE id_recette = :id_recette ";

        $stmtRecupIngredientRecette = $conn->prepare($sql);

        $stmtRecupIngredientRecette->bindParam(":id_recette", $id_recette);

        if ($stmtRecupIngredientRecette->execute()) {
            $ingredients = $stmtRecupIngredientRecette->fetchAll();
            return $ingredients;
        } else {
            return "La récupération a échouée.";
        }
    } catch (PDOException $e) {

        return "Erreur de connexion à la base de données, veuillez contacter le service client" . $e->getMessage();

    } finally {
        if (isset($conn)) {
            $conn = null;
        }
    }
}


/* ====================================================== ETAPES ================================================================= */

// recupère les étapes pour une recette donnée
function recupEtapes($id_recette)
{
    try {
        $conn = connexionPDO();


        $sql = "SELECT description FROM etapes WHERE id_recette=:id_recette";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id_recette', $id_recette);

        if ($stmt->execute()) {
            $etapes = $stmt->fetchAll();
            return $etapes;
        } else {
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
        $conn = connexionPDO();

        //2-Sauvegarde du commentaire en base de données 
        $sqlAjout = "INSERT INTO etapes (description, id_recette) VALUES (:description, :id_recette)";
       
        $stmtAjout = $conn->prepare($sqlAjout);

        $stmtAjout->bindParam(':description', $description);
        $stmtAjout->bindParam(':id_recette', $id_recette);

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

        $sql = "SELECT contenu, login FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur=utilisateurs.id_utilisateur WHERE id_recette=:id_recette";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id_recette', $id_recette);

        if ($stmt->execute()) {
            $commentaires = $stmt->fetchAll();
            return $commentaires;
        } else {
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
       
        $conn = connexionPDO();

        $sqlUtilisateur = "SELECT id_utilisateur FROM utilisateurs WHERE adresse_mail_ = :adresse_mail_auteur";
        $stmtUtilisateur = $conn->prepare($sqlUtilisateur);

        $stmtUtilisateur->bindParam(':adresse_mail_auteur', $adresse_mail_auteur);

        if ($stmtUtilisateur->execute()) {
            $row = $stmtUtilisateur->fetch();
            $idUtilisateur = $row['id_utilisateur'];
        } else {
            return "Erreur : " . $sqlUtilisateur . "<br>" . $stmtUtilisateur->errorInfo()[2];
        }

        // Test si il y a bien un utilisateur
        if ($idUtilisateur == NULL) {
            // Dans le cas ou l'utilisateur n'existe pas on renvoie un message d'erreur
            return "Erreur : l'utilisateur n'a pas été trouvé en base de données";
        }

        // Sauvegarde du commentaire en base de données

        $sqlAjout = "INSERT INTO commentaires (contenu, id_recette, id_utilisateur )
                VALUES (:contenu, :id_recette, :id_utilisateur) ";
        $stmtAjout = $conn->prepare($sqlAjout);

        $stmtAjout->bindParam(':contenu', $contenu);
        $stmtAjout->bindParam(':id_recette', $id_recette);
        $stmtAjout->bindParam(':id_utilisateur', $idUtilisateur);

        // Exécutez la requête SQL
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