<?php include './vue/vueHead.php'; ?>
<?php include './vue/vueHeader.php'; ?>

<!-- <div id="banniereCI"> -->
    <article class="form-card" id="inscription">
        <h2>Inscription</h2>
        <?php require './vue/vueMessageErreur.php' ?>
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
            <input type="checkbox"  name="rgpd" value="rgpd" required>
            <label for="rgpd">
                J'autorise ce site à utiliser mes données personnelles selon
                notre <a href="./?action=politiques" id="rgpd">Politique de confidentialité</a> *
            </label>

            <br>
            <input type="submit" value="S'inscrire" class="form-button"  id="btn-inscription"/>

        </form>
    </article>
</div>

<?php include './vue/vueFooter.php'; ?>