<?php include './vue/vueHead.php'; ?>
<?php include './vue/vueHeaderC&I.php'; ?>

<div id="banniereCI">
    <article class="form-card" id="inscription">
        <h2>Inscription</h2>
        <form action="./?action=inscription" method="POST" class="form">
            <br>
            <label for="email">Adresse-mail *</label><br>
            <input type="email" id="email" name="email" placeholder="<?php ?>" required>
            <br>
            <label for="login">Login *</label><br>
            <input type="text" id="login" name="login" placeholder="<?php ?>" required>
            <br>
            <label for="mdp">Mot de passe *</label><br>
            <input type="password" id="mdp" name="mdp" placeholder="<?php ?>" required>
            <br>
            <input type="submit" value="S'inscrire" class="form-button" />

        </form>
    </article>
</div>

<?php include './vue/vueFooter.php'; ?>