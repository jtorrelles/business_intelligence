<?php
error_reporting(0);
ob_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once("../classes/presenters_services.php");

$loc = new presenterServices();	

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

  if($type=='getPresenters') {
     if(!isset($_GET['stateId']) || empty($_GET['stateId'])) {
      throw new exception("State Id is not set.");
     }
     $stateId = $_GET['stateId'];
     $data = $loc->getPresenters($stateId);
  }

  if($type=='getDataPresenters') {
     if(!isset($_GET['presenterId']) || empty($_GET['presenterId'])) {
      throw new exception("Presenter Id is not set.");
     }
     $presenterId = $_GET['presenterId'];
     $data = $loc->getDataPresenters($presenterId);
  }

} catch (Exception $e) {
   $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
} finally {
  echo json_encode($data);
}

ob_flush();






