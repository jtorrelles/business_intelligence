<?php
require '../db/database_conn.php';
include '../header.html';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/contracts_controller.js\"></script>";

echo "<h1>Modify An Existing Contract:</h1>";
if(isset($_GET['selectedid'])){
  	echo "<script>findData(".$_GET['selectedid'].");</script>";

	echo "<div style=\"display:none\" id=\"datacontract\">";
	echo "<form action=\"contract_modify_results.php\" method=\"POST\">";
	echo "<table>
			<tr>
				<td><b>Contract ID:</b></td>
				<td><input style=\"background-color: lightgrey;\" readonly type='text' name='id' class='id'>This field cannot be modified</td>
			</tr>
			<tr>
				<td colspan=2><h3>GENERAL DATA</h3></td>
				<td></td>
			</tr>
			<tr>
				<td>Show:</td>
				<td>
					<select name=\"show_name\" class=\"shows\" id=\"showId\" required>
						<option value=\"\">Select Show</option>
					</select>
				</td></tr>
				<td>Presenter:</td>
				<td>
					<select name=\"presenter_name\" class=\"presenters\" id=\"presenterId\" required>
						<option value=\"\">Select Presenter</option>
					</select>
				</td></tr>
				<td>Venue:</td>
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
				<td><input type=\"date\" name='opening_date' class='opening_date'></td></tr>
				<td>Closing Date:</td>
				<td><input type=\"date\" name='closing_date' class='closing_date'></td></tr>
				<td>Number of Performances:</td>
				<td><input type=\"number\" name='number_of_performances' class='number_of_performances' max=99 min=1 step=1></td></tr>
				<td>Gross Potential:</td>
				<td><input type=\"number\" name='gross_potential' class='gross_potential' step=0.01></td></tr>
				<td>Tax:</td>
				<td><input type=\"number\" name='tax' class='tax' step=0.01></td></tr>
				<td>Guarantee:</td>
				<td><input type=\"number\" name='guarantee' class='guarantee' step=0.01></td></tr>
			</tr>
			<tr>
				<td colspan=2><h3>COMMISSIONS (%)</h3></td>
				<td></td>
			</tr>
			<tr>
				<td>Group:</td>
				<td><input type=\"number\" name='group_commission' class='group_commission' max=99 min=1 step=1></td></tr>
				<td>Subscription:</td>
				<td><input type=\"number\" name='subscription_commission' class='subscription_commission' max=99 min=1></td></tr>
				<td>Phone:</td>
				<td><input type=\"number\" name='phone_commission' class='phone_commission' max=99 min=1 step=1></td></tr>
				<td>Internet:</td>
				<td><input type=\"number\" name='internet_commission' class='internet_commission' max=99 min=1 step=1></td></tr>
				<td>Credit Card:</td>
				<td><input type=\"number\" name='credit_card_commission' class='credit_card_commission' max=99 min=1 step=1></td></tr>
				<td>Remotes:</td>
				<td><input type=\"number\" name='remotes_commission' class='remotes_commission' max=99 min=1 step=1></td></tr>
			</tr>
			<tr>
				<td colspan=2><h3>EXPENSES</h3></td>
				<td></td>
			</tr>
			<tr>
				<td>Total Fixed Expense:</td>
				<td><input type=\"number\" name='fixed_expense' class='fixed_expense' step=0.01></td></tr>
				<td>Total Documented Expense:</td>
				<td><input type=\"number\" name='documented_expense' class='documented_expense' step=0.01></td></tr>
				<td>Total Presenter Expenses:</td>
				<td><input type=\"number\" name='total_presenter_expense' class='total_presenter_expense' step=0.01></td></tr>
			</tr>
		</table>";
	echo "<p><input type=\"submit\" name=\"modify\" value=\"Modify / Save\"></p>";
	echo "</form>";
  echo "</div>";

}
else {
  echo "failed";
}
$conn->close();
include '../footer.html';
?>
