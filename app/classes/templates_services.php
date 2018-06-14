<?php
require_once('../db/dbconfig2.php');
class templatesServices extends dbconfig {
   
  public static $data;

  function __construct() {
    parent::__construct();
  }

  public static function getTemplatesByUser($userId, $module){
    try {

	      $query = "SELECT t.id, t.`name` 
					FROM templates t, modules m 
					WHERE t.`user` = '$userId' 
					AND t.moduleid = m.id 
					AND m.`name` = '$module'";

	      $result = dbconfig::run($query);
	      if(!$result) {
			throw new exception("Templates not found.");
	      }

	      $res = array();
	      $x=0;

	      while($resultSet = mysqli_fetch_assoc($result)) {
	        $res[$x]["id"] = $resultSet['id'];
	        $res[$x]["name"] = $resultSet['name'];
	        $x++;       
	      }

	      dbconfig::close();

	      $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Templates fetched successfully.", 'result'=>$res);

	    }catch (Exception $e) {
	      $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
	    } finally {
	      return $data;
	    }
	}

  public static function getTemplatesFieldsById($templateId){
    try {

	    $query = "SELECT CONCAT(\"'\",mf.field_name,\"'\") as field_name, mf.field_description 
					FROM templates t, templates_fields tf, modules_fields mf  
					WHERE t.id = $templateId 
					AND t.id = tf.templateid 
					AND tf.modulefieldid = mf.id   
					AND mf.field_name NOT IN ('ID', 'SHOWID', 'CITYID')";

		$result = dbconfig::run($query);
		if(!$result) {
			throw new exception("Templates Fields not found.");
		}

		$res = array();
		$x=0;

		while($resultSet = mysqli_fetch_assoc($result)) {
			$res[$x]["field_name"] = $resultSet['field_name'];
			$res[$x]["field_description"] = $resultSet['field_description'];
			$x++;
		}

		dbconfig::close();

	    $data = array('status'=>'success', 'tp'=>1, 'msg'=>"Templates Fields fetched successfully.", 'result'=>$res);

	    }catch (Exception $e) {
	      $data = array('status'=>'error', 'tp'=>0, 'msg'=>$e->getMessage());
	    } finally {
	      return $data;
	    }
	}	

}

?>