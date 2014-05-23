<?php
/* show all errors */
error_reporting(E_ALL); 
ini_set("display_errors", "1");

require_once "src/PropelInit.php"; // load Propel

header("Location: src/userCake/index.php");
?>
