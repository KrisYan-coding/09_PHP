<?php
require './parts/connect_db.php';
require './functions/func.php';
$pageName = 'report-list';
$title = 'report-list';

if (!isset($_GET['report_id'])) {
    header('Location: ./story-report-list.php');
    exit;
}

if (empty($_GET['report_id'])) {
    header('Location: ./story-report-list.php');
    exit;
}


$report_id = $_GET['report_id'];

$sql = "SELECT 
RU.report_id, 
RU.story_id, 
RU.`user_id(reporter)`, 
SU.user_id, 
RU.report_datetime, 
RR.report_reason_name 
FROM reports_by_user AS RU 
RIGHT OUTER JOIN report_reason AS RR ON RR.report_reason_id = RU.report_reason_id 
RIGHT OUTER JOIN stories_uploaded_by_user AS SU ON SU.story_id = RU.story_id 
WHERE report_id={$report_id} AND verified=0";

$row = $pdo->query($sql)->fetch();

if (!$row) {
    header('Location: ./story-report-list.php');
    exit;
}

$sql = "SELECT `story_title`, `story_path` FROM `stories_uploaded_by_user` WHERE story_id={$row['story_id']}";

$row2 = $pdo->query($sql)->fetch();

$sql = "SELECT * FROM `verified_result`";

$row3 = $pdo->query($sql)->fetchAll();

// echo json_encode($row3);

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
                <div class="legend-table-unverified">未審核案件</div>
                <thead>
                    <tr>
                        <th>案件編號</th>
                        <th>影片編號</th>
                        <th>檢舉人ID</th>
                        <th>被檢舉人ID</th>
                        <th>檢舉時間</th>
                        <th>檢舉原因</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><?= $row['report_id'] ?></th>
                        <td><?= $row['story_id'] ?></td>
                        <td><?= $row['user_id(reporter)'] ?></td>
                        <td><?= $row['user_id'] ?></td>
                        <td><?= $row['report_datetime'] ?></td>
                        <td><?= $row['report_reason_name'] ?></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
    <div class="bg-secondary rounded h-100 p-4 d-flex section-story-watch">
        <video controls width="400" height='400' style='background-color: black'>
            <source src="./story-data/story/<?= $row2['story_path']  ?>" type="video/mp4">
        </video>
        <div class="story-info ms-3">
            <div>影片標題</div>
            <div class="story-title"><?= $row2['story_title'] ?></div>
            <div class="verified-result-selection mt-5">
                <form class="d-flex flex-column" id="form1" name="form1" onsubmit="checkForm(event)">
                    <input type="hidden" value="<?= $report_id ?>" name="report_id">
                    <select class="form-select" aria-label="Default select example" name="verified_result_id">
                        <option selected>請選擇審核結果</option>
                        <?php for ($i = 0; $i < count($row3); $i++) : ?>
                            <option value="<?= $i + 1 ?>"><?= $row3[$i]['verified_result_name'] ?></option>
                        <?php endfor ?>
                    </select>
                    <button class="btn btn-primary mt-3 me-0 w-25" type="submit">確認</button>
                </form>
            </div>
            <a class="btn btn-success mt-3 me-0 w-25" onclick="checkReturn(event)">返回列表</a>
        </div>


    </div>
</div>
</div>



<?php
include './parts/scripts.php';
?>

<script>
    function checkForm(e) {
        e.preventDefault();

        $('#form1 select').css({
            border: '',
        });
        $('.story-info button').attr('disabled', false);
        $('.story-info select').attr('disabled', false);

        let dForm1 = document.form1;
        const fd = new FormData(dForm1);
        // console.log(fd);

        if (dForm1.verified_result_id.value === '請選擇審核結果' || !dForm1.verified_result_id.value) {
            $('#form1 select').css({
                border: '3px solid red',
            });
            return;
        };

        fetch('story-report-verify-api.php', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);

                if (obj.success) {
                    alert('審核成功');
                    $('.story-info button').attr('disabled', true);
                    $('.story-info select').attr('disabled', true);

                } else {
                    $('.story-info .result-text').html(obj.error);
                }
            });
    }

    function checkReturn(e) {
        e.preventDefault();

        if (!$('.story-info button').attr('disabled')) {
            if (confirm('尚未審核完成，確定要返回列表?')) {
                let comeFrom = (document.referrer) ? document.referrer : './story-report-list.php.php';
                location.href = comeFrom;
            }
        } else {
            let comeFrom = (document.referrer) ? document.referrer : './story-report-list.php.php';
            location.href = comeFrom;
        }
    }
</script>

<?php
include './parts/html-footer.php';
?>