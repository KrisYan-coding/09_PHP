
<pre>
<?php 

	$arr1 = [
		'Hello' => '嗨',
		'name' => 'David',
		'age' => 25,
		'Male'
	];

	echo json_encode($arr1, JSON_UNESCAPED_UNICODE); // 編碼成 JSON 字串
	// 中文會變成 UTF 編碼
	// JSON_UNESCAPED_UNICODE : JSON 不要編碼 Unicode

	// $json1 = "{
	// 	name: David,
	// 	age: 25
	// }";

	// $obj1 = json_decode($json1);
	// var_dump($obj1);




?>
</pre>