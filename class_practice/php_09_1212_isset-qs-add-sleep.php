

<?php


$a = isset($_GET['a']) ? intval($_GET['a']) : 0;
$b = isset($_GET['b']) ? intval($_GET['b']) : 0;

sleep(5);

echo $a + $b; 
echo '<br>';

// echo $_GET['c'];
// var_dump(!! isset($_GET['c']));

?>
