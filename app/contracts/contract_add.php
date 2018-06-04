<?php
include '../header.html';
include '../session.php';
include 'access_control.php';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/contracts_controller.js\"></script></td>";
echo "<script> onloadManagement(); </script>";
echo "<h1>Add a New Deal:</h1>";
echo "<form action=\"contract_add_results.php\" method=\"POST\">";
echo "<table>
		<tr>
			<td colspan=2><h3>GENERAL DATA</h3></td>
		</tr>
		<tr>
			<td>Show:</td>
			<td>
				<select name=\"show_name\" class=\"shows\" id=\"showId\" required>
					<option value=\"\">Select Show</option>
				</select>
			</td></tr>
			<tr><td>Presenter:</td>
			<td>
				<select name=\"presenter_name\" class=\"presenters\" id=\"presenterId\" required>
					<option value=\"\">Select Presenter</option>
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
			<td colspan=2><h3>PERFORMANCE DETAIL</h3></td>
			<td></td>
		</tr>
		<tr>
			<td>Opening Date:</td>
			<td><input type=\"date\" name=\"opening_date\"></td></tr>
			<td>Closing Date:</td>
			<td><input type=\"date\" name=\"closing_date\"></td></tr>
			<td>Number of Performances:</td>
			<td><input type=\"number\" name=\"number_of_performances\" max=99 min=1 step=1></td></tr>
			<td>Gross Potential:</td>
			<td><input type=\"number\" name=\"gross_potential\" value=0.0 step=0.01></td></tr>
			<td>Withholding Tax:</td>
			<td><input type=\"number\" name=\"tax\" value=0.0 step=0.01></td></tr>
			<td>Guarantee:</td>
			<td><input type=\"number\" name=\"guarantee\" value=0.0 step=0.01></td></tr>
			<td>Variable Guarantee:</td>
			<td><input type=\"number\" name=\"variable_guarantee\" max=99 min=1 step=1></td></tr>
			<td>Producer Overages:</td>
			<td><input type=\"number\" name=\"producer_overages\" max=99 min=1 step=1></td></tr>
			<td>Sales Tax 1:</td>
			<td><input type=\"number\" name=\"sales_tax_1\" value=0.0 step=0.01></td></tr>
			<td>Sales Tax 2:</td>
			<td><input type=\"number\" name=\"sales_tax_2\" value=0.0 step=0.01></td></tr>
			<td>Facility Fee 1:</td>
			<td><input type=\"number\" name=\"facility_fees_1\" value=0.0 step=0.01></td></tr>
			<td>Facility Fee 2:</td>
			<td><input type=\"number\" name=\"facility_fees_2\" value=0.0 step=0.01></td></tr>			
		</tr>
		<tr>
			<td colspan=2><h3>COMMISSIONS (%)</h3></td>
			<td></td>
		</tr>
		<tr>
			<td>Subscription:</td>
			<td><input type=\"number\" name=\"subscription_commission\" max=99 min=1 step=1></td></tr>		
			<td>Group:</td>
			<td><input type=\"number\" name=\"group_commission\" max=99 min=1 step=1></td></tr>
			<td>Phone:</td>
			<td><input type=\"number\" name=\"phone_commission\" max=99 min=1 step=1></td></tr>
			<td>Internet:</td>
			<td><input type=\"number\" name=\"internet_commission\" max=99 min=1 step=1></td></tr>
			<td>Credit Card:</td>
			<td><input type=\"number\" name=\"credit_card_commission\" max=99 min=1 step=1></td></tr>
			<td>Remotes:</td>
			<td><input type=\"number\" name=\"remotes_commission\" max=99 min=1 step=1></td></tr>
		</tr>
		<tr>
			<td colspan=2><h3>EXPENSES</h3></td>
			<td></td>
		</tr>
		<tr>
			<td>Fixed Expense:</td>
			<td><input type=\"number\" class=\"fixed_exp\" name=\"fixed_expense\" value=0.0 step=0.01></td></tr>
			<td>Total Documented Expense:</td>
			<td><input type=\"number\" class=\"document_exp\" name=\"documented_expense\" value=0.0  step=0.01></td></tr>
			<td>Total Presenter Expenses:</td>
			<td><input type=\"number\" class=\"total_exp\" name=\"total_presenter_expense\" value=0.0 step=0.01></td></tr>
		</tr>
		<tr>
			<td colspan=2><h3>ADDITIONAL INFO</h3></td>
			<td></td>
		</tr>
		<tr>
			<td>Notes:</td>
			<td><textarea class=\"notes_contract\" name=\"notes\" rows=4 cols=40></textarea></td></tr>		
	</table>";
echo "<p><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
echo "</form>";
echo "<br>";
echo "<br>";
include '../footer.html';
?>