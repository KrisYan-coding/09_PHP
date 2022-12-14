
<?php 
    // include './php_40_1214_db.php';
    // --找不到時 warning，程式繼續

    require './php_40_1214_db.php';
    // --找不到時 error，程式停止

    // --兩者結果一樣，建議用 require

    // $sql = "SELECT * FROM address_book LIMIT 5";
    $sql = "SELECT * FROM address_book LIMIT 3, 5"; // get 5 data start from 3 + 1

    $stmt = $pdo->query($sql);
    // --$stmt 不是拿到的資料本身，是一個代理物件

    // $row = $stmt->fetch(); // 索引 + 關聯 array
    // $row = $stmt->fetch(PDO::FETCH_ASSOC); // 關聯 array
    // $row = $stmt->fetch(PDO::FETCH_NUM);  // 索引 array
    // echo print_r($row);
    // -- ->fetch() 拿第一筆資料
    // -- 參數可以在 './php_40_1214_db.php' 先預設 **1
    // $row = $stmt->fetch();  // 第一筆
    $row = $stmt->fetchAll(); // 所有資料

    header('Content-Type: application/json');

    echo json_encode($row, JSON_UNESCAPED_UNICODE);

?>