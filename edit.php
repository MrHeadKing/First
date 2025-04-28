
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
        $edit_data_number = $_GET["my_edit"];
        $_SESSION["update_this"] = $edit_data_number;
        $data = $db->query("SELECT * FROM Students WHERE std_number = '$edit_data_number';");
        $first_row = $data->fetch(PDO::FETCH_ASSOC);
        
    ?>
    <div style="margin:auto;" class="container mt-5">
            
            <form style="width: 50%;" action="edit.php" method="POST">
                
                <div class="mb-3">
                    <label class="form-label" for="s_name">Öğrenci adı</label>
                    <input value="<?= $first_row["name"] ?>" class="form-control" type="text" name="s_name">
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="s_surname">Öğrenci soyadı</label>
                    <input value="<?= $first_row["surname"] ?>" class="form-control" name="s_surname" type="text">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="s_email">Email adresi</label>
                    <input value="<?= $first_row["email"] ?>" class="form-control" type="text" name="s_email">
                </div>


                <div class="mb-3">
                    <label class="form-label" for="s_department">Öğrencinin bölümü</label>
                    <select name="s_department" id="">
                        
                        <option <?= $first_row["department"] == "Bilgisayar Programcılığı" ? "selected":"" ?> value="Bilgisayar Programcılığı">Bilgisayar Programcılığı</option>
                        <option <?= $first_row["department"] == "Elektrik" ? "selected":"" ?> value="Elektrik">Elektrik</option>
                        <option <?= $first_row["department"] == "Aşçılık" ? "selected":"" ?> value="Aşçılık">Aşçılık</option>
                        <option <?= $first_row["department"] == "Arkeoloji" ? "selected":"" ?> value="Arkeoloji">Arkeoloji</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="s_is_active">Aktif mi ?</label>
                    <input <?php if($first_row["is_active"]) echo "checked"; ?> class="form-check" name="s_is_active" type="checkbox">
                </div>
                <button class="btn btn-success" type="submit">Güncelle</button>
            </form>

            <?php
                session_start();
                if(isset($edit_data_number))
                {
                    
                    $_SESSION["update_this"] = $edit_data_number;
                }



                
                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $name = $_POST["s_name"];
                    $surname = $_POST["s_surname"];
                    $email = $_POST["s_email"];
                    $department = $_POST["s_department"];
                    $is_active = $_POST["s_is_active"];

                    if($is_active == "on")
					{
						$is_active = true;
					}
					else
					{
						$is_active = 0;
						
					}
                    $session_data = $_SESSION["update_this"];
                    $db->exec("UPDATE Students SET name = '$name',surname='$surname',
                    email='$email',department='$department',is_active=$is_active
                    WHERE std_number = '$session_data';");
                    header("Location:example.php");
                    
                }
                
            ?>
    </div>
</body>
</html>