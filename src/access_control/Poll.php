<?php
require_once("Permission.php");
require_once("../PropelInit.php");

/**
 * This permission allows a user to edit, add and remove the options of an event.
 * @author Elias Frantar
 * @version 24.5.2014
*/
class Poll extends Permission {
	/**
	 * Creates a new Poll permission for the given user and event.
	 * @param Event the event to create the permission for
	 * @param MyUser the user to create the permission for
	 */
	public function __construct($event, $user) {
		$this->event = $event;
		$this->user = $user;
	}

	/**
	 * Polls for the given option with either yes or no.
	 * @param DateOption the option to poll for
	 * @param boolean true for accept; false for decline
	 * @return boolean true if polling was successfull; false otherwise
	 */
	public function poll($option, $accept) {
		$ret = $option->poll($this->user, $accept);
		$option->save();
		
		return $ret;
	}
}
?>