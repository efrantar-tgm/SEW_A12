<?php
require_once("models/config.php");
require_once("../PropelInit.php");
require_once("../forms/EventListForm.php");

/* this page should only be accessed by logged in users */
if (!securePage($_SERVER['PHP_SELF'])){ die(); }

$user = MyUserQuery::create()->findPk($loggedInUser->username);

$myEvents = $user->findAllInvitedEvents();
$invitedEvents = $user->findAllOrganizedEvents();

$form = new EventListForm($myEvents, $invitedEvents);
$form->show();
?>
