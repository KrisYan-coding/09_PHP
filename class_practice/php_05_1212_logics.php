<?php
// php 放在 html 中不省略結尾tag

$a = true;
$b = false;

echo "--{$a}--<br>";
echo "--{$b}--<br>"; // echo not showing false

$c = 5 || 7; // true: 1
$d = 0 && 7; // false: nothing

echo "--{$c}--<br>";
echo "--{$d}--<br>";

// var_dump(): 查看變數類型和值--
var_dump($c);
echo '<br>';
var_dump($d);
echo '<br>';
?>

<pre><?php
// <pre> 輸出可以自動換行，但 echo 不行
$a = true;
$b = false;

echo "--{$a}--<br>";
echo "--{$b}--<br>"; // echo not showing false

$c = 5 || 7; // true: 1
$d = 0 && 7; // false: nothing

echo "--{$c}--<br>";
echo "--{$d}--<br>";

// var_dump(): 查看變數類型和值--
var_dump($c);
var_dump($d);

$e = 5 or 7;  // and, or 優先權低於 =
$f = 5 and 7;

var_dump($e);
var_dump($f);

$g = (5 or 7);
$h = (5 and 7);

var_dump($g);
var_dump($h);

?></pre>
