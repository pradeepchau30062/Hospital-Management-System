<?php
    session_start();
    unset($_SESSION['ad_id']);
    session_destroy();

    header("Location:pat_login.php");
    exit;
?>