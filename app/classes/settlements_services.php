<?php
/*
* Author: Rohit Kumar
* Website: iamrohit.in
* Version: 0.0.1
* Date: 25-04-2015
* App Name: Php+ajax country state city dropdown
* Description: A simple oops based php and ajax country state city dropdown list
*/
require_once('../db/dbconfig.php');
class settlementsServices extends dbconfig {
   
   public static $data;
   function __construct() {
     parent::__construct();
   }
 
 // Fetch all countries list
   public static function getShows() {
     try {
       $query = "SELECT showid, showname FROM shows WHERE showactive = 'Y'";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Show not found.");
       }
       $res = array();
       while($resultSet = mysqli_fetch_assoc($result)) {
        $res[$resultSet['showid']] = $resultSet['showname'];
       }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Shows fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

 // Fetch all countries list
   public static function getVenues() {
     try {
       $query = "SELECT venueid, venuename FROM venues WHERE venueactive = 'Y'";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Venue not found.");
       }
       $res = array();
       while($resultSet = mysqli_fetch_assoc($result)) {
        $res[$resultSet['venueid']] = $resultSet['venuename'];
       }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Venues fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

    // Fetch all countries list
   public static function getCountries() {
     try {
       $query = "SELECT id, name FROM countries";
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Country not found.");
       }
       $res = array();
       while($resultSet = mysqli_fetch_assoc($result)) {
        $res[$resultSet['id']] = $resultSet['name'];
       }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Countries fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

   // Fetch all states list by country id
  public static function getStates($countryId) {
     try {
       $query = "SELECT id, name FROM states WHERE country_id=".$countryId;
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("State not found.");
       }
       $res = array();
       while($resultSet = mysqli_fetch_assoc($result)) {
        $res[$resultSet['id']] = $resultSet['name'];
       }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"States fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

    // Fetch all cities list by state id
  public static function getCities($stateId) {
     try {
       $query = "SELECT id, name FROM cities WHERE state_id=".$stateId;
       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("City not found.");
       }
       $res = array();
       while($resultSet = mysqli_fetch_assoc($result)) {
        $res[$resultSet['id']] = $resultSet['name'];
       }
       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Cities fetched successfully.", 'result'=>$res);
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

  public static function getGlobalLocation($cityId){
    try {

      $query = "SELECT ci.`id` as city, st.`id` as state, co.`id` as country 
              FROM cities ci, states st, countries co 
              WHERE ci.`id` = $cityId 
              AND ci.state_id = st.`id` 
              AND st.country_id = co.`id`";
      $result = dbconfig::run($query);

      if(!$result) {
        throw new exception("Data not found.");
      }

      $res = array();
      $resultSet = mysqli_fetch_assoc($result);

      $res["cityid"] = $resultSet['city'];
      $res["stateid"] = $resultSet['state'];
      $res["countryid"] = $resultSet['country'];

      $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Data fetched successfully.", 'result'=>$res);

    } catch (Exception $e) {
      $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
    } finally {
      return $data;
    }
  }

  // Fetch all countries list
  public static function getCityOfVenues($venueID) {
      try {

        $query = "SELECT s.`name` as statename, c.`name` as cityname, c.id as cityid 
                  FROM states s, cities c, venues ve 
                  WHERE ve.VenueID = $venueID 
                  AND ve.VenueCITYID = c.id 
                  AND c.state_id = s.id";
        $result = dbconfig::run($query);

        if(!$result) {
         throw new exception("Cities not found.");
        }

        $res = array();

        $resultSet = mysqli_fetch_assoc($result);
        $res["statename"] = $resultSet['statename'];
        $res["cityname"] = $resultSet['cityname'];
        $res["cityid"] = $resultSet['cityid'];

       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Venues fetched successfully.", 'result'=>$res);
       
      } catch (Exception $e) {
        $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
      } finally {
        return $data;
      }
    } 

   // Fetch all countries list
   public static function getDataOfSettlements($settlementID) {
     try {
       $query = "SELECT se.SettlementID, 
                        sd.SettlementDETAIL_ID, sd.ShowID, sw.ShowNAME, ve.VenueID, ve.VenueNAME, 
                        se.SettlementCITYID as CityID, se.SettlementOPENING_DATE,
                        se.SettlementCLOSING_DATE, sd.NumberPerformances, 
                        sd.GrossPotential as GrossPotential,
                        sd.ActualGross as ActualGross, sd.TicketsSold as TicketsSold,
                        sd.TicketsCompd as TicketsCompd, sd.Subscriptions as Subscriptions,
                        sd.Tax as Tax, sd.SubscriptionComm as SubscriptionComm,
                        sd.PhoneComm as PhoneComm, sd.InternetComm as InternetComm,
                        sd.CreditCardComm as CreditCardComm, sd.RemotesComm as RemotesComm,
                        sd.GroupSalesComm as GroupSalesComm, sd.Overage as Overage,
                        sd.Advertising as Advertising, sd.InsuranceTicket as InsuranceTicket,
                        sd.TotalTicketInsurance as TotalTicketInsurance, sd.Catering as Catering,
                        sd.Catering2 as Catering2, sd.StageHands as StageHands,
                        sd.Musicians as Musicians, sd.WardrobeHair as WardrobeHair,
                        sd.TicketPrint as TicketPrint, sd.TotalTicketPrint as TotalTicketPrint,
                        sd.OtherDocumentedExpense as OtherDocumentedExpense, 
                        sd.TotalDocumentedExpense as TotalDocumentedExpense,
                        sd.ADAExpense as ADAExpense, sd.BoxOffice as BoxOffice,
                        sd.Cleaning as Cleaning, sd.DirectMail as DirectMail,
                        sd.EquipmentRental as EquipmentRental, sd.GroupSales as GroupSales,
                        sd.HousemanTD as HousemanTD, sd.HouseStaff as HouseStaff,
                        sd.LeagueFees as LeagueFees, sd.LicensesPermits as LicensesPermits,
                        sd.LimosAutos as LimosAutos, sd.Miscellaneous as Miscellaneous,
                        sd.PresenterProfit as PresenterProfit, 
                        sd.PoliceSecurity as PoliceSecurity,
                        sd.Programs as Programs, sd.PublicRelations as PublicRelations,
                        sd.Rent as Rent, sd.Soundlights as Soundlights,
                        sd.TicketPrinting as TicketPrinting, sd.Phones as Phones,
                        sd.OtherVariableExpenses as OtherVariableExpenses,
                        sd.LocalFixedExpenses as LocalFixedExpenses, 
                        sd.TotalFixedExpenses as TotalFixedExpenses,
                        sd.TotalPresenterExpense as TotalPresenterExpense, 
                        sd.TotalRestorationCharge as TotalRestorationCharge,
                        sd.Breakeven as Breakeven, 
                        ci.`name` as city, 
                        st.`name` as state, 
                        co.sortname as country
                  FROM settlements_details sd, settlements se, shows sw, venues ve, cities ci, states st, countries co 
                  WHERE se.SettlementID = $settlementID 
                  AND se.SettlementID = sd.SettlementID 
                  AND se.SettlementShowID = sw.ShowID 
                  AND se.SettlementVENUEID = ve.VenueID 
                  AND se.SettlementCITYID = ci.id 
                  AND ci.state_id = st.id 
                  AND st.country_id = co.id";

       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Settlement not found.");
       }
       $res = array();

       $resultSet = mysqli_fetch_assoc($result);
       $res["settlementid"] = $resultSet['SettlementID'];
       $res["settlement_detailid"] = $resultSet['SettlementDETAIL_ID'];
       $res["showid"] = $resultSet['ShowID'];
       $res["show_name"] = $resultSet['ShowNAME'];
       $res["venueid"] = $resultSet['VenueID'];
       $res["venue_name"] = $resultSet['VenueNAME'];
       $res["opening_date"] = $resultSet['SettlementOPENING_DATE'];
       $res["closing_date"] = $resultSet['SettlementCLOSING_DATE'];
       $res["num_performances"] = $resultSet['NumberPerformances'];
       $res["gross_potential"] = $resultSet['GrossPotential'];
       $res["actual_gross"] = $resultSet['ActualGross'];
       $res["tickets_sold"] = $resultSet['TicketsSold'];
       $res["tickets_compd"] = $resultSet['TicketsCompd'];
       $res["subsc"] = $resultSet['Subscriptions'];
       $res["tax"] = $resultSet['Tax'];
       $res["subsc_com"] = $resultSet['SubscriptionComm'];
       $res["phone_com"] = $resultSet['PhoneComm'];
       $res["int_com"] = $resultSet['InternetComm'];
       $res["cc_com"] = $resultSet['CreditCardComm'];
       $res["remotes_com"] = $resultSet['RemotesComm'];
       $res["group_sales_com"] = $resultSet['GroupSalesComm'];
       $res["overage"] = $resultSet['Overage'];
       $res["advertising"] = $resultSet['Advertising'];
       $res["insurance_ticket"] = $resultSet['InsuranceTicket'];
       $res["total_insurance"] = $resultSet['TotalTicketInsurance'];
       $res["catering"] = $resultSet['Catering'];
       $res["catering2"] = $resultSet['Catering2'];
       $res["stage_hands"] = $resultSet['StageHands'];
       $res["musicians"] = $resultSet['Musicians'];
       $res["wardrobe_hair"] = $resultSet['WardrobeHair'];
       $res["ticket_print"] = $resultSet['TicketPrint'];
       $res["total_ticket_print"] = $resultSet['TotalTicketPrint'];
       $res["other_doc_expenses"] = $resultSet['OtherDocumentedExpense'];
       $res["total_doc_expenses"] = $resultSet['TotalDocumentedExpense'];
       $res["ada"] = $resultSet['ADAExpense'];
       $res["box_office"] = $resultSet['BoxOffice'];
       $res["cleaning"] = $resultSet['Cleaning'];
       $res["direct_mail"] = $resultSet['DirectMail'];
       $res["equipment_rental"] = $resultSet['EquipmentRental'];
       $res["group_sales"] = $resultSet['GroupSales'];
       $res["houseman"] = $resultSet['HousemanTD'];
       $res["house_staff"] = $resultSet['HouseStaff'];
       $res["league_fees"] = $resultSet['LeagueFees'];
       $res["licenses_permit"] = $resultSet['LicensesPermits'];
       $res["limos_autos"] = $resultSet['LimosAutos'];
       $res["miscellaneous"] = $resultSet['Miscellaneous'];
       $res["presenter_profit"] = $resultSet['PresenterProfit'];
       $res["police_sec"] = $resultSet['PoliceSecurity'];
       $res["programs"] = $resultSet['Programs'];
       $res["public_relations"] = $resultSet['PublicRelations'];
       $res["rent"] = $resultSet['Rent'];
       $res["sound_lights"] = $resultSet['Soundlights'];
       $res["ticket_printing"] = $resultSet['TicketPrinting'];
       $res["phones"] = $resultSet['Phones'];
       $res["other_expenses"] = $resultSet['OtherVariableExpenses'];
       $res["local_expenses"] = $resultSet['LocalFixedExpenses'];
       $res["total_expenses"] = $resultSet['TotalFixedExpenses'];
       $res["total_presenter"] = $resultSet['TotalPresenterExpense'];
       $res["total_restoration"] = $resultSet['TotalRestorationCharge'];
       $res["breakeven"] = $resultSet['Breakeven'];
       $res["cityid"] = $resultSet['CityID'];
       $res["cityname"] = $resultSet['city'];
       $res["statename"] = $resultSet['state'];
       $res["countryname"] = $resultSet['country'];

       $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Settlement fetched successfully.", 'result'=>$res);
       
     } catch (Exception $e) {
       $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
     } finally {
        return $data;
     }
   }

   public static function processUploadFile($dataFileName){
      try {

        //import library
        require_once '../libs/PHPExcel/IOFactory.php';

        $uploadOk = 1;
        $target_dir = "../uploads/";
        $imageFileType = strtolower(pathinfo($dataFileName['name'],PATHINFO_EXTENSION));
        $target_file = $target_dir . basename($dataFileName['name']);

        //Verify extension File
        if($imageFileType != "xls" && $imageFileType != "xlsx" && 
          $imageFileType != "ods" && $imageFileType != "csv" ) {

            $message = "Sorry, only XLS, XLSX, ODS & CSV files are allowed.";
            $uploadOk = 0;

            $data = array('status'=>'error', 'tp'=>$uploadOk, 'msg'=>$message, 'result'=>null);

        }else{
          //Verify Size File < 50MB
          if ($dataFileName['size'] > 50000000) {
            $message = "Sorry, your file is too large.";
            $uploadOk = 0;

            $data = array('status'=>'error', 'tp'=>$uploadOk, 'msg'=>$message, 'result'=>null);
          }else{

            if (file_exists($target_file)) {
                $message = "Sorry, file already exists.";
                $uploadOk = 0;

                $data = array('status'=>'error', 'tp'=>$uploadOk, 'msg'=>$message, 'result'=>null);
            }else{

              if ($uploadOk == 0) {
                $message = "Sorry, your file was not uploaded.";
                $uploadOk = 0;
                // if everything is ok, try to upload file
              }else{
                //move file to target directory
                if(move_uploaded_file($dataFileName["tmp_name"], $target_file)){

                  $objPHPExcel = PHPExcel_IOFactory::load($target_file);

                  //Set up all the variables from the Excel Spreadsheet
                  $ShowName = $objPHPExcel->getSheet(2)->getCell('A1')->getCalculatedValue();
                  $CityState = $objPHPExcel->getSheet(2)->getCell('A2')->getCalculatedValue();
                  $Venue = $objPHPExcel->getSheet(2)->getCell('A3')->getCalculatedValue();
                  $OpeningDate = $objPHPExcel->getSheet(0)->getCell('A8')->getValue();
                  $OD = date($format = "Y-m-d", PHPExcel_Shared_Date::ExceltoPHP($OpeningDate));
                  $ClosingDate = $objPHPExcel->getSheet(0)->getCell('B8')->getValue();
                  $CD = date($format = "Y-m-d", PHPExcel_Shared_Date::ExceltoPHP($ClosingDate));

                  $numberperformances = $objPHPExcel->getSheet(0)->getCell('C8')->getValue();
                  $subscription_com = $objPHPExcel->getSheet(1)->getCell('B16')->getValue();
                  $phone_com = $objPHPExcel->getSheet(1)->getCell('B17')->getValue();
                  $internet_com = $objPHPExcel->getSheet(1)->getCell('B18')->getValue();
                  $cc_com = $objPHPExcel->getSheet(1)->getCell('B19')->getValue();
                  $remotes_com = $objPHPExcel->getSheet(1)->getCell('B20')->getValue();
                  $group_sales_com = $objPHPExcel->getSheet(1)->getCell('B22')->getValue();

                  $GrossPotential = $objPHPExcel->getSheet(2)->getCell('E8')->getCalculatedValue();
                  $ActualGross = $objPHPExcel->getSheet(2)->getCell('E10')->getCalculatedValue();
                  $TotalAllowableExpenses = $objPHPExcel->getSheet(2)->getCell('D26')->getCalculatedValue();
                  $NAGBOR = $objPHPExcel->getSheet(2)->getCell('E28')->getCalculatedValue();
                  $TotalCompanyRoyalty = $objPHPExcel->getSheet(2)->getCell('D33')->getCalculatedValue();
                  $TotalCompanyGuarantee = $objPHPExcel->getSheet(2)->getCell('D36')->getCalculatedValue();
                  $SubtotalCompanyCompensation = $objPHPExcel->getSheet(2)->getCell('D38')->getCalculatedValue();
                  $VariableExpenseBudgeted = $objPHPExcel->getSheet(2)->getCell('C54')->getCalculatedValue();
                  $VariableExpenseActual = $objPHPExcel->getSheet(2)->getCell('D54')->getCalculatedValue();
                  $LocalExpenseBudgeted = $objPHPExcel->getSheet(2)->getCell('C77')->getCalculatedValue();
                  $LocalExpenseActual = $objPHPExcel->getSheet(2)->getCell('D77')->getCalculatedValue();
                  $TotalLocalExpenseBudgeted = $objPHPExcel->getSheet(2)->getCell('C78')->getCalculatedValue();
                  $TotalLocalExpenseActual = $objPHPExcel->getSheet(2)->getCell('D78')->getCalculatedValue();
                  $TotalEngagementExpenses = $objPHPExcel->getSheet(2)->getCell('E79')->getCalculatedValue();
                  $MoneyRemaining = $objPHPExcel->getSheet(2)->getCell('E81')->getCalculatedValue();
                  $TotalCompanyPercentage = $objPHPExcel->getSheet(2)->getCell('D92')->getCalculatedValue();
                  $PresenterPercentage = $objPHPExcel->getSheet(2)->getCell('D96')->getCalculatedValue();
                  $TotalCompanyShare = $objPHPExcel->getSheet(2)->getCell('E98')->getCalculatedValue();
                  $LessDirectCompanyCharges = $objPHPExcel->getSheet(2)->getCell('E99')->getCalculatedValue();
                  $AdjustedCompanyShare = $objPHPExcel->getSheet(2)->getCell('E100')->getCalculatedValue();
                  $TotalPresenterShare = $objPHPExcel->getSheet(2)->getCell('E102')->getCalculatedValue();
                  $PresenterFacilityFee = $objPHPExcel->getSheet(2)->getCell('E103')->getCalculatedValue();
                  $AdjustedPresenterShare = $objPHPExcel->getSheet(2)->getCell('E104')->getCalculatedValue();
                  $TotalSharesEqual = $objPHPExcel->getSheet(2)->getCell('E106')->getCalculatedValue();

                  //Free Memory
                  $objPHPExcel->disconnectWorksheets();
                  unset($objPHPExcel);

                  $res = array();

                  $res["opening_date"] = $OD;
                  $res["closing_Date"] = $CD;
                  $res["numberperformances"] = $numberperformances;
                  $res["subscription_com"] = $subscription_com;
                  $res["phone_com"] = $phone_com;
                  $res["internet_com"] = $internet_com;
                  $res["cc_com"] = $cc_com;
                  $res["remotes_com"] = $remotes_com;
                  $res["group_sales_com"] = $group_sales_com;
                  $res["gross_potential"] = $GrossPotential;
                  $res["actual_gross"] = $ActualGross;
                  $res["total_allowable_expenses"] = $TotalAllowableExpenses;
                  $res["nagbor"] = $NAGBOR;
                  $res["royality"] = $TotalCompanyRoyalty;
                  $res["guarantee"] = $TotalCompanyGuarantee;
                  $res["st_company_compensation"] = $SubtotalCompanyCompensation;
                  $res["expense_budgeted"] = $VariableExpenseBudgeted;
                  $res["expense_actual"] = $VariableExpenseActual;
                  $res["local_expense_budgeted"] = $LocalExpenseBudgeted;
                  $res["local_expense_actual"] = $LocalExpenseActual;
                  $res["total_local_expense_budgeted"] = $TotalLocalExpenseBudgeted;
                  $res["total_local_expense_actual"] = $TotalLocalExpenseActual;
                  $res["total_engagement_expenses"] = $TotalEngagementExpenses;
                  $res["money_remaining"] = $MoneyRemaining;
                  $res["total_company_percentage"] = $TotalCompanyPercentage;
                  $res["presenter_persentage"] = $PresenterPercentage;
                  $res["total_company_share"] = $TotalCompanyShare;
                  $res["less_direct_company_charges"] = $LessDirectCompanyCharges;
                  $res["adjusted_company_share"] = $AdjustedCompanyShare;
                  $res["total_presenter_share"] = $TotalPresenterShare;
                  $res["presenter_facility_fee"] = $PresenterFacilityFee;
                  $res["adjusted_presenter_share"] = $AdjustedPresenterShare;
                  $res["total_shares_equal"] = $TotalSharesEqual;

                  $data = array('status'=>'success', 'tp'=>$uploadOk, 'msg'=>'SpreadSheet Upload Successfully', 'result'=>$res);
                }
              }
            }
          }
        }

      } catch (Exception $e) {
        $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
      } finally {
        return $data;
      }
   }

   private static function checkFileSize($size){
      $res = array();
      // Check file size
      if ($size > 50000000) {
          $res["msg"] = "Sorry, your file is too large.";
          $res["ok"] = 0;
      }else{
         $res["msg"] = "Size permit's.";
         $res["ok"] = 1;
      }

      return $res;
   }

   private static function checkName($name_file){
      $res_name = array();

      $res_name["msg"] = $name_file;
      $res_name["ok"] = 1;

      return $res_name;
   }
}