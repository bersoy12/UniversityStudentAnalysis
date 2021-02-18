<!DOCTYPE html>
<html>
<body>
<h2>Herhangi Bir Üniversitenin Herhangi Bir Bölümüne İl İl Toplam Yerleşen Sayısı</h2>
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
	echo "<form action='bir_uniye_yerlesen_sayisi.php' method='post'>";
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

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 

$sql = "SELECT uni_adi,sehir_adi,sum(yerlesen_sayisi)
		FROM geldikleri_iller gi
		LEFT JOIN (SELECT program_id,u.uni_adi
					FROM universiteler u
					RIGHT JOIN (SELECT * FROM bolumler) b ON u.uni_id=b.uni_id) ub ON gi.program_id=ub.program_id
		RIGHT JOIN sehirler s ON s.sehir_id=gi.sehir_id
		WHERE uni_adi='". $_POST['universiteAdi'] ."'
		GROUP BY 1,2
		ORDER BY 3 DESC;";

$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	echo "<table border='1'>";
	echo "<tr><th>Üniversite Adı</th><th>Geldiği Şehir</th><th>Yerleşen Sayısı</th></tr>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row["uni_adi"]. "</td><td>" . $row["sehir_adi"]. "</td>"."<td>" . $row[2]. "</td>";
        echo "</tr>";
    }
	echo "</table>";
}
mysqli_close($conn);
?>