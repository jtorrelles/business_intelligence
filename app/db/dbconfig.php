<?php
class dbconfig {
  // database hostname 
  //protected static $host = "localhost";
  protected static $host = "userverdev";
  // database username
  //protected static $username = "root";
  protected static $username = "root";
  // database password
  //protected static $password = "C4r4lh0_V04d0r";
  protected static $password = "1234";
  //database name
  protected static $dbname = "networksbi";
  static $con;
  function __construct() {
    self::$con = self::connect(); 
  }
  
  // open connection
  protected static function connect() {
     try {
       $link = mysqli_connect(self::$host, self::$username, self::$password, self::$dbname); 
        if(!$link) {
          throw new exception(mysqli_error($link));
        }
        return $link;
     } catch (Exception $e) {
       echo "Error: ".$e->getMessage();
     } 
  }
 // close connection
  public static function close() {
     mysqli_close(self::$con);
  }
  public static function run($query) {
    try {
      if(empty($query) && !isset($query)) {
        throw new exception("Query string is not set.");
      }
      $result = mysqli_query(self::$con, $query);
      self::close();
     return $result;
    } catch (Exception $e) {
      echo "Error: ".$e->getMessage();
    }
     
  } 
}