<?php include './vue/vueHead.php'; ?>
<?php include './vue/vueHeader.php'; ?>

<?php require_once './modele/mdl_profil.php'; ?>

<?php 

function afficherRole($profil){
    if($profil['is_Admin'] == 0){
        return "Utilisateur";
    }else{
        return "Admin";
    }
}


?>


<?php if (isset($_SESSION['is_Admin']) && $_SESSION['is_Admin'] == 1) { ?>

    <section>
        <table>
            <thead>
                <tr class="elements-profil">
                    <th id ="elmts-mail">Adresse-mail</th>
                    <th id ="elmts-login">Login</th>
                    <th id ="elmts-role">Rôle</th>
                    <th id ="elmts-action">Action</th>
                </tr>
            </thead>
            <tbody class="contenu-admin">
                <?php $profils = recupProfils();
                foreach ($profils as $profil) {
                    echo "<form method=\"post\" action=\"./?action=supprimerUtilisateur\">";
                    echo "<tr>";
                    echo "<td id='mail-vue'>" . $profil['adresse_mail_'] . "</td>";
                    echo "<td id='login-vue'>" . $profil['login'] . "</td>";
                    echo "<td id='role-vue'>" . afficherRole($profil) . "</td>";
                    echo "<input type='hidden' name=\"id_utilisateur\" value=\"". $profil['id_utilisateur'] ."\"></input>";
                    echo "<td id='action-vue'><button type='submit'><i class='fa-solid fa-trash'></i></td>";
                    echo "</form>";
                    echo "</tr>";

                } ?>
            </tbody>
        </table>

    </section>
<?php } else {
    header("Location: ./?action=404");
} ?>


<?php include './vue/vueFooter.php'; ?>