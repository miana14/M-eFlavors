<?php include './vue/vueHead.php'; ?>
<?php include './vue/vueHeader.php'; ?>

<?php if (!isset($_SESSION)) {
    session_start();
}
?>

<?php require_once './modele/mdl_profil.php'; ?>

<?php $id_utilisateur = $_SESSION['id_utilisateur']; // recuperation du id de l'utilisateur via la SESSION ?>

<?php $profil = recupProfil($id_utilisateur); ?>

<section class="mon-profil">
    <article class="form-profil">
        <h2>Modification de mon Profil</h2>
        <form action="./?action=profil" method="POST" class="form">
            <?php require './vue/vueMessageErreur.php'?>
            <?php /* les echo gardent en memoire les données saisies lors de l'inscription d'un utilisateur 
            et les affichent par la suite lorsqu'on souhaite modifier le profil */?> 
            <fieldset>
                <legend>Genre</legend>

                <div id="genre">
                    <input type="radio" name="genre" value="homme" <?php if($profil['genre'] == 'homme') echo "checked"?>/>
                    <label for="homme">Homme</label>

                    <input type="radio" name="genre" value="femme" <?php if($profil['genre'] == 'femme') echo "checked"?>/>
                    <label for="femme">Femme</label>

                    <input type="radio" name="genre" value="autre" <?php if($profil['genre'] == 'autre') echo "checked"?>/>
                    <label for="autre">Autre</label>
                </div>
            </fieldset><br>
            <fieldset>
                <legend>Votre Niveau</legend>

                <div id="niveau">
                    <input type="radio" name="niv" value="debutant" <?php if($profil['niveau'] == 'debutant') echo "checked"?> />
                    <label for="debutant">Débutant</label>

                    <input type="radio" name="niv" value="inter" <?php if($profil['niveau'] == 'inter') echo "checked"?>/>
                    <label for="inter">Intermédiaire</label>

                    <input type="radio" name="niv" value="expert" <?php if($profil['niveau'] == 'expert') echo "checked"?>/>
                    <label for="expert">Expert</label>
                </div>
            </fieldset>
            <br>
            <br>
            <label for="age">Age</label><br>
            <input type="number" id="age" name="age" min="15" max="125" value="<?= $profil['age'] ?>">
            <br>
            <label for="login">Login</label><br>
            <input type="text" name="login" value="<?= $profil['login'] ?>">
            <br>
            <label for="email">Adresse-mail </label><br>
            <input type="email" id="email" name="email" value="<?= $profil['adresse_mail_'] ?>">
            <br>
            <label for="mdp">Mot de passe </label><br>
            <input type="password" id="mdp" name="mdp" value="" required>
            <?php 
            if (isset($_SESSION['msg_mdp'])) {
                $messagesMdp = $_SESSION['msg_mdp'];
                echo "<ul>";
                foreach ($messagesMdp as $message) {
                    echo "<li>$message</li>";
                }
                echo "</ul>";
                // effacer les messages une fois affichées
                unset($_SESSION['msg_mdp']);
            }
            ?>
            <br>
            <input type="submit" value="MODIFIER" class="form-button" />

        </form>
    </article>

</section>

<?php include './vue/vueFooter.php'; ?>