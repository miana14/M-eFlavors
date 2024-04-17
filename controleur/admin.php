<?php 

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    
    die('Erreur : ' . basename(__FILE__));
} ?>


<?php

require_once './modele/mdl_profil.php';







?>



<?php include './vue/vueAdmin.php'; ?>