<?php
/*
* Author: Rohit Kumar
* Website: iamrohit.in
* Version: 0.0.1
* Date: 25-04-2015
* App Name: Php+ajax country state city dropdown
* Description: A simple oops based php and ajax country state city dropdown list
*/
error_reporting(0);
ob_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once("../classes/settlements_services.php");

$loc = new settlementsServices();	

try {

  if(!isset($_GET['type']) || empty($_GET['type'])) {
  	throw new exception("Type is not set.");
  }

  $type = $_GET['type'];

  if($type=='getCityOfVenues') {
    if(!isset($_GET['venueId']) || empty($_GET['venueId'])) {
      throw new exception("Venue Id is not set.");
     }
     $venueId = $_GET['venueId'];
    $data = $loc->getCityOfVenues($venueId);
  } 

  if($type=='getShows') {
  	$data = $loc->getShows();
  } 
  
  if($type=='getPresenters') {
  	$data = $loc->getPresenters();
  }   

  if($type=='getVenues') {
    $data = $loc->getVenues();
  } 

  if($type=='getCountries') {
    $data = $loc->getCountries();
  } 

  if($type=='getStates') {
    if(!isset($_GET['countryId']) || empty($_GET['countryId'])) {
      throw new exception("Country Id is not set.");
    }
    $countryId = $_GET['countryId'];
    $data = $loc->getStates($countryId);
  }

  if($type=='getCities') {
    if(!isset($_GET['stateId']) || empty($_GET['stateId'])) {
      throw new exception("State Id is not set.");
    }
    $stateId = $_GET['stateId'];
    $data = $loc->getCities($stateId);
  }

  if($type=='getGlobalLocation') {
    if(!isset($_GET['cityId']) || empty($_GET['cityId'])) {
      throw new exception("City Id is not set.");
    }
    $cityId = $_GET['cityId'];
    $data = $loc->getGlobalLocation($cityId);
  }

  if($type=='getData') {
    if(!isset($_GET['settlementId']) || empty($_GET['settlementId'])) {
      throw new exception("Settelment Id is not set.");
     }
     $settlementId = $_GET['settlementId'];
  	 $data = $loc->getDataOfSettlements($settlementId);
  } 

  if($type=='getUploadProcess'){
    //$data = "prueba";
    $data = $loc->processUploadFile($_FILES["fileToUpload"]);
  }

} catch (Exception $e) {
   $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
} finally {
  echo json_encode($data);
}

ob_flush();