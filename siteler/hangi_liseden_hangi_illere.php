<!DOCTYPE html>
<html>
<body>
<h2>Hangi Liseden Hangi İllere Yerleşildi?</h2>
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

$sql = "SELECT lise_adi,sehir_adi,SUM((yeni_mezun+onceki_donem)) FROM bolumler b 
		LEFT JOIN (SELECT uni_id,sehir_adi FROM universiteler u
					LEFT JOIN (select sehir_adi,sehir_id FROM sehirler) s ON s.sehir_id=u.sehir_id) us ON us.uni_id=b.uni_id
		RIGHT JOIN geldikleri_liseler gl ON gl.program_id=b.program_id
		GROUP BY 1,2
		ORDER BY 3 DESC;";

$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0) {
	echo "<table border='1'>";
	echo "<tr><td>Lise Adı</td><td>Üniversitenin Bulunduğu Şehir</td><td>Toplam Yerleşen Sayısı</td></tr>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row[0]. "</td><td>" . $row[1]. "</td><td>" . $row[2]. "</td>";
        echo "</tr>";
    }
	echo "</table>";
}
mysqli_close($conn);
?>