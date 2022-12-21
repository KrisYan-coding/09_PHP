
<?php 

$pass = '123456';
$hash = '$2y$10$g/xtaAKSEIs2XXi0d2p/4Op2UOpSLzgVso31c/dD8kGZ9FeToCMsC';

var_dump( password_verify($pass, $hash) );
// password_hash 相同的字串，每次執行結果都不一樣，但長度固定
// password_verify 只要是相同的字串轉換成的 hash，都可以對應(true)

$pass = '12345';

var_dump( password_verify($pass, $hash) );







?>