<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // Un MVC utilise uniquement ses requêtes depuis le contrôleur principal : index.php
    die('Erreur : ' . basename(__FILE__));
}

?>

<?php

require_once './modele/mdl_recettes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenu = $_POST['contenu'];
    $id_recette = $_GET['id_recette'];

  
    
    if (!isset($_SESSION)) {
        session_start();
    }
   
    
    $adresse_mail_auteur = $_SESSION['email_user'];

    $resultCommentaire = ajoutCommentaire($contenu, $id_recette, $adresse_mail_auteur);
    
     $_SESSION['resultCommentaire'] = $resultCommentaire;

    if ($resultCommentaire == "Commentaire ajouté avec succès !") {
        header("Location: ./?action=recette&id_recette=" .$id_recette ."&resultat_com=". $resultCommentaire);
        
    }

} else {
    $_SESSION['msg'] = $resultCommentaire;
}



?>

<?php include "vue/vueRecette.php";?>
