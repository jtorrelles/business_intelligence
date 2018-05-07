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
       $query = "SELECT se.ID, se.SHOWID, sw.ShowNAME, se.CITYID, se.VENUEID, ve.VenueNAME, 
                        OPENINGDATE,CLOSINGDATE,DROPCOUNT,PAIDATTENDANCE,COMPS,TOTALATTENDANCE, 
                        CAPACITY,GROSSSUBSCRIPTIONSALES,GROSSPHONESALES,GROSSINTERNETSALES,
                        GROSSCREDITCARDSALES,GROSSREMOTEOUTLETSALES,GROSSSINGLETIX, 
                        GROSSGROUPSALES1,GROSSGROUPSALES2,GROSSGOLDSTARPERCENTAGE,GROSSGROUPONPERCENTAGE,
                        GROSSTRAVELOOPERCENTAGE,GROSSLIVINGSOCIALPERCENTAGE,GROSSOTHERPERCENTAGE,GROSSOTHERAMOUNT,
                        TTLSUBDISCOUNT,TTLGROUPDISCOUNT1,TTLGROUPDISCOUNT2,TOTALDISCOUNTS,TTLCOMPTICKETCOST, 
                        DEMANDPRICING,NUMBEROFPERFORMANCES,TOPTICKETPRICE,USCANADIANEXCHANGERATE,
                        GROSSBOXOFFICEPOTENTIAL,GROSSBOXOFFICERECEIPTS,GROSSBOXOFFICEPERCENTAGEOFPOTENTIAL,
                        TAX1PERCENTAGE,TAX1AMOUNT,TAX2PERCENTAGE,TAX2AMOUNT,FACILITYPERCENTAGE,FACILITYAMOUNT,
                        SUBSCRIPTIONSALESCOMMPERCENTAGE,SUBSCRIPTIONSALESCOMMAMOUNT,PHONESALESCOMMPERCENTAGE,
                        PHONESALESCOMMAMOUNT,INTERNETSALESCOMMPERCENTAGE,INTERNETSALESCOMMAMOUNT,
                        CREDITCARDSALESCOMMPERCENTAGE,CREDITCARDSALESCOMMAMOUNT,REMOTESALESCOMMPERCENTAGE,
                        REMOTESALESCOMMAMOUNT,SINGLETIXPERCENTAGE,SINGLETIXAMOUNT,GROUPSALESCOMM1PERCENTAGE, 
                        GROUPSALESCOMM1AMOUNT,GROUPSALESCOMM2PERCENTAGE,GROUPSALESCOMM2AMOUNT,GOLDSTARPERCENTAGE, 
                        GOLDSTARAMOUNT,GROUPONPERCENTAGE,GROUPONAMOUNT,TRAVELZOOPERCENTAGE,TRAVELZOOAMOUNT,
                        LIVINGSOCIALPERCENTAGE,LIVINGSOCIALAMOUNT,OTHERAPERCENTAGE,OTHERAAMOUNT,OTHERBPERCENTAGE, 
                        OTHERBAMOUNT,TOTALALLOWABLEBOEXPENSES,DEDUCTIONSOFGBOR,NAGBOR,NETCOMPANYROYALTY,
                        TAXWITHHELDATSOURCE,TOTALCOMPANYROYALTY,TOTALCOMPANYGUARANTEE,LESSOTHERDEDUCTION, 
                        INSURANCEPERTICKET,TICKETPRINTING1PERTICKET,ADVERTISINGBUDGETED,ADVERTISINGACTUAL,
                        STAGEHANDSLOAINBUDGETED,STAGEHANDSLOAINACTUAL,STAGEHANDSLOADOUTBUDGETED,
                        STAGEHANDSLOADOUTACTUAL,STAGEHANDSRUNNINGBUDGETED,STAGEHANDSRUNNINGACTUAL,
                        WARDROBELOADINBUDGETED,WARDROBELOADINACTUAL,WARDROBELOADOUTBUDGETED,WARDROBELOADOUTACTUAL, 
                        WARDROBERUNNINGBUDGETED,WARDROBERUNNINGACTUAL,LABORCATERINGBUDGETED,LABORCATERINGACTUAL,
                        MUSICIANSBUDGETED,MUSICIANSACTUAL,INSURANCEBUDGETED,INSURANCEACTUAL,TICKETPRINTING1BUDGETED, 
                        TICKETPRINTING1ACTUAL,OTHERCBUDGETED,OTHERCACTUAL,SUBTOTALVARIABLEEXPENSEBUDGETED, 
                        SUBTOTALVARIABLEEXPENSEACTUAL,ADAEXPENSEBUDGETED,ADAEXPENSEACTUAL,BOXOFFICEBUDGETED, 
                        BOXOFFICEACTUAL,HOSPITALITYBUDGETED,HOSPITALITYACTUAL,THIRDPARTYBUDGETED,THIRDPARTYACTUAL,
                        HOUSESTAFFBUDGETED,HOUSESTAFFACTUAL,LICENSESBUDGETED,LICENSESACTUAL,LIMOSAUTOBUDGETED, 
                        LIMOSAUTOACTUAL,ORCHESTRABUDGETED,ORCHESTRAACTUAL,PRESENTERPROFITBUDGETED, 
                        PRESENTERPROFITACTUAL,SECURITYBUDGETED,SECURITYACTUAL,PROGRAMBUDGETED,PROGRAMACTUAL,
                        RENTBUDGETED,RENTACTUAL,SOUNDBUDGETED,SOUNDACTUAL,TICKETPRINTING2BUDGETED, 
                        TICKETPRINTING2ACTUAL,TELEPHONESBUDGETED,TELEPHONESACTUAL,DRYICEBUDGETED,DRYICEACTUAL,
                        PRESSAGENTFEEBUDGETED,PRESSAGENTFEEACTUAL,OTHERDBUDGETED,OTHERDACTUAL,OTHEREBUDGETED, 
                        OTHEREACTUAL,OTHERFBUDGETED,OTHERFACTUAL,OTHERGBUDGETED,OTHERGACTUAL,PIANOBUDGETED, 
                        PIANOACTUAL,LOCALFIXEDBUDGETED,LOCALFIXEDACTUAL,SUBTOTALLOCALEXPENSESBUDGETED, 
                        SUBTOTALLOCALEXPENSESACTUAL,TOTALLOCALEXPENSEBUDGETED,TOTALLOCALEXPENSEACTUAL,
                        TOTALENGAGEMENTEXPENSES,MIDDLEMONIESTOCOMPANY,MIDDLEMONIESTOPRESENTER,MONEYREMAINING,
                        COMPANYOVERAGEPERCENTAGE,TOTALCOMPANYOVERAGEAMOUNT,NETSTARPERFORMEROVERAGEPERCENTAGE, 
                        TOTALSTARPERFORMEROVERAGEAMOUNT,PRESENTEROVERAGETOCOMPANY,PRESENTEROVERAGEADJUSTED, 
                        PRESENTEROVERAGETOPRESENTER,TOTALCOMPANYSHARE,LESSDIRECTCOMPANYCHARGES,ADJUSTEDCOMPANYSHARE,
                        TOTALPRESENTERSHARE, PRESENTERFACILITYFEE, ADJUSTEDPRESENTERSHARE,NOTES, 
                        ci.`name` as city, st.`name` as state, co.sortname as country
                FROM settlements se, shows sw, venues ve, cities ci, states st, countries co 
                WHERE se.ID = $settlementID  
                AND se.SHOWID = sw.ShowID 
                AND se.VENUEID = ve.VenueID 
                AND se.CITYID = ci.id 
                AND ci.state_id = st.id 
                AND st.country_id = co.id";

       $result = dbconfig::run($query);
       if(!$result) {
         throw new exception("Settlement not found.");
       }
       $res = array();

       $resultSet = mysqli_fetch_assoc($result);
       $res["se_1"] = $resultSet['ID'];
       $res["se_2"] = $resultSet['SHOWID'];
       $res["se_3"] = $resultSet['ShowNAME'];
       $res["se_4"] = $resultSet['VENUEID'];
       $res["se_5"] = $resultSet['VenueNAME'];
       $res["se_6"] = $resultSet['OPENINGDATE'];
       $res["se_7"] = $resultSet['CLOSINGDATE'];
       $res["se_8"] = $resultSet['DROPCOUNT'];
       $res["se_9"] = $resultSet['PAIDATTENDANCE'];
       $res["se_10"] = $resultSet['COMPS'];
       $res["se_11"] = $resultSet['TOTALATTENDANCE'];
       $res["se_12"] = $resultSet['CAPACITY'];
       $res["se_12_1"] = $resultSet['GROSSSUBSCRIPTIONSALES'];
       $res["se_12_2"] = $resultSet['GROSSPHONESALES'];
       $res["se_13"] = $resultSet['GROSSINTERNETSALES'];
       $res["se_14"] = $resultSet['GROSSCREDITCARDSALES'];
       $res["se_15"] = $resultSet['GROSSREMOTEOUTLETSALES'];
       $res["se_16"] = $resultSet['GROSSSINGLETIX'];
       $res["se_17"] = $resultSet['GROSSGROUPSALES1'];
       $res["se_18"] = $resultSet['GROSSGROUPSALES2'];
       $res["se_19"] = $resultSet['GROSSGOLDSTARPERCENTAGE'];
       $res["se_20"] = $resultSet['GROSSGROUPONPERCENTAGE'];
       $res["se_21"] = $resultSet['GROSSTRAVELOOPERCENTAGE'];
       $res["se_22"] = $resultSet['GROSSLIVINGSOCIALPERCENTAGE'];
       $res["se_23"] = $resultSet['GROSSOTHERPERCENTAGE'];
       $res["se_24"] = $resultSet['GROSSOTHERAMOUNT'];
       $res["se_25"] = $resultSet['TTLSUBDISCOUNT'];
       $res["se_26"] = $resultSet['TTLGROUPDISCOUNT1'];
       $res["se_27"] = $resultSet['TTLGROUPDISCOUNT2'];
       $res["se_28"] = $resultSet['TOTALDISCOUNTS'];
       $res["se_29"] = $resultSet['TTLCOMPTICKETCOST'];
       $res["se_30"] = $resultSet['DEMANDPRICING'];
       $res["se_31"] = $resultSet['NUMBEROFPERFORMANCES'];
       $res["se_32"] = $resultSet['TOPTICKETPRICE'];
       $res["se_33"] = $resultSet['USCANADIANEXCHANGERATE'];
       $res["se_34"] = $resultSet['GROSSBOXOFFICEPOTENTIAL'];
       $res["se_35"] = $resultSet['GROSSBOXOFFICERECEIPTS'];
       $res["se_36"] = $resultSet['GROSSBOXOFFICEPERCENTAGEOFPOTENTIAL'];
       $res["se_37"] = $resultSet['TAX1PERCENTAGE'];
       $res["se_38"] = $resultSet['TAX1AMOUNT'];
       $res["se_39"] = $resultSet['TAX2PERCENTAGE'];
       $res["se_40"] = $resultSet['TAX2AMOUNT'];
       $res["se_41"] = $resultSet['FACILITYPERCENTAGE'];
       $res["se_42"] = $resultSet['FACILITYAMOUNT'];
       $res["se_43"] = $resultSet['SUBSCRIPTIONSALESCOMMPERCENTAGE'];
       $res["se_44"] = $resultSet['SUBSCRIPTIONSALESCOMMAMOUNT'];
       $res["se_45"] = $resultSet['PHONESALESCOMMPERCENTAGE'];
       $res["se_46"] = $resultSet['PHONESALESCOMMAMOUNT'];
       $res["se_47"] = $resultSet['INTERNETSALESCOMMPERCENTAGE'];
       $res["se_48"] = $resultSet['INTERNETSALESCOMMAMOUNT'];
       $res["se_49"] = $resultSet['CREDITCARDSALESCOMMPERCENTAGE'];
       $res["se_50"] = $resultSet['CREDITCARDSALESCOMMAMOUNT'];
       $res["se_51"] = $resultSet['REMOTESALESCOMMPERCENTAGE'];
       $res["se_52"] = $resultSet['REMOTESALESCOMMAMOUNT'];
       $res["se_53"] = $resultSet['SINGLETIXPERCENTAGE'];
       $res["se_54"] = $resultSet['SINGLETIXAMOUNT'];
       $res["se_55"] = $resultSet['GROUPSALESCOMM1PERCENTAGE'];
       $res["se_56"] = $resultSet['GROUPSALESCOMM1AMOUNT'];
       $res["se_57"] = $resultSet['GROUPSALESCOMM2PERCENTAGE'];
       $res["se_58"] = $resultSet['GROUPSALESCOMM2AMOUNT'];
       $res["se_59"] = $resultSet['GOLDSTARPERCENTAGE'];
       $res["se_60"] = $resultSet['GOLDSTARAMOUNT'];
       $res["se_61"] = $resultSet['GROUPONPERCENTAGE'];
       $res["se_62"] = $resultSet['GROUPONAMOUNT'];
       $res["se_63"] = $resultSet['TRAVELZOOPERCENTAGE'];
       $res["se_64"] = $resultSet['TRAVELZOOAMOUNT'];
       $res["se_65"] = $resultSet['LIVINGSOCIALPERCENTAGE'];
       $res["se_66"] = $resultSet['LIVINGSOCIALAMOUNT'];
       $res["se_67"] = $resultSet['OTHERAPERCENTAGE'];
       $res["se_68"] = $resultSet['OTHERAAMOUNT'];
       $res["se_69"] = $resultSet['OTHERBPERCENTAGE'];
       $res["se_70"] = $resultSet['OTHERBAMOUNT'];
       $res["se_71"] = $resultSet['TOTALALLOWABLEBOEXPENSES'];
       $res["se_72"] = $resultSet['DEDUCTIONSOFGBOR'];
       $res["se_73"] = $resultSet['NAGBOR'];
       $res["se_74"] = $resultSet['NETCOMPANYROYALTY'];
       $res["se_75"] = $resultSet['TAXWITHHELDATSOURCE'];
       $res["se_76"] = $resultSet['TOTALCOMPANYROYALTY'];
       $res["se_77"] = $resultSet['TOTALCOMPANYGUARANTEE'];
       $res["se_78"] = $resultSet['LESSOTHERDEDUCTION'];
       $res["se_79"] = $resultSet['INSURANCEPERTICKET'];
       $res["se_80"] = $resultSet['TICKETPRINTING1PERTICKET'];
       $res["se_81"] = $resultSet['ADVERTISINGBUDGETED'];
       $res["se_82"] = $resultSet['ADVERTISINGACTUAL'];
       $res["se_83"] = $resultSet['STAGEHANDSLOAINBUDGETED'];
       $res["se_84"] = $resultSet['STAGEHANDSLOAINACTUAL'];
       $res["se_85"] = $resultSet['STAGEHANDSLOADOUTBUDGETED'];
       $res["se_86"] = $resultSet['STAGEHANDSLOADOUTACTUAL'];
       $res["se_87"] = $resultSet['STAGEHANDSRUNNINGBUDGETED'];
       $res["se_88"] = $resultSet['STAGEHANDSRUNNINGACTUAL'];
       $res["se_89"] = $resultSet['WARDROBELOADINBUDGETED'];
       $res["se_90"] = $resultSet['WARDROBELOADINACTUAL'];
       $res["se_91"] = $resultSet['WARDROBELOADOUTBUDGETED'];
       $res["se_92"] = $resultSet['WARDROBELOADOUTACTUAL'];
       $res["se_93"] = $resultSet['WARDROBERUNNINGBUDGETED'];
       $res["se_94"] = $resultSet['WARDROBERUNNINGACTUAL'];
       $res["se_95"] = $resultSet['LABORCATERINGBUDGETED'];
       $res["se_96"] = $resultSet['LABORCATERINGACTUAL'];
       $res["se_97"] = $resultSet['MUSICIANSBUDGETED'];
       $res["se_98"] = $resultSet['MUSICIANSACTUAL'];
       $res["se_99"] = $resultSet['INSURANCEBUDGETED'];
       $res["se_100"] = $resultSet['INSURANCEACTUAL'];
       $res["se_101"] = $resultSet['TICKETPRINTING1BUDGETED'];
       $res["se_102"] = $resultSet['TICKETPRINTING1ACTUAL'];
       $res["se_103"] = $resultSet['OTHERCBUDGETED'];
       $res["se_104"] = $resultSet['OTHERCACTUAL'];
       $res["se_105"] = $resultSet['SUBTOTALVARIABLEEXPENSEBUDGETED'];
       $res["se_106"] = $resultSet['SUBTOTALVARIABLEEXPENSEACTUAL'];
       $res["se_107"] = $resultSet['ADAEXPENSEBUDGETED'];
       $res["se_108"] = $resultSet['ADAEXPENSEACTUAL'];
       $res["se_109"] = $resultSet['BOXOFFICEBUDGETED'];
       $res["se_110"] = $resultSet['BOXOFFICEACTUAL'];
       $res["se_111"] = $resultSet['HOSPITALITYBUDGETED'];
       $res["se_112"] = $resultSet['HOSPITALITYACTUAL'];
       $res["se_113"] = $resultSet['THIRDPARTYBUDGETED'];
       $res["se_114"] = $resultSet['THIRDPARTYACTUAL'];
       $res["se_115"] = $resultSet['HOUSESTAFFBUDGETED'];
       $res["se_116"] = $resultSet['HOUSESTAFFACTUAL'];
       $res["se_117"] = $resultSet['LICENSESBUDGETED'];
       $res["se_118"] = $resultSet['LICENSESACTUAL'];
       $res["se_119"] = $resultSet['LIMOSAUTOBUDGETED'];
       $res["se_120"] = $resultSet['LIMOSAUTOACTUAL'];
       $res["se_121"] = $resultSet['ORCHESTRABUDGETED'];
       $res["se_122"] = $resultSet['ORCHESTRAACTUAL'];
       $res["se_123"] = $resultSet['PRESENTERPROFITBUDGETED'];
       $res["se_124"] = $resultSet['PRESENTERPROFITACTUAL'];
       $res["se_125"] = $resultSet['SECURITYBUDGETED'];
       $res["se_126"] = $resultSet['SECURITYACTUAL'];
       $res["se_127"] = $resultSet['PROGRAMBUDGETED'];
       $res["se_128"] = $resultSet['PROGRAMACTUAL'];
       $res["se_129"] = $resultSet['RENTBUDGETED'];
       $res["se_130"] = $resultSet['RENTACTUAL'];
       $res["se_131"] = $resultSet['SOUNDBUDGETED'];
       $res["se_132"] = $resultSet['SOUNDACTUAL'];
       $res["se_133"] = $resultSet['TICKETPRINTING2BUDGETED'];
       $res["se_134"] = $resultSet['TICKETPRINTING2ACTUAL'];
       $res["se_135"] = $resultSet['TELEPHONESBUDGETED'];
       $res["se_136"] = $resultSet['TELEPHONESACTUAL'];
       $res["se_137"] = $resultSet['DRYICEBUDGETED'];
       $res["se_138"] = $resultSet['DRYICEACTUAL'];
       $res["se_139"] = $resultSet['PRESSAGENTFEEBUDGETED'];
       $res["se_140"] = $resultSet['PRESSAGENTFEEACTUAL'];
       $res["se_141"] = $resultSet['OTHERDBUDGETED'];
       $res["se_142"] = $resultSet['OTHERDACTUAL'];
       $res["se_143"] = $resultSet['OTHEREBUDGETED'];
       $res["se_144"] = $resultSet['OTHEREACTUAL'];
       $res["se_145"] = $resultSet['OTHERFBUDGETED'];
       $res["se_146"] = $resultSet['OTHERFACTUAL'];
       $res["se_147"] = $resultSet['OTHERGBUDGETED'];
       $res["se_148"] = $resultSet['OTHERGACTUAL'];
       $res["se_149"] = $resultSet['PIANOBUDGETED'];
       $res["se_150"] = $resultSet['PIANOACTUAL'];
       $res["se_151"] = $resultSet['LOCALFIXEDBUDGETED'];
       $res["se_152"] = $resultSet['LOCALFIXEDACTUAL'];
       $res["se_153"] = $resultSet['SUBTOTALLOCALEXPENSESBUDGETED'];
       $res["se_154"] = $resultSet['SUBTOTALLOCALEXPENSESACTUAL'];
       $res["se_155"] = $resultSet['TOTALLOCALEXPENSEBUDGETED'];
       $res["se_156"] = $resultSet['TOTALLOCALEXPENSEACTUAL'];
       $res["se_157"] = $resultSet['TOTALENGAGEMENTEXPENSES'];
       $res["se_158"] = $resultSet['MIDDLEMONIESTOCOMPANY'];
       $res["se_159"] = $resultSet['MIDDLEMONIESTOPRESENTER'];
       $res["se_160"] = $resultSet['MONEYREMAINING'];
       $res["se_161"] = $resultSet['COMPANYOVERAGEPERCENTAGE'];
       $res["se_162"] = $resultSet['TOTALCOMPANYOVERAGEAMOUNT'];
       $res["se_163"] = $resultSet['NETSTARPERFORMEROVERAGEPERCENTAGE'];
       $res["se_164"] = $resultSet['TOTALSTARPERFORMEROVERAGEAMOUNT'];
       $res["se_165"] = $resultSet['PRESENTEROVERAGETOCOMPANY'];
       $res["se_166"] = $resultSet['PRESENTEROVERAGEADJUSTED'];
       $res["se_167"] = $resultSet['PRESENTEROVERAGETOPRESENTER'];
       $res["se_168"] = $resultSet['TOTALCOMPANYSHARE'];
       $res["se_169"] = $resultSet['LESSDIRECTCOMPANYCHARGES'];
       $res["se_170"] = $resultSet['ADJUSTEDCOMPANYSHARE'];
       $res["se_171"] = $resultSet['TOTALPRESENTERSHARE'];
       $res["se_172"] = $resultSet['PRESENTERFACILITYFEE'];
       $res["se_173"] = $resultSet['ADJUSTEDPRESENTERSHARE'];
       $res["se_174"] = $resultSet['NOTES'];
       $res["se_175"] = $resultSet['CITYID'];
       $res["se_176"] = $resultSet['city'];
       $res["se_177"] = $resultSet['state'];
       $res["se_178"] = $resultSet['country'];

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
                  $ShowName = $objPHPExcel->getSheet(20)->getCell('A1')->getValue();
                  $CityState = $objPHPExcel->getSheet(20)->getCell('A2')->getValue();
                  $Venue = $objPHPExcel->getSheet(20)->getCell('A3')->getValue();
                  $OpeningDate = $objPHPExcel->getSheet(20)->getCell('A4')->getValue();
                  $OD = date($format = "Y-m-d", PHPExcel_Shared_Date::ExceltoPHP($OpeningDate));
                  $ClosingDate = $objPHPExcel->getSheet(20)->getCell('A5')->getValue();
                  $CD = date($format = "Y-m-d", PHPExcel_Shared_Date::ExceltoPHP($ClosingDate));

                  $tax_1_perc = $objPHPExcel->getSheet(20)->getCell('B13')->getCalculatedValue();
                  $tax_2_perc = $objPHPExcel->getSheet(20)->getCell('B14')->getCalculatedValue();
                  $facility_perc = $objPHPExcel->getSheet(20)->getCell('B15')->getCalculatedValue();
                  $subs_perc = $objPHPExcel->getSheet(20)->getCell('B16')->getCalculatedValue();
                  $phone_perc = $objPHPExcel->getSheet(20)->getCell('B17')->getCalculatedValue();
                  $internet_perc = $objPHPExcel->getSheet(20)->getCell('B18')->getCalculatedValue();
                  $cc_perc = $objPHPExcel->getSheet(20)->getCell('B19')->getCalculatedValue();
                  $remote_perc = $objPHPExcel->getSheet(20)->getCell('B20')->getCalculatedValue();
                  $single_tix_perc = $objPHPExcel->getSheet(20)->getCell('B21')->getCalculatedValue();
                  $group_1_perc = $objPHPExcel->getSheet(20)->getCell('B22')->getCalculatedValue();
                  $group_2_perc = $objPHPExcel->getSheet(20)->getCell('B23')->getCalculatedValue();
                  $goldstar_perc = $objPHPExcel->getSheet(20)->getCell('B24')->getCalculatedValue();
                  $groupon_perc = $objPHPExcel->getSheet(20)->getCell('B25')->getCalculatedValue();
                  $travelzoo_perc = $objPHPExcel->getSheet(20)->getCell('B26')->getCalculatedValue();
                  $living_perc = $objPHPExcel->getSheet(20)->getCell('B27')->getCalculatedValue();
                  $othera_perc = $objPHPExcel->getSheet(20)->getCell('B28')->getCalculatedValue();
                  $otherb_perc = $objPHPExcel->getSheet(20)->getCell('B29')->getCalculatedValue();
                  $tax_1_amou = $objPHPExcel->getSheet(20)->getCell('C13')->getCalculatedValue();
                  $tax_2_amou = $objPHPExcel->getSheet(20)->getCell('C14')->getCalculatedValue();
                  $facility_amou = $objPHPExcel->getSheet(20)->getCell('C15')->getCalculatedValue();
                  $subs_amou = $objPHPExcel->getSheet(20)->getCell('C16')->getCalculatedValue();
                  $phone_amou = $objPHPExcel->getSheet(20)->getCell('C17')->getCalculatedValue();
                  $internet_amou = $objPHPExcel->getSheet(20)->getCell('C18')->getCalculatedValue();
                  $cc_amou = $objPHPExcel->getSheet(20)->getCell('C19')->getCalculatedValue();
                  $remote_amou = $objPHPExcel->getSheet(20)->getCell('C20')->getCalculatedValue();
                  $single_tix_amou = $objPHPExcel->getSheet(20)->getCell('C21')->getCalculatedValue();
                  $group_1_amou = $objPHPExcel->getSheet(20)->getCell('C22')->getCalculatedValue();
                  $group_2_amou = $objPHPExcel->getSheet(20)->getCell('C23')->getCalculatedValue();
                  $goldstar_amou = $objPHPExcel->getSheet(20)->getCell('C24')->getCalculatedValue();
                  $groupon_amou = $objPHPExcel->getSheet(20)->getCell('C25')->getCalculatedValue();
                  $travelzoo_amou = $objPHPExcel->getSheet(20)->getCell('C26')->getCalculatedValue();
                  $living_amou = $objPHPExcel->getSheet(20)->getCell('C27')->getCalculatedValue();
                  $othera_amou = $objPHPExcel->getSheet(20)->getCell('C28')->getCalculatedValue();
                  $otherb_amou = $objPHPExcel->getSheet(20)->getCell('C29')->getCalculatedValue();

                  $drop_count = $objPHPExcel->getSheet(19)->getCell('I6')->getCalculatedValue();
                  $paid_attendance = $objPHPExcel->getSheet(19)->getCell('I7')->getCalculatedValue();
                  $comps = $objPHPExcel->getSheet(19)->getCell('I8')->getCalculatedValue();
                  $total_attendance = $objPHPExcel->getSheet(19)->getCell('I9')->getCalculatedValue();
                  $capacity = $objPHPExcel->getSheet(19)->getCell('I10')->getCalculatedValue();
                  $subs_sales = $objPHPExcel->getSheet(19)->getCell('J37')->getValue();
                  $phone_sales = $objPHPExcel->getSheet(19)->getCell('J38')->getValue();
                  $internet_sales = $objPHPExcel->getSheet(19)->getCell('J39')->getValue();
                  $credit_card_sales = $objPHPExcel->getSheet(19)->getCell('J40')->getValue();
                  $remote_outlet_sales = $objPHPExcel->getSheet(19)->getCell('J41')->getValue();
                  $single_tix = $objPHPExcel->getSheet(19)->getCell('J42')->getValue();
                  $group_sales_1 = $objPHPExcel->getSheet(19)->getCell('J43')->getValue();
                  $group_sales_2 = $objPHPExcel->getSheet(19)->getCell('J44')->getValue();
                  $goldstar = $objPHPExcel->getSheet(19)->getCell('J45')->getValue();
                  $groupon = $objPHPExcel->getSheet(19)->getCell('J46')->getValue();
                  $traveloo = $objPHPExcel->getSheet(19)->getCell('J47')->getValue();
                  $living_social = $objPHPExcel->getSheet(19)->getCell('J48')->getValue();
                  $other_percentage = $objPHPExcel->getSheet(19)->getCell('J49')->getValue();
                  $other_amount = $objPHPExcel->getSheet(19)->getCell('J50')->getValue();
                  $sub_discount = $objPHPExcel->getSheet(19)->getCell('I74')->getCalculatedValue();
                  $group1_discount = $objPHPExcel->getSheet(19)->getCell('I78')->getCalculatedValue();
                  $group2_discount = $objPHPExcel->getSheet(19)->getCell('I82')->getCalculatedValue();
                  $total_discount = $objPHPExcel->getSheet(19)->getCell('I96')->getCalculatedValue();
                  $comp_ticket_cost = $objPHPExcel->getSheet(19)->getCell('I99')->getCalculatedValue();
                  $demand_pricing = $objPHPExcel->getSheet(19)->getCell('I101')->getCalculatedValue();

                  $number_performances = $objPHPExcel->getSheet(20)->getCell('D2')->getValue();
                  $top_ticket_price = $objPHPExcel->getSheet(20)->getCell('D6')->getValue();
                  $exchange_rate = $objPHPExcel->getSheet(20)->getCell('G3')->getValue();
                  $box_office_pot = $objPHPExcel->getSheet(20)->getCell('E8')->getCalculatedValue();
                  $box_office_receipts = $objPHPExcel->getSheet(20)->getCell('E10')->getValue();
                  $box_office_perc_pot = $objPHPExcel->getSheet(20)->getCell('D11')->getCalculatedValue();

                  $total_abo_expenses = $objPHPExcel->getSheet(20)->getCell('D31')->getCalculatedValue();
                  $deductions_gbor = $objPHPExcel->getSheet(20)->getCell('E31')->getCalculatedValue();
                  $nagbor = $objPHPExcel->getSheet(20)->getCell('E33')->getCalculatedValue();
                  $net_com_royalty = $objPHPExcel->getSheet(20)->getCell('B36')->getCalculatedValue();
                  $tax_withheld = $objPHPExcel->getSheet(20)->getCell('B37')->getCalculatedValue();
                  $total_com_royalty = $objPHPExcel->getSheet(20)->getCell('D38')->getCalculatedValue();
                  $total_com_guarantee = $objPHPExcel->getSheet(20)->getCell('D41')->getCalculatedValue();
                  $other_deduction = $objPHPExcel->getSheet(20)->getCell('D42')->getCalculatedValue();
                  $insurance_per = $objPHPExcel->getSheet(20)->getCell('B56')->getCalculatedValue();
                  $ticketprinting_per = $objPHPExcel->getSheet(20)->getCell('B57')->getCalculatedValue();
                  $advertising_bug = $objPHPExcel->getSheet(20)->getCell('C47')->getCalculatedValue();
                  $advertising_act = $objPHPExcel->getSheet(20)->getCell('D47')->getCalculatedValue();
                  $sh_loadin_bug = $objPHPExcel->getSheet(20)->getCell('C48')->getCalculatedValue();
                  $sh_loadin_act = $objPHPExcel->getSheet(20)->getCell('D48')->getCalculatedValue();
                  $sh_loadout_bug = $objPHPExcel->getSheet(20)->getCell('C49')->getCalculatedValue();
                  $sh_loadout_act = $objPHPExcel->getSheet(20)->getCell('D49')->getCalculatedValue();
                  $sh_running_bug = $objPHPExcel->getSheet(20)->getCell('C50')->getCalculatedValue();
                  $sh_running_act = $objPHPExcel->getSheet(20)->getCell('D50')->getCalculatedValue();
                  $wh_loadin_bug = $objPHPExcel->getSheet(20)->getCell('C51')->getCalculatedValue();
                  $wh_loadin_act = $objPHPExcel->getSheet(20)->getCell('D51')->getCalculatedValue();
                  $wh_loadout_bug = $objPHPExcel->getSheet(20)->getCell('C52')->getCalculatedValue();
                  $wh_loadout_act = $objPHPExcel->getSheet(20)->getCell('D52')->getCalculatedValue();
                  $wh_running_bug = $objPHPExcel->getSheet(20)->getCell('C53')->getCalculatedValue();
                  $wh_running_act = $objPHPExcel->getSheet(20)->getCell('D53')->getCalculatedValue();
                  $labor_catering_bug = $objPHPExcel->getSheet(20)->getCell('C54')->getCalculatedValue();
                  $labor_catering_act = $objPHPExcel->getSheet(20)->getCell('D54')->getCalculatedValue();
                  $musicians_bug = $objPHPExcel->getSheet(20)->getCell('C55')->getCalculatedValue();
                  $musicians_act = $objPHPExcel->getSheet(20)->getCell('D55')->getCalculatedValue();
                  $insurance_bug = $objPHPExcel->getSheet(20)->getCell('C56')->getCalculatedValue();
                  $insurance_act = $objPHPExcel->getSheet(20)->getCell('D56')->getCalculatedValue();
                  $ticketprinting_bug = $objPHPExcel->getSheet(20)->getCell('C57')->getCalculatedValue();
                  $ticketprinting_act = $objPHPExcel->getSheet(20)->getCell('D57')->getCalculatedValue();
                  $otherc_bug = $objPHPExcel->getSheet(20)->getCell('C58')->getCalculatedValue();
                  $otherc_act = $objPHPExcel->getSheet(20)->getCell('D58')->getCalculatedValue();
                  $st_variable_bug = $objPHPExcel->getSheet(20)->getCell('C59')->getCalculatedValue();
                  $st_variable_act = $objPHPExcel->getSheet(20)->getCell('D59')->getCalculatedValue();
                  $ada_bug = $objPHPExcel->getSheet(20)->getCell('C61')->getCalculatedValue();
                  $ada_act = $objPHPExcel->getSheet(20)->getCell('D61')->getCalculatedValue();
                  $boxoffice_bug = $objPHPExcel->getSheet(20)->getCell('C62')->getCalculatedValue();
                  $boxoffice_act = $objPHPExcel->getSheet(20)->getCell('D62')->getCalculatedValue();
                  $hospitality_bug = $objPHPExcel->getSheet(20)->getCell('C63')->getCalculatedValue();
                  $hospitality_act = $objPHPExcel->getSheet(20)->getCell('D63')->getCalculatedValue();
                  $third_equip_bug = $objPHPExcel->getSheet(20)->getCell('C64')->getCalculatedValue();
                  $third_equip_act = $objPHPExcel->getSheet(20)->getCell('D64')->getCalculatedValue();
                  $housestaff_bug = $objPHPExcel->getSheet(20)->getCell('C65')->getCalculatedValue();
                  $housestaff_act = $objPHPExcel->getSheet(20)->getCell('D65')->getCalculatedValue();
                  $licenses_bug = $objPHPExcel->getSheet(20)->getCell('C66')->getCalculatedValue();
                  $licenses_act = $objPHPExcel->getSheet(20)->getCell('D66')->getCalculatedValue();
                  $limos_bug = $objPHPExcel->getSheet(20)->getCell('C67')->getCalculatedValue();
                  $limos_act = $objPHPExcel->getSheet(20)->getCell('D67')->getCalculatedValue();
                  $orchestra_bug = $objPHPExcel->getSheet(20)->getCell('C68')->getCalculatedValue();
                  $orchestra_act = $objPHPExcel->getSheet(20)->getCell('D68')->getCalculatedValue();
                  $presenter_bug = $objPHPExcel->getSheet(20)->getCell('C69')->getCalculatedValue();
                  $presenter_act = $objPHPExcel->getSheet(20)->getCell('D69')->getCalculatedValue();
                  $security_bug = $objPHPExcel->getSheet(20)->getCell('C70')->getCalculatedValue();
                  $security_act = $objPHPExcel->getSheet(20)->getCell('D70')->getCalculatedValue();
                  $program_bug = $objPHPExcel->getSheet(20)->getCell('C71')->getCalculatedValue();
                  $program_act = $objPHPExcel->getSheet(20)->getCell('D71')->getCalculatedValue();
                  $rent_bug = $objPHPExcel->getSheet(20)->getCell('C72')->getCalculatedValue();
                  $rent_act = $objPHPExcel->getSheet(20)->getCell('D72')->getCalculatedValue();
                  $soundlights_bug = $objPHPExcel->getSheet(20)->getCell('C73')->getCalculatedValue();
                  $soundlights_act = $objPHPExcel->getSheet(20)->getCell('D73')->getCalculatedValue();
                  $ticketprinting2_bug = $objPHPExcel->getSheet(20)->getCell('C74')->getCalculatedValue();
                  $ticketprinting2_act = $objPHPExcel->getSheet(20)->getCell('D74')->getCalculatedValue();
                  $phone_int_bug = $objPHPExcel->getSheet(20)->getCell('C75')->getCalculatedValue();
                  $phone_int_act = $objPHPExcel->getSheet(20)->getCell('D75')->getCalculatedValue();
                  $dry_bug = $objPHPExcel->getSheet(20)->getCell('C76')->getCalculatedValue();
                  $dry_act = $objPHPExcel->getSheet(20)->getCell('D76')->getCalculatedValue();
                  $press_agent_bug = $objPHPExcel->getSheet(20)->getCell('C77')->getCalculatedValue();
                  $press_agent_act = $objPHPExcel->getSheet(20)->getCell('D77')->getCalculatedValue();
                  $otherd_bug = $objPHPExcel->getSheet(20)->getCell('C78')->getCalculatedValue();
                  $otherd_act = $objPHPExcel->getSheet(20)->getCell('D78')->getCalculatedValue();
                  $othere_bug = $objPHPExcel->getSheet(20)->getCell('C79')->getCalculatedValue();
                  $othere_act = $objPHPExcel->getSheet(20)->getCell('D79')->getCalculatedValue();
                  $otherf_bug = $objPHPExcel->getSheet(20)->getCell('C80')->getCalculatedValue();
                  $otherf_act = $objPHPExcel->getSheet(20)->getCell('D80')->getCalculatedValue();
                  $otherg_bug = $objPHPExcel->getSheet(20)->getCell('C81')->getCalculatedValue();
                  $otherg_act = $objPHPExcel->getSheet(20)->getCell('D81')->getCalculatedValue();
                  $piano_bug = $objPHPExcel->getSheet(20)->getCell('C82')->getCalculatedValue();
                  $piano_act = $objPHPExcel->getSheet(20)->getCell('D82')->getCalculatedValue();
                  $local_fixed_bug = $objPHPExcel->getSheet(20)->getCell('C83')->getCalculatedValue();
                  $local_fixed_act = $objPHPExcel->getSheet(20)->getCell('D83')->getCalculatedValue();
                  $st_expenses_bug = $objPHPExcel->getSheet(20)->getCell('C84')->getCalculatedValue();
                  $st_expenses_act = $objPHPExcel->getSheet(20)->getCell('D84')->getCalculatedValue();
                  $total_expenses_bug = $objPHPExcel->getSheet(20)->getCell('C85')->getCalculatedValue();
                  $total_expenses_act = $objPHPExcel->getSheet(20)->getCell('D85')->getCalculatedValue();
                  $t_engagement_act = $objPHPExcel->getSheet(20)->getCell('E86')->getCalculatedValue();
                  $overage_comp = $objPHPExcel->getSheet(20)->getCell('B90')->getCalculatedValue();
                  $net_star_overage = $objPHPExcel->getSheet(20)->getCell('D90')->getCalculatedValue();
                  $overage_pre = $objPHPExcel->getSheet(20)->getCell('E94')->getCalculatedValue();
                  $monies_comp = $objPHPExcel->getSheet(20)->getCell('B97')->getCalculatedValue();
                  $monies_pre = $objPHPExcel->getSheet(20)->getCell('D99')->getCalculatedValue();
                  $total_comp_overage = $objPHPExcel->getSheet(20)->getCell('B100')->getCalculatedValue();
                  $total_star_overage = $objPHPExcel->getSheet(20)->getCell('D102')->getCalculatedValue();
                  $pre_overage_pre = $objPHPExcel->getSheet(20)->getCell('B103')->getCalculatedValue();
                  $overage_share = $objPHPExcel->getSheet(20)->getCell('C103')->getCalculatedValue();
                  $money_rem_total = $objPHPExcel->getSheet(20)->getCell('D103')->getCalculatedValue();
                  $total_comp_share = $objPHPExcel->getSheet(20)->getCell('E105')->getCalculatedValue();
                  $less_direct_comp = $objPHPExcel->getSheet(20)->getCell('E106')->getCalculatedValue();
                  $adj_comp_share = $objPHPExcel->getSheet(20)->getCell('E107')->getCalculatedValue();
                  $total_pre_share = $objPHPExcel->getSheet(20)->getCell('E109')->getCalculatedValue();
                  $pre_facility_fee = $objPHPExcel->getSheet(20)->getCell('E110')->getCalculatedValue();
                  $adj_pre_share = $objPHPExcel->getSheet(20)->getCell('E111')->getCalculatedValue();
                  $notes = $objPHPExcel->getSheet(20)->getCell('A123')->getValue();

                  //Free Memory
                  $objPHPExcel->disconnectWorksheets();
                  unset($objPHPExcel);

                  $res = array();

                  $res["se_3"] = $ShowName;
                  $res["se_5"] = $Venue;
                  $res["se_6"] = $OD;
                  $res["se_7"] = $CD;
                  $res["se_8"] = $drop_count;
                  $res["se_9"] = $paid_attendance;
                  $res["se_10"] = $comps;
                  $res["se_11"] = $total_attendance;
                  $res["se_12"] = $capacity;
                  $res["se_12_1"] = $subs_sales;
                  $res["se_12_2"] = $phone_sales;
                  $res["se_13"] = $internet_sales;
                  $res["se_14"] = $credit_card_sales;
                  $res["se_15"] = $remote_outlet_sales;
                  $res["se_16"] = $single_tix;
                  $res["se_17"] = $group_sales_1;
                  $res["se_18"] = $group_sales_2;
                  $res["se_19"] = $goldstar;
                  $res["se_20"] = $groupon;
                  $res["se_21"] = $traveloo;
                  $res["se_22"] = $living_social;
                  $res["se_23"] = $other_percentage;
                  $res["se_24"] = $other_amount;
                  $res["se_25"] = $sub_discount;
                  $res["se_26"] = $group1_discount;
                  $res["se_27"] = $group2_discount;
                  $res["se_28"] = $total_discount;
                  $res["se_29"] = $comp_ticket_cost;
                  $res["se_30"] = $demand_pricing;
                  $res["se_31"] = $number_performances;
                  $res["se_32"] = $top_ticket_price;
                  $res["se_33"] = $exchange_rate;
                  $res["se_34"] = $box_office_pot;
                  $res["se_35"] = $box_office_receipts;
                  $res["se_36"] = $box_office_perc_pot;
                  $res["se_37"] = $tax_1_perc;
                  $res["se_38"] = $tax_1_amou;
                  $res["se_39"] = $tax_2_perc;
                  $res["se_40"] = $tax_2_amou;
                  $res["se_41"] = $facility_perc;
                  $res["se_42"] = $facility_amou;
                  $res["se_43"] = $subs_perc;
                  $res["se_44"] = $subs_amou;
                  $res["se_45"] = $phone_perc;
                  $res["se_46"] = $phone_amou;
                  $res["se_47"] = $internet_perc;
                  $res["se_48"] = $internet_amou;
                  $res["se_49"] = $cc_perc;
                  $res["se_50"] = $cc_amou;
                  $res["se_51"] = $remote_perc;
                  $res["se_52"] = $remote_amou;
                  $res["se_53"] = $single_tix_perc;
                  $res["se_54"] = $single_tix_amou;
                  $res["se_55"] = $group_1_perc;
                  $res["se_56"] = $group_1_amou;
                  $res["se_57"] = $group_2_perc;
                  $res["se_58"] = $group_2_amou;
                  $res["se_59"] = $goldstar_perc;
                  $res["se_60"] = $goldstar_amou;
                  $res["se_61"] = $groupon_perc;
                  $res["se_62"] = $groupon_amou;
                  $res["se_63"] = $travelzoo_perc;
                  $res["se_64"] = $travelzoo_amou;
                  $res["se_65"] = $living_perc;
                  $res["se_66"] = $living_amou;
                  $res["se_67"] = $othera_perc;
                  $res["se_68"] = $othera_amou;
                  $res["se_69"] = $otherb_perc;
                  $res["se_70"] = $otherb_amou;
                  $res["se_71"] = $total_abo_expenses;
                  $res["se_72"] = $deductions_gbor;
                  $res["se_73"] = $nagbor;
                  $res["se_74"] = $net_com_royalty;
                  $res["se_75"] = $tax_withheld;
                  $res["se_76"] = $total_com_royalty;
                  $res["se_77"] = $total_com_guarantee;
                  $res["se_78"] = $other_deduction;
                  $res["se_79"] = $insurance_per;
                  $res["se_80"] = $ticketprinting_per;
                  $res["se_81"] = $advertising_bug;
                  $res["se_82"] = $advertising_act;
                  $res["se_83"] = $sh_loadin_bug;
                  $res["se_84"] = $sh_loadin_act;
                  $res["se_85"] = $sh_loadout_bug;
                  $res["se_86"] = $sh_loadout_act;
                  $res["se_87"] = $sh_running_bug;
                  $res["se_88"] = $sh_running_act;
                  $res["se_89"] = $wh_loadin_bug;
                  $res["se_90"] = $wh_loadin_act;
                  $res["se_91"] = $wh_loadout_bug;
                  $res["se_92"] = $wh_loadout_act;
                  $res["se_93"] = $wh_running_bug;
                  $res["se_94"] = $wh_running_act;
                  $res["se_95"] = $labor_catering_bug;
                  $res["se_96"] = $labor_catering_act;
                  $res["se_97"] = $musicians_bug;
                  $res["se_98"] = $musicians_act;
                  $res["se_99"] = $insurance_bug;
                  $res["se_100"] = $insurance_act;
                  $res["se_101"] = $ticketprinting_bug;
                  $res["se_102"] = $ticketprinting_act;
                  $res["se_103"] = $otherc_bug;
                  $res["se_104"] = $otherc_act;
                  $res["se_105"] = $st_variable_bug;
                  $res["se_106"] = $st_variable_act;
                  $res["se_107"] = $ada_bug;
                  $res["se_108"] = $ada_act;
                  $res["se_109"] = $boxoffice_bug;
                  $res["se_110"] = $boxoffice_act;
                  $res["se_111"] = $hospitality_bug;
                  $res["se_112"] = $hospitality_act;
                  $res["se_113"] = $third_equip_bug;
                  $res["se_114"] = $third_equip_act;
                  $res["se_115"] = $housestaff_bug;
                  $res["se_116"] = $housestaff_act;
                  $res["se_117"] = $licenses_bug;
                  $res["se_118"] = $licenses_act;
                  $res["se_119"] = $limos_bug;
                  $res["se_120"] = $limos_act;
                  $res["se_121"] = $orchestra_bug;
                  $res["se_122"] = $orchestra_act;
                  $res["se_123"] = $presenter_bug;
                  $res["se_124"] = $presenter_act;
                  $res["se_125"] = $security_bug;
                  $res["se_126"] = $security_act;
                  $res["se_127"] = $program_bug;
                  $res["se_128"] = $program_act;
                  $res["se_129"] = $rent_bug;
                  $res["se_130"] = $rent_act;
                  $res["se_131"] = $soundlights_bug;
                  $res["se_132"] = $soundlights_act;
                  $res["se_133"] = $ticketprinting2_bug;
                  $res["se_134"] = $ticketprinting2_act;
                  $res["se_135"] = $phone_int_bug;
                  $res["se_136"] = $phone_int_act;
                  $res["se_137"] = $dry_bug;
                  $res["se_138"] = $dry_act;
                  $res["se_139"] = $press_agent_bug;
                  $res["se_140"] = $press_agent_act;
                  $res["se_141"] = $otherd_bug;
                  $res["se_142"] = $otherd_act;
                  $res["se_143"] = $othere_bug;
                  $res["se_144"] = $othere_act;
                  $res["se_145"] = $otherf_bug;
                  $res["se_146"] = $otherf_act;
                  $res["se_147"] = $otherg_bug;
                  $res["se_148"] = $otherg_act;
                  $res["se_149"] = $piano_bug;
                  $res["se_150"] = $piano_act;
                  $res["se_151"] = $local_fixed_bug;
                  $res["se_152"] = $local_fixed_act;
                  $res["se_153"] = $st_expenses_bug;
                  $res["se_154"] = $st_expenses_act;
                  $res["se_155"] = $total_expenses_bug;
                  $res["se_156"] = $total_expenses_act;
                  $res["se_157"] = $t_engagement_act;
                  $res["se_158"] = $monies_comp;
                  $res["se_159"] = $monies_pre;
                  $res["se_160"] = $money_rem_total;
                  $res["se_161"] = $overage_comp;
                  $res["se_162"] = $total_comp_overage;
                  $res["se_163"] = $net_star_overage;
                  $res["se_164"] = $total_star_overage;
                  $res["se_165"] = $overage_pre;
                  $res["se_166"] = $overage_share;
                  $res["se_167"] = $pre_overage_pre;
                  $res["se_168"] = $total_comp_share;
                  $res["se_169"] = $less_direct_comp;
                  $res["se_170"] = $adj_comp_share;
                  $res["se_171"] = $total_pre_share;
                  $res["se_172"] = $pre_facility_fee;
                  $res["se_173"] = $adj_pre_share;
                  $res["se_174"] = $notes;

                  unlink($target_file);

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