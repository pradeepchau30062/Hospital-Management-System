<?php
    session_start();
    unset($_SESSION['ad_id']);
    session_destroy();

    header("Location: admin_login.php");
    exit;
?>