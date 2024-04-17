<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    
    header('Content-Type:text/plain');
}
function connexionPDO() {
    // connexion en local 

    $login = "root";
    $mdp = "";
    $bd = "maeflavors2";
    $serveur = "localhost";

    // connexion en distant 

    // $login = "gretaxao_loureiroma";
    // $mdp = "LoureiroMa2023!";
    // $bd = "gretaxao_loureiroma";
    // $serveur = "www.greta-bretagne-sud.fr";
   

    try {
        $conn = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); // connexion a la BDD
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e){
        // le throw permet de remonter l'erreur à l'appelant tout en évitant que tout le serveur s'arrête contrairement au return
         throw $e;
    }
}



?>
