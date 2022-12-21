
<?php 

session_start();

if (isset($_SESSION['admin'])){
    // header('Location: ./list-admin.php');
    include './list-admin.php';
} else {
    // header('Location: ./list-no-admin.php');
    include './list-no-admin.php';

};


 ?>