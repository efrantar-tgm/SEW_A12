<?php
/**
 * This is the control file of the event-create UI. It handles all submit events.
 * @author Elias Frantar
 * @version 29.5.2014
 */

/* TODO: remove error reporting; error reporting is just for testing! */
error_reporting(E_ALL); 
ini_set("display_errors", "1");

/* require all necessary files */
require_once("models/config.php");
require_once("../PropelInit.php");
require_once("../forms/EventCreateForm.php");
require_once("../access_control/Role.php");

/* this page should only be accessed by logged in users */
if (!securePage($_SERVER['PHP_SELF'])){ die(); }

/* create the new event of the specified type */
switch($_POST['eventtype']) {
	case 'standardEvent':
		$event = new StandardEvent();
		break;
	case 'oneoneEvent':
		$event = new OneOneEvent();		
		break;
	default:
		die();	
}
$event->setName($_POST['eventName']);
$event->save();

/* invite yourself as an organizer */
$user = MyUser::findByName($loggedInUser->username);

$role = new Role(array(Permission::MANAGE_INVITATIONS), $user, $event);
$role->getPermission(Permission::MANAGE_INVITATIONS)->invite($user, Event::ORGANIZER);

header("Location: EventList.php"); // return to the EventList after creation
?>
