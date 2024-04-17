<?php 
    if (isset($_SESSION['msg'])) {
        $message = $_SESSION['msg'];
        echo "<div class=\"msg-erreur\">$message</div>"; // on insere une div pour les messages d'erreur
        // erase the message from SESSION
        unset($_SESSION['msg']);
    }
?>