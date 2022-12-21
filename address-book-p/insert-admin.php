

<?php 

require './parts/connect_db.php';

$account = 'shin';
$password = '123456';

$hash = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO `admins`(`account`, `password_hash`) VALUES 
('{$account}','{$hash}')";

try {
    echo $pdo->query($sql)->rowCount();
    // --有可能發生錯誤的部分

} catch (PDOException $ex) {
    echo $ex->getMessage();
    // --若 try 發生錯誤就會執行 catch
    // --且後面的程式繼續運行

}

echo '<br>~~~C';






?>