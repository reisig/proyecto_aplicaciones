<?php 
// datos para la coneccion a mysql 
define('DB_SERVER','/192.168.56.102/'); 
define('DB_NAME','aplicacion_web'); 
define('DB_USER','root'); 
define('DB_PASS','1234'); 
$con = mysql_connect(DB_SERVER,DB_USER,DB_PASS); 
mysql_select_db(DB_NAME,$con); 
?>