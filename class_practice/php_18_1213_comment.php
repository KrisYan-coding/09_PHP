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
	<?php /*
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
	*/ ?>
	<!-- php + html 一起註解 -->

	<!-- <table>
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
						
	</table> -->
	<!-- ctrl + /: 只註解 html -->

</body>
</html>