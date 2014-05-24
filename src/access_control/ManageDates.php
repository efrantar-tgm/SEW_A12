<?php
require_once("Permission.php");
require_once("../PropelInit.php");

/**
 * This permission allows a user to edit, add and remove the options of an event.
 * @author Elias Frantar
 * @version 24.5.2014
 */
class ManageDates extends Permission {
	/**
	 * Creates a new ManageDates permission for the given user and event.
   * @param Event the event to create the permission for
   * @param MyUser the user to create the permission for
   */
	public function __construct($event, $user) {
		$this->event = $event;
		$this->user = $user;
	}
	
	/**
	 * Adds the given option to the event.
 	 * @param DateOption the option to add
	 */
	public function addOption($option) {
		$this->event->addDateOption($option);
		$this->event->save();
	}

	/**
   * Removes the given option from the event.
   * @param DateOption the option to remove
   */
	public function removeOption($option) {
		$this->event->removeDateOption($option); // this should also automatically delete the removed option from the database
		$this->event->save();
	}

	/**
   * Edits the date in the given option.
   * @param DateOption the option to edit the date in
	 * @param Date the new date to update in the given option
   */
	public function editOption($option, $newDate) {
		$option->setDate($newDate);
		$option->setFixed(false); // a changed option cannot be fixed already
		$option->save();
	}
}
?>
