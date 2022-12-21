<?php 

if (! isset($_SESSION)){
    session_start();
};

if (! isset($_SESSION['admin'])){
    echo json_encode([
        'success' => false,
        'error' => '權限不足不能訪問'
    ]);
    exit;
}

// 有登入的話不要 echo 否則功能的 api 也會回傳 echo

?>
