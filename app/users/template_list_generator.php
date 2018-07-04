<?php
require "../db/database_conn.php";
include "../session.php";
include "access_control.php";
include "../header.html";

$sql_shows = "SELECT ShowNAME, ShowID 
			   FROM shows
			   WHERE ShowACTIVE = 'Y'
			   ORDER BY ShowNAME ASC";
$result_shows = $conn->query($sql_shows);
if ($result_shows->num_rows > 0) {
	$html_shows = "<table>
			<tr><th>SHOWS TAB</th></tr>";
			while($row_shows = $result_shows->fetch_assoc()) {
				$html_shows .= "<tr><td>".$row_shows['ShowNAME']."//".$row_shows['ShowID']."</td></tr>";
			}
	$html_shows .= "</table>";
}

$sql_cities = "SELECT cities.name, venues.VenueCITYID, states.shortname
			   FROM venues
			   INNER JOIN cities ON cities.id = venues.VenueCITYID
			   INNER JOIN states ON states.id = cities.state_id
			   WHERE venues.VenueACTIVE = 'Y'
			   GROUP BY cities.name
			   ORDER BY states.shortname ASC, cities.name ASC";
$result_cities = $conn->query($sql_cities);
if ($result_cities->num_rows > 0) {
	$html_cities = "<table>
			<tr><th colspan=2>CITIES WITH CODES TAB</th></tr>";
			while($row_cities = $result_cities->fetch_assoc()) {
				$html_cities .= "<tr><td>".strtoupper($row_cities['name']).", ".strtoupper($row_cities['shortname'])."</td><td>".$row_cities['name']."//".$row_cities['VenueCITYID']."</td></tr>";
			}
	$html_cities .= "</table>";
}

$sql_venues = "SELECT venues.VenueNAME, venues.VenueID, cities.name, states.shortname 
			   FROM venues
			   INNER JOIN cities ON cities.id = venues.VenueCITYID
			   INNER JOIN states ON states.id = cities.state_id
			   WHERE venues.VenueACTIVE = 'Y'
			   ORDER BY states.shortname ASC, cities.name ASC, venues.VenueNAME ASC";
$result_venues = $conn->query($sql_venues);
if ($result_venues->num_rows > 0) {
	$html_venues = "<table>
			<tr><th colspan=2>VENUES WITH CODES TAB</th></tr>";
			while($row_venues = $result_venues->fetch_assoc()) {
				$html_venues .= "<tr><td>".str_replace(" ","_",$row_venues['name'])."_".$row_venues['shortname']."</td><td>".$row_venues['VenueNAME']."//".$row_venues['VenueID']."</td></tr>";
			}
	$html_venues .= "</table>";
}

$sql_presenters = "SELECT PresenterNAME, PresenterID 
			   FROM presenters
			   WHERE PresenterACTIVE = 'Y'
			   ORDER BY PresenterNAME ASC";
$result_presenters = $conn->query($sql_presenters);
if ($result_presenters->num_rows > 0) {
	$html_presenters = "<table>
			<tr><th>PRESENTERS TAB</th></tr>";
			while($row_presenters = $result_presenters->fetch_assoc()) {
				$html_presenters .= "<tr><td>".$row_presenters['PresenterNAME']."//".$row_presenters['PresenterID']."</td></tr>";
			}
	$html_presenters .= "</table>";
}

echo "
<head>
<style>
table {
    border-collapse: collapse;
	border: 1px solid black;
}

th, td {
    text-align: left;
    padding: 4px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: darkblue;
    color: white;
}
</style>
</head>
<body>
<h1>ROUTE TEMPLATE DATA</h1>
<p>Use this data to populate the Route Excel Spreadsheet. In case of doubt please contact Connect IT for support.</p>
<div id='wrapper'>
	<div id='shows' style='float:left; margin-right:25px;'>".$html_shows."</div>
	<div id='presenters' style='float:left; margin-right:25px;'>".$html_presenters."</div>
	<div id='cities' style='float:left; margin-right:25px;'>".$html_cities."</div>
	<div id='venues'>".$html_venues."</div>
</div>
</body>
";
include "../footer.html";
?>