


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
        session_start();
        ini_set('display_errors',1);
        error_reporting(E_ALL);
        $dept_data = $db->query("SELECT (name) FROM Department");
        $errors = $_SESSION["errors"] ?? [];
        unset($_SESSION["errors"]);
    ?>
    <div class="container mt-5">
        <form style="width: 50%;" action="example.php" method="POST">
            <div class="mb-3">
                <label for="s_number">Öğrenci Numarası</label>
                <input class="form-control" type="text" name="s_number">
                <?php
                    if(isset($errors["std_number"]))
                    {
                        echo "<div class='alert alert-danger mt-2'>".$errors["std_number"]."</div>";
                        
                    }
                ?>
            </div>
            <div class="mb-3">
                <label for="s_name">Öğrenci adı</label>
                <input class="form-control" type="text" name="s_name">
                <?php
                    if(isset($errors["std_name"]))
                    {
                        echo "<div class='alert alert-danger mt-2'>".$errors["std_name"]."</div>";
                    }
                ?>
            </div>
            
            <div class="mb-3">
                <label for="s_surname">Öğrenci soyadı</label>
                <input class="form-control" name="s_surname" type="text">
                <?php
                    if(isset($errors["std_surname"]))
                    {
                        echo "<div class='alert alert-danger mt-2'>".$errors["std_surname"]."</div>";
                    }
                ?>
            </div>

            <div class="mb-3">
                <label for="s_email">Email adresi</label>
                <input class="form-control" type="text" name="s_email">
            </div>


            <div class="mb-3">
                <label for="s_department">Öğrencinin bölümü</label>
                <select name="s_department" id="">
                    <?php
                        foreach($dept_data as $dd)
                        {
                            $dept_name = $dd["name"];
                            echo "<option value = '$dept_name'>$dept_name</option>";
                        }
                    ?>
                    
                </select>
            </div>
            <div class="mb-3">
                <label for="s_is_active">Aktif mi ?</label>
                <input class="form-check" name="is_active" type="checkbox">
            </div>
            <button class="btn btn-success" type="submit">Kaydet</button>
        </form>
    </div>
</body>
</html>

