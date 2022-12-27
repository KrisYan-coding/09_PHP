<?php
require './parts/connect_db.php';

$output = [
    'post' => $_POST['story_id'],
    'success' => false,
    'error' => '',
    'note' => ''
];

$story_id = $_POST['story_id'];

$sql = "SELECT user_id FROM `stories_uploaded_by_user` WHERE story_id=$story_id;";

$row = $pdo->query($sql)->fetch();

$output['note'] = $row;

echo json_encode($output, JSON_UNESCAPED_UNICODE);
