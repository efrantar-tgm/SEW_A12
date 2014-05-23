<?php
error_reporting(E_ALL); 
ini_set("display_errors", "1");

require_once("models/config.php");
require_once("../PropelInit.php");
require_once("../forms/EventListForm.php");

/* this page should only be accessed by logged in users */
if (!securePage($_SERVER['PHP_SELF'])){ die(); }

/*
$user = MyUserQuery::create()->findPk($loggedInUser->username);
echo $user->getName();
*/

$myarray = array("event1","event2","event3","event4","event5");
$invited = array("event6","event7","event8","event9","event10");

$form = new EventListForm($myarray, $invited);
$form->show();
?>
