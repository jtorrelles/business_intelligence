<?php 
include '../header.html';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/show_routes_controller.js\"></script>";
echo "<h1>Upload Route</h1>";
echo "<div id=\"route_uploadfile\">";
echo "<form id=\"fileUploadForm\" method=\"POST\" enctype=\"multipart/form-data\">";
	echo "<table>";
	echo "<tr><td><p>Select Spreadsheet (Route) to upload (XLS, XLSX, ODS and CVS only):</p></td></tr>";
	echo "<tr>";
		echo "<td><input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">";
	echo "</tr>";
	echo "</table>";
	echo "<p align=center><input type=\"button\" value=\"Upload Spreadsheet\" id=\"btnUpload\"></p>";
echo "</form>";
echo "</div>";
echo "<div style=\"display:none\" id=\"back_to_upload\">";
echo "<p><a href='#' id=\"btnBackUpload\">Return to Upload SpreadSheet</a></p><br>";
echo "</div>";
echo "<div style=\"display:none\" id=\"route_data\">";
echo "<form action=\"route_upload_add_results.php\" method=\"POST\">";
	echo "<table>";
		echo "<tr>
		<td><b>Show:</b></td>
		<td><input type='hidden' class=\"showtorouteid\" name='showtorouteid'>";		
		echo "<input type='text' style=\"background-color: lightgrey;\" readonly  size='50' class=\"showtoroute\" name='showtoroute'>
			</td>
		</tr>	
		<tr>
			<td><b>Number of Trucks:</b></td>
			<td><input type='number' class=\"numberoftrucks\" value=0 name='numberoftrucks'></td>
		</tr>		
		<tr>
			<td><b>Weekly NUT:</b></td>
			<td><input type='number' class=\"weeklynut\" value=0.0 name='weeklynut' step=0.01></td>
		</tr>
		<tr>
			<td><b>Date Of Route:</b></td>
			<td><input type=\"date\" class=\"date_route\" name='date_route'></td>
		</tr>";
		for($i = 0; $i < 364; $i++){
			$presentation_date = 'presentation_date' . $i;
			echo "<input type='hidden' class=\"$presentation_date\" name=$presentation_date>";
			$holiday = 'holiday' . $i;
			echo "<input type='hidden' class=\"$holiday\" name=$holiday>";
			$city = 'city' . $i;
			echo "<input type='hidden' class=\"$city\" name=$city>";
			$repeat = 'repeat' . $i;
			echo "<input type='hidden' class=\"$repeat\" name=$repeat>";
			$mileage = 'mileage' . $i;
			echo "<input type='hidden' class=\"$mileage\" name=$mileage>";
			$book_notes = 'book_notes' . $i;
			echo "<input type='hidden' class=\"$book_notes\" name=$book_notes>";
			$prod_notes = 'prod_notes' . $i;
			echo "<input type='hidden' class=\"$prod_notes\" name=$prod_notes>";
			$time_zone = 'time_zone' . $i;
			echo "<input type='hidden' class=\"$time_zone\" name=$time_zone>";
			$show_times = 'show_times' . $i;
			echo "<input type='hidden' class=\"$show_times\" name=$show_times>";
			$perf = 'perf' . $i;
			echo "<input type='hidden' class=\"$perf\" name=$perf>";
			$venue = 'venue' . $i;
			echo "<input type='hidden' class=\"$venue\" name=$venue>";
			$presenter = 'presenter' . $i;
			echo "<input type='hidden' class=\"$presenter\" name=$presenter>";
			$capacity = 'capacity' . $i;
			echo "<input type='hidden' class=\"$capacity\" name=$capacity>";
			$fixed_gntee = 'fixed_gntee' . $i;
			echo "<input type='hidden' class=\"$fixed_gntee\" name=$fixed_gntee>";
			$royalty = 'royalty' . $i;
			echo "<input type='hidden' class=\"$royalty\" name=$royalty>";
			$backend = 'backend' . $i;
			echo "<input type='hidden' class=\"$backend\" name=$backend>";
			$breakeven = 'breakeven' . $i;
			echo "<input type='hidden' class=\"$breakeven\" name=$breakeven>";
			$deal_notes = 'deal_notes' . $i;
			echo "<input type='hidden' class=\"$deal_notes\" name=$deal_notes>";
			$est_royalty = 'est_royalty' . $i;
			echo "<input type='hidden' class=\"$est_royalty\" name=$est_royalty>";
			$on_sub = 'on_sub' . $i;
			echo "<input type='hidden' class=\"$on_sub\" name=$on_sub>";
			$date_conf = 'date_conf' . $i;
			echo "<input type='hidden' class=\"$date_conf\" name=$date_conf>";
			$offer = 'offer' . $i;
			echo "<input type='hidden' class=\"$offer\" name=$offer>";
			$price_scales = 'price_scales' . $i;
			echo "<input type='hidden' class=\"$price_scales\" name=$price_scales>";
			$expenses = 'expenses' . $i;
			echo "<input type='hidden' class=\"$expenses\" name=$expenses>";
			$deal_memo = 'deal_memo' . $i;
			echo "<input type='hidden' class=\"$deal_memo\" name=$deal_memo>";
			$contract = 'contract' . $i;
			echo "<input type='hidden' class=\"$contract\" name=$contract>";
    	}
	echo "</table>";
	echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
echo "</form>";
echo "</div>";
include '../footer.html'; 
?>