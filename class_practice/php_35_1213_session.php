<?php 
    // session: 用戶在使用瀏覽器的過程
    // 3. 瀏覽器關掉(所有分頁)後清除
    // 1. session 是 server 為了知道 client 是否還在瀏覽該網站的機制
    // 2. when a client first visit the server, the server ask browser to set a session id in client's cookie, so that when the same client visit the server again, the server can recogize the seesion id in the cookie of the client's request 
    // 4. data of session is saved in the server
    // 5. live of session rely on live of cookie

    session_start(); // 啟用 session 功能

    if (! isset($_SESSION['myName'])){
        $_SESSION['myName'] = 'Kris';
    }
    if (! isset($_SESSION['myAge'])){
        $_SESSION['myAge'] = 0;
    } else {
        $_SESSION['myAge'] ++;
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        echo $_SESSION['myAge'];
        echo $_SESSION['myName'];
        // --session 資料存在 server，第一次執行即可讀取
    
    
    
     ?>
</body>
</html>