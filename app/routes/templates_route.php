<?php
error_reporting(0);
ob_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
include_once("../classes/templates_services.php");
include '../session.php';

$loc = new templatesServices();	

try {

  if(!isset($_GET['type']) || empty($_GET['type'])) {
  	throw new exception("Type is not set.");
  }

  $type = $_GET['type'];

  if($type=='getByUser') {
    if(!isset($_GET['module']) || empty($_GET['module'])) {
      throw new exception("Module is not set.");
    }
    $userId = $_SESSION['login_user'];
    $module = $_GET['module'];
  	$data = $loc->getTemplatesByUser($userId, $module);
  } 

  if($type=='getFieldsById') {
    if(!isset($_GET['templateId']) || empty($_GET['templateId'])) {
      throw new exception("Template Id is not set.");
     }
    $templateId = $_GET['templateId'];
    $data = $loc->getTemplatesFieldsById($templateId);
  }   

} catch (Exception $e) {
   $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
} finally {
  echo json_encode($data);
}

ob_flush();
