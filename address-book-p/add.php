<!-- model $ controller -->
<?php
require './parts/connect_db.php';

$pageName = 'add';
$title = '新增資料';


?>

<!-- view -->
<?php require './parts/html-head.php'; ?>
<?php require './parts/html-navbar.php'; ?>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>
                    <form name="form1" onsubmit="checkForm(event)" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <!-- type=eamil 有填值才會判斷 -->
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" pattern="09\d{2}-?\d{3}-?\d{3}">
                            <!-- pattern 有填值才會判斷 -->
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">address</label>
                            <textarea class="form-control" name="address" id="address" cols="30" rows="3"></textarea>
                            <div class="form-text"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require './parts/html-scripts.php'; ?>

<script>
    const checkForm = (e) => {
        e.preventDefault(); // 不要讓表單預設送出(值不會一直被清空)

        // TODO: 欄位資料檢查--

        const fd = new FormData(document.form1);
        // --從 document.form1 複製一份表單，沒有外觀只有資料的表單

        // // 傳送資料給api--
        // fetch('./add-api.php', {
        //     method: 'POST',
        //     body: fd
        // })
        // .then(function(response){
        //     console.log(response);
        //     return response.json();  // response.text() : Promise // .json()/.text() : parse response to json/text data
        // })
        // .then(function (obj){
        //     console.log(obj);
        // })

        // 傳送資料給api--
        fetch('./add-api.php', {
                method: 'POST',
                body: fd // -> request Content-Type: multipart/form-data
            })
            .then(r => {
                console.log(r);
                return r.json(); // response.json() : a Promise which resolves with the result of parsing the body text as json // .json()/.text() : parse to json/text data
            })
            .then(obj => {
                console.log(obj);
            })
    }
</script>

<?php require './parts/html-foot.php'; ?>