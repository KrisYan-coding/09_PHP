<div class="container">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= ($pageName == 'list') ? 'active' : '' ?>" href="00_list.php">List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($pageName == 'add') ? 'active' : '' ?>" href="01_add.php">Add</a>
                    </li>

                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['admin'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./edit_avatar.php"><?= $_SESSION['admin']['account'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="08_logout.php">登出</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $pageName == 'login' ? 'active' : '' ?>" href="06_login.php">登入</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#沒有實作">註冊</a>
                        </li>
                    <?php endif ?>

                </ul>

            </div>
        </div>
    </nav>

</div>