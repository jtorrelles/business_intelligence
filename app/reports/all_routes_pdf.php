<?php

require '../db/database_conn.php';
require '../libs/dompdf/dompdf_config.inc.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$codHtml='
<table width="100%" border="1" cellspacing="0" cellpadding="0">
	<tr><td colspan="6" bgcolor="skyblue"><CENTER><strong>REPORTE DE LA TABLA SHOWS</strong></CENTER></td></tr>
  	<tr bgcolor="red">
	    <td><strong>SHOWID</strong></td>
	    <td><strong>SHOWNAME</strong></td>
	    <td><strong>CATEGORY1</strong></td>
	    <td><strong>CATEGORY2</strong></td>
	    <td><strong>WEEKLY NUTS</strong></td>
	    <td><strong>NUMBER OF TRUCKS</strong></td>	    
  	</tr>';

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
$codHtml.='	
	<tr>
		<td>'.$row['showid'].'</td>
		<td>'.$row['showname'].'</td>	
		<td>'.$row['cat1'].'</td>
		<td>'.$row['cat2'].'</td>
		<td>'.$row['showweekly_nut'].'</td>	
		<td>'.$row['shownumber_of_trucks'].'</td>							
	</tr>';	
}

$codHtml.='</table>';
$codHtml=utf8_encode($codHtml);
$dompdf=new DOMPDF();
$dompdf->load_html($codHtml);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("Reporte_tabla_shows.pdf");
?>