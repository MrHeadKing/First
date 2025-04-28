


<!DOCTYPE html>
<html>
<head>
	<?php
		include 'bg.php';
	?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<?php
		include '_nav.html';
	?>
	<div class="container mt-5 me-auto">
			
			<?php
				include 'db.php';
				$data = $db->query("SELECT std_number,name,surname,department FROM Students");
			?>
			<?php
				session_start();
				if($_SERVER["REQUEST_METHOD"] == "POST")
				{
					$student_number = $_POST["s_number"];
					$student_name = $_POST["s_name"];
					$student_surname = $_POST["s_surname"];
					$student_email = $_POST["s_email"];
					$student_department = $_POST["s_department"];
					$student_is_active = $_POST["is_active"] ?? 0;
					
					$error_messages = [];

					if(empty($student_number))
					{
						$error_messages["std_number"] = "Öğrenci numarası boş geçilemez !";
					}

					if(empty($student_name))
					{
						$error_messages["std_name"] = "Öğrenci adı boş geçilemez !";
					}

					if(empty($student_surname))
					{
						$error_messages["std_surname"] = "Öğrenci soyadı boş geçilemez";
					}

					if($student_is_active == "on")
					{
						$student_is_active = true;
					}
					else
					{
						$student_is_active = 0;
						
					}
				

					if(!empty($error_messages))
					{
						$_SESSION["errors"] = $error_messages;
						header("Location:add_student.php");
						exit;
					}

					$db->exec("INSERT INTO Students VALUES('$student_number','$student_name','$student_surname','$student_email','$student_department',$student_is_active);");
					
				}		
				?>

			
			
			
			
			<form action="example.php" method="GET">
				
				<input name="search_data" placeholder="" type="text">
				<select name="fields" id="">
					<option value="std_number">Öğrenci no</option>
					<option value="name">İsim</option>
					<option value="surname">Soyisim</option>
					<option value="department">Bölüm</option>
				</select>
				<button class="btn btn-outline-secondary" type="submit">Ara</button>
			</form>
			
			<br>
			<?php
			
				$any_data = $_GET["search_data"] ?? '';
				$toggle = $_GET["fields"] ?? '';
				
				

				if(!empty($any_data) and !empty($toggle))
				{
					$search_data = $db->query("SELECT * FROM Students
					WHERE $toggle like '%$any_data%';
					");
					echo "<table style='width:70%' class='table table-bordered' border='4'>";
					foreach($search_data as $sd)
					{
						echo "<tr>
								<td><a href='details.php'>".$sd["std_number"]."</a></td>
								<td>".$sd["name"]."</td>
								<td>".$sd["surname"]."</td>
								<td>".$sd["department"]."</td>
								<td class='d-flex'><a class='btn btn-primary' href='#'>düzenle</a>
								<a style='margin-left:8px;' class='btn btn-danger' href='sure.php?veri=örnek sayi'>sil</a>
								
								</td>
							</tr>";
						
					}
					echo "</table>";

				}

				

				
				
			?>

			 
			


			
			<br>
			<table style="width:70%;" class="table table-bordered" border="4">
				<thead>
					<th>Öğrenci numarası</th>
					<th>Adı</th>
					<th>Soyadı</th>
					<th>Bölüm</th>
					<th>İşlem</th>
				</thead>
				<?php
					foreach($data as $d)
					{
						$part = $d["std_number"]; 
						echo "<tr>
							<td><a href='details.php'>".$d["std_number"]."</a></td>
							<td>".$d["name"]."</td>
							<td>".$d["surname"]."</td>
							<td>".$d["department"]."</td>
							<td class='d-flex'><a class='btn btn-primary' href='edit.php?my_edit=$part'>düzenle</a>
							<a style='margin-left:8px;' class='btn btn-danger' href='sure.php?my_data=$part'>sil</a>
							
							</td>
						</tr>";
					}
					
				?>
				
			</table>
			
			
	</div>

</body>
</html>
