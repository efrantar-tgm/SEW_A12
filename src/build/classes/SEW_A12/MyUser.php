<?php
/**
 * This class is our own User-object. It is used for database relations and permission management.
 * @author Elias Frantar
 * @version 23.5.2014
 */
class MyUser extends BaseMyUser
{
	/**
	 * Returns the user identified by the given name.
	 * @param String the name of the user to find
	 * @return MyUser the user with the given name (if exists); null otherwise
	 */
	public static function findByName($name) {
		return MyUserQuery::create()->findPk($name);
	}
	
	/**
	 * Returns all events this user is invited to.
     * @return Event[] all events this user is invited to
     */
	public function findAllInvitedEvents() {
		return $this->findEventsByRole(Event::PARTICIPANT);
	}
	/**
	 * Returns all events this user organizes.
	 * @return Event[] all events this user organizes
     */
	public function findAllOrganizedEvents() {
		return $this->findEventsByRole(Event::ORGANIZER);	
	}

	/**
     * Returns all events, in which the user has the given role
	 * @param int the role this user should have in the returned events (one of the constants stored in the class 'Event')
	 * @return Event[] all events, in which the user has the given role
     */
	private function findEventsByRole($role) {
		$pks = InvitationQuery::create()
			-> join('Event')
			-> filterByRole($role)
			-> filterByUsername($this->name)
			-> select(array('Event.id'))
			-> find();
		
		return EventQuery::create()->findPks($pks);
	}
}
