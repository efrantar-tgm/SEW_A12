<?php



/**
 * This class defines the structure of the 'notifications' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.SEW_A12.map
 */
class NotificationTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'SEW_A12.map.NotificationTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('notifications');
        $this->setPhpName('Notification');
        $this->setClassname('Notification');
        $this->setPackage('SEW_A12');
        $this->setUseIdGenerator(false);
        $this->setSingleTableInheritance(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, null, null);
        $this->addForeignKey('option', 'Option', 'INTEGER', 'dateOptions', 'id', false, null, null);
        $this->addForeignKey('event_id', 'EventId', 'INTEGER', 'events', 'id', true, null, null);
        $this->addForeignPrimaryKey('username', 'Username', 'VARCHAR' , 'users', 'name', true, 255, null);
        $this->addColumn('class_key', 'ClassKey', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('DateOption', 'DateOption', RelationMap::MANY_TO_ONE, array('option' => 'id', ), 'CASCADE', null);
        $this->addRelation('Event', 'Event', RelationMap::MANY_TO_ONE, array('event_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('MyUser', 'MyUser', RelationMap::MANY_TO_ONE, array('username' => 'name', ), 'CASCADE', null);
    } // buildRelations()

} // NotificationTableMap
