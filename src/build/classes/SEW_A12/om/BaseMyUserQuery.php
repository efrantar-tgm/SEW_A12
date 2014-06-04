<?php


/**
 * Base class that represents a query for the 'users' table.
 *
 *
 *
 * @method MyUserQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method MyUserQuery groupByName() Group by the name column
 *
 * @method MyUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MyUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MyUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MyUserQuery leftJoinDateOption($relationAlias = null) Adds a LEFT JOIN clause to the query using the DateOption relation
 * @method MyUserQuery rightJoinDateOption($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DateOption relation
 * @method MyUserQuery innerJoinDateOption($relationAlias = null) Adds a INNER JOIN clause to the query using the DateOption relation
 *
 * @method MyUserQuery leftJoinInvitation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Invitation relation
 * @method MyUserQuery rightJoinInvitation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Invitation relation
 * @method MyUserQuery innerJoinInvitation($relationAlias = null) Adds a INNER JOIN clause to the query using the Invitation relation
 *
 * @method MyUserQuery leftJoinNotification($relationAlias = null) Adds a LEFT JOIN clause to the query using the Notification relation
 * @method MyUserQuery rightJoinNotification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Notification relation
 * @method MyUserQuery innerJoinNotification($relationAlias = null) Adds a INNER JOIN clause to the query using the Notification relation
 *
 * @method MyUserQuery leftJoinComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the Comment relation
 * @method MyUserQuery rightJoinComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Comment relation
 * @method MyUserQuery innerJoinComment($relationAlias = null) Adds a INNER JOIN clause to the query using the Comment relation
 *
 * @method MyUser findOne(PropelPDO $con = null) Return the first MyUser matching the query
 * @method MyUser findOneOrCreate(PropelPDO $con = null) Return the first MyUser matching the query, or a new MyUser object populated from the query conditions when no match is found
 *
 *
 * @method array findByName(string $name) Return MyUser objects filtered by the name column
 *
 * @package    propel.generator.SEW_A12.om
 */
abstract class BaseMyUserQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMyUserQuery object.
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
            $modelName = 'MyUser';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MyUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   MyUserQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MyUserQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MyUserQuery) {
            return $criteria;
        }
        $query = new MyUserQuery(null, null, $modelAlias);

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
     * @return   MyUser|MyUser[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MyUserPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MyUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 MyUser A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByName($key, $con = null)
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
     * @return                 MyUser A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `name` FROM `users` WHERE `name` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new MyUser();
            $obj->hydrate($row);
            MyUserPeer::addInstanceToPool($obj, (string) $key);
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
     * @return MyUser|MyUser[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|MyUser[]|mixed the list of results, formatted by the current formatter
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
     * @return MyUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MyUserPeer::NAME, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MyUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MyUserPeer::NAME, $keys, Criteria::IN);
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
     * @return MyUserQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MyUserPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related DateOption object
     *
     * @param   DateOption|PropelObjectCollection $dateOption  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 MyUserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByDateOption($dateOption, $comparison = null)
    {
        if ($dateOption instanceof DateOption) {
            return $this
                ->addUsingAlias(MyUserPeer::NAME, $dateOption->getUsername(), $comparison);
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
     * @return MyUserQuery The current query, for fluid interface
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
     * Filter the query by a related Invitation object
     *
     * @param   Invitation|PropelObjectCollection $invitation  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 MyUserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByInvitation($invitation, $comparison = null)
    {
        if ($invitation instanceof Invitation) {
            return $this
                ->addUsingAlias(MyUserPeer::NAME, $invitation->getUsername(), $comparison);
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
     * @return MyUserQuery The current query, for fluid interface
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
     * @return                 MyUserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNotification($notification, $comparison = null)
    {
        if ($notification instanceof Notification) {
            return $this
                ->addUsingAlias(MyUserPeer::NAME, $notification->getUsername(), $comparison);
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
     * @return MyUserQuery The current query, for fluid interface
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
     * @return                 MyUserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByComment($comment, $comparison = null)
    {
        if ($comment instanceof Comment) {
            return $this
                ->addUsingAlias(MyUserPeer::NAME, $comment->getUsername(), $comparison);
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
     * @return MyUserQuery The current query, for fluid interface
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
     * Filter the query by a related Event object
     * using the invitations table as cross reference
     *
     * @param   Event $event the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MyUserQuery The current query, for fluid interface
     */
    public function filterByEvent($event, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useInvitationQuery()
            ->filterByEvent($event, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   MyUser $myUser Object to remove from the list of results
     *
     * @return MyUserQuery The current query, for fluid interface
     */
    public function prune($myUser = null)
    {
        if ($myUser) {
            $this->addUsingAlias(MyUserPeer::NAME, $myUser->getName(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
