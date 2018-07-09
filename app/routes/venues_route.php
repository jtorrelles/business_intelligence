<?php
error_reporting(0);
ob_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once("../classes/venues_services.php");

$loc = new venuesServices();			

try {
  if(!isset($_GET['type']) || empty($_GET['type'])) {
  	throw new exception("Type is not set.");
  }
  $type = $_GET['type'];
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

   if($type=='getVenues') {
  	 if(!isset($_GET['stateId']) || empty($_GET['stateId'])) {
  	 	throw new exception("State Id is not set.");
  	 }
     $stateId = $_GET['stateId'];
  	 $data = $loc->getVenues($stateId);
  }

  if($type=='getVenuesFilter') {

    $countryId = $_GET['countryId'];
    $stateId = $_GET['stateId'];
    $cityId = $_GET['cityId'];

    $data = $loc->getVenuesFilter($countryId,$stateId,$cityId);
  }

  if($type=='getDataVenues') {
     if(!isset($_GET['venueId']) || empty($_GET['venueId'])) {
      throw new exception("Venue Id is not set.");
     }
     $venueId = $_GET['venueId'];
     $data = $loc->getDataVenues($venueId);
  }

} catch (Exception $e) {
   $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
} finally {
  echo json_encode($data);
}

ob_flush();
