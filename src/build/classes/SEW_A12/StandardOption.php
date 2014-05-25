<?php
class StandardOption extends DateOption {

    /**
     * Constructs a new StandardOption class, setting the class_key column to DateOptionPeer::CLASSKEY_STANDARD.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setClassKey(DateOptionPeer::CLASSKEY_STANDARD);
    }

		/*
     * @see DateOption
     */
		public abstract function poll($user, $accept) {
		}

		/**
		 * @see DateOption
		 */
		public abstract function pollFinished() {
		}
}
?>
