<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php
		$age = isset($_GET['age']) ? intval($_GET['age']) : 0;

		if ($age >= 18){
	?>
			<h2>歡迎光臨</h2>
	<?php
		} else {
	?>
			<h2>下次再來</h2>
	<?php
		}
	?>

	<!-- php 中間穿插 HTML，可以截斷 php 加入 HTML -->
	<?php
		$age = isset($_GET['year']) ? intval($_GET['year']) : 0;

		if ($age == 2022):
	?>
			<h2>今年</h2>
	<?php
		else:
	?>
			<h2>不知道哪一年</h2>
	<?php
		endif
	?>
	
	
	
</body>
</html>