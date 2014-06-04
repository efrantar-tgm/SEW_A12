<?php


/**
 * Base class that represents a query for the 'notifications' table.
 *
 *
 *
 * @method NotificationQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NotificationQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method NotificationQuery orderByOption($order = Criteria::ASC) Order by the option column
 * @method NotificationQuery orderByEventId($order = Criteria::ASC) Order by the event_id column
 * @method NotificationQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method NotificationQuery orderByClassKey($order = Criteria::ASC) Order by the class_key column
 *
 * @method NotificationQuery groupById() Group by the id column
 * @method NotificationQuery groupByStatus() Group by the status column
 * @method NotificationQuery groupByOption() Group by the option column
 * @method NotificationQuery groupByEventId() Group by the event_id column
 * @method NotificationQuery groupByUsername() Group by the username column
 * @method NotificationQuery groupByClassKey() Group by the class_key column
 *
 * @method NotificationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NotificationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NotificationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NotificationQuery leftJoinDateOption($relationAlias = null) Adds a LEFT JOIN clause to the query using the DateOption relation
 * @method NotificationQuery rightJoinDateOption($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DateOption relation
 * @method NotificationQuery innerJoinDateOption($relationAlias = null) Adds a INNER JOIN clause to the query using the DateOption relation
 *
 * @method NotificationQuery leftJoinEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Event relation
 * @method NotificationQuery rightJoinEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Event relation
 * @method NotificationQuery innerJoinEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the Event relation
 *
 * @method NotificationQuery leftJoinMyUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the MyUser relation
 * @method NotificationQuery rightJoinMyUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MyUser relation
 * @method NotificationQuery innerJoinMyUser($relationAlias = null) Adds a INNER JOIN clause to the query using the MyUser relation
 *
 * @method Notification findOne(PropelPDO $con = null) Return the first Notification matching the query
 * @method Notification findOneOrCreate(PropelPDO $con = null) Return the first Notification matching the query, or a new Notification object populated from the query conditions when no match is found
 *
 * @method Notification findOneById(int $id) Return the first Notification filtered by the id column
 * @method Notification findOneByStatus(int $status) Return the first Notification filtered by the status column
 * @method Notification findOneByOption(int $option) Return the first Notification filtered by the option column
 * @method Notification findOneByEventId(int $event_id) Return the first Notification filtered by the event_id column
 * @method Notification findOneByUsername(string $username) Return the first Notification filtered by the username column
 * @method Notification findOneByClassKey(string $class_key) Return the first Notification filtered by the class_key column
 *
 * @method array findById(int $id) Return Notification objects filtered by the id column
 * @method array findByStatus(int $status) Return Notification objects filtered by the status column
 * @method array findByOption(int $option) Return Notification objects filtered by the option column
 * @method array findByEventId(int $event_id) Return Notification objects filtered by the event_id column
 * @method array findByUsername(string $username) Return Notification objects filtered by the username column
 * @method array findByClassKey(string $class_key) Return Notification objects filtered by the class_key column
 *
 * @package    propel.generator.SEW_A12.om
 */
abstract class BaseNotificationQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNotificationQuery object.
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
            $modelName = 'Notification';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NotificationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NotificationQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NotificationQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NotificationQuery) {
            return $criteria;
        }
        $query = new NotificationQuery(null, null, $modelAlias);

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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$id, $username]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Notification|Notification[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NotificationPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NotificationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Notification A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `status`, `option`, `event_id`, `username`, `class_key` FROM `notifications` WHERE `id` = :p0 AND `username` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $cls = NotificationPeer::getOMClass($row, 0);
            $obj = new $cls();
            $obj->hydrate($row);
            NotificationPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return Notification|Notification[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Notification[]|mixed the list of results, formatted by the current formatter
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
     * @return NotificationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(NotificationPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(NotificationPeer::USERNAME, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NotificationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(NotificationPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(NotificationPeer::USERNAME, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return NotificationQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NotificationPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NotificationPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status >= 12
     * $query->filterByStatus(array('max' => 12)); // WHERE status <= 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotificationQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NotificationPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NotificationPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the option column
     *
     * Example usage:
     * <code>
     * $query->filterByOption(1234); // WHERE option = 1234
     * $query->filterByOption(array(12, 34)); // WHERE option IN (12, 34)
     * $query->filterByOption(array('min' => 12)); // WHERE option >= 12
     * $query->filterByOption(array('max' => 12)); // WHERE option <= 12
     * </code>
     *
     * @see       filterByDateOption()
     *
     * @param     mixed $option The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotificationQuery The current query, for fluid interface
     */
    public function filterByOption($option = null, $comparison = null)
    {
        if (is_array($option)) {
            $useMinMax = false;
            if (isset($option['min'])) {
                $this->addUsingAlias(NotificationPeer::OPTION, $option['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($option['max'])) {
                $this->addUsingAlias(NotificationPeer::OPTION, $option['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationPeer::OPTION, $option, $comparison);
    }

    /**
     * Filter the query on the event_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEventId(1234); // WHERE event_id = 1234
     * $query->filterByEventId(array(12, 34)); // WHERE event_id IN (12, 34)
     * $query->filterByEventId(array('min' => 12)); // WHERE event_id >= 12
     * $query->filterByEventId(array('max' => 12)); // WHERE event_id <= 12
     * </code>
     *
     * @see       filterByEvent()
     *
     * @param     mixed $eventId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotificationQuery The current query, for fluid interface
     */
    public function filterByEventId($eventId = null, $comparison = null)
    {
        if (is_array($eventId)) {
            $useMinMax = false;
            if (isset($eventId['min'])) {
                $this->addUsingAlias(NotificationPeer::EVENT_ID, $eventId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventId['max'])) {
                $this->addUsingAlias(NotificationPeer::EVENT_ID, $eventId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationPeer::EVENT_ID, $eventId, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%'); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NotificationQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NotificationPeer::USERNAME, $username, $comparison);
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
     * @return NotificationQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NotificationPeer::CLASS_KEY, $classKey, $comparison);
    }

    /**
     * Filter the query by a related DateOption object
     *
     * @param   DateOption|PropelObjectCollection $dateOption The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NotificationQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByDateOption($dateOption, $comparison = null)
    {
        if ($dateOption instanceof DateOption) {
            return $this
                ->addUsingAlias(NotificationPeer::OPTION, $dateOption->getId(), $comparison);
        } elseif ($dateOption instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NotificationPeer::OPTION, $dateOption->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDateOption() only accepts arguments of type DateOption or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DateOption relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NotificationQuery The current query, for fluid interface
     */
    public function joinDateOption($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DateOption');

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
            $this->addJoinObject($join, 'DateOption');
        }

        return $this;
    }

    /**
     * Use the DateOption relation DateOption object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   DateOptionQuery A secondary query class using the current class as primary query
     */
    public function useDateOptionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDateOption($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DateOption', 'DateOptionQuery');
    }

    /**
     * Filter the query by a related Event object
     *
     * @param   Event|PropelObjectCollection $event The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NotificationQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByEvent($event, $comparison = null)
    {
        if ($event instanceof Event) {
            return $this
                ->addUsingAlias(NotificationPeer::EVENT_ID, $event->getId(), $comparison);
        } elseif ($event instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NotificationPeer::EVENT_ID, $event->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return NotificationQuery The current query, for fluid interface
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
     * @return                 NotificationQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByMyUser($myUser, $comparison = null)
    {
        if ($myUser instanceof MyUser) {
            return $this
                ->addUsingAlias(NotificationPeer::USERNAME, $myUser->getName(), $comparison);
        } elseif ($myUser instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NotificationPeer::USERNAME, $myUser->toKeyValue('PrimaryKey', 'Name'), $comparison);
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
     * @return NotificationQuery The current query, for fluid interface
     */
    public function joinMyUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useMyUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMyUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MyUser', 'MyUserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Notification $notification Object to remove from the list of results
     *
     * @return NotificationQuery The current query, for fluid interface
     */
    public function prune($notification = null)
    {
        if ($notification) {
            $this->addCond('pruneCond0', $this->getAliasedColName(NotificationPeer::ID), $notification->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(NotificationPeer::USERNAME), $notification->getUsername(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
