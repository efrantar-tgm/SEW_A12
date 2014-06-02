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

if(isset($_GET["id"])) {
	$_SESSION["event_id"] = $_GET["id"];
}

/* load the current user and event */
$event = Event::findById($_SESSION["event_id"]);
$user = MyUser::findByName($loggedInUser->username);

/* manage permissions */
$roletype = $event->getRole($user);
switch($roletype) {
	case Event::PARTICIPANT:
		$role = new Role(array(Permission::POLL), $user, $event);
		break;
}

/* handle the AJAX requests differntating them by the 'action' parameter */
if(isset($_POST["action"])) {
	switch($_POST["action"]) {
		case "FIX_DATE":
			$option = DateOption::findById($_POST["option"]);
			$option->setFixed(true);
			$option->save();
			
			if($event instanceof StandardEvent) {
				$event->setFixed(true);
				$event->save();
			}
			break;
	}
}

if(isset($_POST["save"])) {
	$options = DateOptionQuery::create()
		-> filterByEvent($event)
		-> orderByDate()
		-> find();
	
	for($i = 0;$i < count($options);$i++) {
		switch($_POST["poll".$i]) {
		case "OK":
			$state = true;
			break;
		case "DECLINE":
			$state = false;
			break;
		}

		if(isset($state)) {
			$role->getPermission(Permission::POLL)->poll($options[$i], $state);
		}
	}
	
	header("Location: EventList.php");
	die();
}

/* this was neither an AJAX-request or a form submission, so just load the UI */
$form = new EventForm($event, $user);
$form->show();
?>