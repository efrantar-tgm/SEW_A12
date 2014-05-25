<?php
/**
 * This is the base-class for all date-options used in this application.
 * @author Elias Frantar
 * @version 25.5.2014
 */
abstract class DateOption extends BaseDateOption
{
	/**
   * Polls this option for a given user.
   * @param MyUser the user to poll for
   * @param boolean true if accept; false otherwise
   * @return boolean true if poll was successful/allowed; false otherwise
   */
	public abstract function poll($user, $accept);

	/**
   * Determines if the poll for this option has already been finished.
   * @return boolean true if poll is finished; false otherwise
   */
	public abstract function pollFinished();
}
?>
