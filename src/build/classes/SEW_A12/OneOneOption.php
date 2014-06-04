<?php
/**
 * This is the DateOption-class for one-one-events.
 * @author Elias Frantar
 * @version 26.5.2014
 */
class OneOneOption extends DateOption {

    /**
     * Constructs a new OneOneOption class, setting the class_key column to DateOptionPeer::CLASSKEY_ONEONE.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setClassKey(DateOptionPeer::CLASSKEY_ONEONE);
    }

		/*
     * @see DateOption
     */
		public function poll($user, $accept) {
			if(!$accept) {
				if($user->getName() == $this->getUsername()) { // unpoll
					$this->setUsername(null);
				}
				return true;
			}
			else {
				if(empty($this->getUsername())) { // do not override a previous user
					$this->setUsername($user->getName());
					return true; // success			
				}
			}
			return false; // it has already been polled before
		}

		/**
		 * @see DateOption
		 */
		public function pollFinished($event) {
			return !is_null($this->getUsername());
		}
		
		/**
		 * @see DateOption
		 */
		public function getPollStatus($user) {
			if($this->getUsername() == $user->getName()) {
				return DateOption::ACCEPT;
			}
			else {
				return DateOption::NONE;
			}
		}
}
