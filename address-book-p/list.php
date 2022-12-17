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
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>

<?php require './parts/html-scripts.php'; ?>
<?php require './parts/html-foot.php'; ?>