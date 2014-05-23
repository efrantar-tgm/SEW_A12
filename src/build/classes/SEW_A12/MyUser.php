<?php
require_once("../../../PropelInit.php");

class MyUser extends BaseMyUser
{
	public function findAllInvitedEvents() {
		return findEventsByRole(Event::PARTICIPANT);
	}
	public function findAllOrganizedEvents() {
		return findEventsByRole(Event::ORGANIZER);	
	}

	private function findEventsByRole($role) {
		return InvitationQuery::create()
			-> join('Event')
			-> filterByRole($role)
			-> filterByUsername($this->name)
			-> select(array('Event.id'))
			-> find();
	}
}
