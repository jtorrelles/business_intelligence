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
<script src="../js/jquery.stickytable.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="../js/multiple/multiple-select.css">
<link rel="stylesheet" href="../css/jquery.stickytable.min.css">
<script> getAllCountries();</script>

<h1>Route Conflicts Report:</h1>

<form action="#" method="POST">
	<table style="width:100%">
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>			
			<th>ACTIONS</th>
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
				<input type="button" class="button" id="btnFindConflictsRoutes" value="Find">
				<input type="button" class="button" id="btnCleanConflictsRoutes" value="Clear">
			</td>
		</tr>
		<tr>
			<td>
				<b>Init Date <font color=red>*</font>:</b>
			</td>		
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
				<b>Conflict Criteria:</b>
			</td>
			<td>
				<select name="conflict_reasons" class="reasons" id="reasonId">
					<option value="0">--Select--</option>
					<option value="DOUBLE HOLD">DOUBLE HOLD</option>
					<option value="OVERLAPPING MARKET HOLD">OVERLAPPING MARKET HOLD</option>
					<option value="PROXIMITY BOOKING">PROXIMITY BOOKING</option>
					<option value="BACK TO BACK BOOKING">BACK TO BACK BOOKING</option>
					<option value="BACK TO BACK TO BACK">BACK TO BACK TO BACK</option>					
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
			<input type="image" name="excel" src="../images/excel.png" width=30 onclick=this.form.action="export_excel.php">
			<input type="image" name="pdf" src="../images/pdf.png" width=30 onclick=this.form.action="export_pdf.php">
			</p>
			<div class="sticky-table" style="overflow-x:hidden;">
			<table id="allroutestable" style="width: 100%;">
				<thead id="header">
				</thead>
				<tbody id="body">
				</tbody>
			</table>
			</div>
			<input type='hidden' class="htmlpdf" name=htmlpdf>
			<input type='hidden' class="htmlexc" name=htmlexc>
			<input type='hidden' class="name" name=name value="Route_conflicts">
		</form>
	</div>
</body>
</html>
<?php
	$conn->close();
	include '../footer.html';
?> 
