
<?php 

require './admin-required-api.php';
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

// sid 沒給值 或 給空值 或 給0，exit--
if (empty($_POST['sid'])){
    $output['errors']['sid'] = '沒有標號資料';
    // echo print_r($output);
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}  

// name 沒給值，exit--
if (empty($_POST['name'])){
    $output['errors']['name'] = '沒有姓名資料';
    // echo print_r($output);
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}  

// name 長度不足 2 & email 格式錯誤 --
$isPass = true;
// --可以一次指出錯誤的輸入


if (mb_strlen($_POST['name']) < 2){
    $output['errors']['name'] = '姓名長度不足';
    $isPass = false;
}

if (empty($_POST['email'])){
    $output['errors']['email'] = '沒有email資料';
    // echo print_r($output);
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}  
// --若 $_POST['email'] 沒收到資料，可以用 empty 檢查，return true

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
    $output['errors']['email'] = 'email 格式錯誤';
    $isPass = false;
}
// --若 $_POST['email'] 沒收到資料，用 filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) 檢查會錯誤
// -- $_POST['email'] 沒收到資料 不等於 $_POST['email']=''

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

$sid = intval($_POST['sid']);
$mobile = $_POST['mobile'] ?? '';
$address = $_POST['address'] ?? '';
// note: 透過前端表單發送，若使用者沒填值，$_POST['mobile']='' 自動給空字串
// note: 透過postman發送，若沒設定mobile，$_POST['mobile'] undefined 會有 error



// 若驗證通過，新增資料到資料庫--
if ($isPass){
    $sql = "UPDATE `address_book` SET 
            `name`=?,`email`=?,`mobile`=?,`birthday`=?,`address`=? 
            WHERE `sid`=?";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $mobile,
        $birthday,
        $address,
        $sid
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
    // --若沒有修改，sql 會判斷出資料跟原本的一樣，$stmt->rowCount() return false
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>
