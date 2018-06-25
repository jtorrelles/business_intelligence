<?php
require '../db/database_conn.php';
include '../session.php';
include 'access_control.php';
include '../header_nologout.html';

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$settlementid = $_POST['id'];
	$showid = $_POST['show_name'];
	$venueid = $_POST['venue_name'];
	$cityid = $_POST['cityid'];
	$presenterid = $_POST['presenter_name'];
	$openingdate = $_POST['opening_date'];
	$closingdate = $_POST['closing_date'];
	$drop_count = $_POST['drop_count'];
	$paid_attendance = $_POST['paid_attendance'];
	$comps = $_POST['comps'];
	$total_attendance = $_POST['total_attendance'];
	$capacity = $_POST['capacity'];
	$subs_sales = $_POST['subs_sales'];
	$phone_sales = $_POST['phone_sales'];
	$internet_sales = $_POST['internet_sales'];
	$credit_card_sales = $_POST['credit_card_sales'];	
	$remote_outlet_sales = $_POST['remote_outlet_sales'];
	$single_tix = $_POST['single_tix'];
	$group_sales_1 = $_POST['group_sales_1'];
	$group_sales_2 = $_POST['group_sales_2'];
	$goldstar = $_POST['goldstar'];
	$groupon = $_POST['groupon'];
	$traveloo = $_POST['traveloo'];
	$living_social = $_POST['living_social'];
	$other_percentage = $_POST['other_percentage'];
	$other_amount = $_POST['other_amount'];
	$sub_discount = $_POST['sub_discount'];
	$group1_discount = $_POST['group1_discount'];
	$group2_discount = $_POST['group2_discount'];
	$total_discount = $_POST['total_discount'];
	$comp_ticket_cost = $_POST['comp_ticket_cost'];
	$demand_pricing = $_POST['demand_pricing'];
	$number_performances = $_POST['number_performances'];
	$top_ticket_price = $_POST['top_ticket_price'];
	$exchange_rate = $_POST['exchange_rate'];
	$box_office_pot = $_POST['box_office_pot'];
	$box_office_receipts = $_POST['box_office_receipts'];
	$box_office_perc_pot = $_POST['box_office_perc_pot'];
	$tax_1_perc = $_POST['tax_1_perc'];
	$tax_1_amou = $_POST['tax_1_amou'];
	$tax_2_perc = $_POST['tax_2_perc'];
	$tax_2_amou = $_POST['tax_2_amou'];
	$facility_perc = $_POST['facility_perc'];
	$facility_amou = $_POST['facility_amou'];
	$subs_perc = $_POST['subs_perc'];
	$subs_amou = $_POST['subs_amou'];
	$phone_perc = $_POST['phone_perc'];
	$phone_amou = $_POST['phone_amou'];
	$internet_perc = $_POST['internet_perc'];
	$internet_amou = $_POST['internet_amou'];
	$cc_perc = $_POST['cc_perc'];
	$cc_amou = $_POST['cc_amou'];
	$remote_perc = $_POST['remote_perc'];
	$remote_amou = $_POST['remote_amou'];
	$single_tix_perc = $_POST['single_tix_perc'];
	$single_tix_amou = $_POST['single_tix_amou'];
	$group_1_perc = $_POST['group_1_perc'];
	$group_1_amou = $_POST['group_1_amou'];
	$group_2_perc = $_POST['group_2_perc'];
	$group_2_amou = $_POST['group_2_amou'];
	$goldstar_perc = $_POST['goldstar_perc'];
	$goldstar_amou = $_POST['goldstar_amou'];
	$groupon_perc = $_POST['groupon_perc'];
	$groupon_amou = $_POST['groupon_amou'];
	$travelzoo_perc = $_POST['travelzoo_perc'];
	$travelzoo_amou = $_POST['travelzoo_amou'];
	$living_perc = $_POST['living_perc'];
	$living_amou = $_POST['living_amou'];
	$othera_perc = $_POST['othera_perc'];
	$othera_amou = $_POST['othera_amou'];
	$otherb_perc = $_POST['otherb_perc'];
	$otherb_amou = $_POST['otherb_amou'];
	$total_abo_expenses = $_POST['total_abo_expenses'];
	$deductions_gbor = $_POST['deductions_gbor'];
	$nagbor = $_POST['nagbor'];
	$net_com_royalty = $_POST['net_com_royalty'];
	$tax_withheld = $_POST['tax_withheld'];	
	$total_com_royalty = $_POST['total_com_royalty'];	
	$total_com_guarantee = $_POST['total_com_guarantee'];
	$other_deduction = $_POST['other_deduction'];
	$insurance_per = $_POST['insurance_per'];
	$ticketprinting_per = $_POST['ticketprinting_per'];
	$advertising_bug = $_POST['advertising_bug'];
	$advertising_act = $_POST['advertising_act'];
	$sh_loadin_bug = $_POST['sh_loadin_bug'];
	$sh_loadin_act = $_POST['sh_loadin_act'];
	$sh_loadout_bug = $_POST['sh_loadout_bug'];
	$sh_loadout_act = $_POST['sh_loadout_act'];
	$sh_running_bug = $_POST['sh_running_bug'];
	$sh_running_act = $_POST['sh_running_act'];
	$wh_loadin_bug = $_POST['wh_loadin_bug'];
	$wh_loadin_act = $_POST['wh_loadin_act'];
	$wh_loadout_bug = $_POST['wh_loadout_bug'];
	$wh_loadout_act = $_POST['wh_loadout_act'];
	$wh_running_bug = $_POST['wh_running_bug'];
	$wh_running_act = $_POST['wh_running_act'];
	$labor_catering_bug = $_POST['labor_catering_bug'];
	$labor_catering_act = $_POST['labor_catering_act'];
	$musicians_bug = $_POST['musicians_bug'];
	$musicians_act = $_POST['musicians_act'];
	$insurance_bug = $_POST['insurance_bug'];
	$insurance_act = $_POST['insurance_act'];
	$ticketprinting_bug = $_POST['ticketprinting_bug'];
	$ticketprinting_act = $_POST['ticketprinting_act'];
	$otherc_bug = $_POST['otherc_bug'];
	$otherc_act = $_POST['otherc_act'];
	$st_variable_bug = $_POST['st_variable_bug'];
	$st_variable_act = $_POST['st_variable_act'];
	$ada_bug = $_POST['ada_bug'];
	$ada_act = $_POST['ada_act'];
	$boxoffice_bug = $_POST['boxoffice_bug'];
	$boxoffice_act = $_POST['boxoffice_act'];
	$hospitality_bug = $_POST['hospitality_bug'];
	$hospitality_act = $_POST['hospitality_act'];
	$third_equip_bug = $_POST['third_equip_bug'];
	$third_equip_act = $_POST['third_equip_act'];
	$housestaff_bug = $_POST['housestaff_bug'];
	$housestaff_act = $_POST['housestaff_act'];
	$licenses_bug = $_POST['licenses_bug'];
	$licenses_act = $_POST['licenses_act'];
	$limos_bug = $_POST['limos_bug'];
	$limos_act = $_POST['limos_act'];
	$orchestra_bug = $_POST['orchestra_bug'];
	$orchestra_act = $_POST['orchestra_act'];
	$presenter_bug = $_POST['presenter_bug'];
	$presenter_act = $_POST['presenter_act'];
	$security_bug = $_POST['security_bug'];
	$security_act = $_POST['security_act'];
	$program_bug = $_POST['program_bug'];
	$program_act = $_POST['program_act'];
	$rent_bug = $_POST['rent_bug'];
	$rent_act = $_POST['rent_act'];
	$soundlights_bug = $_POST['soundlights_bug'];
	$soundlights_act = $_POST['soundlights_act'];
	$ticketprinting2_bug = $_POST['ticketprinting2_bug'];
	$ticketprinting2_act = $_POST['ticketprinting2_act'];
	$phone_int_bug = $_POST['phone_int_bug'];
	$phone_int_act = $_POST['phone_int_act'];
	$dry_bug = $_POST['dry_bug'];
	$dry_act = $_POST['dry_act'];
	$press_agent_bug = $_POST['press_agent_bug'];
	$press_agent_act = $_POST['press_agent_act'];
	$otherd_bug = $_POST['otherd_bug'];
	$otherd_act = $_POST['otherd_act'];
	$othere_bug = $_POST['othere_bug'];
	$othere_act = $_POST['othere_act'];
	$otherf_bug = $_POST['otherf_bug'];
	$otherf_act = $_POST['otherf_act'];
	$otherg_bug = $_POST['otherg_bug'];
	$otherg_act = $_POST['otherg_act'];
	$piano_bug = $_POST['piano_bug'];
	$piano_act = $_POST['piano_act'];
	$local_fixed_bug = $_POST['local_fixed_bug'];
	$local_fixed_act = $_POST['local_fixed_act'];
	$st_expenses_bug = $_POST['st_expenses_bug'];
	$st_expenses_act = $_POST['st_expenses_act'];
	$total_expenses_bug = $_POST['total_expenses_bug'];
	$total_expenses_act = $_POST['total_expenses_act'];
	$t_engagement_act = $_POST['t_engagement_act'];
	$overage_comp = $_POST['overage_comp'];
	$net_star_overage = $_POST['net_star_overage'];
	$overage_pre = $_POST['overage_pre'];
	$monies_comp = $_POST['monies_comp'];
	$monies_pre = $_POST['monies_pre'];
	$total_comp_overage = $_POST['total_comp_overage'];
	$total_star_overage = $_POST['total_star_overage'];
	$pre_overage_pre = $_POST['pre_overage_pre'];
	$overage_share = $_POST['overage_share'];
	$money_rem_total = $_POST['money_rem_total'];
	$total_comp_share = $_POST['total_comp_share'];
	$less_direct_comp = $_POST['less_direct_comp'];
	$adj_comp_share = $_POST['adj_comp_share'];
	$total_pre_share = $_POST['total_pre_share'];
	$pre_facility_fee = $_POST['pre_facility_fee'];
	$adj_pre_share = $_POST['adj_pre_share'];
	$notes = $_POST['notes'];

$sql = "UPDATE settlements 
			SET  SHOWID = $showid, CITYID = $cityid, VENUEID = $venueid, PresenterID = $presenterid, OPENINGDATE = '$openingdate', 
				CLOSINGDATE = '$closingdate', DROPCOUNT = $drop_count, PAIDATTENDANCE = $paid_attendance, 
				COMPS = $comps, TOTALATTENDANCE = $total_attendance, CAPACITY = $capacity, 
				GROSSSUBSCRIPTIONSALES = $subs_sales, GROSSPHONESALES = $phone_sales, 
				GROSSINTERNETSALES = $internet_sales, GROSSCREDITCARDSALES = $credit_card_sales, 
				GROSSREMOTEOUTLETSALES = $remote_outlet_sales, GROSSSINGLETIX = $single_tix, 
				GROSSGROUPSALES1 = $group_sales_1, GROSSGROUPSALES2 = $group_sales_2, 
				GROSSGOLDSTARPERCENTAGE = $goldstar, GROSSGROUPONPERCENTAGE = $groupon, 
				GROSSTRAVELOOPERCENTAGE = $traveloo, GROSSLIVINGSOCIALPERCENTAGE = $living_social, 
				GROSSOTHERPERCENTAGE = $other_percentage, GROSSOTHERAMOUNT = $other_amount, 
				TTLSUBDISCOUNT = $sub_discount, TTLGROUPDISCOUNT1 = $group1_discount, 
				TTLGROUPDISCOUNT2 = $group2_discount, TOTALDISCOUNTS = $total_discount, 
				TTLCOMPTICKETCOST = $comp_ticket_cost, DEMANDPRICING = $demand_pricing, 
				NUMBEROFPERFORMANCES = $number_performances, TOPTICKETPRICE = $top_ticket_price, 
				USCANADIANEXCHANGERATE = $exchange_rate, GROSSBOXOFFICEPOTENTIAL = $box_office_pot, 
				GROSSBOXOFFICERECEIPTS = $box_office_receipts, 
				GROSSBOXOFFICEPERCENTAGEOFPOTENTIAL = $box_office_perc_pot, TAX1PERCENTAGE = $tax_1_perc, 
				TAX1AMOUNT = $tax_1_amou, TAX2PERCENTAGE = $tax_2_perc, TAX2AMOUNT = $tax_2_amou, 
				FACILITYPERCENTAGE = $facility_perc, FACILITYAMOUNT = $facility_amou, 
				SUBSCRIPTIONSALESCOMMPERCENTAGE = $subs_perc, SUBSCRIPTIONSALESCOMMAMOUNT = $subs_amou, 
				PHONESALESCOMMPERCENTAGE = $phone_perc, PHONESALESCOMMAMOUNT = $phone_amou, 
				INTERNETSALESCOMMPERCENTAGE = $internet_perc, INTERNETSALESCOMMAMOUNT = $internet_amou, 
				CREDITCARDSALESCOMMPERCENTAGE = $cc_perc, CREDITCARDSALESCOMMAMOUNT = $cc_amou, 
				REMOTESALESCOMMPERCENTAGE = $remote_perc, REMOTESALESCOMMAMOUNT = $remote_amou, 
				SINGLETIXPERCENTAGE = $single_tix_perc, SINGLETIXAMOUNT = $single_tix_amou, 
				GROUPSALESCOMM1PERCENTAGE = $group_1_perc, GROUPSALESCOMM1AMOUNT = $group_1_amou, 
				GROUPSALESCOMM2PERCENTAGE = $group_2_perc, GROUPSALESCOMM2AMOUNT = $group_2_amou, 
				GOLDSTARPERCENTAGE = $goldstar_perc, GOLDSTARAMOUNT = $goldstar_amou, 
				GROUPONPERCENTAGE = $groupon_perc, GROUPONAMOUNT = $groupon_amou, 
				TRAVELZOOPERCENTAGE = $travelzoo_perc, TRAVELZOOAMOUNT = $travelzoo_amou, 
				LIVINGSOCIALPERCENTAGE = $living_perc, LIVINGSOCIALAMOUNT = $living_amou, 
				OTHERAPERCENTAGE = $othera_perc, OTHERAAMOUNT = $othera_amou, OTHERBPERCENTAGE = $otherb_perc, 
				OTHERBAMOUNT = $otherb_amou, TOTALALLOWABLEBOEXPENSES = $total_abo_expenses, 
				DEDUCTIONSOFGBOR = $deductions_gbor, NAGBOR = $nagbor, NETCOMPANYROYALTY = $net_com_royalty, 
				TAXWITHHELDATSOURCE = $tax_withheld, TOTALCOMPANYROYALTY = $total_com_royalty, 
				TOTALCOMPANYGUARANTEE = $total_com_guarantee, LESSOTHERDEDUCTION = $other_deduction, 
				INSURANCEPERTICKET = $insurance_per, TICKETPRINTING1PERTICKET = $ticketprinting_per, 
				ADVERTISINGBUDGETED = $advertising_bug, ADVERTISINGACTUAL = $advertising_act, 
				STAGEHANDSLOAINBUDGETED = $sh_loadin_bug, STAGEHANDSLOAINACTUAL = $sh_loadin_act, 
				STAGEHANDSLOADOUTBUDGETED = $sh_loadout_bug, STAGEHANDSLOADOUTACTUAL = $sh_loadout_act, 
				STAGEHANDSRUNNINGBUDGETED = $sh_running_bug, STAGEHANDSRUNNINGACTUAL = $sh_running_act, 
				WARDROBELOADINBUDGETED = $wh_loadin_bug, WARDROBELOADINACTUAL = $wh_loadin_act, 
				WARDROBELOADOUTBUDGETED = $wh_loadout_bug, WARDROBELOADOUTACTUAL = $wh_loadout_act, 
				WARDROBERUNNINGBUDGETED = $wh_running_bug, WARDROBERUNNINGACTUAL = $wh_running_act, 
				LABORCATERINGBUDGETED = $labor_catering_bug, LABORCATERINGACTUAL = $labor_catering_act, 
				MUSICIANSBUDGETED = $musicians_bug, MUSICIANSACTUAL = $musicians_act, 
				INSURANCEBUDGETED = $insurance_bug, INSURANCEACTUAL = $insurance_act, 
				TICKETPRINTING1BUDGETED = $ticketprinting_bug, TICKETPRINTING1ACTUAL = $ticketprinting_act, 
				OTHERCBUDGETED = $otherc_bug, OTHERCACTUAL = $otherc_act, 
				SUBTOTALVARIABLEEXPENSEBUDGETED = $st_variable_bug, SUBTOTALVARIABLEEXPENSEACTUAL = $st_variable_act, 
				ADAEXPENSEBUDGETED = $ada_bug, ADAEXPENSEACTUAL = $ada_act, BOXOFFICEBUDGETED = $boxoffice_bug, 
				BOXOFFICEACTUAL = $boxoffice_act, HOSPITALITYBUDGETED = $hospitality_bug, 
				HOSPITALITYACTUAL = $hospitality_act, THIRDPARTYBUDGETED = $third_equip_bug, 
				THIRDPARTYACTUAL = $third_equip_act, HOUSESTAFFBUDGETED = $housestaff_bug, 
				HOUSESTAFFACTUAL = $housestaff_act, LICENSESBUDGETED = $licenses_bug, 
				LICENSESACTUAL = $licenses_act, LIMOSAUTOBUDGETED = $limos_bug, 
				LIMOSAUTOACTUAL = $limos_act, ORCHESTRABUDGETED = $orchestra_bug, ORCHESTRAACTUAL = $orchestra_act, 
				PRESENTERPROFITBUDGETED = $presenter_bug, PRESENTERPROFITACTUAL = $presenter_act, 
				SECURITYBUDGETED = $security_bug, SECURITYACTUAL = $security_act, PROGRAMBUDGETED = $program_bug, 
				PROGRAMACTUAL = $program_act, RENTBUDGETED = $rent_bug, RENTACTUAL = $rent_act, 
				SOUNDBUDGETED = $soundlights_bug, SOUNDACTUAL = $soundlights_act, 
				TICKETPRINTING2BUDGETED = $ticketprinting2_bug, TICKETPRINTING2ACTUAL = $ticketprinting2_act, 
				TELEPHONESBUDGETED = $phone_int_bug, TELEPHONESACTUAL = $phone_int_act, DRYICEBUDGETED = $dry_bug, 
				DRYICEACTUAL = $dry_act, PRESSAGENTFEEBUDGETED = $press_agent_bug, 
				PRESSAGENTFEEACTUAL = $press_agent_act, OTHERDBUDGETED = $otherd_bug, OTHERDACTUAL = $otherd_act, 
				OTHEREBUDGETED = $othere_bug, OTHEREACTUAL = $othere_act, OTHERFBUDGETED = $otherf_bug, 
				OTHERFACTUAL = $otherf_act, OTHERGBUDGETED = $otherg_bug, OTHERGACTUAL = $otherg_act, 
				PIANOBUDGETED = $piano_bug, PIANOACTUAL = $piano_act, LOCALFIXEDBUDGETED = $local_fixed_bug, 
				LOCALFIXEDACTUAL = $local_fixed_act, SUBTOTALLOCALEXPENSESBUDGETED = $st_expenses_bug, 
				SUBTOTALLOCALEXPENSESACTUAL = $st_expenses_act, TOTALLOCALEXPENSEBUDGETED = $total_expenses_bug, 
				TOTALLOCALEXPENSEACTUAL = $total_expenses_act, TOTALENGAGEMENTEXPENSES = $t_engagement_act, 
				MIDDLEMONIESTOCOMPANY = $monies_comp, MIDDLEMONIESTOPRESENTER = $monies_pre, 
				MONEYREMAINING = $money_rem_total, COMPANYOVERAGEPERCENTAGE = $overage_comp, 
				TOTALCOMPANYOVERAGEAMOUNT = $total_comp_overage, 
				NETSTARPERFORMEROVERAGEPERCENTAGE = $net_star_overage, 
				TOTALSTARPERFORMEROVERAGEAMOUNT = $total_star_overage, PRESENTEROVERAGETOCOMPANY = $overage_pre, 
				PRESENTEROVERAGEADJUSTED = $overage_share, PRESENTEROVERAGETOPRESENTER = $pre_overage_pre, 
				TOTALCOMPANYSHARE = $total_comp_share, LESSDIRECTCOMPANYCHARGES = $less_direct_comp, 
				ADJUSTEDCOMPANYSHARE = $adj_comp_share, TOTALPRESENTERSHARE = $total_pre_share, 
				PRESENTERFACILITYFEE = $pre_facility_fee, ADJUSTEDPRESENTERSHARE = $adj_pre_share, NOTES = '$notes' 
			WHERE ID = $settlementid";

	if ($conn->query($sql) === TRUE) {
		echo "<p>Settlement Modified Successfully!</p>";
	} else {
	    echo "Error modifying record: " . $conn->error;
	}

	echo "<script language=\"javascript\" type=\"text/javascript\">
			function windowClose() {
				window.open('','_parent','');
				window.opener.location.reload();
				window.close();
			}
		</script>
		<p align=center>
			<input type=\"button\" value=\"CLOSE THIS WINDOW\" onclick=\"windowClose();\">
		</p>";

$conn->close();
include '../footer.html';
?>