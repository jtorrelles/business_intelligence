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
include_once("../classes/shows_services.php");

$loc = new showsServices();			

try {
  if(!isset($_GET['type']) || empty($_GET['type'])) {
  	throw new exception("Type is not set.");
  }

  $type = $_GET['type'];

  if($type=='getShowsByCategory') {

	/*if(!isset($_GET['categoryId']) || empty($_GET['categoryId'])) {
      throw new exception("Category Id is not set.");
	}*/

	  $categoryId = $_GET['categoryId'];
  	$data = $loc->getByCategory($categoryId);
  } 

} catch (Exception $e) {
   $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
} finally {
  echo json_encode($data);
}

ob_flush();