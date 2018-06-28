<?php
require_once('../db/dbconfig2.php');
class breakevenServices extends dbconfig {

	public static $data;
	protected static $result;
	protected static $sql;

	function __construct() {
		parent::__construct();
	}

	public static function getAnalysisSelection($inid,$endd,$country,$state,$city,$show,$venues){

		$data = array();

		$data["settlements"] = self::getAnalysisBySettlements($country,$state,$city,$show,$venues);
		$data["contracts"] = self::getAnalysisByContracts($inid,$endd,$country,$state,$city,$show,$venues);
		$data["routes"] = self::getAnalysisByRoutes($inid,$endd,$country,$state,$city,$show,$venues);

		$data = array('status'=>'success', 'tp'=>1, 'msg'=>"Analysis Succesfull.", 'result'=>$data);

		dbconfig::close();

		return $data;
	}

	public static function getAnalysisBySettlements($country,$state,$city,$show,$venues){

		try{

			$query = "SELECT se.ID, se.SHOWID, sw.ShowNAME, ve.VenueNAME, 
					DATE_FORMAT(OPENINGDATE, '%m/%d/%Y') as OPENINGDATE, 
					DATE_FORMAT(CLOSINGDATE, '%m/%d/%Y') as CLOSINGDATE, 
					OPENINGDATE as OPENINGDATE2, 
					CLOSINGDATE as CLOSINGDATE2, 
					ROUND(DATEDIFF(CLOSINGDATE,OPENINGDATE)/7,2) AS NUMBEROFWEEKS,
					NUMBEROFPERFORMANCES,CAPACITY,GROSSBOXOFFICEPOTENTIAL,
					1 AS EXCHANGERATE,GROSSSUBSCRIPTIONSALES AS SUBLOADIN,
					(GROSSGROUPSALES1 + GROSSGROUPSALES2) AS ESTIMATEDGROUPS,
					TAX1AMOUNT AS SALESTAX1,TAX2AMOUNT AS SALESTAX2,
					FACILITYAMOUNT AS FACILITYFEE1,SUBSCRIPTIONSALESCOMMPERCENTAGE AS SUBSCRIPTIONCOMMISION,
					(GROUPSALESCOMM1PERCENTAGE + GROUPSALESCOMM2PERCENTAGE) / 2 AS GROUPSALESCOMMISION,
					CREDITCARDSALESCOMMPERCENTAGE AS CREDITCARDCOMMISION,TOTALCOMPANYGUARANTEE AS GUARANTEE,
					TOTALCOMPANYROYALTY AS VARIABLEGUARATEE,ADVERTISINGACTUAL AS ADVERTISING,
					STAGEHANDSLOAINACTUAL,STAGEHANDSLOADOUTACTUAL,STAGEHANDSRUNNINGACTUAL,
					WARDROBELOADINACTUAL,WARDROBELOADOUTACTUAL,WARDROBERUNNINGACTUAL,
					LABORCATERINGACTUAL AS LABORCATERING,MUSICIANSACTUAL AS MUSICIANS,
					INSURANCEACTUAL AS INSURANCE,TICKETPRINTING1ACTUAL AS TICKETPRINTING,
					OTHERCACTUAL AS OTHER,ADAEXPENSEACTUAL AS ADAEXPENSES,
					BOXOFFICEACTUAL AS BOXOFFICE,DRYICEACTUAL AS DRYICE,
					HOSPITALITYACTUAL AS HOSPITALITY,HOUSESTAFFACTUAL AS HOUSESTAFF,
					LICENSESACTUAL AS LICENSES,LIMOSAUTOACTUAL AS LIMOS,
					PIANOACTUAL AS PIANO,SECURITYACTUAL AS POLICESECURITY,
					PRESENTERPROFITACTUAL AS PRESENTERPROFIT,
					PRESSAGENTFEEACTUAL AS PRESSAGENTFEE,
					PROGRAMACTUAL AS PROGRAMS,RENTACTUAL AS RENT,SOUNDACTUAL AS SOUND,
					TELEPHONESACTUAL AS TELEPHONES,THIRDPARTYACTUAL AS EQUIPMENTRENTAL,
					OTHERDACTUAL,OTHEREACTUAL,OTHERFACTUAL,OTHERGACTUAL,
					LOCALFIXEDACTUAL AS LOCALFIX,
					TAXWITHHELDATSOURCE AS LESSINCOMETAXES1,
					ci.`name` as city, st.`name` as state, co.sortname as country, 
					ci.id as CITYID, st.id as STATEID, co.id as COUNTRYID 
					FROM settlements se, shows sw, cities ci, states st, countries co, venues ve  
					WHERE se.SHOWID = sw.ShowID 
					AND se.VENUEID = ve.VenueID 
					AND ve.VenueCITYID = ci.id 
					AND ci.state_id = st.id 
					AND st.country_id = co.id";

			$filter1 = "
					AND ve.VenueCITYID like ('$city')
					AND se.SHOWID = $show 
					AND ve.VENUEID IN ('$venues') 
					ORDER BY se.OPENINGDATE DESC 
					LIMIT 4";			

			$filter2 = "
					AND st.id like ('$state') 
					AND se.SHOWID = $show 
					AND ve.VENUEID IN ('$venues') 
					ORDER BY se.OPENINGDATE DESC 
					LIMIT 4";
			$filter3 = "
					AND se.SHOWID = $show 
					ORDER BY se.OPENINGDATE DESC 
					LIMIT 4";			

			self::$sql = $query.$filter1;

			self::$result = dbconfig::run(self::$sql);
			if(!self::$result) {
				throw new exception("Settlements not found.");
			}

			$count = dbconfig::num_rows(self::$result);
			if($count == 0){

				self::$sql = $query.$filter2;

				self::$result = dbconfig::run(self::$sql);
				if(!self::$result) {
					throw new exception("Settlements not found.");
				}

				$count = dbconfig::num_rows(self::$result);

				if($count == 0){
					self::$sql = $query.$filter3;

					self::$result = dbconfig::run(self::$sql);
					if(!self::$result) {
						throw new exception("Settlements not found.");
					}

				}
			}

			$data = array();
			$x = 0;

			while($resultSet = mysqli_fetch_assoc(self::$result)) {

				$capacity = $resultSet["CAPACITY"];
				$numberofweeks = ceil($resultSet['NUMBEROFWEEKS']);
				$numberofshowsperweek = $resultSet['NUMBEROFPERFORMANCES'] / $numberofweeks;
				$weeklygross = $resultSet['GROSSBOXOFFICEPOTENTIAL'] / $numberofweeks;
				$netaverage = $resultSet['GROSSBOXOFFICEPOTENTIAL'] / ($numberofshowsperweek * $capacity);

				$data[$x]["ID"] = $resultSet['ID'];
				$data[$x]["SHOWID"] = $resultSet['SHOWID'];
				$data[$x]["SHOWNAME"] = $resultSet['ShowNAME'];
				$data[$x]["VENUENAME"] = $resultSet['VenueNAME'];
				$data[$x]["NUMBEROFWEEKS"] = ceil($resultSet['NUMBEROFWEEKS']);
				$data[$x]["OPENINGDATE"] = $resultSet['OPENINGDATE'];
				$data[$x]["CLOSINGDATE"] = $resultSet['CLOSINGDATE'];
				$data[$x]["OPENINGDATE_SF"] = $resultSet['OPENINGDATE1'];
				$data[$x]["CLOSINGDATE_SF"] = $resultSet['CLOSINGDATE2'];				
				$data[$x]["NUMBEROFSHOWSPERWEEKS"] = round($numberofshowsperweek);
				$data[$x]["CAPACITY"] = $resultSet['CAPACITY'];
				$data[$x]["WEEKLYGROSSPOTENTIAL"] = round($weeklygross,2);
				$data[$x]["NETAVERAGEPERTICKET"] = round($netaverage,2);
				$data[$x]["EXCHANGERATE"] = $resultSet['EXCHANGERATE'];
				$data[$x]["SUBLOADIN"] = $resultSet['SUBLOADIN'];
				$data[$x]["ESTIMATEDGROUPS"] = $resultSet['ESTIMATEDGROUPS'];
				$data[$x]["SALESTAX1"] = $resultSet['SALESTAX1'];
				$data[$x]["SALESTAX2"] = $resultSet['SALESTAX2'];
				$data[$x]["FACILITYFEE1"] = $resultSet['FACILITYFEE1'];
				$data[$x]["SUBSCRIPTIONCOMMISION"] = $resultSet['SUBSCRIPTIONCOMMISION'];
				$data[$x]["GROUPSALESCOMMISION"] = $resultSet['GROUPSALESCOMMISION'];
				$data[$x]["CREDITCARDCOMMISION"] = $resultSet['CREDITCARDCOMMISION'];
				$data[$x]["GUARANTEE"] = $resultSet['GUARANTEE'];
				$data[$x]["VARIABLEGUARANTEE"] = $resultSet['VARIABLEGUARANTEE'];
				$data[$x]["ADVERTISING"] = $resultSet['ADVERTISING'];
				$data[$x]["STAGEHANDSLOAINACTUAL"] = $resultSet['STAGEHANDSLOAINACTUAL'];
				$data[$x]["STAGEHANDSLOADOUTACTUAL"] = $resultSet['STAGEHANDSLOADOUTACTUAL'];
				$data[$x]["STAGEHANDSRUNNINGACTUAL"] = $resultSet['STAGEHANDSRUNNINGACTUAL'];
				$data[$x]["WARDROBELOADINACTUAL"] = $resultSet['WARDROBELOADINACTUAL'];
				$data[$x]["WARDROBELOADOUTACTUAL"] = $resultSet['WARDROBELOADOUTACTUAL'];
				$data[$x]["WARDROBERUNNINGACTUAL"] = $resultSet['WARDROBERUNNINGACTUAL'];
				$data[$x]["LABORCATERING"] = $resultSet['LABORCATERING'];
				$data[$x]["MUSICIANS"] = $resultSet['MUSICIANS'];
				$data[$x]["INSURANCE"] = $resultSet['INSURANCE'];
				$data[$x]["TICKETPRINTING"] = $resultSet['TICKETPRINTING'];
				$data[$x]["OTHER"] = $resultSet['OTHER'];
				$data[$x]["ADAEXPENSES"] = $resultSet['ADAEXPENSES'];
				$data[$x]["BOXOFFICE"] = $resultSet['BOXOFFICE'];
				$data[$x]["DRYICE"] = $resultSet['DRYICE'];
				$data[$x]["HOSPITALITY"] = $resultSet['HOSPITALITY'];
				$data[$x]["HOUSESTAFF"] = $resultSet['HOUSESTAFF'];
				$data[$x]["LICENSES"] = $resultSet['LICENSES'];
				$data[$x]["LIMOS"] = $resultSet['LIMOS'];
				$data[$x]["PIANO"] = $resultSet['PIANO'];
				$data[$x]["POLICESECURITY"] = $resultSet['POLICESECURITY'];
				$data[$x]["PRESENTERPROFIT"] = $resultSet['PRESENTERPROFIT'];
				$data[$x]["PRESSAGENTFEE"] = $resultSet['PRESSAGENTFEE'];
				$data[$x]["PROGRAMS"] = $resultSet['PROGRAMS'];
				$data[$x]["RENT"] = $resultSet['RENT'];
				$data[$x]["SOUND"] = $resultSet['SOUND'];
				$data[$x]["TELEPHONES"] = $resultSet['TELEPHONES'];
				$data[$x]["EQUIPMENTRENTAL"] = $resultSet['EQUIPMENTRENTAL'];
				$data[$x]["OTHERDACTUAL"] = $resultSet['OTHERDACTUAL'];
				$data[$x]["OTHEREACTUAL"] = $resultSet['OTHEREACTUAL'];
				$data[$x]["OTHERFACTUAL"] = $resultSet['OTHERFACTUAL'];
				$data[$x]["OTHERGACTUAL"] = $resultSet['OTHERGACTUAL'];
				$data[$x]["LOCALFIX"] = $resultSet['LOCALFIX'];
				$data[$x]["LESSINCOMETAXES1"] = $resultSet['LESSINCOMETAXES1'];
				$data[$x]["CITYNAME"] = $resultSet['city'];
				$data[$x]["STATENAME"] = $resultSet['state'];
				$data[$x]["COUNTRYNAME"] = $resultSet['country'];
				$data[$x]["CITYID"] = $resultSet['CITYID'];
				$data[$x]["STATEID"] = $resultSet['STATEID'];
				$data[$x]["COUNTRYID"] = $resultSet['COUNTRYID'];				

				$x++;			
			}

		}catch (Exception $e) {
			$data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}
	}

	public static function getAnalysisByContracts($inid,$endd,$country,$state,$city,$show,$venues){

		try{

			$query = "SELECT co.ContractID AS ID, co.ShowID AS SHOWID, sw.ShowNAME, ve.VenueName, 
						DATE_FORMAT(co.ContractOPENING_DATE, '%m/%d/%Y') as OPENINGDATE, 
						DATE_FORMAT(co.ContractCLOSING_DATE, '%m/%d/%Y') as CLOSINGDATE, 
						co.ContractOPENING_DATE as OPENINGDATE2, 
						co.ContractCLOSING_DATE as CLOSINGDATE2, 	
						ROUND(DATEDIFF(co.ContractCLOSING_DATE,co.ContractOPENING_DATE)/7,2) AS NUMBEROFWEEKS, 
						co.ContractNUMBER_OF_PERFORMANCES AS NUMBEROFPERFORMANCES, 
						co.ContractGROSS_POTENTIAL AS GROSSBOXOFFICEPOTENTIAL, 
						1 AS EXCHANGERATE, 
						co.ContractSALES_TAX_1 AS SALESTAX1, 
						co.ContractSALES_TAX_2 AS SALESTAX2, 
						co.ContractFACILITY_FEES_1 AS FACILITYFEE1, 
						co.ContractFACILITY_FEES_2 AS FACILITYFEE2, 
						co.ContractSUBSCRIPTION_COMISSION AS SUBSCRIPTIONCOMMISION, 
						co.ContractGROUP_COMISSION AS GROUPSALESCOMMISION, 
						co.ContractCREDIT_CARD_COMISSION AS CREDITCARDCOMMISION, 
						co.ContractGUARANTEE AS GUARANTEE, 
						co.ContractVARIABLE_GUARANTEE AS VARIABLEGUARANTEE, 
						co.ContractTAX AS LESSINCOMETAXES1, 
						ci.`name` as city, st.`name` as state, cou.sortname as country, 
						ci.id as CITYID, st.id as STATEID, cou.id as COUNTRYID 
						FROM contracts co, shows sw, cities ci, states st, countries cou, venues ve  
						WHERE co.ShowID = sw.ShowID 
						AND co.ContractVENUEID = ve.VenueID 
						AND ve.VenueCITYID = ci.id 
						AND ci.state_id = st.id 
						AND st.country_id = cou.id";

			$filter1 = "
					AND ve.VenueCITYID like ('$city') 
					AND co.ShowID = $show 
					AND co.ContractOPENING_DATE >= '$inid' 
					AND co.ContractCLOSING_DATE <= '$endd' 
					AND co.ContractVENUEID IN ('$venues') 
					ORDER BY co.ContractOPENING_DATE DESC 
					LIMIT 4";

			$filter2 = "
					AND ve.VenueCITYID like ('$city') 
					AND co.ShowID = $show 
					ORDER BY co.ContractOPENING_DATE DESC 
					LIMIT 4";

			$filter3 = "
					AND st.id like ('$state') 
					AND co.ShowID = $show 
					ORDER BY co.ContractOPENING_DATE DESC 
					LIMIT 4";

			self::$sql = $query.$filter1;

			self::$result = dbconfig::run(self::$sql);
			if(!self::$result) {
				throw new exception("Contracts not found.");
			}

			$count = dbconfig::num_rows(self::$result);
			if($count == 0){

				self::$sql = $query.$filter2;

				self::$result = dbconfig::run(self::$sql);
				if(!self::$result) {
					throw new exception("Contracts not found.");
				}

				$count = dbconfig::num_rows(self::$result);

				if($count == 0){
					self::$sql = $query.$filter3;

					self::$result = dbconfig::run(self::$sql);
					if(!self::$result) {
						throw new exception("Contracts not found.");
					}

				}
			}

			$data = array();
			$x = 0;

			while($resultSet = mysqli_fetch_assoc(self::$result)) {

				$numberofweeks = ceil($resultSet['NUMBEROFWEEKS']);
				$numberofshowsperweek = $resultSet['NUMBEROFPERFORMANCES'] / $numberofweeks;
				$weeklygross = $resultSet['GROSSBOXOFFICEPOTENTIAL'] / $numberofweeks;

				$data[$x]["ID"] = $resultSet['ID'];
				$data[$x]["SHOWID"] = $resultSet['SHOWID'];
				$data[$x]["SHOWNAME"] = $resultSet['ShowNAME'];
				$data[$x]["VENUENAME"] = $resultSet['VenueName'];
				$data[$x]["NUMBEROFWEEKS"] = ceil($resultSet['NUMBEROFWEEKS']);
				$data[$x]["OPENINGDATE"] = $resultSet['OPENINGDATE'];
				$data[$x]["CLOSINGDATE"] = $resultSet['CLOSINGDATE'];		
				$data[$x]["OPENINGDATE_SF"] = $resultSet['OPENINGDATE1'];
				$data[$x]["CLOSINGDATE_SF"] = $resultSet['CLOSINGDATE2'];	
				$data[$x]["NUMBEROFSHOWSPERWEEKS"] = round($numberofshowsperweek);
				$data[$x]["WEEKLYGROSSPOTENTIAL"] = round($weeklygross,2);
				$data[$x]["EXCHANGERATE"] = $resultSet['EXCHANGERATE'];
				$data[$x]["SALESTAX1"] = $resultSet['SALESTAX1'];
				$data[$x]["SALESTAX2"] = $resultSet['SALESTAX2'];
				$data[$x]["FACILITYFEE1"] = $resultSet['FACILITYFEE1'];
				$data[$x]["FACILITYFEE2"] = $resultSet['FACILITYFEE2'];
				$data[$x]["SUBSCRIPTIONCOMMISION"] = $resultSet['SUBSCRIPTIONCOMMISION'];
				$data[$x]["GROUPSALESCOMMISION"] = $resultSet['GROUPSALESCOMMISION'];
				$data[$x]["CREDITCARDCOMMISION"] = $resultSet['CREDITCARDCOMMISION'];
				$data[$x]["GUARANTEE"] = $resultSet['GUARANTEE'];
				$data[$x]["VARIABLEGUARANTEE"] = $resultSet['VARIABLEGUARANTEE'];
				$data[$x]["LESSINCOMETAXES1"] = $resultSet['LESSINCOMETAXES1'];
				$data[$x]["CITYNAME"] = $resultSet['city'];
				$data[$x]["STATENAME"] = $resultSet['state'];
				$data[$x]["COUNTRYNAME"] = $resultSet['country'];
				$data[$x]["CITYID"] = $resultSet['CITYID'];
				$data[$x]["STATEID"] = $resultSet['STATEID'];
				$data[$x]["COUNTRYID"] = $resultSet['COUNTRYID'];					

				$x++;			
			}

		}catch (Exception $e) {
			$data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}
	}

	public static function getAnalysisByRoutes($inid,$endd,$country,$state,$city,$show,$venues){

		try{

			$query = "SELECT ro.ROUTESID AS ID, rd.ROUTES_DETID AS DET_ID, ro.SHOWID AS SHOWID, 
							sw.ShowNAME, ve.VenueNAME, rd.CAPACITY, rd.PERF, 
							DATE_FORMAT(MIN(rd.PRESENTATION_DATE), '%m/%d/%Y') as OPENINGDATE, 
							DATE_FORMAT(MAX(rd.PRESENTATION_DATE), '%m/%d/%Y') as CLOSINGDATE, 
							MIN(rd.PRESENTATION_DATE) as OPENINGDATE2, 
							MAX(rd.PRESENTATION_DATE) as CLOSINGDATE2, 
							ROUND(DATEDIFF(MAX(rd.PRESENTATION_DATE),MIN(rd.PRESENTATION_DATE)) / 7, 2) AS NUMBEROFWEEKS, 
							rd.FIXED_GNTEE, rd.ROYALTY, 
							ci.`name` as city, st.`name` as state, cou.sortname as country, 
							ci.id as CITYID, st.id as STATEID, cou.id as COUNTRYID 
						FROM routes ro, routes_det rd, shows sw, cities ci, states st, countries cou, venues ve  
						WHERE ro.ROUTESID = rd.ROUTESID 
						AND ro.ShowID = sw.ShowID 
						AND rd.VENUEID = ve.VenueID 
						AND ve.VenueCITYID = ci.id 				
						AND ci.state_id = st.id 
						AND st.country_id = cou.id 
						AND ci.id like ('$city') 
						AND ro.SHOWID = $show 
						AND rd.PRESENTATION_DATE >= '$inid' 
						AND rd.PRESENTATION_DATE <= '$endd' 
						AND rd.VENUEID IN ('$venues') 
						GROUP BY ID";

			self::$result = dbconfig::run($query);
			if(!self::$result) {
				throw new exception("Contracts not found.");
			}

			$data = array();
			$x = 0;

			$count = dbconfig::num_rows(self::$result);

			if($count > 0){

				while($resultSet = mysqli_fetch_assoc(self::$result)) {

					$numberofweeks = ceil($resultSet['NUMBEROFWEEKS']);
					$numberofshowsperweek = $resultSet['PERF'] / $numberofweeks;

					$data[$x]["ID"] = $resultSet['ID'];
					$data[$x]["DET_ID"] = $resultSet['DET_ID'];
					$data[$x]["SHOWID"] = $resultSet['SHOWID'];
					$data[$x]["SHOWNAME"] = $resultSet['ShowNAME'];
					$data[$x]["VENUENAME"] = $resultSet['VenueNAME'];
					$data[$x]["NUMBEROFWEEKS"] = ceil($resultSet['NUMBEROFWEEKS']);
					$data[$x]["OPENINGDATE"] = $resultSet['OPENINGDATE'];
					$data[$x]["CLOSINGDATE"] = $resultSet['CLOSINGDATE'];
					$data[$x]["OPENINGDATE_SF"] = $resultSet['OPENINGDATE1'];
					$data[$x]["CLOSINGDATE_SF"] = $resultSet['CLOSINGDATE2'];
					$data[$x]["NUMBEROFSHOWSPERWEEKS"] = round($numberofshowsperweek);
					$data[$x]["EXCHANGERATE"] = 1;
					$data[$x]["CAPACITY"] = $resultSet['CAPACITY'];
					$data[$x]["PERF"] = $resultSet['PERF'];
					$data[$x]["FIXED_GNTEE"] = $resultSet['FIXED_GNTEE'];
					$data[$x]["ROYALTY"] = $resultSet['ROYALTY'];
					$data[$x]["CITYNAME"] = $resultSet['city'];
					$data[$x]["STATENAME"] = $resultSet['state'];
					$data[$x]["COUNTRYNAME"] = $resultSet['country'];
					$data[$x]["CITYID"] = $resultSet['CITYID'];
					$data[$x]["STATEID"] = $resultSet['STATEID'];
					$data[$x]["COUNTRYID"] = $resultSet['COUNTRYID'];						

					$x++;			
				}

			}

		}catch (Exception $e) {
			$data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}
	}		

}

?>
