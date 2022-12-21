<?php

require './parts/connect_db.php';

?>

<?php require './parts/html-head.php'; ?>
<?php require './parts/html-navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">登入</h5>
                    <form name="form1" onsubmit="checkForm(event)">
                        <div class="mb-3">
                            <label for="account" class="form-label">account</label>
                            <input type="text" class="form-control" id="account" name="account">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <!-- type=eamil 有填值才會判斷 -->
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

        console.log(document.form1.account.value);
        console.log(document.form1.password.value);
    }
</script>
<?php require './parts/html-foot.php'; ?>