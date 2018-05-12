<?php

include '../session.php';
include '../header.html';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<html>
<head>
<!-- 	<style>
		#settlements {
		    font-family: 'Trebuchet MS', Arial, Helvetica, 
		    sans-serif;font-size: 11px;
		    border-collapse: collapse;
		    width: 100%;
		}

		#settlements td, #customers th {
		    border: 1px solid #ddd;
		    padding: 8px;
		}

		#settlements tr:nth-child(even){background-color: #f2f2f2;}

		#settlements tr:hover {background-color: #ddd;}

		#settlements th {
			padding: 8px;
		    padding-top: 12px;
		    padding-bottom: 12px;
		    text-align: left;
		    background-color: #000066;
		    color: white;
		}
	</style> -->
</head>
<body>

<script src="../js/jquery.min.js"></script>
<script src="../js/utility.js"></script>
<script src="../js/reports_controller.js"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<script> getCountries(); </script>

<h1>Report All Routes:</h1>

<form action="#" method="POST">

	<table>
		<tr align="right">
			<td><b>Contry:</b></td>
			<td>
				<select name="country" class="countries" id="countryId">
					<option value="">Select Country</option>
				</select>
			</td>
			<td><b>State:</b></td>
			<td>
				<select name="state" class="states" id="stateId">
					<option value="">Select State</option>
				</select>
			</td>
			<td><b>City:</b></td>
			<td>
				<select name="city" class="cities" id="cityId">
					<option value="">Select City</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<b>Init Date:</b>
				<input type="date" class="dateini" name="dateini">
			</td>
			<td colspan="2">
				<b>End Date:</b>
				<input type="date" class="dateend" name='dateend'>
			</td>
		</tr>
		<tr>
			<td colspan="6" align="left">
				<input type="button" class="button" id="btnFindAllRoutes" value="Find">
				<input type="button" class="button" id="btnCleanAllRoutes" value="Clear">
			</td>
		</tr>
	</table>
</form>	
	<div style="display:none" class="loader" id="loader"></div>
	<div style="display:none" class="export" id="export">
		<form method="POST">
			<input type="image" name="excel" src="../images/excel.png" width=30 onclick=this.form.action="all_routes_excel.php">
			<input type="image" name="pdf" src="../images/pdf.png" width=30 onclick=this.form.action="all_routes_pdf.php">
			</p>
			<table id="allroutestable">
				<thead id="header">
				</thead>
				<tbody id="body">
				</tbody>
			</table>
			<input type='hidden' class="codhtml" name=codhtml>
		</form>
	</div>
</body>
</html>
<?php
	$conn->close();
	include '../footer.html';
?> 