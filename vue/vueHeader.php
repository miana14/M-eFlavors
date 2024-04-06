<!DOCTYPE html>
<html>
<?php require_once './modele/mdl_connexion.php';
include ('vueHead.php');
?>

<body>
    <header>
        <nav>

            <ul class="navigation" role="navigation">
                <div class="container">
                    <div>
                        <i class="fa-solid fa-bars" id="burger-menu" style="color: #d9b88f;" onclick="burger()"></i>
                    </div>
                    <div class="menu" id="list-items">
                        <li><a href="./?action=presentation">Présentation</a></li>
                        <li><a href="./?action=recettes">Nos Recettes</a></li>
                        <li><a href="./?action=forum">Forum</a></li>
                        <li><a href="./?action=contact">Contact</a></li>
                    </div>
                    <a href="./?action=accueil"><img src="assets/img/logo.PNG" alt="logo" id="logo"></a>
                </div>
                <li id="user">
                    <div>
                        <i class="fa-solid fa-user" id="user-icon" style="color: #d9b88f;" onclick="user()"></i>
                    </div>
                    <?php
                    // Vérifier si des données de connexion ont été soumises via POST
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $email = $_POST['email'];
                        $mdp = $_POST['mdp'];
                    } else {
                        // Par défaut, initialiser les variables à vide pour éviter les erreurs
                        $email = "";
                        $mdp = "";
                    }

                    // Afficher le menu utilisateur
                    echo '<ul id="user-menu">';
                    if(!isset($_SESSION)){
                        session_start(); 
                   }
                    if (isset($_SESSION['email_user']) == true) {
                        // Si l'utilisateur est connecté, afficher les liens de profil et de déconnexion
                        echo '<li><a href="./?action=profil">Mon Profil</a></li>';
                        echo '<li><a href="./?action=deconnexion">Déconnexion</a></li>';
                        
                    } else {
                        // Si l'utilisateur n'est pas connecté, afficher les liens de connexion et d'inscription
                        echo '<li class="hide-on-start"><a href="./?action=connexion">Connexion</a></li>';
                        echo '<li><a href="./?action=inscription">Inscription</a></li>';
                    }
                    echo '</ul>';
                    ?>
                </li>
            </ul>
        </nav>
        <div id="banniere"></div>
        <!-- Breadcrumb Trail -->
        <?php $action = isset($_GET['action']) ? $_GET['action'] : ''; ?>
        <ul class="breadcrumb">
            <li><a href="./?action=accueil">Accueil</a></li>
            <?php
            if ($action == 'presentation') {
                echo '<li>Présentation</li>';
            } elseif ($action == 'recettes') {
                echo '<li>Nos Recettes</li>';
            } elseif ($action == 'forum') {
                echo '<li>Forum</li>';
            } elseif ($action == 'contact') {
                echo '<li>Contact</li>';
            }
            ?>
        </ul>
    </header>