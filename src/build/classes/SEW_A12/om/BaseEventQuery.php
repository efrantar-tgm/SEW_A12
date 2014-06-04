<?php


/**
 * Base class that represents a query for the 'events' table.
 *
 *
 *
 * @method EventQuery orderById($order = Criteria::ASC) Order by the id column
 * @method EventQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method EventQuery orderByFixed($order = Criteria::ASC) Order by the fixed column
 * @method EventQuery orderByClassKey($order = Criteria::ASC) Order by the class_key column
 *
 * @method EventQuery groupById() Group by the id column
 * @method EventQuery groupByName() Group by the name column
 * @method EventQuery groupByFixed() Group by the fixed column
 * @method EventQuery groupByClassKey() Group by the class_key column
 *
 * @method EventQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EventQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EventQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EventQuery leftJoinDateOption($relationAlias = null) Adds a LEFT JOIN clause to the query using the DateOption relation
 * @method EventQuery rightJoinDateOption($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DateOption relation
 * @method EventQuery innerJoinDateOption($relationAlias = null) Adds a INNER JOIN clause to the query using the DateOption relation
 *
 * @method EventQuery leftJoinInvitation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Invitation relation
 * @method EventQuery rightJoinInvitation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Invitation relation
 * @method EventQuery innerJoinInvitation($relationAlias = null) Adds a INNER JOIN clause to the query using the Invitation relation
 *
 * @method EventQuery leftJoinNotification($relationAlias = null) Adds a LEFT JOIN clause to the query using the Notification relation
 * @method EventQuery rightJoinNotification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Notification relation
 * @method EventQuery innerJoinNotification($relationAlias = null) Adds a INNER JOIN clause to the query using the Notification relation
 *
 * @method EventQuery leftJoinComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the Comment relation
 * @method EventQuery rightJoinComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Comment relation
 * @method EventQuery innerJoinComment($relationAlias = null) Adds a INNER JOIN clause to the query using the Comment relation
 *
 * @method Event findOne(PropelPDO $con = null) Return the first Event matching the query
 * @method Event findOneOrCreate(PropelPDO $con = null) Return the first Event matching the query, or a new Event object populated from the query conditions when no match is found
 *
 * @method Event findOneByName(string $name) Return the first Event filtered by the name column
 * @method Event findOneByFixed(boolean $fixed) Return the first Event filtered by the fixed column
 * @method Event findOneByClassKey(string $class_key) Return the first Event filtered by the class_key column
 *
 * @method array findById(int $id) Return Event objects filtered by the id column
 * @method array findByName(string $name) Return Event objects filtered by the name column
 * @method array findByFixed(boolean $fixed) Return Event objects filtered by the fixed column
 * @method array findByClassKey(string $class_key) Return Event objects filtered by the class_key column
 *
 * @package    propel.generator.SEW_A12.om
 */
abstract class BaseEventQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEventQuery object.
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
            $modelName = 'Event';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EventQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   EventQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EventQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EventQuery) {
            return $criteria;
        }
        $query = new EventQuery(null, null, $modelAlias);

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
     * @return   Event|Event[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EventPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Event A model object, or null if the key is not found
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
     * @return                 Event A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `fixed`, `class_key` FROM `events` WHERE `id` = :p0';
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
            $cls = EventPeer::getOMClass($row, 0);
            $obj = new $cls();
            $obj->hydrate($row);
            EventPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Event|Event[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Event[]|mixed the list of results, formatted by the current formatter
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
     * @return EventQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EventPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EventQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EventPeer::ID, $keys, Criteria::IN);
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
     * @return EventQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(EventPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(EventPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EventQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EventPeer::NAME, $name, $comparison);
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
     * @return EventQuery The current query, for fluid interface
     */
    public function filterByFixed($fixed = null, $comparison = null)
    {
        if (is_string($fixed)) {
            $fixed = in_array(strtolower($fixed), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EventPeer::FIXED, $fixed, $comparison);
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
     * @return EventQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EventPeer::CLASS_KEY, $classKey, $comparison);
    }

    /**
     * Filter the query by a related DateOption object
     *
     * @param   DateOption|PropelObjectCollection $dateOption  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 EventQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByDateOption($dateOption, $comparison = null)
    {
        if ($dateOption instanceof DateOption) {
            return $this
                ->addUsingAlias(EventPeer::ID, $dateOption->getEventid(), $comparison);
        } elseif ($dateOption instanceof PropelObjectCollection) {
            return $this
                ->useDateOptionQuery()
                ->filterByPrimaryKeys($dateOption->getPrimaryKeys())
                ->endUse();
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
     * @return EventQuery The current query, for fluid interface
     */
    public function joinDateOption($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useDateOptionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDateOption($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DateOption', 'DateOptionQuery');
    }

    /**
     * Filter the query by a related Invitation object
     *
     * @param   Invitation|PropelObjectCollection $invitation  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 EventQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByInvitation($invitation, $comparison = null)
    {
        if ($invitation instanceof Invitation) {
            return $this
                ->addUsingAlias(EventPeer::ID, $invitation->getEventid(), $comparison);
        } elseif ($invitation instanceof PropelObjectCollection) {
            return $this
                ->useInvitationQuery()
                ->filterByPrimaryKeys($invitation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByInvitation() only accepts arguments of type Invitation or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Invitation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EventQuery The current query, for fluid interface
     */
    public function joinInvitation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Invitation');

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
            $this->addJoinObject($join, 'Invitation');
        }

        return $this;
    }

    /**
     * Use the Invitation relation Invitation object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   InvitationQuery A secondary query class using the current class as primary query
     */
    public function useInvitationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinInvitation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Invitation', 'InvitationQuery');
    }

    /**
     * Filter the query by a related Notification object
     *
     * @param   Notification|PropelObjectCollection $notification  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 EventQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNotification($notification, $comparison = null)
    {
        if ($notification instanceof Notification) {
            return $this
                ->addUsingAlias(EventPeer::ID, $notification->getEventId(), $comparison);
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
     * @return EventQuery The current query, for fluid interface
     */
    public function joinNotification($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useNotificationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNotification($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Notification', 'NotificationQuery');
    }

    /**
     * Filter the query by a related Comment object
     *
     * @param   Comment|PropelObjectCollection $comment  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 EventQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByComment($comment, $comparison = null)
    {
        if ($comment instanceof Comment) {
            return $this
                ->addUsingAlias(EventPeer::ID, $comment->getEventid(), $comparison);
        } elseif ($comment instanceof PropelObjectCollection) {
            return $this
                ->useCommentQuery()
                ->filterByPrimaryKeys($comment->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByComment() only accepts arguments of type Comment or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Comment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EventQuery The current query, for fluid interface
     */
    public function joinComment($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Comment');

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
            $this->addJoinObject($join, 'Comment');
        }

        return $this;
    }

    /**
     * Use the Comment relation Comment object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   CommentQuery A secondary query class using the current class as primary query
     */
    public function useCommentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinComment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Comment', 'CommentQuery');
    }

    /**
     * Filter the query by a related MyUser object
     * using the invitations table as cross reference
     *
     * @param   MyUser $myUser the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EventQuery The current query, for fluid interface
     */
    public function filterByMyUser($myUser, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useInvitationQuery()
            ->filterByMyUser($myUser, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Event $event Object to remove from the list of results
     *
     * @return EventQuery The current query, for fluid interface
     */
    public function prune($event = null)
    {
        if ($event) {
            $this->addUsingAlias(EventPeer::ID, $event->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
