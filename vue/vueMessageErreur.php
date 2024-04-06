<?php 
    if (isset($_SESSION['msg'])) {
        $message = $_SESSION['msg'];
        echo "<div>$message</div>";
        // erase the message from SESSION
        unset($_SESSION['msg']);
    }
?>