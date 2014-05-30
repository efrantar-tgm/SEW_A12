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
			if($accept) { // only care about accepting polls
				if(is_empty($this->getUser())) { // do not override a previous user
					$this->setUser($user);
					return true; // success				
				}
			}
			return false; // it has already been polled before
		}

		/**
		 * @see DateOption
		 */
		public function pollFinished($event) {
			return !is_null($this->getUser());
		}
}
