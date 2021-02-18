<!DOCTYPE html>
<html>
<body>
<h2>Hangi İller Ne Kadar Eğitim Göçü Verdi?</h2>
</div>
<style type ="text/css" >
		.footer{ 
			position: fixed;     
			text-align: center;    
			bottom: 0px; 
			width: 100%;
		}  
	 </style>
	 <div class="footer">Berkay Ersoy YÖK-Atlas</div>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "berkay_ersoy";

$conn = mysqli_connect($servername, $username, $password, $dbname);			// Create connection

if (!$conn) {																// Check connection
    die("Connection failed: " . mysqli_connect_error());
} 

$sql = "SELECT gise.sehir_adi,SUM(yerlesen_sayisi) 
		FROM bolumler b
		LEFT JOIN (SELECT program_id,yerlesen_sayisi,se.sehir_adi FROM geldikleri_iller gi 
		   			RIGHT JOIN sehirler se ON gi.sehir_id=se.sehir_id) gise ON gise.program_id=b.program_id
   		RIGHT JOIN (SELECT s.sehir_adi,uni_adi,uni_id,s.sehir_id FROM universiteler uni
					LEFT JOIN sehirler s ON s.sehir_id=uni.sehir_id) us ON us.uni_id=b.uni_id
		WHERE LOWER(gise.sehir_adi)!=LOWER(us.sehir_adi)
		GROUP BY 1
		ORDER BY 2 DESC;";

$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0) {											// output data of each row
	echo "<table border='1'>";
	echo "<tr><td>Şehir Adı</td><td>Farklı İllere Yerleşen Sayısı</td></tr>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row[0]. "</td><td>" . $row[1]. "</td>";
        echo "</tr>";
    }
	echo "</table>";
}
mysqli_close($conn);
?>