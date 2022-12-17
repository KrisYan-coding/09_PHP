
<?php 
    
require './php_40_1214_db.php';

$account = 'shin';
$password = '123456';

$hash = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO `admins`
        (
            `account`,
            `password`) VALUE
        (
            '{$account}',
            '{$password}'
        )";

try {
    echo $pdo->query($sql)->rowCount();
} catch(PDOException $ex) {
    echo 'error';
    echo $ex->getMessage();
};


?>