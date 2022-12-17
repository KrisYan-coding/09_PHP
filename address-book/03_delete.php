
<?php

require './admin-required.php';
require './parts/php_40_1214_db.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;


// echo $sid;
// echo empty($sid); // 0, '', null, undefined : empty
if (empty($sid)) {
    // echo 'not delete';
    header('Location: 00_list.php');
    exit;
}

$sql = "DELETE FROM `address_book` WHERE sid=$sid";
$pdo->query($sql);

echo $_SERVER['HTTP_REFERER'];
if (empty($_SERVER['HTTP_REFERER'])){
    $come_from = '00_list.php';
} else {
    $come_from = $_SERVER['HTTP_REFERER']; // 在第三頁刪除完，留在第三頁
}

header("Location: $come_from");


// header("Location: 00_list.php");


?>