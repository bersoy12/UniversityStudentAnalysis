<!DOCTYPE html>
<html>
<body>
<h2>Birinci Tercih ile Yerleşilen Bölümler ve Yerleşen Sayıları</h2>
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

$sql = "SELECT bu.uni_adi,bu.program_adi,yerlesen_sayisi FROM kacinci_tercih kt
		LEFT JOIN (SELECT uni_adi,program_adi,program_id FROM bolumler b
           			LEFT JOIN universiteler u ON u.uni_id=b.uni_id ) bu ON bu.program_id=kt.program_id
		WHERE tercih_sirasi=1 AND LOWER(bu.program_adi) NOT LIKE '%açıköğretim%'
		ORDER BY 1 ASC,3 DESC,2 ASC";

$result = mysqli_query($conn,$sql) or die("Error");

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	echo "<table border='1'>";
	echo "<tr><th>Üniversite Adı</th><th>Program Adı</th><th>1.Tercihi ile Yerleşen Sayısı</th></tr>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row[0]. "</td><td>" . $row[1]. "</td>"."<td>" . $row[2]. "</td>";
        echo "</tr>";
    }
	echo "</table>";
}
mysqli_close($conn);
?>