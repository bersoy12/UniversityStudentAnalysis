<!DOCTYPE html>
<html>
<body>
<h2>Yerleşenlerin İl Bazlı Analizi</h2>
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "berkay_ersoy";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 

$sql = "SELECT DISTINCT(uni_adi) FROM universiteler ";
$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	echo "<form action='yerlesenlerin_il_bazli_analizi.php' method='post'>";
	echo '<select name="universiteAdi">';
    while($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row["uni_adi"] . "'>";
        echo $row["uni_adi"];
		echo "</option>";
    }
	echo '</select>';
	echo '<input type="submit" value="Submit">';
	echo "</form>";
	echo "<br>";
}
mysqli_close($conn);
?>
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

$sql = "SELECT uni_adi,program_adi,gise.sehir_adi,yerlesen_sayisi FROM bolumler b
        LEFT JOIN (SELECT sehir_adi,yerlesen_sayisi,program_id FROM geldikleri_iller gi 
                    LEFT JOIN sehirler se ON gi.sehir_id=se.sehir_id) gise ON gise.program_id=b.program_id
        RIGHT JOIN (SELECT sehir_adi,uni_id,uni_adi FROM universiteler u 
                    LEFT JOIN sehirler s ON s.sehir_id=u.sehir_id) us ON us.uni_id=b.uni_id
		WHERE uni_adi='". $_POST['universiteAdi'] ."'
        ORDER BY 2 ASC,4 DESC;";

$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0) {
	echo "<table border='1'>";
	echo "<tr><td>Üniversite Adı</td><td>Program Adı</td><td>Yerleşenlerin Geldikleri İller</td><td>Yerleşen Sayısı</td></tr>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row[0]. "</td><td>" . $row[1]. "</td><td>" . $row[2]. "</td><td>" . $row[3]. "</td>";
        echo "</tr>";
    }
	echo "</table>";
}
mysqli_close($conn);
?>