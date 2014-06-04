<?php



/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'notifications' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.SEW_A12
 */
class OptionFixed extends BaseNotification {

    /**
     * Constructs a new OptionFixed class, setting the class_key column to NotificationPeer::CLASSKEY_OPTION_FIXED.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setClassKey(NotificationPeer::CLASSKEY_OPTION_FIXED);
    }

} // OptionFixed
