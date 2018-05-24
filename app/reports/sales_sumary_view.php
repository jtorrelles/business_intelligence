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
<script> getCountries(); getShows(); </script>

<h1>Sales Summary Report:</h1>

<form action="#" method="POST">
	<table style="width:100%">
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
			<td>
				<b>Country:</b>
			</td>
			<td>
				<select name="country" class="countries" id="countryId">
					<option value="">Select Country</option>
				</select>
			</td>
			<td>
				<b>State:</b>
			</td>
			<td>
				<select name="state" class="states" id="stateId">
					<option value="">Select State</option>
				</select>
			</td>
			<td>
				<b>City:</b>
			</td>			
			<td>
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
			<td>
				<b>Init Date <font color=red>*</font>:</b>
			</td >
			<td>
				<input type="date" class="dateini" name="dateini">
			</td>
			<td>
				<b>End Date <font color=red>*</font>:</b>
			</td>
			<td>
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
			<td>
				<b>Shows:</b>
			</td>
			<td>
				<select name="shows[]" multiple="multiple" id="shows">
					<option value="0">Select Shows</option>
				</select>
			</td>
			<td>
				<b>Fields:</b>
			</td>
			<td>
				<select name="fields[]" multiple="multiple" id="fields">
					<option value="1"> SUBS VS. GROSS % </option>
					<option value="2"> SUBS VS. GROSS POTENTIAL % </option>
					<option value="3"> GROUPS VS. GROSS % </option>
					<option value="4"> GROUPS VS. GROSS POTENTIAL % </option>
					<option value="5"> SINGLE VS. GROSS % </option>
					<option value="6"> SINGLE VS. GROSS POTENTIAL % </option>
					<option value="7"> ADVERTISING VS. SINGLES % </option>
				</select>
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
			<input type="image" name="excel" src="../images/excel.png" width=30 onclick=this.form.action="export_excel.php">
			<input type="image" name="pdf" src="../images/pdf.png" width=30 onclick=this.form.action="export_pdf.php">
			</p>
			<table id="allroutestable">
				<thead id="header">
				</thead>
				<tbody id="body">
				</tbody>
			</table>
			<input type='hidden' class="htmlpdf" name=htmlpdf>
			<input type='hidden' class="htmlexc" name=htmlexc>
			<input type='hidden' class="name" name=name value="Sales_summary">
		</form>
	</div>
</body>
</html>
<?php
	$conn->close();
	include '../footer.html';
?> 
