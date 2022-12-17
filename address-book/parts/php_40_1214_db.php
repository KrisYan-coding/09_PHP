
<?php 
    // $db_host = 'localhost';
    // $db_name = 'my_php_test';
    // $db_user = 'root';
    // $db_pass = '';

    // $dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8;";

    
    // $pdo_options = [
    //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // error 發生時的處理模式
    //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // 資料呈現方式預設
    // ];
        
    // $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

    $db_host = 'localhost';
    $db_name = 'my_php_test';
    $db_user = 'root';
    $db_pass = '';

    $dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8";

    $pdo_options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
    
    if (! isset($_SESSION)) {
        session_start();
    }
    
    
?>