<?php
error_reporting(0);
ob_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once("../classes/contracts_services.php");

$loc = new contractsServices();			

try {
  if(!isset($_GET['type']) || empty($_GET['type'])) {
  	throw new exception("Type is not set.");
  }
  $type = $_GET['type'];
  if($type=='getShows') {
  	$data = $loc->getShows();
  } 

  if($type=='getPresenters') {
  	$data = $loc->getPresenters();
  } 

  if($type=='getVenues') {
  	$data = $loc->getVenues();
  } 

  if($type=='getCityOfVenues') {
    if(!isset($_GET['venueId']) || empty($_GET['venueId'])) {
      throw new exception("Venue Id is not set.");
     }
     $venueId = $_GET['venueId'];
  	$data = $loc->getCityOfVenues($venueId);
  } 

  if($type=='getData') {
    if(!isset($_GET['contractId']) || empty($_GET['contractId'])) {
      throw new exception("Contract Id is not set.");
     }
     $contractId = $_GET['contractId'];
     $data = $loc->getFindData($contractId);
  } 

} catch (Exception $e) {
   $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
} finally {
  echo json_encode($data);
}

ob_flush();
