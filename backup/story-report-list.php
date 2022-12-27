<?php
require './parts/connect_db.php';
require './functions/func.php';
$pageName = 'report-list';
$title = 'report-list';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page2 = isset($_GET['page2']) ? intval($_GET['page2']) : 1;

// -----table-unverified--------
# total amount count
$totalAmount = count_data($pdo, "SELECT COUNT(report_id) FROM reports_by_user WHERE verified=0");

# amount per page
$perPage = 5;

// total page count
$totalPages = ceil($totalAmount / $perPage);

// if user amount > 0
$report_data = [];    # set user info to an empty array to prevent errors when rendering
if (!empty($totalAmount)) {

    // if search page exceeds total page
    if ($page > $totalPages) {
        header("Location: ?page=$totalPages&page2={$page2}");
        exit;
    }
    if ($page < 1) {
        header("Location: ?page=1&page2={$page2}");    // turn to page 1
        exit;
    }
}


$report_data = show_data(
    $pdo,
    sprintf("SELECT RU.report_id, RU.story_id, RU.`user_id(reporter)`, SU.user_id, RU.report_datetime, RR.report_reason_name FROM reports_by_user AS RU RIGHT OUTER JOIN report_reason AS RR ON RR.report_reason_id = RU.report_reason_id RIGHT OUTER JOIN stories_uploaded_by_user AS SU ON SU.story_id = RU.story_id WHERE verified=0 ORDER BY report_id ASC LIMIT %s, %s", ($page - 1) * $perPage, $perPage)
);

// -----table-verified--------
# total amount count
$totalAmount2 = count_data($pdo, "SELECT COUNT(report_id) FROM reports_by_user WHERE verified=1");

# amount per page
$perPage2 = 5;

// total page count
$totalPages2 = ceil($totalAmount2 / $perPage2);

// if user amount > 0
$report_data2 = [];    # set user info to an empty array to prevent errors when rendering
if (!empty($totalAmount2)) {

    // if search page exceeds total page
    if ($page2 > $totalPages2) {
        header("Location: ?page={$page}&page2=$totalPages2");
        exit;
    }
    if ($page2 < 1) {
        header("Location: ?page={$page}&page2=1");    // turn to page 1
        exit;
    }
}

$report_data2 = show_data(
    $pdo,
    sprintf("SELECT 
    RU.report_id, 
    RU.story_id, 
    RU.`user_id(reporter)`, 
    SU.user_id, 
    RU.report_datetime, 
    RR.report_reason_name, 
    RU.verified_datetime, 
    VR.verified_result_name, 
    AU.name 
    FROM reports_by_user AS RU 
    RIGHT OUTER JOIN report_reason AS RR ON RR.report_reason_id = RU.report_reason_id 
    RIGHT OUTER JOIN stories_uploaded_by_user AS SU ON SU.story_id = RU.story_id 
    RIGHT OUTER JOIN `verified_result` AS VR ON VR.verified_result_id= RU.verified_result_id 
    RIGHT OUTER JOIN `admin_user` AS AU ON AU.admin_id = RU.admin_id 
    WHERE verified = 1 
    ORDER BY report_id ASC LIMIT %s, %s", ($page2 - 1) * $perPage2, $perPage2)
);


?>






<?php
include './parts/html-head.php';
?>
<?php
include './parts/sidebar.php';
?>
<?php
include './parts/navbar.php';
?>
<!-- <div>
    <label for="search_user">Search User</label>
    <input type="text" name="search_user">
    <input type="submit" value="search">
</div> -->
<div class="col-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">短影音檢舉管理</h6>
        <div class="table-responsive">
            <table class="table table-unverified">
                <div class="legend-table-verified">未審核案件</div>
                <thead>
                    <tr>
                        <th>案件編號</th>
                        <th>影片編號</th>
                        </th>
                        <th>檢舉人ID</th>
                        <th>被檢舉人ID</th>
                        <th>檢舉時間</th>
                        <th>檢舉原因</th>
                        <th colspan="2">More Info</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($report_data as $report) {
                    ?>
                        <tr>
                            <th><?= $report['report_id'] ?></th>
                            <td><?= $report['story_id'] ?></td>
                            <td><?= $report['user_id(reporter)'] ?></td>
                            <td><?= $report['user_id'] ?></td>
                            <td><?= $report['report_datetime'] ?></td>
                            <td><?= $report['report_reason_name'] ?></td>


                            <td><a href="javascript: " onclick="delete_it(event, <?= $report['report_id'] ?>)"><i class="fa-solid fa-trash"></i></a></td>

                            <td><a href="story-report-verify.php?report_id=<?= $report['report_id'] ?>"><i class="fa-solid fa-file-pen"></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>&page2=<?= $page2 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = $page - 3; $i <= $page + 3; $i++) :
                            if ($i >= 1 && $i <= $totalPages) :
                        ?>
                                <li class="page-item"><a class="page-link <?= $i == $page ? 'active' : '' ?>" href="?page=<?= $i ?>&page2=<?= $page2 ?>"><?= $i ?></a></li>
                            <?php endif ?>
                        <?php endfor ?>
                        <li class="page-item  <?= $page == $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>&page2=<?= $page2 ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="bg-secondary rounded h-100 p-4">
        <div class="table-responsive">
            <table class="table table-unverified">
                <div class="legend-table-unverified">已審核案件</div>
                <thead>
                    <tr>
                        <th>案件編號</th>
                        <th>影片編號</th>
                        </th>
                        <th>檢舉人ID</th>
                        <th>被檢舉人ID</th>
                        <th>檢舉時間</th>
                        <th>檢舉原因</th>
                        <th>審核時間</th>
                        <th>審核結果</th>
                        <th>審核人</th>
                        <th colspan="2">More Info</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($report_data2 as $report) {
                    ?>
                        <tr>
                            <th><?= $report['report_id'] ?></th>
                            <td><?= $report['story_id'] ?></td>
                            <td><?= $report['user_id(reporter)'] ?></td>
                            <td><?= $report['user_id'] ?></td>
                            <td><?= $report['report_datetime'] ?></td>
                            <td><?= $report['report_reason_name'] ?></td>
                            <td><?= $report['verified_datetime'] ?></td>
                            <td><?= $report['verified_result_name'] ?></td>
                            <td><?= $report['name'] ?></td>


                            <td><a href="javascript: " onclick="delete_it(event, <?= $report['report_id'] ?>)"><i class="fa-solid fa-trash"></i></a></td>

                            <td><a href="edit.php?user_id=<?= $report['report_id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item <?= $page2 == 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page ?>&page2=<?= $page2 - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = $page2 - 3; $i <= $page2 + 3; $i++) :
                            if ($i >= 1 && $i <= $totalPages2) :
                        ?>
                                <li class="page-item"><a class="page-link <?= $i == $page2 ? 'active' : '' ?>" href="?page=<?= $page ?>&page2=<?= $i ?>"><?= $i ?></a></li>
                            <?php endif ?>
                        <?php endfor ?>
                        <li class="page-item  <?= $page2 == $totalPages2 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page ?>&page2=<?= $page2 + 1 ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
</div>



<?php
include './parts/scripts.php';
?>

<script>
    function delete_it(e, reportId) {
        e.preventDefault();
        // console.log(reportId);

        if (confirm(`確定要刪除標號為${reportId}的檢舉案件?`)) {
            location.href = `./story-report-delete-api.php?report_id=${reportId}`;
        }
    }
</script>

<?php
include './parts/html-footer.php';
?>