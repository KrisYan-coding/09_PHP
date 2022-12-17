<?php

require './admin-required.php';
require './parts/php_40_1214_db.php';

$pageName = 'add';
$title = '新增資料';

?>

<?php require './parts/html-head.php' ?>
<?php require './parts/html-navbar.php' ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>
                    <form name="form1" method="post" onsubmit="checkForm(event)" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="mobile" class="form-label">mobile</label>
                            <input type="number" class="form-control" id="mobile" name="mobile" pattern="09\d{2}-?\d{3}-?\d{3}">
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


<script>
    const checkForm = (e) => {
        e.preventDefault(); // 不要讓原來的表單送出

        $('form input').css({
            border: '',
        }).next().html('');


        console.log('enter checkForm');

        // TODO: 欄位資料檢查--

        let isPass = true;

        // 1. 前端 input-name 檢查(不通過就不會送資料)--
        let field = document.form1.name;
        // <input type="text" class="form-control" id="name" name="name" required="" style="">
        if (field.value.length < 2) {
            field.style.border = '2px solid red';
            field.nextElementSibling.innerHTML = '請輸入正確姓名';
            isPass = false;
        }

        // 2. 前端 input-email 檢查(不通過就不會送資料)--
        function validateEmail(email) {
            var re =
                /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zAZ]{2,}))$/;
            return re.test(email);
        };

        field = document.form1.email;
        if (!validateEmail(field.value)) {
            field.style.border = '2px solid red';
            field.nextElementSibling.innerHTML = '請輸入正確email';
            isPass = false;
        }

        if (!isPass) {
            return;
        }


        // 後端檢查(送到後端檢查)--
        const fd = new FormData(document.form1);
        console.log('fd');

        // fetch('02_add-api.php', {
        //     method: 'POST',
        //     body: fd
        // }).then(function(response) {
        //     console.log('then1');
        //     return response.text();
        // }).then(obj => {
        //     console.log(obj);
        // })

        fetch('02_add-api.php', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (obj['success']) {
                    alert('新增成功');
                } else {
                    for (let k in obj.errors) {
                        const el = document.querySelector('#' + k);
                        if (el) {
                            el.style.border = '1px solid red';
                            $(el).next().append(`${obj.errors[k]}`)
                        }
                    }
                }
            })

    };
</script>

<?php require './parts/html-scripts.php' ?>
<?php require './parts/html-foot.php' ?>