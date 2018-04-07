<?php
require '../db/database_conn.php';
include '../header.html';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h3>GENERAL DATA</h3>";
if(isset($_GET['selectedid'])){
  $selectedid = $_GET['selectedid'];
  	$sql = "SELECT ROUTES_DETID,
  	               PRESENTATION_DATE,
  	               HOLIDAY,
  	               CITYID,
  	               rd.REPEAT,
  	               MILEAGE,
  	               BOOK_NOTES,
  	               PROD_NOTES,
  	               (SELECT TRUCKS * MILEAGE 
  	                FROM routes ro
  	                where ro.ROUTESID = rd.ROUTESID) as TEAM_DRIVE,
  	               TIME_ZONE,
  	               SHOW_TIMES,
  	               PERF,
  	               VENUEID,
  	               PRESENTERID,
  	               CAPACITY,
  	               FIXED_GNTEE,
  	               ROYALTY,
  	               BACKEND,
  	               BREAKEVEN,
  	               DEAL_NOTES,
  	               EST_ROYALTY,
  	               ON_SUB,
  	               DATE_CONF,
  	               OFFER,
  	               PRICE_SCALES,
  	               EXPENSES,
  	               DEAL_MEMO,
  	               CONTRACT
			FROM routes_det rd
			WHERE ROUTES_DETID = $selectedid";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
	echo "<form action=\"routes_detail_modify_selected_results.php\" method=\"POST\">";
	echo "<table>";

	/*Route Detail ID*/
	echo "<tr><td><b>Route Detail ID:</b></td><td><input style=\"background-color: lightgrey;\" readonly type='text' name='detid' value='".$row['ROUTES_DETID']."'>This field cannot be modified</td></tr>";	
	/*Presentation Date*/
	echo "<tr><td><b>Presentation Date:</b></td><td><input style=\"background-color: lightgrey;\" readonly type='text' name='presentation_date' value='".$row['PRESENTATION_DATE']."'>This field cannot be modified</td></tr>";	
	/*Holiday*/
	$active = $row['HOLIDAY'];
	if ($active == 1){
		echo "<tr><td><b>Holiday:</b></td><td><input type='checkbox' name='holiday' checked></td></tr>";
	}else{	
    	echo "<tr><td><b>Holiday:</b></td><td><input type='checkbox' name='holiday'></td></tr>";
    }
    /*State*/
    echo "<tr><td><b>State:</b></td><td><select name='state'>";
    if (empty($row['CITYID'])){    	
		echo "<option selected hidden value0>Choose States</option>";		
    }else{
    	$city = $row['CITYID'];
		$select = "SELECT sta.ID as STATE_ID, 
	                  	  sta.NAME as STATE_NAME
	           	   FROM cities ci, states sta
	               WHERE ci.STATE_ID = sta.ID
	               AND ci.ID = $city";
		$result = $conn->query($select);
		$row1 = $result->fetch_assoc();	
		echo "<option selected hidden value=".$row1['STATE_ID'].">".$row1['STATE_NAME']."</option>";		
    }
	$states_sql = "SELECT ID, NAME 
		           FROM states 
		           WHERE COUNTRY_ID = 231 
		           ORDER BY NAME ASC";
	$states_sql_result = $conn->query($states_sql);
	while ($row_sql = $states_sql_result->fetch_assoc()) {
       echo "<option value='".$row_sql['ID']."'>".$row_sql['NAME']."</option>";  
    }
    /*City*/
    echo "<tr><td><b>City:</b></td><td><select name='city'>";
    if (empty($row['CITYID'])){    	
		echo "<option selected hidden value0>Choose Cities</option>";		
    }else{
    	$state = $row1['STATE_ID'];
    	$city = $row['CITYID'];
		$select = "SELECT ID, NAME
	           FROM cities
	           WHERE ID = $city";
		$result = $conn->query($select);
		$row2 = $result->fetch_assoc();	
		echo "<option selected hidden value=".$row2['ID'].">".$row2['NAME']."</option>";
		$city_sql = "SELECT ID, NAME 
	             FROM cities 
	             WHERE STATE_ID = $state 
	             ORDER BY NAME ASC";
		$city_sql_result = $conn->query($city_sql);
		while ($row_sql = $city_sql_result->fetch_assoc()) {
      		echo "<option value='".$row_sql['ID']."'>".$row_sql['NAME']."</option>";
      	}		
    }
	/*Repeat*/
    $active = $row['REPEAT'];	
    if ($active == 1){
		echo "<tr><td><b>Repeat:</b></td><td><input type='checkbox' name='repeat' checked></td></tr>";
	}else{	
    	echo "<tr><td><b>Repeat:</b></td><td><input type='checkbox' name='repeat' ></td></tr>";
    }
    /*Mileage*/
    echo "<tr><td><b>Mileage:</b></td><td><input type='number' name='mileage' value='".$row['MILEAGE']."' step=0.01></td></tr>";
    /*Booking Notes*/
    echo "<tr><td><b>Booking Notes:</b></td><td><textarea name='book_notes' rows=4 cols=40>".$row['BOOK_NOTES']."</textarea></td></tr>";
    /*Production Notes*/	
    echo "<tr><td><b>Production Notes:</b></td><td><textarea name='prod_notes' rows=4 cols=40>".$row['PROD_NOTES']."</textarea></td></tr>";
    /*Team Drive Cost Estimate*/
	echo "<tr><td><b>Team Drive Cost Estimate:</b></td><td><input style=\"background-color: lightgrey;\" readonly type='number' name='team_drive' value='".$row['TEAM_DRIVE']."' step=0.01>This field cannot be modified</td></tr>";
    /*Time Zone*/	
    $time_zone = $row['TIME_ZONE'];	
	echo "<tr><td><b>Time Zone:</b></td><td><select name='time_zone'><br><br>
	<option selected hidden value=".$row['TIME_ZONE'].">".$row['TIME_ZONE']."</option>";
	echo "<option value='PST'>PST</option>
		  <option value='MST'>MST</option>
		  <option value='CST'>CST</option>
		  <option value='EST'>EST</option>";
	echo "</select></td> ></tr>";
	/*Show Times*/  
    echo "<tr><td><b>Show Times:</b></td><td><textarea name='show_times' rows=4 cols=40>".$row['SHOW_TIMES']."</textarea></td></tr>";
    /*Number of Performaces*/  
    echo "<tr><td><b>Number of Performaces:</b></td><td><input type='number' name='perf' value='".$row['PERF']."'></td></tr>";
    /*Venues*/  
    echo "<tr><td><b>Venues:</b></td><td><select name='venue'>";
    if (empty($row['VENUEID'])){    	
		echo "<option selected hidden value0>Choose Venues</option>";		
    }else{
    	$venues = $row['VENUEID'];
		$select = "SELECT VENUEID, 
	                  	  VENUENAME
	           	   FROM venues
	               WHERE VENUEID = $venues";
		$result = $conn->query($select);
		$row1 = $result->fetch_assoc();	
		echo "<option selected hidden value=".$row1['VENUEID'].">".$row1['VENUENAME']."</option>";		
    }
	$venues_sql = "SELECT VENUEID, 
	                      VENUENAME
	       		   FROM venues
	               ORDER BY VENUENAME ASC";
	$venues_sql_result = $conn->query($venues_sql);
	while ($row_sql = $venues_sql_result->fetch_assoc()) {
       echo "<option value='".$row_sql['VENUEID']."'>".$row_sql['VENUENAME']."</option>";                
    }
    /*Presenter*/
    echo "<tr><td><b>Presenters:</b></td><td><select name='presenter'>";
    if (empty($row['PRESENTERID'])){    	
		echo "<option selected hidden value0>Choose Presenters</option>";		
    }else{
    	$presenters = $row['PRESENTERID'];
		$select = "SELECT PRESENTERID, 
	                  	  PRESENTERNAME
	           	   FROM presenters
	               WHERE PRESENTERID = $presenters";
		$result = $conn->query($select);
		$row1 = $result->fetch_assoc();	
		echo "<option selected hidden value=".$row1['PRESENTERID'].">".$row1['PRESENTERNAME']."</option>";		
    }
	$presenters_sql = "SELECT PRESENTERID, 
	                      PRESENTERNAME
	       		   FROM presenters
	               ORDER BY PRESENTERNAME ASC";
	$presenters_sql_result = $conn->query($presenters_sql);
	while ($row_sql = $presenters_sql_result->fetch_assoc()) {
       echo "<option value='".$row_sql['PRESENTERID']."'>".$row_sql['PRESENTERNAME']."</option>";                
    }
    /*Capacity*/ 
    echo "<tr><td><b>Capacity:</b></td><td><input type='number' name='capacity' value='".$row['CAPACITY']."'></td></tr>";
    /*Fixed Guarantee*/ 
    echo "<tr><td><b>Fixed Guarantee:</b></td><td><input type='number' name='fixed_gntee' value='".$row['FIXED_GNTEE']."' step=0.01></td></tr>";
    /*Royalty*/ 
    echo "<tr><td><b>Royalty:</b></td><td><input type='number' name='royalty' value='".$row['ROYALTY']."' step=0.01></td></tr>";
    /*BackEnd*/ 
    echo "<tr><td><b>BackEnd:</b></td><td><input type='number' name='backend' value='".$row['BACKEND']."' step=0.01></td></tr>";
    /*Breakeven*/ 
    echo "<tr><td><b>Breakeven:</b></td><td><input type='number' name='breakeven' value='".$row['BREAKEVEN']."' step=0.01></td></tr>";
    /*Deal Notes*/
    echo "<tr><td><b>Deal Notes:</b></td><td><textarea name='deal_notes' rows=4 cols=40>".$row['DEAL_NOTES']."</textarea></td></tr>";
    /*Estimated Royalty*/
    echo "<tr><td><b>Estimated Royalty:</b></td><td><input type='number' name='est_royalty' value='".$row['EST_ROYALTY']."' step=0.01></td></tr>";
    /*On Sub*/
    $active = $row['ON_SUB'];	
    if ($active == 1){
		echo "<tr><td><b>On Sub:</b></td><td><input type='checkbox' name='on_sub' checked></td></tr>";
	}else{	
    	echo "<tr><td><b>On Sub:</b></td><td><input type='checkbox' name='on_sub'></td></tr>";
    }
    /*Date Confirmed*/
	$active = $row['DATE_CONF'];	
    if ($active == 1){
		echo "<tr><td><b>Date Confirmed:</b></td><td><input type='checkbox' name='date_conf' checked></td></tr>";
	}else{	
    	echo "<tr><td><b>Date Confirmed:</b></td><td><input type='checkbox' name='date_conf' ></td></tr>";
    }
    /*Offer*/
 	$active = $row['OFFER'];	
    if ($active == 1){
		echo "<tr><td><b>Offer:</b></td><td><input type='checkbox' name='offer' checked></td></tr>";
	}else{	
    	echo "<tr><td><b>Offer:</b></td><td><input type='checkbox' name='offer'></td></tr>";
    }
    /*>Price Scales*/
    $active = $row['PRICE_SCALES'];	
    if ($active == 1){
		echo "<tr><td><b>Price Scales:</b></td><td><input type='checkbox' name='price_scales' checked></td></tr>";
	}else{	
    	echo "<tr><td><b>Price Scales:</b></td><td><input type='checkbox' name='price_scales'></td></tr>";
    }
    /*>Expenses*/
    $active = $row['EXPENSES'];	
    if ($active == 1){
		echo "<tr><td><b>Expenses:</b></td><td><input type='checkbox' name='expenses' checked></td></tr>";
	}else{	
    	echo "<tr><td><b>Expenses:</b></td><td><input type='checkbox' name='expenses'></td></tr>";
    }
    /*>Deal Memo*/
    $active = $row['DEAL_MEMO'];	
    if ($active == 1){
		echo "<tr><td><b>Deal Memo:</b></td><td><input type='checkbox' name='deal_memo' checked></td></tr>";
	}else{	
    	echo "<tr><td><b>Deal Memo:</b></td><td><input type='checkbox' name='deal_memo'></td></tr>";
    }
    /*>Contract*/
    $active = $row['CONTRACT'];	
    if ($active == 1){
		echo "<tr><td><b>Contract:</b></td><td><input type='checkbox' name='contract' checked></td></tr>";
	}else{	
    	echo "<tr><td><b>Contract:</b></td><td><input type='checkbox' name='contract'></td></tr>";
    }	

	echo "</table>";
	echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
	echo "</form>";
} 
}
else {
  echo "failed";
}
$conn->close();
include '../footer.html';
?>
