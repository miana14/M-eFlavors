<footer>
    <div id="reseaux">
        <ul>

            <li><a href="https://www.facebook.com" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
            <li><a href="https://www.instagram.com " target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
            <li><a href="https://www.x.com" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
            <li><a href="https://www.github.com" target="_blank"><i class="fa-brands fa-github"></i></a></li>
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