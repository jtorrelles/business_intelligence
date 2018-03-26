<?php
include '../header.html';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/contracts_controller.js\"></script></td>";
echo "<script> onloadManagement(); </script>";
echo "<h1>Add a New Contract:</h1>";
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
			<td><input type=\"number\" name=\"gross_potential\" step=0.01></td></tr>
			<td>Tax:</td>
			<td><input type=\"number\" name=\"tax\" step=0.01></td></tr>
			<td>Guarantee:</td>
			<td><input type=\"number\" name=\"guarantee\" step=0.01></td></tr>
		</tr>
		<tr>
			<td colspan=2><h3>COMMISSIONS (%)</h3></td>
			<td></td>
		</tr>
		<tr>
			<td>Group:</td>
			<td><input type=\"number\" name=\"group_commission\" max=99 min=1 step=1></td></tr>
			<td>Subscription:</td>
			<td><input type=\"number\" name=\"subscription_commission\" max=99 min=1></td></tr>
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
			<td>Total Fixed Expense:</td>
			<td><input type=\"number\" class=\"fixed_exp\" name=\"fixed_expense\" value=0.0 step=0.01></td></tr>
			<td>Total Documented Expense:</td>
			<td><input type=\"number\" class=\"document_exp\" name=\"documented_expense\" value=0.0  step=0.01></td></tr>
			<td>Total Presenter Expenses:</td>
			<td><input type=\"number\" class=\"total_exp\" name=\"total_presenter_expense\" value=0.0 step=0.01></td></tr>
		</tr>
	</table>";
echo "<p><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
echo "</form>";
echo "<br>";
echo "<br>";
echo "Generate Proforma: If a Proforma is not generated then Settlement data needs to be input manually";
include '../footer.html';
?>