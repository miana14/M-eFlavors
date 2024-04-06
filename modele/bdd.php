<?php
function connexionPDO() {
    // connexion en local 

    $login = "root";
    $mdp = "";
    $bd = "maeflavors";
    $serveur = "localhost";

    // connexion en distant 

    // $login = "gretaxao_loureiroma";
    // $mdp = "LoureiroMa2023!";
    // $bd = "gretaxao_loureiroma";
    // $serveur = "www.greta-bretagne-sud.fr";
   

    try {
        $conn = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Erreur de connexion PDO :". $e->getMessage());
    }
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog de test
    header('Content-Type:text/plain');
}

?>
