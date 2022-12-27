<?php

require './parts/connect_db.php';
require './functions/func.php';
$pageName = 'report-list';
$title = 'report-list';

// get stroy id list--
$sql = "SELECT 
`story_id`
FROM `stories_uploaded_by_user` WHERE 1";

$stmt = $pdo->query($sql);

$rows_story_id = $stmt->fetchAll();
// echo json_encode($rows_story_id);

$story_id_list = array_map(function ($item) {
    return $item['story_id'];
}, $rows_story_id);
// echo json_encode($story_id_list);

// get report reason id and name--
$sql = "SELECT `report_reason_id`, `report_reason_name` FROM `report_reason` WHERE 1";

$stmt = $pdo->query($sql);

$rows_report_reason = $stmt->fetchAll();
// echo json_encode($rows_report_reason);

// $report_reason_id_list = array_map(function ($item) {
//     return $item['report_reason_id'];
// }, $rows_report_reason);

$report_reason_name_list = array_map(function ($item) {
    return $item['report_reason_name'];
}, $rows_report_reason);

// echo json_encode($report_reason_id_list);
// echo json_encode($report_reason_name_list, JSON_UNESCAPED_UNICODE);


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

<div class="col-12">
    <div class="bg-secondary rounded h-100 p-4 section-form-outter">
        <h6 class="mb-4">短影音檢舉管理</h6>
        <div class="legend-report-add-form">新增檢舉</div>
        <form class="d-flex flex-column mt-3" id="form1" name="form1" onsubmit="checkForm(event)">

            <label for="select_story_id">檢舉影片ID</label>
            <div class="input-ele w-100 d-flex">
                <select id="select_story_id" name="select_story_id" class="form-select flex-shrink-0" aria-label="Default select example">
                    <option selected disabled value="not_select">請選擇要檢舉的影片ID</option>
                    <?php foreach ($story_id_list as $story_id) : ?>
                        <option value="<?= $story_id ?>"><?= $story_id ?></option>
                    <?php endforeach ?>
                </select>
                <div class="text-box ms-2"></div>
            </div>

            <label for="auto_userid_reported">被檢舉人ID</label>
            <input id="auto_userid_reported" name="auto_userid_reported" class="form-control bg-light border-0 text-dark" type="text" readonly>

            <label for="select_report_reason">檢舉原因</label>
            <div class="input-ele w-100 d-flex">
                <select id="select_report_reason" name="select_report_reason" class="form-select flex-shrink-0" aria-label="Default select example">
                    <option selected disabled value="not_select">請選擇要檢舉的原因</option>
                    <?php foreach ($report_reason_name_list as $key => $report_reason_name) : ?>
                        <option value="<?= $key + 1 ?>"><?= $report_reason_name ?></option>
                    <?php endforeach ?>
                </select>
                <div class="text-box ms-2"></div>
            </div>

            <button class="btn btn-primary mt-3 me-0 w-25" type="submit">確認</button>
        </form>

    </div>
</div>
</div>



<?php
include './parts/scripts.php';
?>

<script>
    let selectStoryId = document.querySelector('#form1 #select_story_id');
    selectStoryId.addEventListener('change', function() {
        let storyId = this.value;
        // console.log(storyId);

        $.ajax({
                method: "POST",
                url: "./story-report-add-auto-insert-userID.php",
                data: {
                    story_id: storyId
                }
            })
            .done(function(response) {
                console.log(response);
                let userId = JSON.parse(response)['note']['user_id'];
                $('#form1 #auto_userid_reported').attr('value', userId);
            });

    });

    function checkForm(e) {
        e.preventDefault();

        // reset 欄位檢查--
        $('#select_story_id').css({
            outline: '',
        })
        $('#select_report_reason').css({
            outline: '',
        })

        // 欄位檢查--
        let isPass = true;

        if ($('#select_story_id option:selected').val() === 'not_select') {
            isPass = false;
            $('#select_story_id').css({
                outline: '3px solid rgba(255, 0, 0, .5)'
            })
        }
        if ($('#select_report_reason option:selected').val() === 'not_select') {
            isPass = false;
            $('#select_report_reason').css({
                outline: '3px solid rgba(255, 0, 0, .5)'
            })
        }


        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('story-report-add-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        alert('檢舉成功');
                    } else {
                        alert(obj.error);
                    }
                })
        }

    }
</script>

<?php
include './parts/html-footer.php';
?>