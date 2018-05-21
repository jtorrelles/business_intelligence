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
<script src="../js/multiple/multiple-select.js"></script>
<script src="../js/utility.js"></script>
<script src="../js/reports_controller.js"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="../js/multiple/multiple-select.css">
<script> getCountries(); getBasicShows(); </script>

<h1>Sales Sumary Report:</h1>

<form action="#" method="POST">
	<table style="width:100%">
		<col align="right">
		<col align="right">
		<col align="right">
		<col align="right">
		<col align="right">
		<col align="right">
		<col align="center">
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th>Actions</th>
		</tr>
		<tr>
			<td align="right">
				<b>Country:</b>
			</td>
			<td align="left">
				<select name="country" class="countries" id="countryId">
					<option value="">Select Country</option>
				</select>
			</td>
			<td align="right">
				<b>State:</b>
			</td>
			<td align="left">
				<select name="state" class="states" id="stateId">
					<option value="">Select State</option>
				</select>
			</td>
			<td align="right">
				<b>City:</b>
			</td>			
			<td align="left">
				<select name="city" class="cities" id="cityId">
					<option value="">Select City</option>
				</select>
			</td>
			<td align="center" rowspan="2">
				<input type="button" class="button" id="btnFindSalesSumary" value="Find">
				<input type="button" class="button" id="btnCleanSalesSumary" value="Clear">
			</td>
		</tr>
		<tr>
			<td align="right">
				<b>Init Date <font color=red>*</font>:</b>
			</td >
			<td align="left">
				<input type="date" class="dateini" name="dateini">
			</td>
			<td align="right">
				<b>End Date <font color=red>*</font>:</b>
			</td>
			<td align="left">
				<input type="date" class="dateend" name='dateend'>
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td align="right">
				<b>Shows:</b>
			</td>
			<td align="left">
				<select name="show"  class="shows" id="showId">
					<option value="0">Select Shows</option>
				</select>
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
	</table>
	<p><b><font color=red>*</font> Indicates a mandatory field</b></p>
</form>	
	<div style="display:none" class="loader" id="loader"></div>
	<div style="display:none" class="export" id="export">
		<form method="POST">
			<input type="image" name="excel" src="../images/excel.png" width=30 onclick=this.form.action="all_routes_excel.php">
			<input type="image" name="pdf" src="../images/pdf.png" width=30 onclick=this.form.action="all_routes_pdf.php">
			</p>
			<table id="salessumarytable">
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