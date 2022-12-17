
<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['admin'])) {
    header('Location: 06_login.php');
    exit;
}




?>