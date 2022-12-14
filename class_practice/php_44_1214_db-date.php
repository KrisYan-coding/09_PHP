

<?php 

    header('Content-Type: text/plain');
    
    // date_default_timezone_set('Asia/Taipei');
    // --設定時區
    // --直接在 php.init 設定

    echo date("Y-m-d H:i:s");
    // --預設: 德國時間
    // --改為: 台北時間


    echo "\n";
    echo date("Y-m-d H:i:s", time() + 30*24*60*60); // 30 天後

    echo "\n";
    $str = '1998/10/15';
    $t = strtotime($str);  // 時間字串 轉為 timestamp
    echo date('Y-m-d', $t);

    // 1995 ~ 2005 隨機挑一個日期
    $start = strtotime('1995-01-01');
    $end = strtotime('2005-01-01') - 1; //不含 2005-01-01

    for ($i = 0; $i < 20; $i++){
        $t = rand($start, $end);
        echo date("Y-m-d\n", $t);
    }




    
    

?>




