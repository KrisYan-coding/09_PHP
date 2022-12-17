
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
    // echo print_r($output);
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}   


// TODO: 欄位資料檢查--


// 新增資料到資料庫--
$sql = "INSERT INTO address_book 
        (`name`, `email`, `mobile`, `birthday`, `address`, `created_at`) VALUES
        (?, ?, ?, ?, ?, NOW())";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['name'],
    $_POST['email'],
    $_POST['mobile'],
    $_POST['birthday'],
    $_POST['address']
]);

// echo $stmt;
$output['success'] = !! $stmt->rowCount();

?>
