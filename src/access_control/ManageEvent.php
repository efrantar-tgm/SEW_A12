<?php
require_once("Permission.php");
require_once("../PropelInit.php");

/**
 * This permission allows a user to rename or delete an event.
 * @author Elias Frantar
 * @version 24.5.2014
 */
class ManageEvent extends Permission {
	/**
	 * Creates a new ManageEvent permission for the given user and event.
     * @param Event the event to create the permission for
     * @param MyUser the user to create the permission for
     */
	public function __construct($event, $user) {
		$this->event = $event;
		$this->user = $user;
	}
	
	/**
	 * Renames the event to the given name.
     * @param String the new name of the event
     */
	public function rename($newName) {
		$this->event->setName($newName);
		$this->event->save();
	}

	/**
     * Deletes the managed Event.
	 * IMPORTANT: Drop the role used for deletion immediately after calling this method!
     */
	public function deleteEvent() {
		$this->event->delete(); // this should also automatically delete all options and invitations from the database
	}
}
?>
