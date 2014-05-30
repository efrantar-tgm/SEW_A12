<?php



/**
 * This class defines the structure of the 'standardOptions' table.
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
class StandardOptionTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'SEW_A12.map.StandardOptionTableMap';

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
        $this->setName('standardOptions');
        $this->setPhpName('StandardOption');
        $this->setClassname('StandardOption');
        $this->setPackage('SEW_A12');
        $this->setUseIdGenerator(false);
        // columns
        $this->addColumn('choices', 'Choices', 'OBJECT', false, null, null);
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'dateOptions', 'id', true, null, null);
        $this->addColumn('date', 'Date', 'TIMESTAMP', true, null, null);
        $this->addColumn('fixed', 'Fixed', 'BOOLEAN', false, 1, false);
        $this->addForeignKey('eventId', 'Eventid', 'INTEGER', 'events', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('DateOption', 'DateOption', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Event', 'Event', RelationMap::MANY_TO_ONE, array('eventId' => 'id', ), 'CASCADE', null);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'concrete_inheritance' =>  array (
  'extends' => 'dateOptions',
  'descendant_column' => 'descendant_class',
  'copy_data_to_parent' => 'true',
  'schema' => '',
  'excluded_parent_behavior' => 'nested_set',
),
        );
    } // getBehaviors()

} // StandardOptionTableMap
