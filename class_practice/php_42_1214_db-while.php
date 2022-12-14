

<?php 
    
    require './php_40_1214_db.php';

    $sql = "SELECT * FROM address_book LIMIT 5";

    $rows = $pdo->query($sql)->fetchAll();
    

?>

<table>
    <?php foreach($rows as $r): ?>
        <tr>
            <td><?= $r['sid'] ?></td>
            <td><?= $r['name'] ?></td>
            <td><?= $r['email'] ?></td>
            <td><?= $r['mobile'] ?></td>
        </tr>
    <?php endforeach ?>
</table>


<?php /* 
<?php 

    $db_host = 'localhost';
    $db_name = 'my_php_test';
    $db_user = 'root';
    $db_pass = '';

    $dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8";

    $pdo_options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

    $sql = "SELECT * FROM address_book LIMIT 5";

    $stmt = $pdo->query($sql);
    
    $rows = $stmt->fetchAll();
?>

<table>
    <?php for ($i = 0; $i < count($rows);$i++ ): ?>
            <tr>
                <td><?= $rows[$i]['sid'] ?></td>
                <td><?= $rows[$i]['name'] ?></td>
                <td><?= $rows[$i]['email'] ?></td>
                <td><?= $rows[$i]['mobile'] ?></td>
            </tr>
    <?php endfor ?>
</table>
*/ ?>

