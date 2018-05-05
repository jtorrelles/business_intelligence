<?php
include '../session.php';
include '../header.html'; 

echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/reports_controller.js\"></script>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/style.css\">";
$fecha_inicio = '05/01/2018';
$fecha_fin = '05/31/2018';
echo "<script> getAllRoutes('$fecha_inicio','$fecha_fin') </script>";

echo "<h1>All Routes Report:</h1>";

echo "<form>";

echo "<table id=\"tablecss\">";
echo "<thead id=\"header\">";
echo "</thead>";
echo "<tbody id=\"body\">";
echo "</tbody>";
echo "</table>";

echo "</form>";

include '../footer.html';
?>

