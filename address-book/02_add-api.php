
<?php 

require './admin-required-api.php';
require './parts/php_40_1214_db.php';

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'errors' => []
];

if (empty($_POST['name'])){
    $output['errors']['name'] = '沒有姓名資料';

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;

}

// TODO: 後端欄位資料檢查: 避免有人沒有通過前端，就把資料送進來，所以要重新驗證，以免資料庫被加入很多假資料，或是被刪除資料
$isPass = true;
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$birthday = $_POST['birthday'] ?? '';
$address = $_POST['address'] ?? '';
// echo 'birthday' . !$birthday;

if (mb_strlen($name) < 2){
    $output['errors']['name'] = '請填寫正確姓名';
    $isPass = false;
}

if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
    $output['errors']['email'] = '請填寫正確的 email';
    $isPass = false;

}


// insert data to sql--
$sql = "INSERT INTO `address_book`
        (`name`, `email`, `mobile`, `birthday`, `address`, `created_at`)
        VALUES
        (?, ?, ?, ?, ?, NOW())";

$stmt = $pdo->prepare($sql);

if (! empty($birthday)){
    $t = strtotime($birthday);
    if ($t !== false){
        $birthday = date('Y-m-d', $t);
    }
}

// echo empty($birthday);
if(empty($birthday)){
    $birthday = null;
    $isPass = false;
}

if ($isPass){
    $stmt->execute([
        $name,
        $email,
        $mobile,
        $birthday,
        $address
    ]);
}

$output['success'] = !! $stmt->rowCount();

echo json_encode($output, JSON_UNESCAPED_UNICODE);
// echo !! $stmt->rowCount();



?>