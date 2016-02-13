<?php
// from: http://php.thedemosite.co.uk/
// version 1.0

require_once 'config.php';

class dbc extends PDO
{
 protected static $instance;

 public function __construct()
 {   
   $options = array(PDO::ATTR_PERSISTENT => true,
   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
   PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '".CHARSET."';" // this command will be executed during every connection to server - suggested by: vit.bares@gmail.com
   );
   try {
        $this->dbconn = new PDO(DBDRIVER.":host=".DBHOST.";port=".DBPORT.";dbname=".DBNAME,DBUSER,DBPASS,$options);
        return $this->dbconn;
       }
    catch (PDOException $e){ $this->reportDBError($e->getMessage()); }   
 }
 
 public function reportDBError($msg)
 {
  if (DEBUG) print_r('<div style="padding:10%;"><h3>'.nl2br($msg).'</h3>(debug ref. 3.9d)</div>');
  else
  {
   if(!session_id()) session_start();
   $_SESSION['mysql_errors'] = "\n\nDb error: ".$msg."\n";
  }
 }
 
 //metodo constructor, se encarga de instanciar solo una vez la conexion
 //para llamarlo : dbc::instance();
 public static function instance()
 {
  if (!isset(self::$instance)) self::$instance = new self();
  return self::$instance;
 }

 public function prepare($query, $options = NULL) {
  try { return $this->dbconn->prepare($query); }
   catch (PDOException $e){ $this->reportDBError($e->getMessage()); }   
 }      

 public function bindParam($query) {
  try { return $this->dbconn->bindParam($query); }
   catch (PDOException $e){ $this->reportDBError($e->getMessage()); }     
 }

 public function query($query) {
  try {
       if ($this->query($query)) return $this->fetchAll();
       else return 0;
      } 
   catch (PDOException $e){ $this->reportDBError($e->getMessage()."<hr>".$e->getTraceAsString()); } }

 public function execute($result) {//use for insert/update/delete
  try { if ($result->execute()) return $result; } 
   catch (PDOException $e){ $this->reportDBError($e->getMessage()."<hr>".$e->getTraceAsString()); }     
 }
 public function executeGetRows($result) {//use to retrieve rows of data
  try { 
       if ($result->execute()) return $result->fetchAll(PDO::FETCH_ASSOC);
       else return 0;
      }
    catch (PDOException $e){ $this->reportDBError($e->getMessage()."<hr>".$e->getTraceAsString()); }     
 }

 public function __clone()
 {  //not allowed
 }
 public function __destruct()
 {
  $this->dbconn = null;
 }
}

?>