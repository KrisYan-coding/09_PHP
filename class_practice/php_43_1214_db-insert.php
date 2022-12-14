

<?php 
    
    require './php_40_1214_db.php';

    $sql = "INSERT INTO `address_book`
            (`name`, `email`, `mobile`, `birthday`, `address`, `created_at`)
            VALUES 
            (?, ?, ?, ?, ?, NOW())";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'Kris',
        'krisyan@gmail',
        '085962533',
        '1997/4/4',
        '下厝路89巷',
    ]);

    echo json_encode([
        'rowCount' => $stmt->rowCount(), // 新增幾筆
        'lastInsertID' => $pdo->lastInsertID()
    ])



    
    

?>




