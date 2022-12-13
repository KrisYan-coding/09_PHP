
<pre>
<?php 

	$arr1 = [
		'Hello',
		'name' => 'David',
		'age' => 25,
		'Male'

	];

	foreach($arr1 as $index => $value){
		echo "$index : $value \n";
	};

	foreach($arr1 as $value){
		echo "___ : $value \n";
	};




?>
</pre>