<?php

require './parts/connect_db.php';
require './functions/func.php';
$pageName = 'report-list';
$title = 'report-list';

$output = [
    'success' => false,
    'get' => $_GET['report_id'],
    'error' => '',
    'note' => ''
];

$sql = "DELETE FROM `reports_by_user` WHERE `report_id`={$_GET['report_id']}";

$stmt = $pdo->query($sql);

$output['note'] = $stmt->rowCount();

// echo json_encode($output, JSON_UNESCAPED_UNICODE);

$come_from = $_SERVER['HTTP_REFERER'] ?? 'story-report-list.php';

header("Location: $come_from");
