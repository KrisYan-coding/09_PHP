
<pre>
	<?php 

		// 索引式陣列--
		$arr1 = array(2, 'bill', 6);
		$arr2 = [3, 'Mary', 7];

		// echo $arr1; // error 不能直接輸出 array

		print_r($arr1);

		var_dump($arr1);

		// 關聯式陣列--
		$arr3 = array(
			'name' => 'David',
			'age' => 25
		);

		$arr4 = array(
			'name' => 'John',
			'age' => 35,
			2 => 333
		);
		// --key 一定要字串，用數字會轉換成字串

		print_r($arr3);
		print_r($arr4);
		print_r($arr4['name']);
		print_r($arr4[2]);
		print_r($arr4['2']);

	
	?>
</pre>