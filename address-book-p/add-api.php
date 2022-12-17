
<?php 
require './parts/connect_db.php';
header('Content-Type: application/json');

// 當 api 處理完，要回應的內容(成果報告)--
$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'errors' => []
];

if (empty($_POST['name'])){
    $output['errors']['name'] = '沒有姓名資料';
    echo print_r($output);
    exit;
}   


// TODO: 欄位資料檢查--

?>
