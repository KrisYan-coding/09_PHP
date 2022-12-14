<?php 
    session_start(); // 啟動 session 功能

    $users = [
        'Shin' => [
            'pw' => '1234',
            'nickname' => '小新'
        ],

        'Ming' => [
            'pw' => '5678',
            'nickname' => '小明'
        ]
    ];

    $error_msg = '';

    print_r(empty($_POST));
    if (! empty($_POST)){
    // --如果用戶端有送表單資料出來
        $error_msg = '欄位錯誤';

        if (! empty($_POST['account']) and ! empty($_POST['password'])){
        // --如果用戶端傳送的資料 'account' 跟 'password' 都有值
            $error_msg = '帳號錯誤';

            if (! empty($users[$_POST['account']])){
            // --如果用戶端傳送的資料 'account'，存在資料庫中
                
                $user = $users[$_POST['account']];

                $error_msg = '密碼錯誤';

                if ($user['pw'] === $_POST['password']){
                // --如果如果用戶端傳送的資料 'password'，跟資料庫中的 pw 相符
                $error_msg = '';

                    $_SESSION['user'] = [
                        'account' => $user,
                        'nickname' => $user['nickname'],
                        'password' => $user['pw']
                    ];
                    // --將 session 設定為當前登入的使用者
                }
            }
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js" integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>

    <style>
        label{
            display: inline-block;
            width: 80px;
        }
    </style>
</head>
<body>
    <?php 
        // echo '--1';
        // print_r(!! $_POST);

        // echo '--2';
        // print_r(!! $_POST);

        // // print_r(! $_POST['account']); // Undefined array key "account" 

        // echo '--3';
        // print_r(!! isset($_POST));

        // echo '--4';
        // print_r(!! isset($_POST['account']));

        // if (! isset($_POST['account'])){
        //     echo 'false';
        // }

        if (isset($_SESSION['user'])){
        // --如果 session 中存在當前登入的使用者
            printf('%s 你好', $_SESSION['user']['nickname']);
    ?>
            <a href="./php_39_1214_logo-out.php">Log out</a>
    <?php 
        }
        
        else{
        // --如果 session 中不存在當前登入的使用者 -> 給表單
    ?>
    
            <?php if (! empty($error_msg)): ?>
                <div class="alert"><?= $error_msg; ?></div>
            <?php endif ?>

            <form name="my-form1" method="post">
            <!-- 沒有設 action -> 送給自己 -->
                <label for="account">account</label>
                <input type="text" name="account" value="<?= isset($_POST['account']) ? htmlentities($_POST['account']) : '' ?>"><br>
                <label for="pwd">password</label>
                <input type="password" name="password" value="<?= isset($_POST['password']) ? htmlentities($_POST['password']) : '' ?>"><br>
                <!-- 打錯時，使用者打的東西可以保留 -->
                <!-- htmlentities : 跳脫使用者打的雙引號，避免發生問題 -->
                <input type="submit">
            </form>

    <?php } ?>

    <script>
        const errorMsg = $('.alert');

        console.log(!! errorMsg.text());

        if (!! errorMsg.text()){
            setTimeout(() => {
                errorMsg.slideUp();
            }, 1000);
        }
    </script>

    
</body>
</html>