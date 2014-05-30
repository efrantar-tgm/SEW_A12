<?php
/**
 * This is the control file of the event-list UI. It handles all submit events.
 * @author Elias Frantar
 * @version 29.5.2014
 */

error_reporting(E_ALL); 
ini_set("display_errors", "1");

require_once("models/config.php");
require_once("../PropelInit.php");
require_once("../forms/EventListForm.php");
require_once("../forms/EventCreateForm.php");
require_once("../access_control/Role.php");

/* this page should only be accessed by logged in users */
if(!securePage($_SERVER['PHP_SELF'])){ die(); }

$user = MyUser::findByName($loggedInUser->username);

/* handle submit events */

/* the 'CreateEvent' button was pressed */
if(isset($_POST['createEvent'])) {
	/* switch to the event-creation GUI */
	$form = new EventCreateForm("EventCreate.php");
	$form->show();
	die();
}

/* show the event list */
$myEvents = $user->findAllInvitedEvents();
$invitedEvents = $user->findAllOrganizedEvents();

$form = new EventListForm($myEvents, $invitedEvents);
$form->show();
?>
