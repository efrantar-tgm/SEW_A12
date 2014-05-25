<?php
/**
 * This is the base-class of all different event types in this application.
 * @author Elias Frantar
 * @version 25.5.2014
 */
abstract class Event extends BaseEvent // abstract because we only want instances of definite events
{
	/* constants defining the different roles a user can have in an event */
	const NONE = -1;
	const ORGANIZER = 0;
	const PARTICIPANT = 1;

	/**
	 * Returns the role the given user has in this event.
   * @param MyUser the user, whose role should be determined
   * @return int the role of the user in this event (one of the constants defined in this class)
   */
	public function getRole($user) {
		$invitation = $this->getInvitation($user);

		if(is_null($invitation)){ return EVENT::NONE; }
		return $invitation->getRole();
	}

	/**
   * Returns the inivtation for this event (if exists) and the given user.
   * @param MyUser the user, whose invitation should be returned
   * @return Invitation the invitation for this user; null if not exists
   */
	public function getInvitation($user) {
		return InvitationQuery::create() -> findPk(array($user->getName(), $this->getId()));
	}

	/**
   * Determines if all participants have already polled
   * @return boolean true if the poll is finished; false otherwise
   */
	public function pollFinished() {
		$finished = true;
		$dateOptions = $this->getDateOptions();

		foreach($dateOptions as $dateOption) {
			$finished &= $dateOption->pollFinisehd();		
		}
		return $finished;
	}
}
?>
