<?php
set_time_limit(0);
$conn = new mysqli('database-1.cznlkcpzyec0.us-east-2.rds.amazonaws.com', 'admin', 'password', '');
/*
$query     = '';
$sqlScript = file('berkay_ersoy.sql');
foreach ($sqlScript as $line) {
    $startWith = substr(trim($line), 0, 2);
    $endWith   = substr(trim($line), -1, 1);
    
    if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
        continue;
    }
    
    $query = $query . $line;
    if ($endWith == ';') {
        mysqli_query($conn, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query . '</b></div>');
        $query = '';
    }
}
echo '<div class="success-response sql-import-response">SQL file imported successfully.</div>';
*/
$con = mysqli_connect("database-1.cznlkcpzyec0.us-east-2.rds.amazonaws.com", "admin", "password", "dbpractice");

if ($con) {
    echo "bağlandı";
    $file   = "csv/sehirler.csv";
    $handle = fopen($file, "r");
    $i      = 0;
    while (($cont = fgetcsv($handle, 1000, ";")) !== false) {
        if ($i == 0) {
            $query = "TRUNCATE TABLE sehirler;";
            echo $query, "<br>";
            mysqli_query($con, $query);
        } else {
            $query = "INSERT INTO sehirler (sehir_id,sehir_adi) 
                        VALUES ('$cont[0]','$cont[1]');";
            //echo $query, "<br>";
            mysqli_query($con, $query);
        }
        $i++;
    }
    echo "sehirler bitti\n";
    
    $file   = "csv/universiteler.csv";
    $handle = fopen($file, "r");
    $i      = 0;
    while (($cont = fgetcsv($handle, 1000, ";")) !== false) {
        if ($i == 0) {
            $query = "TRUNCATE TABLE universiteler;";
            echo $query, "<br>";
            mysqli_query($con, $query);
        } else {
            $query = "INSERT INTO universiteler (uni_id,uni_adi,sehir_id) 
                        VALUES ('$cont[0]','$cont[1]','$cont[2]');";
            //echo $query, "<br>";
            mysqli_query($con, $query);
        }
        $i++;
    }
    echo "uniler bitti\n";
    
    $file   = "csv/bolumler.csv";
    $handle = fopen($file, "r");
    $i      = 0;
    while (($cont = fgetcsv($handle, 1000, ";")) !== false) {
        if ($i == 0) {
            $query = "TRUNCATE TABLE bolumler;";
            echo $query, "<br>";
            mysqli_query($con, $query);
        } else {
            $query = "INSERT INTO bolumler (program_id,program_adi,uni_id) 
                        VALUES ('$cont[0]','$cont[1]','$cont[2]');";
            //echo $query, "<br>";
            mysqli_query($con, $query);
        }
        $i++;
    }
    echo "bolumler bitti\n";

    $file   = "csv/genel_bilgiler.csv";
    $handle = fopen($file, "r");
    $i      = 0;
    while (($cont = fgetcsv($handle, 1000, ";")) !== false) {
        if ($i == 0) {
            $query = "TRUNCATE TABLE genel_bilgiler;";
            echo $query, "<br>";
            mysqli_query($con, $query);
        } else {
            $query = "INSERT INTO genel_bilgiler (program_id,fakulte_adi,puan_turu,burs_turu,genel_kontenjan,okul_birincisi_kontenjani,toplam_kontenjan,genel_kontenjana_yerlesen,okul_birincisi_kontenjanina_yerlesen,toplam_yerlesen,bos_kontenjan,ilk_yerlesme_orani,kayit_yaptirmayan,ek_yerlesen,ortalama_obp,ort_diploma_notu) 
                        VALUES ('$cont[0]','$cont[1]','$cont[2]','$cont[3]','$cont[4]','$cont[5]','$cont[6]','$cont[7]','$cont[8]','$cont[9]','$cont[10]','$cont[11]','$cont[12]','$cont[13]','$cont[14]','$cont[15]');";
            //echo $query, "<br>";
            mysqli_query($con, $query);
        }
        $i++;
    }
    echo "genel_bilgiler bitti\n";
    
    $file   = "csv/geldikleri_iller.csv";
    $handle = fopen($file, "r");
    $i      = 0;
    while (($cont = fgetcsv($handle, 1000, ";")) !== false) {
        if ($i == 0) {
            $query = "TRUNCATE TABLE geldikleri_iller;";
            echo $query, "<br>";
            mysqli_query($con, $query);
        } else {
            $query = "INSERT INTO geldikleri_iller (program_id,sehir_id,yerlesen_sayisi) 
                        VALUES ('$cont[0]','$cont[1]','$cont[2]');";
            //echo $query, "<br>";
            mysqli_query($con, $query);
        }
        $i++;
    }
    echo "geldikleri iller bitti\n";
    
    $file   = "csv/universite_tercihleri.csv";
    $handle = fopen($file, "r");
    $i      = 0;
    while (($cont = fgetcsv($handle, 1000, ";")) !== false) {
        if ($i == 0) {
            $query = "TRUNCATE TABLE universite_tercihleri;";
            echo $query, "<br>";
            mysqli_query($con, $query);
        } else {
            $query = "INSERT INTO universite_tercihleri (program_id,tercih_eden_sayisi) 
                        VALUES ('$cont[0]','$cont[1]');";
            //echo $query, "<br>";
            mysqli_query($con, $query);
        }
        $i++;
    }
    echo "uni_tercihleri bitti\n";
    
    $file   = "csv/kacinci_tercih.csv";
    $handle = fopen($file, "r");
    $i      = 1;
    while (($cont = fgetcsv($handle, 1000, ";")) !== false) {
        if ($i == 0) {
            $query = "TRUNCATE TABLE kacinci_tercih;";
            echo $query, "<br>";
            mysqli_query($con, $query);
        } else {
            $query = "INSERT INTO kacinci_tercih (program_id,tercih_sirasi,yerlesen_sayisi) 
                        VALUES ('$cont[0]','$cont[1]','$cont[2]');";
            //echo $query, "<br>";
            mysqli_query($con, $query);
        }
        $i++;
    }
    echo "kacinci_tercih bitti\n";

    $file   = "csv/geldikleri_liseler.csv";
    $handle = fopen($file, "r");
    $i      = 0;
    while (($cont = fgetcsv($handle, 1000, ";")) !== false) {
        if ($i == 0) {
            $query = "TRUNCATE TABLE geldikleri_liseler;";
            echo $query, "<br>";
            mysqli_query($con, $query);
        } else {
            $query = "INSERT INTO geldikleri_liseler (program_id,lise_adi,yeni_mezun,onceki_donem) 
                        VALUES ('$cont[0]','$cont[1]','$cont[2]','$cont[3]');";
            //echo $query, "<br>";
            mysqli_query($con, $query);
        }
        $i++;
    }

    echo "geldikleri_liseler bitti\n";
    echo "<br>" . "Done.";
} 
else {
    echo "Connection Failed.";
}
?>