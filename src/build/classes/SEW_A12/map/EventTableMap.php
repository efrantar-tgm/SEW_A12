<?php



/**
 * This class defines the structure of the 'events' table.
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
class EventTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'SEW_A12.map.EventTableMap';

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
        $this->setName('events');
        $this->setPhpName('Event');
        $this->setClassname('Event');
        $this->setPackage('SEW_A12');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('fixed', 'Fixed', 'BOOLEAN', false, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('DateOption', 'DateOption', RelationMap::ONE_TO_MANY, array('id' => 'eventId', ), 'CASCADE', null, 'DateOptions');
        $this->addRelation('Invitation', 'Invitation', RelationMap::ONE_TO_MANY, array('id' => 'eventId', ), 'CASCADE', null, 'Invitations');
        $this->addRelation('MyUser', 'MyUser', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'MyUsers');
    } // buildRelations()

} // EventTableMap
