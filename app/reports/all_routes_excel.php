<?php

require '../db/database_conn.php';

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_Tabla_Shows.xls");

echo "<table width='100%' border='1' cellspacing='0' cellpadding='0'>";
echo "<tr><td colspan='6' bgcolor='skyblue'><CENTER><strong>REPORTE DE LA TABLA SHOWS</strong></CENTER></td></tr>";
echo "<tr bgcolor='red'>";
echo "<td><strong>SHOWID</strong></td>";
echo "<td><strong>SHOWNAME</strong></td>";
echo "<td><strong>CATEGORY1</strong></td>";
echo "<td><strong>CATEGORY2</strong></td>";
echo "<td><strong>WEEKLY NUTS</strong></td>";
echo "<td><strong>NUMBER OF TRUCKS</strong></td>";
echo "</tr>";
  
$sql = "SELECT showid,
               showname,
               c1.categoryname as cat1,
               c2.categoryname as cat2,
               showweekly_nut,
               shownumber_of_trucks 
        FROM shows sh,
        	 category c1,
        	 category c2
       WHERE sh.categoryid_1 = c1.categoryid
         AND sh.categoryid_2 = c2.categoryid";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {    
	echo "<tr>";
	echo "<td>".$row["showid"]."</td>";
	echo "<td>".$row["showname"]."</td>";
	echo "<td>".$row["cat1"]."</td>";
	echo "<td>".$row["cat2"]."</td>";
	echo "<td>".$row["showweekly_nut"]."</td>";
	echo "<td>".$row["shownumber_of_trucks"]."</td>";
}

echo "</table>";
?>

