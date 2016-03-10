<?php
session_start();
if (!isset($_SESSION['user'])) {
  readfile('login.php');
}
session_destroy();
header("Location: index.php");
?>