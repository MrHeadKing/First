


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
        
        if(isset($_GET["save_data"]))
        {
            $_SESSION["student_number"] = $_GET["save_data"];
        }

        if(isset($_SESSION["student_number"]))
        {
            $std_num = $_SESSION["student_number"];
            $sql = "SELECT * FROM Students WHERE std_number = '$std_num';";  
        }
        $data = $db->query($sql);
        $first_row = $data->fetch(PDO::FETCH_ASSOC);
        $lessons = $db->query("SELECT * FROM Lessons")->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container mt-5">
        <?php
    
            $data_name = $first_row["name"];
            $data_std_num = $first_row["std_number"];
            
            echo "<h5>".$data_std_num."</h5>";
            echo "<h5>$data_name adlı öğrencinin yapılan ders kayıtları</h5>";
    
            $join_sql = "SELECT Students.name,Lessons.lesson_code,Lessons.AKTS,Lessons.title FROM Students
            JOIN Student_Lesson ON Students.std_number = Student_Lesson.student_id
            JOIN Lessons ON Student_Lesson.lesson_id = Lessons.lesson_code
            WHERE std_number = '$std_num';"; 
    
            $joined_data = $db->query($join_sql)->fetchAll(PDO::FETCH_ASSOC);
                

            

            
        ?>
    
            <?php

                $count = 0;
                foreach($joined_data as $jd)
                {
                    if($jd["title"] != NULL)
                    {
                        $count ++;
                    }
                }
                             
                /*
                    Kesişim tablosundan kayıt silme sorgusu

                    DELETE FROM Student_Lesson
                    WHERE student_id = '242318093' AND lesson_id = '242318030';

                */
                
                if($count > 0)
                {
                    
                    echo "<table class='table table-bordered' border='4'>";
                    echo "<thead>
                    <th>Ders adı</th>
                    <th>İşlem</th>
                    </thead>";
                    
                    $akts_count = 0;
                    foreach($joined_data as $jd)
                    {
                        $akts_count += $jd["AKTS"];
                        $lesson_name = $jd["title"];
                        $join_lesson_code = $jd["lesson_code"];
                        
                        echo "<tr>
                        <td>
                        $lesson_name
                        </td>
                        
                        <td>
                        <a class='btn btn-danger disabled' href='save_student.php?remove_lesson=$join_lesson_code'>Kayıtlı dersi kaldır</a>
                        
                        </td>
                        </tr>";
                                                
                    }
                    $remove_this = $_GET["remove_lesson"] ?? '';
                    echo "</table>";

                    
                
                    echo "$akts_count/30 AKTS";
                    
                }
                else
                {
                    echo "<div class='alert alert-warning'>Bu öğrencinin kayıtlı dersi yok. Ders kaydı yapmak için aşağıdaki tablodan ders seçiniz</div>";
                }
                
            ?>
           

        <br>
        <h4 class="mt-4">Açılan bölüm dersleri</h4>
        <table class="table table-bordered" border="4">
            <thead>
                <th>Ders kodu</th>
                <th>Ders Başlığı</th>
                <th>Kredi</th>
                <th>AKTS</th>
                <th>Tür</th>
            </thead>
            <?php
                        foreach($lessons as $l)
                        {
                            $lesson_code   =  $l["lesson_code"];
                            $lesson_title  =  $l["title"];
                            $lesson_credit =  $l["credit"];
                            $lesson_akts   =  $l["AKTS"];
                            $lesson_type   =  $l["Type"];
                            echo "<tr>
                            <td>$lesson_code</td>
                            <td>$lesson_title</td>
                            <td>$lesson_credit</td>
                            <td>$lesson_akts</td>
                            <td>$lesson_type</td>
                            <td>
                                <a href='save_student.php?choose_lesson=$lesson_code' class='btn btn-primary'>Seç</a>
                            </td>
                            </tr>";
                            
                        }
                        
                        $std_number = $first_row["std_number"] ?? '';
                        $choosed_data =  $_GET["choose_lesson"] ?? '';
                        echo "Öğrenci no: ".$std_number."<br>";
                        echo "Kaydı yapılacak dersin kodu: ".$choosed_data."<br>";

                        if($choosed_data != '' and $akts_count < 30)
                        {

                            $db->exec("INSERT INTO Student_Lesson VALUES('$std_number','$choosed_data');");
                            
                        }
                        else
                        {
                            echo "<div class='alert alert-danger'>En fazla 30 AKTS alabilirsiniz.</div>";
                        }
                        
                        
                        
                        
                    
                
            ?>
            
            
        </table>
        
    </div>
</body>
</html>