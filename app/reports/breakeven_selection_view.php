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
<script src="../js/breakeven_controller.js"></script>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" media="screen" href="../js/multiple/multiple-select.css">
<script> getCountries(); getBasicShowsByStatus('Y'); getVenues();</script>

<h1>Breakeven Analysis Report:</h1>

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
				<input type="button" class="button" id="btnFindBreakevenSelection" value="Find">
				<input type="button" class="button" id="btnCleanBreakevenSelection" value="Clear">
				<input type="button" class="button" id="btnCleanBreakevenManual" value="Manually">
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
				<b>Shows:</b>
			</td>
			<td>
				<select name="show" class="shows" id="showId">
					<option value="">Select Show</option>
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
		<tr>
		<td>
				<b>Venues:</b>
			</td>
			<td>
				<select name="venues[]" multiple="multiple" id="venues">
					<option value="0">Select Venues</option>
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

<div class="results" id="results">
	<h3><font color=blue>Results of Breakeven Selection:</font></h3>
	<div class="settements_data" id="settements_data">
		<h3>Settlements:</h3>
		<table style="width:100%" class="tablecss">
			<tr>
				<th>Show Name</th>
				<th>Opening Date</th>
				<th>Closing Date</th>
				<th>City</th>
				<th>State</th>
				<th>Venue</th>			
				<th>OPTIONS</th>
			</tr>
			<tbody id="body_settlements">
				<tr>
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
					<td>
					</td>
					<td>
					</td>
				</tr>
			</tbody>
		</table>	
	</div>
	<div class="settements_nodata" id="settements_nodata">
		<h3>No Settlements Data:</font></h3>
	</div>
	<div class="contracts_data" id="contracts_data">
		<h3>Contracts:</h3>
		<table style="width:100%" class="tablecss">
			<tr>
				<th>Show Name</th>
				<th>Opening Date</th>
				<th>Closing Date</th>
				<th>City</th>
				<th>State</th>
				<th>Venue</th>			
				<th>OPTIONS</th>
			</tr>
			<tbody id="body_contracts">
				<tr>
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
					<td>
					</td>
					<td>
					</td>
				</tr>
			</tbody>
		</table>		
	</div>
	<div class="contracts_nodata" id="contracts_nodata">
		<h3>No Approved Deals & Terms Data:</font></h3>
	</div>
	<div class="routes_data" id="routes_data">
		<h3>Routes:</h3>
		<table style="width:100%" class="tablecss">
			<tr>
				<th>Show Name</th>
				<th>Opening Date</th>
				<th>Closing Date</th>
				<th>City</th>
				<th>State</th>
				<th>Venue</th>			
				<th>OPTIONS</th>
			</tr>
			<tbody id="body_routes">
				<tr>
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
					<td>
					</td>
					<td>
					</td>
				</tr>
			</tbody>
		</table>		
	</div>
	<div class="routes_nodata" id="routes_nodata">
		<h3>No Routes / Details Routes Data:</font></h3>
	</div>	
</div>

<div style="display:none" class="loader" id="loader"></div>
<div style="display:none" class="export" id="export">
	<form method="POST">
		<input type="image" name="excel" src="../images/excel.png" width=30 onclick=this.form.action="export_excel.php">
		<input type="image" name="pdf" src="../images/pdf.png" width=30 onclick=this.form.action="export_pdf.php">
		</p>
		<table id="allroutestable" style="width: 100%;">
			<thead id="header">
			</thead>
			<tbody id="body">
			</tbody>
		</table>
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
