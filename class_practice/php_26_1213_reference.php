
<pre>
<?php 

	$arr1 = [
		'Hello',
		'name' => 'David',
		'age' => 25,
		'Male'

	];

	$arr2 = $arr1;  // deep copy
	$arr3 = &$arr1;  // assign same reference

	$arr1['name'] = 'Kris';

	print_r($arr1);
	print_r($arr2);
	print_r($arr3);

	$a = 10;
	$b = &$a;
	$b = 7;

	print_r($a);
	print_r($b);



?>
</pre>