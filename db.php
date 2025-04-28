





<?php
    try {
        $db = new PDO("sqlite:myTestDB.db");
        //echo "<div class='mt-5 alert alert-success'>Veritabanı bağlantısı başarılı.</div><br>";	
    } catch (PDOException $th) {
        echo "Bağlantı başarısız".$th->getMessage();
    }
    

?>
