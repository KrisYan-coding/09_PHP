<?php

require './parts/connect_db.php';
require './functions/func.php';
$pageName = 'report-list';
$title = 'report-list';

$output = [
    'success' => false,
    'post' => $_POST,
    'error' => '',
    'note' => ''
];

// 確認重複檢舉--
$sql = "SELECT * FROM `reports_by_user` 
WHERE `story_id`={$_POST['select_story_id']} AND `user_id(reporter)`={$_SESSION['admin']['admin_id']}";

$stmt = $pdo->query($sql);

// $output['note'] = $stmt->rowCount();
if ($stmt->rowCount()) {
    $output['error'] = '您已檢舉過此影片';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `reports_by_user`
(`story_id`, 
`user_id(reporter)`, 
`user_id(reported)`, 
`report_datetime`, 
`report_reason_id`, 
`verified`) VALUES 
(?, ?, ?, NOW(), ?, 0)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['select_story_id'],
    $_SESSION['admin']['admin_id'],
    $_POST['auto_userid_reported'],
    $_POST['select_report_reason']
]);

$output['note'] = $stmt->rowCount();

if ($stmt->rowCount() === 1) {
    $output['success'] = true;
} else {
    $output['error'] = '檢舉失敗';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
