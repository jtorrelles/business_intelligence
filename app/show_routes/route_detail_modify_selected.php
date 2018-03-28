<?php
require '../db/database_conn.php';
include '../header.html';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/show_routes_controller.js\"></script>";

if(isset($_GET['selectedid'])){
	echo "<script>findDetailData(".$_GET['selectedid'].");</script>";

	echo "<div style=\"display:none\" id=\"datadetailroute\">";
	echo "<form action=\"routes_detail_modify_selected_results.php\" method=\"POST\">";
	echo "<table>";
	echo "<tr><td colspan=2><h3>GENERAL DATA</h3></td></tr>";
	echo "<tr>
			<td><b>Route Detail ID:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='text' name='detid' class=\"detid\">This field cannot be modified</td>
		</tr>";	
	echo "<tr>
			<td><b>Presentation Date:</b></td>
			<td><input type=\"date\" class=\"presentation_date\" name='presentation_date'></td>
		</tr>";	
	echo "<tr>
			<td><b>Holiday:</b></td>
			<td><input type='checkbox' class=\"holiday\" name='holiday'></td>
		</tr>";	
	echo "<tr>
			<td><b>Repeat:</b></td>
			<td><input type='checkbox' class=\"repeat\" name='repeat'></td>
		</tr>";
	echo "<tr>
			<td><b>Milleage:</b></td>
			<td><input type='number' name='mileage' class=\"mileage\" value=0.0 step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Booking Notes:</b></td>
			<td><textarea name='book_notes' class='book_notes' rows=4 cols=40></textarea></td>
		</tr>";
	echo "<tr>
			<td><b>Production Notes:</b></td>
			<td><textarea name='prod_notes' class='prod_notes' rows=4 cols=40></textarea></td>
		</tr>";
	echo "<tr>
			<td><b>Time Zone:</b></td>
			<td><input type='text' name='time_zone' class=\"time_zone\"></td>
		</tr>";
	echo "<tr>
			<td><b>Show Times:</b></td>
			<td><textarea name='show_times' class='show_times' rows=4 cols=40></textarea></td>
		</tr>";		
	echo "<tr>
			<td><b>Number of Performaces:</b></td>
			<td><input type='number' name='perf' class=\"perf\" value=0 ></td>
		</tr>";
	echo "<tr>
			<td><b>Capacity:</b></td>
			<td><input type='number' name='capacity' class=\"capacity\" value=0 ></td>
		</tr>";
	echo "<tr>
			<td><b>Fixed Guarantee:</b></td>
			<td><input type='number' name='fixed_gntee' class=\"fixed_gntee\" value=0.0 step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Royalty:</b></td>
			<td><input type='number' name='royalty' class=\"royalty\" value=0.0 step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>BackEnd:</b></td>
			<td><input type='number' class=\"backend\" name='backend' value=0.0 step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Breakeven:</b></td>
			<td><input type='number' name='breakeven' class=\"breakeven\" value=0.0 step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Deal Notes:</b></td>
			<td><textarea name='deal_notes' class='deal_notes' rows=4 cols=40></textarea></td>
		</tr>";
	echo "<tr>
			<td><b>Estimated Royalty:</b></td>
			<td><input type='number' name='est_royalty' class=\"est_royalty\" value=0.0 step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>On Sub:</b></td>
			<td><input type='checkbox' name='on_sub' class=\"on_sub\"></td>
		</tr>";
	echo "<tr>
			<td><b>Date Confirmed:</b></td>
			<td><input type='checkbox' name='date_conf' class=\"date_conf\"></td>
		</tr>";
	echo "<tr>
			<td><b>Offer:</b></td>
			<td><input type='checkbox' name='offer' class=\"offer\"></td>
		</tr>";
	echo "<tr>
			<td><b>Price Scales:</b></td>
			<td><input type='checkbox' name='price_scales' class=\"price_scales\"></td>
		</tr>";
	echo "<tr>
			<td><b>Expenses:</b></td>
			<td><input type='checkbox' name='expenses' class=\"expenses\"></td>
		</tr>";
	echo "<tr>
			<td><b>Deal Nemo:</b></td>
			<td><input type='checkbox' name='deal_nemo' class=\"deal_nemo\"></td>
		</tr>";
	echo "<tr>
			<td><b>Contract:</b></td>
			<td><input type='checkbox' name='contract' class=\"contract\"></td>
		</tr>";
	echo "</table>";
	echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
	echo "</form>";
	echo "</div>";		
}
else {
  echo "failed";
}

$conn->close();
include '../footer.html';
?>