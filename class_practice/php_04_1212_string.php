<?php

$name_single = 'David';
$name_double = "David";

echo "hello $name_single <br>";
echo 'hello $name_single <br>';
echo 'hello $name_double <br>';
// --雙引號內可以加入變數，單引號不行

echo "hello 
        $name_single 
        <br>";
echo 'hello 
        $name_single
        <br>';
// 單雙引號都可以換行，browser只認 1 個空白

echo "hello {$name_single} <br>";
echo "hello ${name_single} <br>";

$int1 = 100;
$int2 = 200;

echo $int1 + $int2;
// echo "total {$int1 + $int2}"; // variable only
echo '<br>';

echo "xyz\nabc\"def\'ghi\\\\";
echo '<br>';

echo 'xyz\nabc\"def\'ghi\\\\';