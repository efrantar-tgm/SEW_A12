<?php



/**
 * This class defines the structure of the 'invitations' table.
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
class InvitationTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'SEW_A12.map.InvitationTableMap';

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
        $this->setName('invitations');
        $this->setPhpName('Invitation');
        $this->setClassname('Invitation');
        $this->setPackage('SEW_A12');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addColumn('role', 'Role', 'INTEGER', true, null, null);
        $this->addForeignPrimaryKey('userName', 'Username', 'VARCHAR' , 'users', 'name', true, 255, null);
        $this->addForeignPrimaryKey('eventId', 'Eventid', 'INTEGER' , 'events', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('MyUser', 'MyUser', RelationMap::MANY_TO_ONE, array('userName' => 'name', ), 'CASCADE', null);
        $this->addRelation('Event', 'Event', RelationMap::MANY_TO_ONE, array('eventId' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // InvitationTableMap
