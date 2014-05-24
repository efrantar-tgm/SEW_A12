<?php
class Event extends BaseEvent
{
	const NONE = -1;
	const ORGANIZER = 0;
	const PARTICIPANT = 1;

	public function getRole($user) {
		$invitation = $this->getInvitation($user);

		if(is_null($invitation)){ return EVENT::NONE; }
		return $invitation->getRole();
	}

	public function getInvitation($user) {
		return InvitationQuery::create() -> findPk(array($user->getName(), $this->getId()));
	}
}
