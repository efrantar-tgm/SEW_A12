<?php



/**
 * This class defines the structure of the 'comments' table.
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
class CommentTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'SEW_A12.map.CommentTableMap';

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
        $this->setName('comments');
        $this->setPhpName('Comment');
        $this->setClassname('Comment');
        $this->setPackage('SEW_A12');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('content', 'Content', 'VARCHAR', true, 255, null);
        $this->addColumn('postTime', 'Posttime', 'TIMESTAMP', true, null, null);
        $this->addForeignKey('username', 'Username', 'VARCHAR', 'users', 'name', false, 255, null);
        $this->addForeignKey('eventid', 'Eventid', 'INTEGER', 'events', 'id', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('MyUser', 'MyUser', RelationMap::MANY_TO_ONE, array('username' => 'name', ), 'CASCADE', null);
        $this->addRelation('Event', 'Event', RelationMap::MANY_TO_ONE, array('eventid' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // CommentTableMap
