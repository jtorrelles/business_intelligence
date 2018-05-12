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
</head>
<body>

<script src="../js/jquery.min.js"></script>
<script src="../js/utility.js"></script>
<script src="../js/reports_controller.js"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<script> getCountries(); </script>

<h1>Report All Routes:</h1>

<form action="#" method="POST">
	<table style="width:70%">
		<col align="right">
		<col align="right">
		<col align="right">
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th>Actions</th>
		</tr>
		<tr>
			<td align="right">
				<b>Contry:</b>
				<select name="country" class="countries" id="countryId">
					<option value="">Select Country</option>
				</select>
			</td>
			<td align="right">
				<b>State:</b>
				<select name="state" class="states" id="stateId">
					<option value="">Select State</option>
				</select>
			</td>
			<td align="right">
				<b>City:</b>
				<select name="city" class="cities" id="cityId">
					<option value="">Select City</option>
				</select>
			</td>
			<td align="right" rowspan="2">
				<input type="button" class="button" id="btnFindAllRoutes" value="Find">
				<input type="button" class="button" id="btnCleanAllRoutes" value="Clear">
			</td>
		</tr>
		<tr>
			<td align="right">
				<b>Init Date:</b>
				<input type="date" class="dateini" name="dateini">
			</td>
			<td align="right">
				<b>End Date:</b>
				<input type="date" class="dateend" name='dateend'>
			</td>
			<td align="right">

			</td>
			<td>
			</td>
		</tr>
	</table>
</form>	
	<div style="display:none" class="loader" id="loader"></div>
	<div style="display:none" class="export" id="export">
		<form method="POST">
			<input type="image" name="excel" src="../images/excel.png" width=30 onclick=this.form.action="export_excel.php">
			<input type="image" name="pdf" src="../images/pdf.png" width=30 onclick=this.form.action="export_pdf.php">
			</p>
			<table id="allroutestable">
				<thead id="header">
				</thead>
				<tbody id="body">
				</tbody>
			</table>
			<input type='hidden' class="codhtml" name=codhtml>
			<input type='hidden' class="name" name=name value="All_Routes">
		</form>
	</div>
</body>
</html>
<?php
	$conn->close();
	include '../footer.html';
?> 