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
    function validateEmail(email) {
        var re =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zAZ]{2,}))$/;
        return re.test(email);
    }

    const checkForm = (e) => {
        e.preventDefault(); // 不要讓表單預設送出(值不會一直被清空，頁面不會重整)

        // 提醒格式清除--
        $('input.form-control').css({
            border: ''
        }).next().html('');

        // TODO: 欄位資料檢查--
        let isPass = true;
        let field = document.form1.name;
        if (field.value.length < 2) {
            isPass = false;
            field.style.border = '1px solid red';
            // console.log(field.nextElementSibling);
            field.nextElementSibling.innerHTML = '姓名長度不足';
        };

        field = document.form1.email;
        if (! validateEmail(field.value)) {
            isPass = false;
            field.style.border = '1px solid red';
            // console.log(field.nextElementSibling);
            field.nextElementSibling.innerHTML = 'email格式錯誤';
        };
        // 

        // 前端資料檢查不通過就不會發送 request
        if (!isPass) {
            return; // end function
        }

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
                // console.log(obj);
                if (obj.success) {
                    alert('新增成功');
                } else {
                    for (let key in obj.errors) {
                        const el = $(`#${key}`);
                        if (el.length > 0) {
                            el.css({
                                border: '1px solid red'
                            })
                            el.next().html(obj.errors[key]);
                            // console.log(obj['errors'][key]);
                        }
                    }
                }
            })

    }
</script>

<?php require './parts/html-foot.php'; ?>