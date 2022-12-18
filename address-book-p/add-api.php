
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

// TODO: 欄位資料檢查--
// name 沒給值，exit--
if (empty($_POST['name'])){
    $output['errors']['name'] = '沒有姓名資料';
    // echo print_r($output);
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}  

// birthday 沒給值，exit--
if (empty($_POST['birthday'])){
    $output['errors']['birthday'] = '沒有生日資料';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// birthday 無法轉換 timestamp 用 null--
$t = strtotime($_POST['birthday']);
// -- 格式無法轉為 timestamp -> return false
// 19860404 / 1986-04-04 / 1986-4-4
// 1970-1-1 = -28800 = -8 hr
// echo gettype($t);

// if(! $t){
//     $output['errors']['birthday'] = '沒有生日資料';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }
$birthday = null;
if ($t !== false){  // int 0 == false; int 0 !== false
    $birthday = date('Y-m-d', $t);
};

// name 長度不足 2 & email 格式錯誤 --
$isPass = true;

if (mb_strlen($_POST['name']) < 2){
    $output['errors']['name'] = '姓名長度不足';
    $isPass = false;
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
    $output['errors']['email'] = 'email 格式錯誤';
    $isPass = false;
}


// 若驗證通過，新增資料到資料庫--
if ($isPass){
    $sql = "INSERT INTO address_book 
            (`name`, `email`, `mobile`, `birthday`, `address`, `created_at`) VALUES
            (?, ?, ?, ?, ?, NOW())";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['mobile'],
        $birthday,
        $_POST['address']
    ]);
    
    // echo print_r($stmt);
    /**PDOStatement Object
    (
        [queryString] => INSERT INTO address_book 
            (`name`, `email`, `mobile`, `birthday`, `address`, `created_at`) VALUES
            (?, ?, ?, ?, ?, NOW())
    ) */
    $output['success'] = !! $stmt->rowCount();
    // echo $stmt->rowCount();
    // --rowCount() - Returns the number of rows affected by the last SQL statement
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>
