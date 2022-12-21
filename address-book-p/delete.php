<?php

require './admin-required.php';
require './parts/connect_db.php';
// header('Content-Type: application/json');

// echo $_GET['sid'];  // 若沒設定 $_GET['sid'] -> error
// echo isset($_GET['sid']); // 若沒設定 $_GET['sid'] -> false

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if (empty($sid)){
    header('Location: ./list.php');
    exit;
}

$sql = "DELETE FROM `address_book` WHERE sid={$sid}";

$stmt = $pdo->query($sql);

// echo json_encode($stmt->rowCount(););

// 從哪一頁來的，就回去哪一頁--
// method1--
// header("Location: ./list.php?page={$_GET['page']}");
// --list a href 要加 query string

// method2--
// if (empty($_SERVER['HTTP_REFERER'])){
//     // 如果不知道從哪裡來的
//     $come_from = 'list.php';
// } else {
//     $come_from = $_SERVER['HTTP_REFERER'];
// };

// $come_from = empty($_SERVER['HTTP_REFERER']) ? 'list.php' : $_SERVER['HTTP_REFERER'];
$come_from = $_SERVER['HTTP_REFERER'] ?? 'list.php';

header("Location: {$come_from}");


?>
