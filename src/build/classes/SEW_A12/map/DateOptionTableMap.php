<?php



/**
 * This class defines the structure of the 'dateOptions' table.
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
class DateOptionTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'SEW_A12.map.DateOptionTableMap';

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
        $this->setName('dateOptions');
        $this->setPhpName('DateOption');
        $this->setClassname('DateOption');
        $this->setPackage('SEW_A12');
        $this->setUseIdGenerator(true);
        $this->setSingleTableInheritance(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('date', 'Date', 'DATE', true, null, null);
        $this->addColumn('fixed', 'Fixed', 'BOOLEAN', false, 1, false);
        $this->addForeignKey('eventId', 'Eventid', 'INTEGER', 'events', 'id', true, null, null);
        $this->addColumn('class_key', 'ClassKey', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Event', 'Event', RelationMap::MANY_TO_ONE, array('eventId' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // DateOptionTableMap
