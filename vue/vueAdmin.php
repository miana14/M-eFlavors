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

    <section class="content-admin">
        <table>
            <thead>
                <tr>
                    <th scope="col">Adresse-mail</th>
                    <th scope="col">Login</th>
                    <th scope="col">Rôle</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $profils = recupProfils();
                foreach ($profils as $profil) {
                    echo "<form method=\"post\" action=\"./action=supprimerUtilisateur\">";
                    echo "<tr>";
                    echo "<td>" . $profil['adresse_mail_'] . "</td>";
                    echo "<td>" . $profil['login'] . "</td>";
                    echo "<td>" . afficherRole($profil) . "</td>";
                    echo "<input type=\"hidden\" name=\"idUtilisateur\" value=\"". $profil['id_utilisateur'] ."\"></input>";
                    echo "<td><button type='submit'><i class='fa-solid fa-trash'></i></td>";
                    // echo "<td><button type=\"submit\" onclick=\"".supprimerUtilisateur($profil['id_utilisateur'])."\"><i class=\"fa-solid fa-trash\"></i></button></td>";
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