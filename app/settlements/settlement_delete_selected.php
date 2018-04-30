<?php
require '../db/database_conn.php';
include '../header.html';
echo "<script src=\"../js/jquery.min.js\"></script>";
echo "<script src=\"../js/settlements_controller.js\"></script>";

echo "<h1 align=center style=\"color: red;\">WARNING: YOU ARE ABOUT TO DELETE THIS SETTLEMENT</h1>";

if(isset($_GET['selectedid'])){
	echo "<script>findData(".$_GET['selectedid'].");</script>";

	echo "<div style=\"display:none\" id=\"datasettlements\">";
	echo "<form action=\"settlement_delete_selected_results.php\" method=\"POST\">";
	echo "<table>
			<tr>
				<td><b>Settlement ID:</b></td>
				<td><input style=\"background-color: lightgrey;\" readonly type='text' name='id' class=\"id\">This field cannot be modified</td>
			</tr>
		    <tr>
		        <td><b>Venue:</b></td>
		        <td>
		        	<input style=\"background-color: lightgrey;\" readonly type='text' class=\"venue_name\" name='venue_name'>
		    	</td>
		    </tr>
		    <tr>
		        <td><b>Show:</b></td>
		        <td>
		        	<input style=\"background-color: lightgrey;\" readonly type='text' class=\"show_name\" name='show_name'>
		    	</td>
		    </tr>
		<tr>
			<td>
				<b>City:</b>
			</td>
			<td>
				<input style=\"background-color: lightgrey;\" readonly type='text' class=\"cityname\" name=\"city\">
			</td>
		</tr>
		<tr>
			<td>
				<b>State:</b>
			</td>
			<td>
				<input style=\"background-color: lightgrey;\" readonly type='text' class=\"statename\" name=\"state\">
			</td>
			<td>
				<input type=\"hidden\" class=\"cityid\" name=\"cityid\">
			</td>
		</tr>		    
    </table>";
    echo "<table>
		<tr>
			<td colspan=2><h3>GENERAL DATA</h3></td>
		</tr>
		<tr>
			<td><b>Opening Date:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type=\"date\" class=\"opening_date\" name='opening_date'></td>
		</tr>	
		<tr>
			<td><b>Closing Date:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type=\"date\" class=\"closing_date\" name='closing_date'></td>
		</tr>	
		<tr>
			<td><b>Drop Count:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"drop_count\" value=0.0 step=0.01 name='drop_count'></td>
		</tr>
		<tr>
			<td><b>Paid Attendance:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"paid_attendance\" value=0.0 step=0.01 name='paid_attendance'></td>
		</tr>
		<tr>
			<td><b>Comps:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"comps\" value=0.0 step=0.01 name='comps'></td>
		</tr>
		<tr>
			<td><b>Total Attendance:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"total_attendance\" value=0.0 step=0.01 name='total_attendance'></td>
		</tr>
		<tr>
			<td><b>Capacity:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"capacity\" value=0.0 step=0.01 name='capacity'></td>
		</tr>
		<tr>
			<td><b>Gross Internet Sales:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"internet_sales\" value=0.0 step=0.01 name='internet_sales'></td>
		</tr>
		<tr>
			<td><b>Gross Credit Card Sales:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"credit_card_sales\" value=0.0 step=0.01 name='credit_card_sales'></td>
		</tr>
		<tr>
			<td><b>Gross Remote Outlet Sales:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"remote_outlet_sales\" value=0.0 step=0.01 name='remote_outlet_sales'></td>
		</tr>
		<tr>
			<td><b>Gross Single Tix:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"single_tix\" value=0.0 step=0.01 name='single_tix'></td>
		</tr>
		<tr>
			<td><b>Gross Group Sales 1:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"group_sales_1\" value=0.0 step=0.01 name='group_sales_1'></td>
		</tr>
		<tr>
			<td><b>Gross Group Sales 2:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"group_sales_2\" value=0.0 step=0.01 name='group_sales_2'></td>
		</tr>
		<tr>
			<td><b>Gross Goldstar %:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"goldstar\" value=0.0 step=0.01 name='goldstar'></td>
		</tr>
		<tr>
			<td><b>Gross Groupon %:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"groupon\" value=0.0 step=0.01 name='groupon'></td>
		</tr>
		<tr>
			<td><b>Gross Traveloo %:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"traveloo\" value=0.0 step=0.01 name='traveloo'></td>
		</tr>
		<tr>
			<td><b>Gross Living Social %:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"living_social\" value=0.0 step=0.01 name='living_social'></td>
		</tr>
		<tr>
			<td><b>Gross Other %:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"other_percentage\" value=0.0 step=0.01 name='other_percentage'></td>
		</tr>
		<tr>
			<td><b>Gross Other $:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"other_amount\" value=0.0 step=0.01 name='other_amount'></td>
		</tr>
		<tr>
			<td><b>TTL Sub Discount:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"sub_discount\" value=0.0 step=0.01 name='sub_discount'></td>
		</tr>
		<tr>
			<td><b>TTL Group 1 Discount:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"group1_discount\" value=0.0 step=0.01 name='group1_discount'></td>
		</tr>
		<tr>
			<td><b>TTL Group 2 Discount:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"group2_discount\" value=0.0 step=0.01 name='group2_discount'></td>
		</tr>
		<tr>
			<td><b>Total Discounts:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"total_discount\" value=0.0 step=0.01 name='total_discount'></td>
		</tr>
		<tr>
			<td><b>TTL Comp Ticket Cost:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"comp_ticket_cost\" value=0.0 step=0.01 name='comp_ticket_cost'></td>
		</tr>
		<tr>
			<td><b>Demand Pricing $:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"demand_pricing\" value=0.0 step=0.01 name='demand_pricing'></td>
		</tr>
		<tr>
			<td><b>Number of Performances:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"number_performances\" value=0.0 step=0.01 name='number_performances'></td>
		</tr>	
		<tr>
			<td><b>Top Ticket Price:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"top_ticket_price\" value=0.0 step=0.01 name='top_ticket_price'></td>
		</tr>		
		<tr>
			<td><b>US/Canadian Exchange Rate:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' class=\"exchange_rate\" value=0.0 name='exchange_rate' step=0.01></td>
		</tr>
		<tr>
			<td><b>Gross Box Office Potential:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='box_office_pot' class=\"box_office_pot\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Gross Box Office Receipts:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='box_office_receipts' class=\"box_office_receipts\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Gross Box Office % of Potential:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='box_office_perc_pot' class=\"box_office_perc_pot\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>	
		<tr>
			<td></td>
			<td><b>Percentage</b></td>
			<td><b>Amount</b></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td><b>Tax 1 %:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='tax_1_perc' class=\"tax_1_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='tax_1_amou' class=\"tax_1_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Tax 2 and/or Percent deduction:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='tax_2_perc' class=\"tax_2_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='tax_2_amou' class=\"tax_2_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Facility/Restoration Fee:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='facility_perc' class=\"facility_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='facility_amou' class=\"facility_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Subscription Sales Comm:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='subs_perc' class=\"subs_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='subs_amou' class=\"subs_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Phone Sales Commission:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='phone_perc' class=\"phone_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='phone_amou' class=\"phone_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Internet Sales Commisssion:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='internet_perc' class=\"internet_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='internet_amou' class=\"internet_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Credit Card Sales Comm:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='cc_perc' class=\"cc_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='cc_amou' class=\"cc_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Remote Sales Commission:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='remote_perc' class=\"remote_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='remote_amou' class=\"remote_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Single Tix (if applicable):</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='single_tix_perc' class=\"single_tix_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='single_tix_amou' class=\"single_tix_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Group Sales Commission 1:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='group_1_perc' class=\"group_1_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='group_1_amou' class=\"group_1_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Group Sales Commission 2:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='group_2_perc' class=\"group_2_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='group_2_amou' class=\"group_2_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Goldstar:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='goldstar_perc' class=\"goldstar_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='goldstar_amou' class=\"goldstar_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Groupon:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='groupon_perc' class=\"groupon_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='groupon_amou' class=\"groupon_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Travelzoo:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='travelzoo_perc' class=\"travelzoo_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='travelzoo_amou' class=\"travelzoo_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Living Social:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='living_perc' class=\"living_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='living_amou' class=\"living_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Other %:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='othera_perc' class=\"othera_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='othera_amou' class=\"othera_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Other $:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='otherb_perc' class=\"otherb_perc\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='otherb_amou' class=\"otherb_amou\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>	
		<tr>
			<td></td>
			<td><b>Total</b></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>		
		<tr>
			<td><b>Total Allowable B.O. Expenses:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='total_abo_expenses' class=\"total_abo_expenses\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Deductions % of GBOR:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='deductions_gbor' class=\"deductions_gbor\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>NAGBOR:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='nagbor' class=\"nagbor\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Net Company Royalty:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='net_com_royalty' class=\"net_com_royalty\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Tax Withheld at Source:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='tax_withheld' class=\"tax_withheld\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Total Company Royalty:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='total_com_royalty' class=\"total_com_royalty\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Total Company Guarantee:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='total_com_guarantee' class=\"total_com_guarantee\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Less Other Deduction To CO.</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='other_deduction' class=\"other_deduction\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><b>Budgeted</b></td>
			<td><b>Actual</b></td>
			<td><b>Percentage</b></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>	
		<tr>
			<td><b>INSURANCE (ON DROP COUNT):</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='insurance_bug' class=\"insurance_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='insurance_act' class=\"insurance_act\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='insurance_per' class=\"insurance_per\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Ticket Printing:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='ticketprinting_bug' class=\"ticketprinting_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='ticketprinting_act' class=\"ticketprinting_act\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='ticketprinting_per' class=\"ticketprinting_per\" value=0.0 step=0.01></td>
		</tr>		
		<tr>
			<td><b>ADVERTISING (at gross):</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='advertising_bug' class=\"advertising_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='advertising_act' class=\"advertising_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>STAGEHANDS (Load-in):</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='sh_loadin_bug' class=\"sh_loadin_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='sh_loadin_act' class=\"sh_loadin_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>STAGEHANDS (Load-out):</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='sh_loadout_bug' class=\"sh_loadout_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='sh_loadout_act' class=\"sh_loadout_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>STAGEHANDS (Running):</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='sh_running_bug' class=\"sh_running_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='sh_running_act' class=\"sh_running_act\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>WARDROBE and HAIR (Load-in):</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='wh_loadin_bug' class=\"wh_loadin_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='wh_loadin_act' class=\"wh_loadin_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>WARDROBE and HAIR (Load-out):</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='wh_loadout_bug' class=\"wh_loadout_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='wh_loadout_act' class=\"wh_loadout_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>WARDROBE and HAIR (Running):</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='wh_running_bug' class=\"wh_running_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='wh_running_act' class=\"wh_running_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>LABOR CATERING:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='labor_catering_bug' class=\"labor_catering_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='labor_catering_act' class=\"labor_catering_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>MUSICIANS:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='musicians_bug' class=\"musicians_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='musicians_act' class=\"musicians_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Other:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='otherc_bug' class=\"otherc_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='otherc_act' class=\"otherc_act\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>SUBTOTAL of VARIABLE EXPENSE:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='st_variable_bug' class=\"st_variable_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='st_variable_act' class=\"st_variable_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>ADA EXPENSE:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='ada_bug' class=\"ada_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='ada_act' class=\"ada_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>BOX OFFICE:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='boxoffice_bug' class=\"boxoffice_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='boxoffice_act' class=\"boxoffice_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>HOSPITALITY (WATER):</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='hospitality_bug' class=\"hospitality_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='hospitality_act' class=\"hospitality_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>3RD PARTY EQUIPMENT RENTAL:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='third_equip_bug' class=\"third_equip_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='third_equip_act' class=\"third_equip_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>HOUSE STAFF:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='housestaff_bug' class=\"housestaff_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='housestaff_act' class=\"housestaff_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>LICENSES/PERMITS:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='licenses_bug' class=\"licenses_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='licenses_act' class=\"licenses_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>LIMOS/AUTO:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='limos_bug' class=\"limos_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='limos_act' class=\"limos_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>ORCHESTRA SHELL REMOVAL:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='orchestra_bug' class=\"orchestra_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='orchestra_act' class=\"orchestra_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>PRESENTER PROFIT:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='presenter_bug' class=\"presenter_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='presenter_act' class=\"presenter_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>POLICE/SECURITY/FIRE MARSHALL:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='security_bug' class=\"security_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='security_act' class=\"security_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>PROGRAM:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='program_bug' class=\"program_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='program_act' class=\"program_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>RENT:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='rent_bug' class=\"rent_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='rent_act' class=\"rent_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>SOUND/LIGHTS:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='soundlights_bug' class=\"soundlights_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='soundlights_act' class=\"soundlights_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>TICKET PRINTING:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='ticketprinting2_bug' class=\"ticketprinting2_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='ticketprinting2_act' class=\"ticketprinting2_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>TELEPHONES/INTERNET:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='phone_int_bug' class=\"phone_int_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='phone_int_act' class=\"phone_int_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>DRY ICE/CO2:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='dry_bug' class=\"dry_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='dry_act' class=\"dry_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>PRESS AGENT FEE:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='press_agent_bug' class=\"press_agent_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='press_agent_act' class=\"press_agent_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>OTHER:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='otherd_bug' class=\"otherd_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='otherd_act' class=\"otherd_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>OTHER:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='othere_bug' class=\"othere_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='othere_act' class=\"othere_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>OTHER:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='otherf_bug' class=\"otherf_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='otherf_act' class=\"otherf_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>OTHER:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='otherg_bug' class=\"otherg_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='otherg_act' class=\"otherg_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>PIANO TUNINGS:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='piano_bug' class=\"piano_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='piano_act' class=\"piano_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>LOCAL FIXED:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='local_fixed_bug' class=\"local_fixed_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='local_fixed_act' class=\"local_fixed_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>SUB-TOTAL of LOCAL EXPENSES:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='st_expenses_bug' class=\"st_expenses_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='st_expenses_act' class=\"st_expenses_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>TOTAL LOCAL EXPENSE:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='total_expenses_bug' class=\"total_expenses_bug\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='total_expenses_act' class=\"total_expenses_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><b>Total</b></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>		
		<tr>
			<td><b>TOTAL ENGAGEMENT EXPENSES:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='t_engagement_act' class=\"t_engagement_act\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><b>To Company</b></td>
			<td><b>To Presenter</></td>
		</tr>	
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td><b>Company Overage %:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='overage_comp' class=\"overage_comp\" value=0.0 step=0.01></td>
			<td></td>
		</tr>		
		<tr>
			<td><b>NET STAR PERFORMER OVERAGE %:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='net_star_overage' class=\"net_star_overage\" value=0.0 step=0.01></td>
			<td></td>
		</tr>		
		<tr>
			<td><b>Presenter Overage % to Company:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='overage_pre' class=\"overage_pre\" value=0.0 step=0.01></td>
			<td></td>
		</tr>		
		<tr>
			<td><b>Middel Monies To:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='monies_comp' class=\"monies_comp\" value=0.0 step=0.01></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='monies_pre' class=\"monies_pre\" value=0.0 step=0.01></td>
		</tr>	
		<tr>
			<td><b>Total Company Overage $:</b></td>
			<td></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='total_comp_overage' class=\"total_comp_overage\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>TOTAL STAR PERFORMER OVERAGE $:</b></td>
			<td></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='total_star_overage' class=\"total_star_overage\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>Presenter Overage % to Presenter:</b></td>
			<td></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='pre_overage_pre' class=\"pre_overage_pre\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><b>To Share</></td>
		</tr>	
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td><b>Presenter Overage % Adjusted Company Share:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='overage_share' class=\"overage_share\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><b>Total</></td>
		</tr>	
		<tr>
			<td></td>
			<td></td>
		</tr>	
		<tr>
			<td><b>Money Remaining:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='money_rem_total' class=\"money_rem_total\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>TOTAL COMPANY SHARE:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='total_comp_share' class=\"total_comp_share\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>LESS DIRECT COMPANY CHARGES:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='less_direct_comp' class=\"less_direct_comp\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>ADJUSTED COMPANY SHARE:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='adj_comp_share' class=\"adj_comp_share\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>TOTAL PRESENTER SHARE:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='total_pre_share' class=\"total_pre_share\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>PRESENTER'S FACILITY FEE:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='pre_facility_fee' class=\"pre_facility_fee\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>ADJUSTED PRESENTER SHARE:</b></td>
			<td><input style=\"background-color: lightgrey;\" readonly type='number' name='adj_pre_share' class=\"adj_pre_share\" value=0.0 step=0.01></td>
		</tr>
		<tr>
			<td><b>NOTES:</b></td>
			<th colspan=2><textarea style=\"background-color: lightgrey;\" readonly rows=4 cols=50 name='notes' class=\"notes\"></textarea></th>
		</tr>
	</table>";
	echo "<p style=\"text-align:center\"><input type=\"submit\" name=\"modify\" value=\"DELETE\"></p>";
	echo "</form>";
	echo "</div>";		
}
else {
  echo "failed";
}

$conn->close();
include '../footer.html';
?>