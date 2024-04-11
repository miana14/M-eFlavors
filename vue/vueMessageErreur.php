<?php 
    if (isset($_SESSION['msg'])) {
        $message = $_SESSION['msg'];
        echo "<div class=\"msg-erreur\">$message</div>";
        // erase the message from SESSION
        unset($_SESSION['msg']);
    }
?>