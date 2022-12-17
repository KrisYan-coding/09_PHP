<!-- model $ controller -->
<?php
require './parts/connect_db.php';

$perPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// echo $page, gettype($page);

// 檢查 GET page--
if ($page < 1) {
    // header('Location: ./list.php?page=1');
    // --同一個 php 內，直接寫 query string--
    header('Location: ?page=1');
    exit(); // 此 php 以下不再執行
}

// $totalRows = 總筆數--
$t_sql = "SELECT COUNT(1) FROM address_book";
// $totalRows = $pdo->query($t_sql)->fetch();
// echo print_r($totalRows);
// --Array ( [COUNT(1)] => 1036 )
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
// echo $totalRows;

// $totalPages = 總頁數--
$totalPages = intval(ceil($totalRows / $perPage));

// empty() : true--
// echo empty('');
// echo empty(0);
// echo empty([]);
// echo empty(null);
// echo empty({}); // error

// 如果資料表有資料的話--
$rows = []; // 避免 table foreach error
if (!empty($totalRows)) {

    if ($page > $totalPages) {
        // 頁碼超出範圍時轉向到最後一頁--
        // method 1 better--
        header("Location: ?page={$totalPages}");
        exit();

        // method 2 (?page=2000 停在不正確的url)--
        // $page = $totalPages;
    }

    $sql = sprintf(
        "SELECT * FROM address_book ORDER BY sid DESC LIMIT %s, %s",
        ($page - 1) * $perPage,
        $perPage
    ); // 從第 0(index)+1 筆，取前 20 筆
    // --sprintf — Return a formatted string

    $stmt = $pdo->query($sql);
    // echo print_r($stmt);
    // --> a PDO statement

    $rows = $stmt->fetchAll();
    // echo print_r($rows);
    // --> array
    // echo json_encode($rows);
    // --> json
}


?>



<!-- view -->
<?php require './parts/html-head.php'; ?>
<?php require './parts/html-navbar.php'; ?>

<div class="container mt-3">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= ($page === 1) ? 'disabled' : '' ?> "><a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a></li>

                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) : ?>
                        <?php if ($i > 0 and $i <= $totalPages) : ?>
                            <li class="page-item <?= ($i === $page) ? 'active' : '' ?> "><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php endif ?>
                    <?php endfor ?>

                    <li class="page-item <?= ($page === $totalPages) ? 'disabled' : '' ?> "><a class="page-link" href="?page=<?= $page + 1 ?>">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-dark table-striped ">
                <thead>
                    <tr>
                        <th scope="col">
                            <a href=""><i class="fa-solid fa-trash"></i></a>
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">姓名</th>
                        <th scope="col">電郵</th>
                        <th scope="col">手機</th>
                        <th scope="col">生日</th>
                        <th scope="col">地址</th>
                        <th scope="col">
                            <a href=""><i class="fa-solid fa-pen"></i></a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <th scope="col">
                                <a href="./delete.php?sid=<?= $r['sid'] ?>"><i class="fa-solid fa-trash"></i></a>
                            </th>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['mobile'] ?></td>
                            <td><?= $r['birthday'] ?></td>
                            <td><?= $r['address'] ?></td>
                            <td scope="col">
                                <a href="./edit.php?sid=<?= $r['sid'] ?>"><i class="fa-solid fa-pen"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<?php require './parts/html-scripts.php'; ?>
<?php require './parts/html-foot.php'; ?>