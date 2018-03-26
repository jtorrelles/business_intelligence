<?php
include 'session.php';
include 'header.html';

echo "<p>";
echo "<b>Full Tables:</b><br>";
echo "All Shows<br>";
echo "All Venues<br>";
echo "All Presenters<br>";
echo "All Categories<br>";
echo "</p>";

echo "<p>";
echo "<b>Reports:</b><br>";
echo "<a href='shows/shows_all.php'>Review Active Shows by Category</a><br>";
echo "<a href='venues/venues_all.php'>Review Active Venues by State</a><br>";
echo "<a href='presenters/presenters_all.php'>Review Active Presenters by State</a><br>";
echo "<a href='contracts/contracts_all.php'>Review Contracts by Active Shows - Includes Presenter's Name</a><br>";
echo "<a href='settlements/settlements_all.php'>Review Settlements by Show Name and State - Includes Averages</a><br>";
echo "<a href='show_routes/show_routes_all.php'>Review Routes by Show Name</a><br>";
echo "</p>";

echo "<p>";
echo "<b>Business Intelligence - Teaser:</b><br>";
echo "<a href='teaser.php'>Report: Average Gross Potential, Average Actual Gross and Average NAGBOR by Show and Year grouped by State</a><br>";
echo "</p>";

echo "<p>";
echo "<b>IMPORTANT</b><br>";
echo 
"This is a BETA Testing Interface, it is NOT the final product. This was only built with the purpose of checking the information stored in the database. 
Changes will not be made to this interface unless NETworks agrees to use this layout.<br>";
echo "</p>";

include 'footer.html';
?>