
<pre>
<?php 
	for ($i = 1; $i <= 49; $i++){
		$arr1[] = $i;
	};

	echo implode('-', $arr1);
	// implode(): 將陣列元素用"-"做字串串接

	$str123456 = '1/2/3/4/5/6';
	$arr2 = explode('/', $str123456);
	// explode(): 將字串用 "/" 切割，並放入陣列，不包含 "/"
	
	echo '<br>';
	
	echo implode('-', $arr2);

	echo '<br>';
	$arr3 = range(1, 30);
	echo implode('-', $arr3);

	echo '<br>';
	shuffle($arr3);
	echo implode('-', $arr3);



?>
</pre>