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

/* functions often used for AJAX-responses */

/**
 * Returns a list of all date-options of the given event. (id + date)
 * @param $event the event to return the options from
 * @return string the json-representation of the date-options-list
 */
function getOptions($event) {
	$options = DateOptionQuery::create()
	-> filterByEvent($event)
	-> orderByDate()
	-> select(array("id", "date"))
	-> find();

	return json_encode($options);
}
/**
 * Returns a list of all invited users of the given event. (username)
 * @param $event the event to return the invited users from
 * @return string the json-representation of the invited-users-list
 */
function getUsers($event) {
	$usernames = InvitationQuery::create()
	-> filterByEvent($event)
	-> filterByRole(1) // we want only participants
	-> orderByUsername()
	-> select(array('username'))
	-> find();
	
	return json_encode($usernames);
}

/* if the loaded user is not an organizer, he should not be able to access the settings */
if($event->getRole($user) != Event::ORGANIZER) {
	die();
}

/* build the admin-role with all permission required for execution setting-changes */
$role = new Role(array(Permission::MANAGE_INVITATIONS, Permission::MANAGE_EVENT, Permission::MANAGE_DATES), $user, $event);

/* handle the AJAX requests differntating them by the 'action' parameter */
switch($_POST["action"]) {
	case "RENAME": // 'Rename'-request
		if($_POST["newName"] != "") { // events cannot have empty names
			$role->getPermission(Permission::MANAGE_EVENT)->rename($_POST["newName"]);
		}
		$result = $event->getName();
		break;
		
	case "ADD_OPTION": // 'AddOption'-request
		$date = new DateTime($_POST["newOption"]);
		
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
		
		$result = getOptions($event);
		break;		
	case "REMOVE_OPTION": // 'RemoveOption'-request
		$option = DateOption::findById($_POST["option"]);
		$role->getPermission(Permission::MANAGE_DATES)->removeOption($option);
		
		$result = getOptions($event);
		break;
		
	case "ADD_USER": // 'AddUser'-request
		$userToInvite = MyUser::findByName($_POST['newUser']);
		
		if(!is_null($userToInvite)) { // do only if the input user exists
			$role->getPermission(Permission::MANAGE_INVITATIONS)->invite($userToInvite, Event::PARTICIPANT);
		}
		
		$result = getUsers($event);
		break;
	case "REMOVE_USER": // 'RemoveUser'-request
		$userToDisinvite = MyUser::findByName($_POST['username']);
		$role->getPermission(Permission::MANAGE_INVITATIONS)->disinvite($userToDisinvite);
		
		$result = getUsers($event);
		break;
		
	case "DELETE_EVENT": // 'DeleteEvent'-requesst
		$role->getPermission(Permission::MANAGE_EVENT)->deleteEvent();
		break;
		
	case "GET_OPTIONS": // 'GetOptions'-request
		$result = getOptions($event);
		break;
	case "GET_USERS": // ''GetUsers'-request
		$result = getUsers($event);
		break;
}

echo $result; // return the AJAX-request-result
?>