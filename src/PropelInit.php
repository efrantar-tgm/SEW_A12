<?php
define("ROOT", "/home/schueler/repositories/SEW_A12/src"); // define the path where the classes are

// include the main Propel script
require_once '/var/www/propel/vendor/propel/propel1/runtime/lib/Propel.php';

// initialize Propel with the runtime configuration
Propel::init(ROOT."/build/conf/SEW_A12-conf.php");

// add the generated 'classes' directory to the include path
set_include_path(ROOT."/build/classes" . PATH_SEPARATOR . get_include_path());
?>
