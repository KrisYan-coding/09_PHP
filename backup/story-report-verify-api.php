<?php
require './parts/connect_db.php';

$output = [
    'post' => $_POST,
    'success' => false,
    'code' => '',
    'error' => '',
    'note' => isset($_POST)
];

if (!isset($_POST)) {
    $output['error'] = '沒有傳資料';
    $output['code'] = 100;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
};

if (empty($_POST['verified_result_id'])) {
    $output['error'] = '沒有傳資料';
    $output['code'] = 200;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
};

$report_id = $_POST['report_id'];
$admin = $_SESSION['admin']['admin_id'];

$sql = "UPDATE `reports_by_user` SET 
`verified`=1,
`verified_datetime`=NOW(),
`verified_result_id`=?,
`admin_id`=$admin
WHERE `report_id`=$report_id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['verified_result_id'],
]);

$output['success'] = !!$stmt->rowCount();


echo json_encode($output, JSON_UNESCAPED_UNICODE);
