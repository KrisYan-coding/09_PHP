
<?php 

require './parts/php_40_1214_db.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

if (empty($_POST['account']) or empty($_POST['password'])) {
    $output['error'] = '欄位不足';
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

if (empty($row)) {
    $output['error'] = '帳號密碼錯誤';
    $output['code'] = 100;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if (($_POST['password'] === $row['password'])) {
    $output['success'] = true;
    $_SESSION['admin'] = [
        'sid' => $row['sid'],
        'account' => $row['account'],
    ];
    
} else {
    $output['error'] = '密碼錯誤';
    $output['code'] = 200;

}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
// echo !! $stmt->rowCount();



?>