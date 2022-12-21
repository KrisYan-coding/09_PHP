
<?php 
    require './parts/php_40_1214_db.php';

    $pageName = 'login';

    if (isset($_SESSION['admin'])){
        header('Location: index_.php');
        exit;
    }

?>

<?php require './parts/html-head.php' ?>
<?php require './parts/html-navbar.php' ?>


<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">管理者登入</h5>
                    <form name="form1" method="post" onsubmit="checkForm(event)">
                        <div class="mb-3">
                            <label for="account" class="form-label">帳號</label>
                            <input type="text" class="form-control" id="account" name="account" required>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">密碼</label>
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

<script>
    function checkForm(e){
        e.preventDefault();
        console.log(document.form1.account.value);
        console.log(document.form1.password.value);

        const fd = new FormData(document.form1);

        fetch('./07_login-api.php', {
            method: 'POST',
            body: fd
        })
        .then(r => r.json())
        .then(data => {
        
            if (data.success){
                location.href = '00_list.php'
            } else {
                alert(data.error)
            }
        })

    }
</script>


<?php require './parts/html-scripts.php' ?>
<?php require './parts/html-foot.php' ?>