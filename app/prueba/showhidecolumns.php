<?php
require '../db/database_conn.php';
include '../header.html';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "
    <p>Click on each Checkbox to hide corresponding Column</p>
    <div id=\"grpChkBox\">
        <p><input type=\"checkbox\" name=\"sid\" />Show ID</p>
        <p><input type=\"checkbox\" name=\"sname\" />Show Name</p>
		<p><input type=\"checkbox\" name=\"sage\" />Show Age</p>
		<p><input type=\"checkbox\" name=\"snut\" />Weekly Nut</p>
    </div>
";
	$shows_sql = "SELECT showid, showname, showage, showweekly_nut FROM shows WHERE showactive='Y'";
    $shows_result = $conn->query($shows_sql);
	if ($shows_result->num_rows > 0) {
		echo "<table id='someTable'>
				<tr>
					<th class='sid'>ID</th>
					<th class='sname'>NAME</th>
					<th class='sage'>SHOW AGE</th>
					<th class='snut'>WEEKLY NUT</th>
				</tr>";
		while($shows_row = $shows_result->fetch_assoc()) {
			echo "<tr>
					<td class='sid'>".$shows_row['showid']."</td>
					<td class='sname'>".$shows_row['showname']."</td>
					<td class='sage'>".$shows_row['showage']."</td>
					<td class='snut'>$ ".number_format($shows_row['showweekly_nut'],2)."</td>
				  </tr>";
		}
		echo "</table>";
	}
$conn->close();
include '../footer.html';
?> 
<head>
    <link href="CSS/table.css" rel="stylesheet" />
    <script src="scripts/jquery-1.11.1.min.js"></script>
    <script>
        $(function () {
            var $chk = $("#grpChkBox input:checkbox");
            var $tbl = $("#someTable");

            $chk.prop('checked', true);

            $chk.click(function () {
                var colToHide = $tbl.find("." + $(this).attr("name"));
                $(colToHide).toggle();
            });
        });
    </script>
</head>
