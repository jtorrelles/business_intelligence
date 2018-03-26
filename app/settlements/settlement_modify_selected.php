<?php
require '../db/database_conn.php';
include '../header.html';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/settlements_controller.js\"></script>";

if(isset($_GET['selectedid'])){
	echo "<script>findData(".$_GET['selectedid'].");</script>";

	echo "<div style=\"display:none\" id=\"datasettlements\">";
	echo "<form action=\"settlement_modify_selected_results.php\" method=\"POST\">";
	echo "<table>";
	echo "<tr><td colspan=2><h3>GENERAL DATA</h3></td></tr>";
	echo "<tr>
			<td><b>Settlement ID:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='text' name='id' class=\"id\">This field cannot be modified</td>
		</tr>";	
	echo "<tr>
			<td><b>Venue Name:</b></td>
			<td><input type='text' style=\"background-color: lightgrey;\" readonly class=\"venue_name\" name='venue_name'></td>
		</tr>";	
	echo "<tr>
			<td><b>Show Name:</b></td>
			<td><input type='text' style=\"background-color: lightgrey;\" readonly class=\"show_name\" name='show_name'></td>
		</tr>";	
	echo "<tr>
			<td><b>Opening Date:</b></td>
			<td><input type=\"date\" class=\"opening_date\" name='opening_date'></td>
		</tr>";	
	echo "<tr>
			<td><b>Closing Date:</b></td>
			<td><input type=\"date\" class=\"closing_date\" name='closing_date'></td>
		</tr>";	
	echo "<tr>
			<td><b>Number of Performances:</b></td>
			<td><input type='number' class=\"number_performances\" name='number_performances'></td>
		</tr>";	
	echo "<tr>
			<td><b>Gross Potential:</b></td>
			<td><input type='number' class=\"gross_potential\" name='gross_potential' step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Actual Gross:</b></td>
			<td><input type='number' name='actual_gross' class=\"actual_gross\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Tickets Sold:</b></td>
			<td><input type='number' name='tickets_sold' class=\"tickets_sold\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Tickets Compd:</b></td>
			<td><input type='number' name='tickets_compd' class=\"tickets_compd\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Subscription:</b></td>
			<td><input type='number' name='subsc' class=\"subsc\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Tax:</b></td>
			<td><input type='number' name='tax' class=\"tax\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Subscription Commission:</b></td>
			<td><input type='number' name='subsc_com' class=\"subsc_com\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Phone Commission:</b></td>
			<td><input type='number' name='phone_com' class=\"phone_com\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Internet Commission:</b></td>
			<td><input type='number' name='int_com' class=\"int_com\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Credit Card Commission:</b></td>
			<td><input type='number' class=\"cc_com\" name='cc_com' step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Remotes Commission:</b></td>
			<td><input type='number' name='remotes_com' class=\"remotes_com\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Group Sales Commission:</b></td>
			<td><input type='number' name='group_sales_com' class=\"group_sales_com\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Overage:</b></td>
			<td><input type='number' name='overage' class=\"overage\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Advertising:</b></td>
			<td><input type='number' name='advertising' class=\"advertising\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Ticket Insurance:</b></td>
			<td><input type='number' name='ticket_insurance' class=\"ticket_insurance\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Total Ticket Insurance:</b></td>
			<td><input type='number' name='total_ticket_insurance' class=\"total_ticket_insurance\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Catering:</b></td>
			<td><input type='number' name='catering' class=\"catering\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Catering (2):</b></td>
			<td><input type='number' name='catering2' class=\"catering2\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Stage Hands:</b></td>
			<td><input type='number' name='stage_hands' class=\"stage_hands\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Musicians:</b></td>
			<td><input type='number' name='musicians' class=\"musicians\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Wardrobe / Hair:</b></td>
			<td><input type='number' name='wardrobe_hair' class=\"wardrobe_hair\" step=0.01></td>
		</tr>";		
	echo "<tr>
			<td><b>Ticket Print:</b></td>
			<td><input type='number' name='ticket_print' class=\"ticket_print\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Total Ticket Print:</b></td>
			<td><input type='number' name='total_ticket_print' class=\"total_ticket_print\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Other Documented Expense:</b></td>
			<td><input type='number' name='other_doc' class=\"other_doc\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Total Documented Expense:</b></td>
			<td><input type='number' name='total_doc' class=\"total_doc\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>ADA Expense:</b></td>
			<td><input type='number' name='ada_expenses' class=\"ada_expenses\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Box Office:</b></td>
			<td><input type='number' name='box_office' class=\"box_office\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Cleaning:</b></td>
			<td><input type='number' name='cleaning' class=\"cleaning\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Direct Mail:</b></td>
			<td><input type='number' name='direct_mail' class=\"direct_mail\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Equipment Rental:</b></td>
			<td><input type='number' name='equipment_rental' class=\"equipment_rental\" step=0.01></td>
		</tr>";		
	echo "<tr>
			<td><b>Group Sales:</b></td>
			<td><input type='number' name='group_sales' class=\"group_sales\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Houseman TD:</b></td>
			<td><input type='number' name='houseman_td' class=\"houseman_td\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>House Staff:</b></td>
			<td><input type='number' name='house_staff' class=\"house_staff\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>League Fees:</b></td>
			<td><input type='number' name='league_fees' class=\"league_fees\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Licenses / Permits:</b></td>
			<td><input type='number' name='licenses_permits' class=\"licenses_permits\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Limos / Autos:</b></td>
			<td><input type='number' name='limos_autos' class=\"limos_autos\"  step=0.01></td>
		</tr>";		
	echo "<tr>
			<td><b>Miscellaneous:</b></td>
			<td><input type='number' name='miscellaneous' class=\"miscellaneous\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Presenter Profit:</b></td>
			<td><input type='number' name='presenter_profit' class=\"presenter_profit\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Police / Security:</b></td>
			<td><input type='number' name='police_security' class=\"police_security\" step=0.01></td>
		</tr>";		
	echo "<tr>
			<td><b>Programs:</b></td>
			<td><input type='number' name='programs' class=\"programs\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Public Relations:</b></td>
			<td><input type='number' name='public_relations' class=\"public_relations\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Rent:</b></td>
			<td><input type='number' name='rent' class=\"rent\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Sound / Lights:</b></td>
			<td><input type='number' name='sound_lights' class=\"sound_lights\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Ticket Printing:</b></td>
			<td><input type='number' name='ticket_printing' class=\"ticket_printing\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Phones:</b></td>
			<td><input type='number' name='phones' class=\"phones\" step=0.01></td>
		</tr>";			
	echo "<tr>
			<td><b>Other Variable Expenses:</b></td>
			<td><input type='number' name='other_expenses' class=\"other_expenses\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Local Fixed Expenses:</b></td>
			<td><input type='number' name='local_fixed_expenses' class=\"local_fixed_expenses\" step=0.01></td>
		</tr>";
	echo "<tr>
			<td><b>Total Fixed Expenses:</b></td>
			<td><input type='number' name='total_fixed_expenses' class=\"total_fixed_expenses\" step=0.01></td>
		</tr>";		
	echo "<tr>
			<td><b>Total Presenter Expense:</b></td>
			<td><input type='number' name='presenter_expenses' class=\"presenter_expenses\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Total Restoration Charge:</b></td>
			<td><input type='number' name='restoration_charge' class=\"restoration_charge\" step=0.01></td>
		</tr>";	
	echo "<tr>
			<td><b>Breakeven:</b></td>
			<td><input type='number' name='breakeven' class=\"breakeven\" step=0.01></td>
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