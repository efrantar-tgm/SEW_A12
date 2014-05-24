<?php
error_reporting(E_ALL); 
ini_set("display_errors", "1");

require_once("models/config.php");
require_once("../PropelInit.php");
require_once("../access_control/Role.php");

/* this page should only be accessed by logged in users */
if (!securePage($_SERVER['PHP_SELF'])){ die(); }

$event = EventQuery::create()->findPk($_GET["id"]);
$user = MyUserQuery::create()->findPk($loggedInUser->username);

/* manage permission */
$roletype = $event->getRole($user);

switch($roletype) {
	case Event::ORGANIZER:
		$role = new Role(array(Permission::MANAGE_INVITATIONS, Permission::MANAGE_EVENT, Permission::MANAGE_DATES), $user, $event);
		break;
	case Event::PARTICIPANT:
		$role = null;
		break;
	case Event::NONE:
		$role = null;
		break;
}

if($roletype == EVENT::ORGANIZER) {
	/* test inviting and disinviting */
	$manage_invitations = $role->getPermission(Permission::MANAGE_INVITATIONS);

	$newUser = MyUserQuery::create()->findPk("User1");
	
	$manage_invitations->disinvite($newUser);
	$manage_invitations->invite($newUser);

	/* test add editing and deleting date options */
	$manage_dates = $role->getPermission(Permission::MANAGE_DATES);
	
	$option = new DateOption(new DateTime("2000-01-01"));

	$manage_dates->addOption($option);
	$manage_dates->editOption($option, new DateTime("2000-01-02"));
	$manage_dates->removeOption($option);

	/* test deleting the event */
	$manage_event = $role->getPermission(Permission::MANAGE_EVENT);

	$manage_event->deleteEvent();
}
?>
