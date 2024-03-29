<?php
/**
 * This is the base-class for all date-options used in this application.
 * @author Elias Frantar
 * @version 25.5.2014
 */
abstract class DateOption extends BaseDateOption
{
	const ACCEPT = 0;
	const DECLINE = 1;
	const NONE = 2;
	
	/**
	 * Returns the date-option identified by the given id.
	 * @param int the id of the option to find
	 * @return DateOption the option with the given id (if exists); null otherwise
	 */
	public static function findById($id) {
		return DateOptionQuery::create()->findPk($id);
	}
	
	/**
     * Polls this option for a given user.
     * @param MyUser the user to poll for
     * @param boolean true if accept; false otherwise
     * @return boolean true if poll was successful/allowed; false otherwise
     */
	public abstract function poll($user, $accept);

	/**
     * Determines if the poll for this option has already been finished.
	 * @param Event the event this date-option is from (required to determine if the poll is finished)
     * @return boolean true if poll is finished; false otherwise
     */
	public abstract function pollFinished($event);
	
	/**
	 * Determines the poll status (accepted, declined, none) for the given user.
	 * @param MyUser $user the user to determine the poll status from
	 * @return int the poll status of the user (one of this class' constants)
	 */
	public abstract function getPollStatus($user);
}
?>
