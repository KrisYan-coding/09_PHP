<!-- model $ controller -->
<?php
require './parts/connect_db.php';

$sql = "SELECT * FROM address_book ORDER BY sid DESC LIMIT 0, 20"; // 從第 0(index)+1 筆，取前 20 筆

$stmt = $pdo->query($sql);
// echo print_r($stmt);
// --> a PDO statement

$rows = $stmt->fetchAll();
// echo print_r($rows);
// --> array
// echo json_encode($rows);
// --> json
?>

<!-- view -->
<?php require './parts/html-head.php'; ?>
<?php require './parts/html-navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-dark table-striped ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">姓名</th>
                        <th scope="col">電郵</th>
                        <th scope="col">手機</th>
                        <th scope="col">生日</th>
                        <th scope="col">地址</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rows as $r): ?>
                        <tr>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['mobile'] ?></td>
                            <td><?= $r['birthday'] ?></td>
                            <td><?= $r['address'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<?php require './parts/html-scripts.php'; ?>
<?php require './parts/html-foot.php'; ?>