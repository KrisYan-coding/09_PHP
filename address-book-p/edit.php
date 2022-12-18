<?php

require './parts/connect_db.php';
// header('Content-Type: application/json');

// echo $_GET['sid'];  // 若沒設定 $_GET['sid'] -> error
// echo isset($_GET['sid']); // 若沒設定 $_GET['sid'] -> false

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if (empty($sid)){
    header('Location: ./list.php');
    exit;
}

$sql = "SELECT * FROM `address_book` WHERE sid=$sid";

$stmt = $pdo->query($sql);

$row = $stmt->fetch();

// echo json_encode($row);
echo empty($row);

if (empty($row)){
    // 沒有此編號的資料
    header('Location: ./list.php');
    exit;
}


echo json_encode($row);

?>
