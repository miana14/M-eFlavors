<?php if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // Un MVC utilise uniquement ses requêtes depuis le contrôleur principal : index.php
    die('Erreur : ' . basename(__FILE__));
} ?>


<?php

require_once './modele/mdl_recettes.php';
require_once './modele/mdl_profil.php';

















?>



<?php include './vue/vueAdmin.php'; ?>