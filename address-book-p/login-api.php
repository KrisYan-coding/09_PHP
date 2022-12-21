
<?php 
require './parts/connect_db.php';
header('Content-Type: application/json');

// 當 api 處理完，要回應的內容(成果報告)--
$output = [
    'success' => false,
    'postData' => $_POST,
    'data' => '',
    'code' => 0,
    'errors' => []
];

if (empty($_POST['account']) or empty($_POST['password'])){
    $output['errors'] = '欄位資料不足';
    $output['code'] = 50;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "SELECT * FROM `admins` WHERE account=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['account']
]);
$row = $stmt->fetch();

// echo empty($row);

if (empty($row)){
    $output['errors'] = '帳號錯誤';
    $output['code'] = 100;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$output['data'] = $row;

if (!password_verify($_POST['password'], $row['password_hash'])){
    $output['errors'] = '密碼錯誤';
    $output['code'] = 200;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


$output['success'] = true;
$_SESSION['admin'] = [
    'sid' => $row['sid'],
    'account' => $row['account']
];

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>
