
<?php 
    session_start();

    // session_destroy(); // 所有的 session 都清除

    unset($_SESSION['user']); // 清除陣列裡的元素

    header('Location: php_38_1214_logo-in.php');
    // 轉向: 再回到登入頁

?>