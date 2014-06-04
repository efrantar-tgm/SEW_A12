<?php
/**
 * This is the control file of the event UI. It handles all submit events.
 * @author Elias Frantar
 * @version 29.5.2014
 */

/* TODO: notification implementation */

/* TODO: remove error reporting; error reporting is just for testing! */
error_reporting(E_ALL); 
ini_set("display_errors", "1");

/* require all necessary classes */
require_once("models/config.php");
require_once("../PropelInit.php");
require_once("../forms/EventForm.php");
require_once("../forms/StandardEventForm.php");
require_once("../forms/OneOneEventForm.php");
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
		
		case "POST_COMMENT":
			$comment = new Comment();
			$comment->setContent($_POST["content"]);
			$comment->setPosttime($_SERVER['REQUEST_TIME']);
			$comment->setUsername($user->getName());
			$comment->setEventid($event->getId());
			$comment->save();
			break;

		case "REMOVE_COMMENT":
			$comment = CommentQuery::create()
  				->findPk($_POST['to_delete']);
			$comment->delete();
			break;
			
	}
}

if(isset($_POST["save"])) {
	$options = DateOptionQuery::create()
	-> filterByEvent($event)
	-> orderByDate()
	-> find();
	
	if($event instanceof StandardEvent) {	
		for($i = 0;$i < count($options);$i++) {
			switch($_POST["poll".$i]) {
			case "OK":
				$state = true;
				break;
			case "DECLINE":
				$state = false;
				break;
			default:
				$state = null;
			}
	
			if(isset($state)) {
				$role->getPermission(Permission::POLL)->poll($options[$i], $state);
			}
		}
	}
	if($event instanceof OneOneEvent) {
		if(isset($_POST["poll"])) {
			foreach($options as $option) {
				$state = $option->getId() == $_POST["poll"];
				$role->getPermission(Permission::POLL)->poll($option, $state);
			}
		}
	}
	
	header("Location: EventList.php");
	die();
}

/* this was neither an AJAX-request or a form submission, so just load the UI */
if($event instanceof StandardEvent) {
	$form = new StandardEventForm($event, $user);
	$form->show();
}
if($event instanceof OneOneEvent) {
	$form = new OneOneEventForm($event, $user);
	$form->show();
}
?>