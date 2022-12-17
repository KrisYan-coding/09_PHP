<?php 
    // cookie: 網站透過瀏覽器、http的機制，將資料存放在用戶端
    // 1. 不能存太多，不同瀏覽器有不同的大小限制(一般為 4096 bytes)
    // 2. 以網域為單位，不同網域不可互相讀取 cookie

    setcookie('mycookie123', '123');
    // --server 端 在 response 中，請 browser set cookie
    // --cookie 只能設定為 string

    setcookie('mycookietime', 'Hi', time() + 10);
    // --time(): timestamp of now
    // -- + 10: now + 10 second 後過期

?>