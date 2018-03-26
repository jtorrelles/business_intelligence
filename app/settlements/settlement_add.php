<?php
include '../header.html';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/settlements_controller.js\"></script></td>";
echo "<script> onloadManagement(); </script>";
echo "<h1>Add a New Settlement:</h1>";
echo "<form action=\"settlement_add_results.php\" method=\"POST\">";
echo "<table>
		<tr>
			<td>Show:</td>
			<td>
				<select name=\"show_name\" class=\"shows\" id=\"showId\" required>
					<option value=\"\">Select Show</option>
				</select>
			</td></tr>
			<tr><td>Venue:</td>
			<td>
				<select name=\"venue_name\" class=\"venues\" id=\"venueId\" required>
					<option value=\"\">Select Venue</option>
				</select>
			</td></tr>
			<tr><td>City:</td>
			<td><input type=\"text\" class=\"cityname\" name=\"city\"></td></tr>
			<tr><td>State:</td>
			<td><input type=\"text\" class=\"statename\" name=\"state\"></td>
			<td><input type=\"hidden\" class=\"cityid\" name=\"cityid\"></td></tr>
		</tr>
		<tr>
			<td colspan=2><h3>GENERAL DATA</h3></td>
		</tr>
		<tr>
			<td><b>Opening Date:</b></td>
			<td><input type=\"date\" class=\"opening_date\" name='opening_date'></td>
		</tr>	
		<tr>
			<td><b>Closing Date:</b></td>
			<td><input type=\"date\" class=\"closing_date\" name='closing_date'></td>
		</tr>	
		<tr>
			<td><b>Number of Performances:</b></td>
			<td><input type='number' class=\"number_performances\" value=0 name='number_performances'></td>
		</tr>	
		<tr>
			<td><b>Gross Potential:</b></td>
			<td><input type='number' class=\"gross_potential\" value=0.0 name='gross_potential' step=0.01></td>
		</tr>
		<tr>
			<td><b>Actual Gross:</b></td>
			<td><input type='number' name='actual_gross' class=\"actual_gross\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Tickets Sold:</b></td>
			<td><input type='number' name='tickets_sold' class=\"tickets_sold\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Tickets Compd:</b></td>
			<td><input type='number' name='tickets_compd' class=\"tickets_compd\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Subscription:</b></td>
			<td><input type='number' name='subsc' class=\"subsc\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Subscription Sales:</b></td>
			<td><input type='number' name='subsc_sales' class=\"subsc_sales\" value=0.0 step=0.01></td>
		</tr>		
		<tr>
			<td><b>NAGBOR:</b></td>
			<td><input type='number' name='nagbor' class=\"nagbor\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Tax:</b></td>
			<td><input type='number' name='tax' class=\"tax\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Subscription Commission:</b></td>
			<td><input type='number' name='subsc_com' class=\"subsc_com\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Phone Commission:</b></td>
			<td><input type='number' name='phone_com' class=\"phone_com\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Internet Commission:</b></td>
			<td><input type='number' name='int_com' class=\"int_com\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Credit Card Commission:</b></td>
			<td><input type='number' class=\"cc_com\" name='cc_com' value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Remotes Commission:</b></td>
			<td><input type='number' name='remotes_com' class=\"remotes_com\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Group Sales Commission:</b></td>
			<td><input type='number' name='group_sales_com' class=\"group_sales_com\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Overage:</b></td>
			<td><input type='number' name='overage' class=\"overage\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Royality:</b></td>
			<td><input type='number' name='royality' class=\"royality\" value=0.0 step=0.01></td>
		</tr>		
		<tr>
			<td><b>Advertising:</b></td>
			<td><input type='number' name='advertising' class=\"advertising\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Ticket Insurance:</b></td>
			<td><input type='number' name='ticket_insurance' class=\"ticket_insurance\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Total Ticket Insurance:</b></td>
			<td><input type='number' name='total_ticket_insurance' class=\"total_ticket_insurance\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Catering:</b></td>
			<td><input type='number' name='catering' class=\"catering\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Catering (2):</b></td>
			<td><input type='number' name='catering2' class=\"catering2\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Stage Hands:</b></td>
			<td><input type='number' name='stage_hands' class=\"stage_hands\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Musicians:</b></td>
			<td><input type='number' name='musicians' class=\"musicians\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Wardrobe / Hair:</b></td>
			<td><input type='number' name='wardrobe_hair' class=\"wardrobe_hair\" value=0.0 step=0.01></td>
		</tr>		
		<tr>
			<td><b>Ticket Print:</b></td>
			<td><input type='number' name='ticket_print' class=\"ticket_print\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Total Ticket Print:</b></td>
			<td><input type='number' name='total_ticket_print' class=\"total_ticket_print\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Other Documented Expense:</b></td>
			<td><input type='number' name='other_doc' class=\"other_doc\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Total Documented Expense:</b></td>
			<td><input type='number' name='total_doc' class=\"total_doc\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>ADA Expense:</b></td>
			<td><input type='number' name='ada_expenses' class=\"ada_expenses\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Box Office:</b></td>
			<td><input type='number' name='box_office' class=\"box_office\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Cleaning:</b></td>
			<td><input type='number' name='cleaning' class=\"cleaning\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Direct Mail:</b></td>
			<td><input type='number' name='direct_mail' class=\"direct_mail\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Equipment Rental:</b></td>
			<td><input type='number' name='equipment_rental' class=\"equipment_rental\" value=0.0 step=0.01></td>
		</tr>		
		<tr>
			<td><b>Group Sales:</b></td>
			<td><input type='number' name='group_sales' class=\"group_sales\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Houseman TD:</b></td>
			<td><input type='number' name='houseman_td' class=\"houseman_td\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>House Staff:</b></td>
			<td><input type='number' name='house_staff' class=\"house_staff\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>League Fees:</b></td>
			<td><input type='number' name='league_fees' class=\"league_fees\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Licenses / Permits:</b></td>
			<td><input type='number' name='licenses_permits' class=\"licenses_permits\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Limos / Autos:</b></td>
			<td><input type='number' name='limos_autos' class=\"limos_autos\" value=0.0 step=0.01></td>
		</tr>		
		<tr>
			<td><b>Miscellaneous:</b></td>
			<td><input type='number' name='miscellaneous' class=\"miscellaneous\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Presenter Profit:</b></td>
			<td><input type='number' name='presenter_profit' class=\"presenter_profit\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Police / Security:</b></td>
			<td><input type='number' name='police_security' class=\"police_security\" value=0.0 step=0.01></td>
		</tr>		
		<tr>
			<td><b>Programs:</b></td>
			<td><input type='number' name='programs' class=\"programs\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Public Relations:</b></td>
			<td><input type='number' name='public_relations' class=\"public_relations\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Rent:</b></td>
			<td><input type='number' name='rent' class=\"rent\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Sound / Lights:</b></td>
			<td><input type='number' name='sound_lights' class=\"sound_lights\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Ticket Printing:</b></td>
			<td><input type='number' name='ticket_printing' class=\"ticket_printing\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Phones:</b></td>
			<td><input type='number' name='phones' class=\"phones\" value=0.0 step=0.01></td>
		</tr>			
		<tr>
			<td><b>Other Variable Expenses:</b></td>
			<td><input type='number' name='other_expenses' class=\"other_expenses\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Local Fixed Expenses:</b></td>
			<td><input type='number' name='local_fixed_expenses' class=\"local_fixed_expenses\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Total Fixed Expenses:</b></td>
			<td><input type='number' name='total_fixed_expenses' class=\"total_fixed_expenses\" value=0.0 step=0.01></td>
		</tr>		
		<tr>
			<td><b>Total Presenter Expense:</b></td>
			<td><input type='number' name='presenter_expenses' class=\"presenter_expenses\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Total Restoration Charge:</b></td>
			<td><input type='number' name='restoration_charge' class=\"restoration_charge\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Breakeven:</b></td>
			<td><input type='number' name='breakeven' class=\"breakeven\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Guarantee:</b></td>
			<td><input type='number' name='guarantee' class=\"guarantee\" value=0.0 step=0.01></td>
		</tr>
	</table>";
echo "<p align=center><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
echo "</form>";
echo "<br>";
echo "<br>";
include '../footer.html';
?>