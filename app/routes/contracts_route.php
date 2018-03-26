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

} catch (Exception $e) {
   $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
} finally {
  echo json_encode($data);
}

ob_flush();