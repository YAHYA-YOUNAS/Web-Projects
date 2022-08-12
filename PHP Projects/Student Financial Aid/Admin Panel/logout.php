<?php
    session_start();

    session_destroy();

    header('Location: adminLoginForm.php');

?>