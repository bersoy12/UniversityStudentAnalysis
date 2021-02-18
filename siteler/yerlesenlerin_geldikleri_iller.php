<!DOCTYPE html>
<html>
<body>
<h2>Hangi İlden Kaç Öğrenci Üniversite Kazandı?</h2>
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

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 

$sql = "SELECT sehir_adi,COUNT(yerlesen_sayisi)
		FROM geldikleri_iller gi
		RIGHT JOIN sehirler s ON s.sehir_id=gi.sehir_id
		GROUP BY sehir_adi
		ORDER BY 2 DESC;";

$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0) {
	echo "<table border='1'>";
	echo "<tr><td>Şehir Adı</td><td>Toplam Yerleşen Sayısı</td></tr>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row[0]. "</td><td>" . $row[1]. "</td>";
        echo "</tr>";
    }
	echo "</table>";
}
mysqli_close($conn);
?>