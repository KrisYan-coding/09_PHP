
<?php

// 變數命名: 第一個字元不可為數字
$a3 = 12;
echo $a3;
echo '<br>';

// UTF-8 編碼下可以用中文命名變數，但盡量不要
$中文 = 'chinese';
echo $中文;
echo '<br>';

$my_age = 25; // snake
$myAge = '25'; // camelCase
echo __DIR__; // 內建常數，snake & capitalized
echo '<br>';

echo $my_age + $myAge . '25'; 
// -> + : 只會數值相加，不作字串串接
// -> . : 字串串接
echo '<br>';

$str1 = 'aaa';
// echo $my_age + $str1;
// -> int, string 不可以相加

$a2 = '100';
echo intval($a2);
echo '<br>';

echo intval($str1); // 無法轉為10進位(default) -> 0
echo '<br>';

echo intval($str1, 16); // 轉為16進位



