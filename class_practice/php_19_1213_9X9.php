<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<style>
		td{
			width: 50px;
			height: 50px;
			background: #ccc;
			display: inline-block;

		}
	</style>
</head>
<body>
	<?php /* 
	<table>
		<?php for ($i = 1; $i < 10; $i ++): ?>
				<tr>
		<?php 	for ($j = 1; $j < 10; $j++): ?>
					<td><?= $i ?>*<?= $j ?>=<?= $i*$j ?></td>
				<?php endfor ?>
				</tr>
		<?php endfor ?>

	</table>
	*/ ?>

	<?php /* 
	<table>
		<?php for ($i = 1; $i < 10; $i ++): ?>
				<tr>
		<?php 	for ($j = 1; $j < 10; $j++): ?>
					<td><?= $i . '*' . $j . '=' . $i*$j ?></td>
				<?php endfor ?>
				</tr>
		<?php endfor ?>

	</table>
	*/ ?>

	<?php /* 
	<table>
		<?php for ($i = 1; $i < 10; $i ++): ?>
				<tr>
		<?php 	for ($j = 1; $j < 10; $j++): ?>
					<td><?= sprintf('%s * %s = %s', $i, $j, $i*$j) ?></td>
				<?php endfor ?>
				</tr>
		<?php endfor ?>

	</table>
	*/ ?>
	<!-- sprintf() -> return a formatted string -->
	<!-- %s : string -->

	<table>
		<?php for ($i = 1; $i < 10; $i ++): ?>
				<tr>
		<?php 	for ($j = 1; $j < 10; $j++): ?>
					<td><?php printf('%s * %s = %s', $i, $j, $i*$j) ?></td>
				<?php endfor ?>
				</tr>
		<?php endfor ?>

	</table>

	<?php echo (sprintf('There are %d monkeys in the %s', 5, 'tree')) ?>
	<?php echo '<br>' ?>
	<?php echo (sprintf('There are %d monkeys in the %s', '5', 'tree')) ?>


</body>
</html>