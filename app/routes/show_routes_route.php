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
include_once("../classes/show_routes_services.php");

$loc = new showRoutesServices();	

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

	if($type=='getShows') {
		$data = $loc->getShows();
	} 

	if($type=='getNUTOfShow') {
		if(!isset($_GET['showId']) || empty($_GET['showId'])) {
		  throw new exception("Show Id is not set.");
		}
		$showId = $_GET['showId'];
		$data = $loc->getNUTOfShow($showId);
	} 

	if($type=='getData') {
		if(!isset($_GET['routeId']) || empty($_GET['routeId'])) {
			throw new exception("Route Id is not set.");
		}
		$routeId = $_GET['routeId'];
		$data = $loc->getDataOfRoute($routeId);
	} 	

	if($type=='getDetailData') {
		if(!isset($_GET['routeDetailId']) || empty($_GET['routeDetailId'])) {
			throw new exception("Route Detail Id is not set.");
		}
		$routeDeatilId = $_GET['routeDetailId'];
		$data = $loc->getDataOfDetailRoute($routeDeatilId);
	} 	

} catch (Exception $e) {
   $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
} finally {
  echo json_encode($data);
}

ob_flush();