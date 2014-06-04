<?php



/**
 * This class defines the structure of the 'users' table.
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
class MyUserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'SEW_A12.map.MyUserTableMap';

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
        $this->setName('users');
        $this->setPhpName('MyUser');
        $this->setClassname('MyUser');
        $this->setPackage('SEW_A12');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('name', 'Name', 'VARCHAR', true, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('DateOption', 'DateOption', RelationMap::ONE_TO_MANY, array('name' => 'userName', ), 'CASCADE', null, 'DateOptions');
        $this->addRelation('Invitation', 'Invitation', RelationMap::ONE_TO_MANY, array('name' => 'userName', ), 'CASCADE', null, 'Invitations');
        $this->addRelation('Notification', 'Notification', RelationMap::ONE_TO_MANY, array('name' => 'username', ), 'CASCADE', null, 'Notifications');
        $this->addRelation('Comment', 'Comment', RelationMap::ONE_TO_MANY, array('name' => 'username', ), 'CASCADE', null, 'Comments');
        $this->addRelation('Event', 'Event', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Events');
    } // buildRelations()

} // MyUserTableMap
