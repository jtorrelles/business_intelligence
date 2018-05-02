<?php
include '../session.php';
include '../header.html'; 

echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/reports_controller.js\"></script>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/style.css\">";
echo "<script> getShows() </script>";

echo "<h1>EJEMPLO REPORTES EN PHP:</h1>";

echo "<form>";

echo "<table id=\"tablecss\">";
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

include '../footer.html';
?>

