<?php
require './parts/php_40_1214_db.php';

$pageName = 'list';
$title = "資料列表";

$perPage = 5;
$page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

// $page = ($page < 1) ? 1 : $page;
// --or--
if ($page < 1) {
    header('Location: ?page=1'); // 同一頁轉向可直接放 query string
    exit;
}

// 取該頁資料--
$sql = sprintf("SELECT * FROM address_book ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * 5, $perPage); // DESC: 最後一筆 index 為0
$rows = $pdo->query($sql)->fetchAll();

// 算總筆數--
$t_sql = "SELECT COUNT(1) FROM address_book";
// $totalRows = $pdo->query($t_sql)->fetch();
// echo json_encode($totalRows);
// {
//     "COUNT(1)": 1037
// }
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

// 算總頁數--
$pages = ceil(intval($totalRows) / $perPage);
// echo $pages;

if ($page > $pages) {
    header("Location: ?page={$pages}");
    exit;
};

?>


<?php require './parts/html-head.php' ?>
<?php require './parts/html-navbar.php' ?>
<div class="container">
    <div class="row">
        <div class="col">
            <?= "總筆數 : " . $totalRows ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <a href="#">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">姓名</th>
                        <th scope="col">email</th>
                        <th scope="col">手機</th>
                        <th scope="col">生日</th>
                        <th scope="col">地址</th>
                        <th>
                            <a href="#">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td>
                                <a class="delete-btn" onclick="delete_it(<?= $r['sid'] ?>)" >
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['mobile'] ?></td>
                            <td><?= $r['birthday'] ?></td>
                            <?php /**<td><?= strip_tags($r['address']) ?></td> */ ?> 
                            <td><?= htmlentities($r['address']) ?></td>
                            <td>
                                <a href="./04_edit.php?sid=<?= $r['sid'] ?>">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <ul class="pagination">
                <?php $currentPage = (isset($_GET['page']))? intval($_GET['page']) : 1 ?>
                <li class="page-item <?= (($currentPage === 1)) ? "disabled" : "" ?>"><a class="page-link " href="?page=<?= ($currentPage === 1) ? 1 : ($currentPage - 1) ?>">Previous</a></li>

                <?php for ($i = $currentPage - 5; $i <= $currentPage + 5; $i++) : ?>
                    <?php if ($i >= 1 and $i <= $pages) : ?>
                        <li class="page-item <?= (($currentPage === $i)) ? "active" : "" ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endif ?>
                <?php endfor ?>

                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>
    </div>
</div>
<?php require './parts/html-scripts.php' ?>
<script>
    function delete_it(sid){
        if (confirm('確定要刪?')){
            location.href = `03_delete.php?sid=${sid}`;
        }

    }
</script>
<?php require './parts/html-foot.php' ?>