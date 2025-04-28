


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
        
        $data = $db->query("SELECT std_number,name,surname,department FROM Students");
    ?>
    <div class="container mt-5">
        <table style="width:70%;" class="table table-bordered" border="4">
                    <thead>
                        <th>Öğrenci numarası</th>
                        <th>Adı</th>
                        <th>Soyadı</th>
                        <th>Bölüm</th>
                        
                    </thead>
                    <?php
                        session_start();
                        foreach($data as $d)
                        {
                            echo "<tr>
                                <td>".$d["std_number"]."</td>
                                <td>".$d["name"]."</td>
                                <td>".$d["surname"]."</td>
                                <td>".$d["department"]."</td>";
                            if($d["department"] == "Bilgisayar Programcılığı")
                            {
                                $student_number = $d["std_number"];
                                echo "<td><a class='btn btn-warning' href='save_student.php?save_data=$student_number'>Ders kaydı yap</a></td>";
                            }
                            else
                            {
                                echo "<td><a class='btn btn-warning disabled' href='#'>Ders kaydı yap</a></td>";
                                
                            }
                            echo "</tr>";
                            
                        }
                        
                    ?>
                    
                </table>
    </div>
</body>
</html>