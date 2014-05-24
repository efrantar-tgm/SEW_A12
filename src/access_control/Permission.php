<?php
/**
 * This is the base-class of the permission management system. It includes the constants defining the different permission types.
 * @author Elias Frantar
 * @version 24.5.2014
 */
abstract class Permission {

	/* choose from the following different permission */
	const MANAGE_DATES = 0;
	const MANAGE_COMMENTS = 1;
	const MANAGE_INVITATIONS = 2;
	const POLL = 3;
	const MANAGE_EVENT = 4;

	var $event;
	var $user;
}
?>
