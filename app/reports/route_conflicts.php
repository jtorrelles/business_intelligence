<?php
include '../session.php';
include '../header.html'; 

echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/reports_controller.js\"></script>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/style.css\">";
$inid = '07/01/2018';
$endd = '07/31/2018';
echo "<script> getRoutesConf('$inid','$endd') </script>";

echo "<h1>Route Conflicts Report:</h1>";

echo "<div class=\"loader\" id=\"loader\"></div>";
echo "<div style=\"display:none\" class=\"export\" id=\"export\">";
echo "<form method=\"POST\">";
echo "<input type=\"image\" name=\"excel\" src=\"../images/excel.png\" width=30 onclick=this.form.action=\"\">";
echo "<input type=\"image\" name=\"pdf\" src=\"../images/pdf.png\" width=30 onclick=this.form.action=\"\"></p>";
echo "</div>";

echo "<table id=\"tablecss\">";
echo "<thead id=\"header\">";
echo "</thead>";
echo "<tbody id=\"body\">";
echo "</tbody>";
echo "</table>";

echo "<input type='hidden' class=\"codhtml\" name=codhtml>";

echo "</form>";

include '../footer.html';
?>

