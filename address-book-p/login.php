<?php

require './parts/connect_db.php';
$pageName = 'login';

?>

<?php require './parts/html-head.php'; ?>
<?php require './parts/html-navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">管理者登入</h5>
                    <form name="form1" onsubmit="checkForm(event)">
                        <div class="mb-3">
                            <label for="account" class="form-label">account</label>
                            <input type="text" class="form-control" id="account" name="account">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">password</label>
                            <input type="password" class="form-control" id="password" name="password">
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
    function checkForm(e){
        e.preventDefault();

        const fd = new FormData(document.form1);

        fetch('login-api.php', {
            method: 'POST',
            body: fd
        })
        .then(response => {
            console.log('response', response);
            return response.json();
        })
        .then(obj => {
            console.log(obj);

            if (obj.success){
                alert('登入成功');
                location.href = './list.php';
            } else {
                alert(`${obj.errors}`);
            }
        })

        // console.log(document.form1.account.value);
        // console.log(document.form1.password.value);
    }
</script>
<?php require './parts/html-foot.php'; ?>