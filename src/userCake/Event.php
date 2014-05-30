<?php
/**
 * This is the control file of the event UI. It handles all submit events.
 * @author Elias Frantar
 * @version 29.5.2014
 */

/* TODO: poll implementation */
/* TODO: fix-date implementation */
/* TODO: notification implementation */
/* TODO: comments + management implementation */

/* TODO: remove error reporting; error reporting is just for testing! */
error_reporting(E_ALL); 
ini_set("display_errors", "1");

/* require all necessary classes */
require_once("models/config.php");
require_once("../PropelInit.php");
require_once("../forms/EventForm.php");
require_once("../forms/EventSettingsForm.php");
require_once("../access_control/Role.php");

/* this page should only be accessed by logged in users */
if (!securePage($_SERVER['PHP_SELF'])){ die(); }

/* if the event id is set, we must add it to $_SESSION to access it from event settings */
if(isset($_GET["id"])) {
	$_SESSION["event_id"] = $_GET["id"];
}

/* load the current user and event */
$event = Event::findById($_SESSION["event_id"]);
$user = MyUser::findByName($loggedInUser->username);

/* manage permission */
$roletype = $event->getRole($user);

/* the 'Edit'-button was pressed */
if(isset($_POST['editEvent'])) {
	/* load the Settings-GUI */
	$form = new EventSettingsForm($event, $user, '../userCake/EventSettings.php');
	$form->show();
	die();
}
/* the 'Back'-button was pressed */
if(isset($_POST['back'])) {
	/* return to the Event-list */
	header("Location: EventList.php");
}

/* load the Event-GUI */
$form = new EventForm($event, $user, '../userCake/Event.php');
$form->show();
?>
