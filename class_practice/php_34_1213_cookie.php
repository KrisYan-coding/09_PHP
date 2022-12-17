<?php 
    // cookie: 網站透過瀏覽器、http的機制，將資料存放在用戶端
    // 1. 不能存太多，不同瀏覽器有不同的大小限制(一般為 4096 bytes)
    // 2. 以網域為單位，不同網域不可互相讀取 cookie
    // 3. 瀏覽器關掉(所有分頁)後清除

    setcookie('mycookie', '123');
    // --server 端 在 response 中，請 browser set cookie


    // 補充:
    // --local storage:
    //      1. js: set localStorage.setItem(key, value);
    //      2. js: get localStorage.gettItem(key);
    //      3. remain when restart browser
    //      4. can save data in json
    //      5. 資料不會主動送給 server
    //      6. 限制 10 M 以下
    //      7. 應用: 最近瀏覽過的商品


?>
<!-- setcookie 設定要在 html 之前 -->

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
        echo $_COOKIE['mycookie'];
        // --server 去讀取 client 端的 cookie
        // --在未 response 給 client 端之前，server 讀取不到 client 端的 cookie
        // --client 端設定好 cookie後，發 request 時會將 cookie 存放在 header中
    ?>
    
</body>
</html>