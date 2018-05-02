<?php
include '../session.php';
include '../header.html'; 

echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/reports_controller.js\"></script>";
echo "<script> getShows() </script>";

echo "<h1>EJEMPLO REPORTES EN PHP:</h1>";

echo "<form action=\"show_routes_all.php\" method=\"POST\">";

echo "<table border='2' bgcolor='#FFFFFF'>";
echo "<thead>";
echo "<tr>
		<th>SHOWID</th>
		<th>SHOWNAME</th>
		<th>STATUS</th>
		<th>CATEGORY1</th>	
	 </tr>";
echo "</thead>";
echo "<tbody id=\"contenido\">";
echo "</tbody>";
echo "</table>";

echo "</form>";


$conn->close();
include '../footer.html';
?>

