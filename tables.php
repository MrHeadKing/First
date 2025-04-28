


<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include '_nav.html';
        include 'db.php';
        include 'bg.php';
        $data = $db->query("SELECT * FROM Lessons");
        $data_dept = $db->query("SELECT * FROM Department");
        $data_std = $db->query("SELECT * FROM Students");
    ?>

    <div class="container">
    

        <h1 class="text-white">Dersler Tablosu</h1>
        <table class="table table-bordered" border="4">
            <thead>
                <th>Ders kodu</th>
                <th>Ders başlığı</th>
                <th>Kredi</th>
                <th>AKTS</th>
                <th>Tür</th>
            </thead>
            <?php
                foreach($data as $d)
                {
                    $les_code = $d["lesson_code"];
                    $les_title = $d["title"];
                    $les_credit = $d["credit"];
                    $les_akts = $d["AKTS"];
                    $les_type = $d["Type"];
                    echo "<tr><td>$les_code</td>
                    <td>$les_title</td><td>$les_credit</td><td>$les_akts</td>
                    <td>$les_type</td></tr>";
                }
            ?>
        </table>
        <br>
        <br>

        <h1 class="text-white">Bölüm Tablosu</h1>
        <table class="table table-bordered" border="4">
            <thead>
                <th>Bölüm adı</th>
                <th>Öğrenim tipi</th>
                
            </thead>
            <?php
                foreach($data_dept as $d)
                {
                    $dept_name = $d["name"];
                    $dept_type = $d["type"];
                    
                    echo "<tr><td>$dept_name</td>
                    <td>$dept_type</td></tr>";
                }
            ?>
        </table>
        <br>
        <br>
        
        <h1 class="text-white">Öğrenciler Tablosu</h1>
    <table class="table table-bordered" border="4">
				<thead>
					<th>Öğrenci numarası</th>
					<th>Adı</th>
					<th>Soyadı</th>
					<th>Bölüm</th>
					
				</thead>
				<?php
					foreach($data_std as $d)
					{
						$part = $d["std_number"]; 
						echo "<tr>
							<td><a href='details.php'>".$d["std_number"]."</a></td>
							<td>".$d["name"]."</td>
							<td>".$d["surname"]."</td>
							<td>".$d["department"]."</td>
							
						</tr>";
					}
					
				?>
				
			</table>



    </div>
    
    
</body>
</html>

