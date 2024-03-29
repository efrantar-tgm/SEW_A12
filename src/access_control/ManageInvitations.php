<?php
require_once("Permission.php");
require_once("../PropelInit.php");

/**
 * This permission allows a user to invite and disinvite user from an event.
 * @author Elias Frantar
 * @version 27.5.2014
 */
class ManageInvitations extends Permission {
	/**
     * Creates a new ManageInvitations permission for the given user and event.
     * @param Event the event to create the permission for
     * @param MyUser the user to create the permission for
     */	
	public function __construct($event, $user) {
		$this->event = $event;
		$this->user = $user;
	}

	/**
	 * Invites the given user to the event.
     * @param MyUser the user to invite
	 * @param int the role the invited use should have in this event (one of the constants in Event)
     */
	public function invite($user, $role) {
		$invitation = new Invitation();
		$invitation->setUsername($user->getName());
		$invitation->setEventId($this->event->getId());
		$invitation->setRole($role);

		$this->event->addInvitation($invitation);
		$this->event->save();
	}

	/**
     * Disinivtes the given user from the event.
     * @param MyUser the user to disinvite
     */
	public function disinvite($user) {
		$invitation = $this->event->getInvitation($user);
		$this->event->removeInvitation($invitation); // this should also automatically remove the invitation from the database		
		$this->event->save();
	}
}
?>
