<?php
/**
 * This is the DateOption-class for standard-events.
 * @author Elias Frantar
 * @version 26.5.2014
 */
class StandardOption extends DateOption {

    /**
     * Constructs a new StandardOption class, setting the class_key column to DateOptionPeer::CLASSKEY_STANDARD.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setClassKey(DateOptionPeer::CLASSKEY_STANDARD);

				$this->setChoices = array();
    }

		/*
     * @see DateOption
     */
		public function poll($user, $accept) {
			$this->getChoices()[$user->getName()] = $accept;
			return true; // in standard-options poll should always be possible
		}

		/**
		 * @see DateOption
		 */
		public function pollFinished($event) {
			$events = InvitationQuery::create() -> findByEventId($event->getId());
			
			$finished = count($this->choices) == count($event); // check if there is an entry for every invitation
			foreach($this->choices as $choice)
				$finished &= !is_null($choiche); // check if no entry is null (it should only be true/false)

			return $finished;
		}
}
?>
