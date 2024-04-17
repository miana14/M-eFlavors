<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    
    die('Erreur : ' . basename(__FILE__));
}

?>

<?php

require_once './modele/mdl_recettes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenu = $_POST['contenu'];
    $id_recette = $_GET['id_recette']; // récupération via l'URL le id de la recette
  
    
    if (!isset($_SESSION)) {
        session_start();
    }
   
    
    $adresse_mail_auteur = $_SESSION['email_user'];

    $resultCommentaire = ajoutCommentaire($contenu, $id_recette, $adresse_mail_auteur);
    
     $_SESSION['resultCommentaire'] = $resultCommentaire;

    if ($resultCommentaire == "Commentaire ajouté avec succès !") {
        header("Location: ./?action=recette&id_recette=" .$id_recette ."&resultat_com=". $resultCommentaire);
        // ajout dans l'url l'id de la recette + le resultat du commentaire si ça marche
    }

} else {
    $_SESSION['msg'] = $resultCommentaire;
}
// renvoie sous forme de message l'erreur


?>

<?php include "vue/vueRecette.php";?>
