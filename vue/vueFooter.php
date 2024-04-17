<footer>
    <div id="reseaux">
        <ul>

            <li><a href="www.facebook.com"><i class="fa-brands fa-facebook"></i></a></li>
            <li><a href="www.instagram.com "><i class="fa-brands fa-instagram"></i></a></li>
            <li><a href="www.x.com"><i class="fa-brands fa-x-twitter"></i></a></li>
            <li><a href="www.github.com"><i class="fa-brands fa-github"></i></a></li>
            <?php if (isset($_SESSION['is_Admin']) && $_SESSION['is_Admin'] == 1) {?>
                <ul id="admin">
                    <li><a href="./?action=admin"><i class="fa-solid fa-lock"></i></a></li>
                </ul>
            <?php }?>


        </ul>
    </div>
    <div id="politiques">
        <ul>
            <li><a href="./?action=mentions">Mentions Légales</a> - <a href="./?action=politiques">Politique de
                    confidentialité</a></li>
        </ul>
    </div>
    <div id="copyright">
        <ul>
            <li>MãeFlavors - 2024 © Tous droits réservés</li>
        </ul>
    </div>
</footer>
</body>

</html>