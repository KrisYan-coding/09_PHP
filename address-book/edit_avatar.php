<?php

require './admin-required.php';
require './parts/php_40_1214_db.php';

$pageName = 'avatar';
$title = '上傳avatar';

?>

<?php require './parts/html-head.php' ?>
<?php require './parts/html-navbar.php' ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img id="my-img" src="./../uploads/<?= empty($_SESSION['admin']['avatar']) ? '_default.png' : $_SESSION['admin']['avatar'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <a onclick="f.click()" class="btn btn-primary">上傳</a>
                    <a onclick="update_avatar()" class="btn btn-primary">確定</a>
                    <a onclick="location.reload()" class="btn btn-primary">取消</a>
                </div>
                <input type="hidden" id="avatar_val" value="<?= $_SESSION['admin']['avatar'] ?>">
            </div>
        </div>
    </div>
</div>


<form name="form1" onsubmit="return false" style="display: none;">
    <input type="file" name="avatar" accept="image/*">


</form>



<script>
    const f = document.form1.avatar;
    const myImg = document.querySelector('#my-img');
    const avatar_val = document.querySelector('#avatar_val');


    // 若有選檔案 or 若有變更檔案--
    f.onchange = async () => {
        const fd = new FormData(document.form1);
        const r = await fetch('../class_practice/php_59_1219_process-single-img-admin.php', {
            method: 'POST',
            body: fd
        });
        console.log(r);

        const data = await r.json();
        console.log(data);

        if (data.success) {
            myImg.src = 'http://localhost/09_PHP/uploads/' + data.filename;
            avatar_val.value = data.filename;
        } else {
            alert(data.error || '沒有上傳檔案');
        }
    }

    async function update_avatar() {
        const filename = avatar_val.value;

        const r = await fetch(`edit_avatar_api.php?filename=${filename}`);
        const data = await r.json();
        if (data.success) {
            alert('大頭貼更新完成~');
        } else {
            alert('大頭貼更新發生錯誤!!');
        }
    }
</script>


<?php require './parts/html-scripts.php' ?>
<?php require './parts/html-foot.php' ?>