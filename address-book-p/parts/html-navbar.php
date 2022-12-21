<style>
    nav.navbar .navbar-nav .nav-link.active {
        color: red;
        font-weight: bold;
    }
</style>

<?php
$pageName = $pageName ?? ''; // '' if  Undefined, remain if defined


?>

<div class="container">
    <div class="row">
        <div class="col">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index_.php">通訊錄</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link <?= ($pageName === 'list') ? 'active' : '' ?>" aria-current="page" href="list.php">列表</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= ($pageName === 'add') ? 'active' : '' ?>" href="add.php">新增</a>
                            </li>

                        </ul>
                        <ul class="navbar-nav mb-lg-0">
                            <?php if (isset($_SESSION['admin'])) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="javascript: "><?= $_SESSION['admin']['account'] ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="logout.php">登出</a>
                                </li>
                            <?php else : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($pageName === 'login') ? 'active' : '' ?>" aria-current="page" href="login.php">登入</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($pageName === 'enroll') ? 'active' : '' ?>" aria-current="page" href="index_.php">註冊</a>
                                </li>
                            <?php endif ?>

                        </ul>

                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>