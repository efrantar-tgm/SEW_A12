<?php


/**
 * Base class that represents a query for the 'dateOptions' table.
 *
 *
 *
 * @method DateOptionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method DateOptionQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method DateOptionQuery orderByFixed($order = Criteria::ASC) Order by the fixed column
 * @method DateOptionQuery orderByEventid($order = Criteria::ASC) Order by the eventId column
 * @method DateOptionQuery orderByClassKey($order = Criteria::ASC) Order by the class_key column
 * @method DateOptionQuery orderByChoices($order = Criteria::ASC) Order by the choices column
 * @method DateOptionQuery orderByUsername($order = Criteria::ASC) Order by the userName column
 *
 * @method DateOptionQuery groupById() Group by the id column
 * @method DateOptionQuery groupByDate() Group by the date column
 * @method DateOptionQuery groupByFixed() Group by the fixed column
 * @method DateOptionQuery groupByEventid() Group by the eventId column
 * @method DateOptionQuery groupByClassKey() Group by the class_key column
 * @method DateOptionQuery groupByChoices() Group by the choices column
 * @method DateOptionQuery groupByUsername() Group by the userName column
 *
 * @method DateOptionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DateOptionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DateOptionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method DateOptionQuery leftJoinEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Event relation
 * @method DateOptionQuery rightJoinEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Event relation
 * @method DateOptionQuery innerJoinEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the Event relation
 *
 * @method DateOptionQuery leftJoinMyUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the MyUser relation
 * @method DateOptionQuery rightJoinMyUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MyUser relation
 * @method DateOptionQuery innerJoinMyUser($relationAlias = null) Adds a INNER JOIN clause to the query using the MyUser relation
 *
 * @method DateOptionQuery leftJoinNotification($relationAlias = null) Adds a LEFT JOIN clause to the query using the Notification relation
 * @method DateOptionQuery rightJoinNotification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Notification relation
 * @method DateOptionQuery innerJoinNotification($relationAlias = null) Adds a INNER JOIN clause to the query using the Notification relation
 *
 * @method DateOption findOne(PropelPDO $con = null) Return the first DateOption matching the query
 * @method DateOption findOneOrCreate(PropelPDO $con = null) Return the first DateOption matching the query, or a new DateOption object populated from the query conditions when no match is found
 *
 * @method DateOption findOneByDate(string $date) Return the first DateOption filtered by the date column
 * @method DateOption findOneByFixed(boolean $fixed) Return the first DateOption filtered by the fixed column
 * @method DateOption findOneByEventid(int $eventId) Return the first DateOption filtered by the eventId column
 * @method DateOption findOneByClassKey(string $class_key) Return the first DateOption filtered by the class_key column
 * @method DateOption findOneByChoices( $choices) Return the first DateOption filtered by the choices column
 * @method DateOption findOneByUsername(string $userName) Return the first DateOption filtered by the userName column
 *
 * @method array findById(int $id) Return DateOption objects filtered by the id column
 * @method array findByDate(string $date) Return DateOption objects filtered by the date column
 * @method array findByFixed(boolean $fixed) Return DateOption objects filtered by the fixed column
 * @method array findByEventid(int $eventId) Return DateOption objects filtered by the eventId column
 * @method array findByClassKey(string $class_key) Return DateOption objects filtered by the class_key column
 * @method array findByChoices( $choices) Return DateOption objects filtered by the choices column
 * @method array findByUsername(string $userName) Return DateOption objects filtered by the userName column
 *
 * @package    propel.generator.SEW_A12.om
 */
abstract class BaseDateOptionQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDateOptionQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'SEW_A12';
        }
        if (null === $modelName) {
            $modelName = 'DateOption';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DateOptionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   DateOptionQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DateOptionQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DateOptionQuery) {
            return $criteria;
        }
        $query = new DateOptionQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   DateOption|DateOption[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DateOptionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DateOptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 DateOption A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 DateOption A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `date`, `fixed`, `eventId`, `class_key`, `choices`, `userName` FROM `dateOptions` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $cls = DateOptionPeer::getOMClass($row, 0);
            $obj = new $cls();
            $obj->hydrate($row);
            DateOptionPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return DateOption|DateOption[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|DateOption[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return DateOptionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DateOptionPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DateOptionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DateOptionPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DateOptionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DateOptionPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DateOptionPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DateOptionPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date < '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DateOptionQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(DateOptionPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(DateOptionPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DateOptionPeer::DATE, $date, $comparison);
    }

    /**
     * Filter the query on the fixed column
     *
     * Example usage:
     * <code>
     * $query->filterByFixed(true); // WHERE fixed = true
     * $query->filterByFixed('yes'); // WHERE fixed = true
     * </code>
     *
     * @param     boolean|string $fixed The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DateOptionQuery The current query, for fluid interface
     */
    public function filterByFixed($fixed = null, $comparison = null)
    {
        if (is_string($fixed)) {
            $fixed = in_array(strtolower($fixed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DateOptionPeer::FIXED, $fixed, $comparison);
    }

    /**
     * Filter the query on the eventId column
     *
     * Example usage:
     * <code>
     * $query->filterByEventid(1234); // WHERE eventId = 1234
     * $query->filterByEventid(array(12, 34)); // WHERE eventId IN (12, 34)
     * $query->filterByEventid(array('min' => 12)); // WHERE eventId >= 12
     * $query->filterByEventid(array('max' => 12)); // WHERE eventId <= 12
     * </code>
     *
     * @see       filterByEvent()
     *
     * @param     mixed $eventid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DateOptionQuery The current query, for fluid interface
     */
    public function filterByEventid($eventid = null, $comparison = null)
    {
        if (is_array($eventid)) {
            $useMinMax = false;
            if (isset($eventid['min'])) {
                $this->addUsingAlias(DateOptionPeer::EVENTID, $eventid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventid['max'])) {
                $this->addUsingAlias(DateOptionPeer::EVENTID, $eventid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DateOptionPeer::EVENTID, $eventid, $comparison);
    }

    /**
     * Filter the query on the class_key column
     *
     * Example usage:
     * <code>
     * $query->filterByClassKey('fooValue');   // WHERE class_key = 'fooValue'
     * $query->filterByClassKey('%fooValue%'); // WHERE class_key LIKE '%fooValue%'
     * </code>
     *
     * @param     string $classKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DateOptionQuery The current query, for fluid interface
     */
    public function filterByClassKey($classKey = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($classKey)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $classKey)) {
                $classKey = str_replace('*', '%', $classKey);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DateOptionPeer::CLASS_KEY, $classKey, $comparison);
    }

    /**
     * Filter the query on the choices column
     *
     * @param     mixed $choices The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DateOptionQuery The current query, for fluid interface
     */
    public function filterByChoices($choices = null, $comparison = null)
    {
        if (is_object($choices)) {
            $choices = serialize($choices);
        }

        return $this->addUsingAlias(DateOptionPeer::CHOICES, $choices, $comparison);
    }

    /**
     * Filter the query on the userName column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE userName = 'fooValue'
     * $query->filterByUsername('%fooValue%'); // WHERE userName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DateOptionQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $username)) {
                $username = str_replace('*', '%', $username);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DateOptionPeer::USERNAME, $username, $comparison);
    }

    /**
     * Filter the query by a related Event object
     *
     * @param   Event|PropelObjectCollection $event The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 DateOptionQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByEvent($event, $comparison = null)
    {
        if ($event instanceof Event) {
            return $this
                ->addUsingAlias(DateOptionPeer::EVENTID, $event->getId(), $comparison);
        } elseif ($event instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DateOptionPeer::EVENTID, $event->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByEvent() only accepts arguments of type Event or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Event relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DateOptionQuery The current query, for fluid interface
     */
    public function joinEvent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Event');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Event');
        }

        return $this;
    }

    /**
     * Use the Event relation Event object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   EventQuery A secondary query class using the current class as primary query
     */
    public function useEventQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEvent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Event', 'EventQuery');
    }

    /**
     * Filter the query by a related MyUser object
     *
     * @param   MyUser|PropelObjectCollection $myUser The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 DateOptionQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByMyUser($myUser, $comparison = null)
    {
        if ($myUser instanceof MyUser) {
            return $this
                ->addUsingAlias(DateOptionPeer::USERNAME, $myUser->getName(), $comparison);
        } elseif ($myUser instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DateOptionPeer::USERNAME, $myUser->toKeyValue('PrimaryKey', 'Name'), $comparison);
        } else {
            throw new PropelException('filterByMyUser() only accepts arguments of type MyUser or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MyUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DateOptionQuery The current query, for fluid interface
     */
    public function joinMyUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MyUser');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'MyUser');
        }

        return $this;
    }

    /**
     * Use the MyUser relation MyUser object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   MyUserQuery A secondary query class using the current class as primary query
     */
    public function useMyUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMyUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MyUser', 'MyUserQuery');
    }

    /**
     * Filter the query by a related Notification object
     *
     * @param   Notification|PropelObjectCollection $notification  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 DateOptionQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNotification($notification, $comparison = null)
    {
        if ($notification instanceof Notification) {
            return $this
                ->addUsingAlias(DateOptionPeer::ID, $notification->getOption(), $comparison);
        } elseif ($notification instanceof PropelObjectCollection) {
            return $this
                ->useNotificationQuery()
                ->filterByPrimaryKeys($notification->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNotification() only accepts arguments of type Notification or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Notification relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DateOptionQuery The current query, for fluid interface
     */
    public function joinNotification($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Notification');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Notification');
        }

        return $this;
    }

    /**
     * Use the Notification relation Notification object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   NotificationQuery A secondary query class using the current class as primary query
     */
    public function useNotificationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNotification($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Notification', 'NotificationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   DateOption $dateOption Object to remove from the list of results
     *
     * @return DateOptionQuery The current query, for fluid interface
     */
    public function prune($dateOption = null)
    {
        if ($dateOption) {
            $this->addUsingAlias(DateOptionPeer::ID, $dateOption->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
