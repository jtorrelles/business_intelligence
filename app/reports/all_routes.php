<?php
include '../session.php';
include '../header.html'; 

echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/reports_controller.js\"></script>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/style.css\">";
$init_date = '05/01/2018';
$end_date = '05/31/2018';
echo "<script> getAllRoutes('$init_date','$end_date') </script>";

echo "<h1>All Routes Report:</h1>";

echo "<div class=\"loader\" id=\"loader\"></div>";
echo "<div style=\"display:none\" class=\"export\" id=\"export\">";
echo "<a href='all_routes_excel.php'><img src='../images/excel.png' width='30' height='25'/></a>";
echo "<a href='all_routes_pdf.php'><img src='../images/pdf.png' width='30' height='25'/></a>";
echo "</div>";

echo "<form>";

echo "<table id=\"allroutestable\">";
echo "<thead id=\"header\">";
echo "</thead>";
echo "<tbody id=\"body\">";
echo "</tbody>";
echo "</table>";

echo "</form>";

include '../footer.html';
?>

