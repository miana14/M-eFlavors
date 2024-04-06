<?php include './vue/vueHead.php'; ?>
<?php include './vue/vueHeaderC&I.php'; ?>

<div id="banniereCI">
    <article class="form-card">
        <h2>Connexion</h2>
        <?php require './vue/vueMessageErreur.php'?>
        <form action="./?action=connexion" method="POST" class="form">
            <br>
            <label for="email">Adresse-Mail </label><br>
            <input type="email" id="email" name="email">
            <br>
            <label for="mdp">Mot de passe </label><br>
            <input type="password" id="mdp" name="mdp">
            <br>
            <input type="submit" value="Se Connecter" class="form-button" />

        </form>
    </article>
</div>

<?php include './vue/vueFooter.php'; ?>