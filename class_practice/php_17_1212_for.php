<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<style>
		td{
			width: 20px;
			height: 20px;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<?php
				for ($i = 0; $i < 256; $i += 17){
			?>
					<td style="background-color: rgb(<?= $i ?>, 0, 0);"></td>
			<?php
				}
			?>
		</tr>
	</table>

	<table>
		<?php
			$color = 0;
				for ($i = 0; $i < 16; $i++):
		?>
					<tr>
		<?php
					for ($j = 0; $j < 16; $j++):
		?>
						<td style="background-color: rgb(<?= $color ?>, 0, 0);"></td>
		<?php
						$color += 1;

					endfor;
		?>
				</tr>
		<?php
				endfor
		?>
						
	</table>

	<table>
		<?php for($i = 0; $i < 256; $i += 17): ?>
				<tr>
					<?php for ($j = 0; $j < 256; $j += 17): ?>
						<td style="background-color: rgb(<?= $i ?>, <?= $j ?>, 0);"></td>
					<?php endfor ?>
				</tr>
		<?php endfor ?>

		
	</table>
</body>
</html>