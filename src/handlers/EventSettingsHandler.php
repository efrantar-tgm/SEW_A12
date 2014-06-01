<?php
/**
 * This is the control file of the event-settings UI. It handles all submit events.
* @author Elias Frantar
* @version 29.5.2014
*/

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

/* if this page was access via hardcoded URL -> exit */
if(!isset($_SESSION["event_id"])) {
	die();
}

/* load the current user and event */
$event = Event::findById($_SESSION["event_id"]);
$user = MyUser::findByName($loggedInUser->username);

/* if the loaded user is not an organizer, he should not be able to access the settings */
if($event->getRole($user) != Event::ORGANIZER) {
	die();
}

/* build the admin-role with all permission required for execution setting-changes */
$role = new Role(array(Permission::MANAGE_INVITATIONS, Permission::MANAGE_EVENT, Permission::MANAGE_DATES), $user, $event);

/* handle the submit actions */

/* the 'Edit-Name' button was pressed */
if(isset($_POST['editName'])) {
	if($_POST['eventName'] != "") { // events cannot have empty names
		$role->getPermission(Permission::MANAGE_EVENT)->rename($_POST['eventName']);
	}
}

/* the 'Add-Option' button was pressed */
if(isset($_POST['addOption'])) {
	/* TODO: add checks for validity */
	/* TODO: return feedback about wrong input to the user */

	$date = new DateTime($_POST['dateOption']);
	if($date != false) { // if Date-parsing was successfull
		if($event instanceof StandardEvent) {
			$option = new StandardOption();
			$option->setDate($date);
		}
		if($event instanceof OneOneEvent) {
			$option = new OneOneOption();
			$option->setDate($date);
		}

		$role->getPermission(Permission::MANAGE_DATES)->addOption($option);
	}
}
/* a 'Delete-Option' button was pressed */
if(isset($_POST['deleteOption'])) {
	$option = DateOption::findById($_POST['deleteOption']);
	$role->getPermission(Permission::MANAGE_DATES)->removeOption($option);
}

/* the 'Add-User' button was pressed */
if(isset($_POST['addUser'])) {
	/* TODO: return feedback to the user if the specified user was not found */

	$userToInvite = MyUser::findByName($_POST['username']);

	if(!is_null($userToInvite)) { // do only if the input user exists
		$role->getPermission(Permission::MANAGE_INVITATIONS)->invite($userToInvite, Event::PARTICIPANT);
	}
}
/* a 'Delete-User' button was pressed */
if(isset($_POST['deleteUser'])) {
	$userToDisinvite = MyUser::findByName($_POST['deleteUser']);
	$role->getPermission(Permission::MANAGE_INVITATIONS)->disinvite($userToDisinvite);
}

/* the 'Delete-Event' button was pressed */
if(isset($_POST['deleteEvent'])) {
	/* TODO: maybe show confirm dialog before performing the delete */

	$role->getPermission(Permission::MANAGE_EVENT)->deleteEvent();
	header("Location: EventList.php"); // return to the list since this event does not exist anymore
}

/* the 'Back' button was pressed */
if(isset($_POST['back'])) {
	/* return to the Event-GUI */
	$form = new EventForm($event, $user, '../userCake/Event.php');
	$form->show();
	die();
}

/* display the event-settings GUI */
$form = new EventSettingsForm($event, $user, '../userCake/EventSettings.php');
$form->show();
?>

?>