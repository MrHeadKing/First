



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
	<?php
		include '_nav.html';
	?>
	<?php
		include 'db.php';
		include 'bg.php';
	?>

	<div class="container mt-5" align="center">

		<?php
			$button_data = $_GET["my_data"];
			$db->exec("DELETE FROM Students
			WHERE std_number = '$button_data' ;");
			
			echo "<div class='alert alert-success'>".$button_data." "."numaralı öğrenci silindi</div>";
			
		?>
		<a class="btn btn-primary" href="example.php">Geri dön</a>


	</div>


</body>
</html>