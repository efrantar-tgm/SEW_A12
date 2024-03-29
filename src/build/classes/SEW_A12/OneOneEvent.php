<?php



/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'events' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.SEW_A12
 */
class OneOneEvent extends Event {

    /**
     * Constructs a new OneOneEvent class, setting the class_key column to EventPeer::CLASSKEY_ONEONE.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setClassKey(EventPeer::CLASSKEY_ONEONE);
    }

} // OneOneEvent
