<?php


/**
 * Base class that represents a row from the 'events' table.
 *
 *
 *
 * @package    propel.generator.SEW_A12.om
 */
abstract class BaseEvent extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'EventPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        EventPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the fixed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $fixed;

    /**
     * The value for the class_key field.
     * @var        string
     */
    protected $class_key;

    /**
     * @var        PropelObjectCollection|DateOption[] Collection to store aggregation of DateOption objects.
     */
    protected $collDateOptions;
    protected $collDateOptionsPartial;

    /**
     * @var        PropelObjectCollection|Invitation[] Collection to store aggregation of Invitation objects.
     */
    protected $collInvitations;
    protected $collInvitationsPartial;

    /**
     * @var        PropelObjectCollection|Notification[] Collection to store aggregation of Notification objects.
     */
    protected $collNotifications;
    protected $collNotificationsPartial;

    /**
     * @var        PropelObjectCollection|Comment[] Collection to store aggregation of Comment objects.
     */
    protected $collComments;
    protected $collCommentsPartial;

    /**
     * @var        PropelObjectCollection|MyUser[] Collection to store aggregation of MyUser objects.
     */
    protected $collMyUsers;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $myUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $dateOptionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $invitationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $notificationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $commentsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->fixed = false;
    }

    /**
     * Initializes internal state of BaseEvent object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * Get the [fixed] column value.
     *
     * @return boolean
     */
    public function getFixed()
    {

        return $this->fixed;
    }

    /**
     * Get the [class_key] column value.
     *
     * @return string
     */
    public function getClassKey()
    {

        return $this->class_key;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = EventPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = EventPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Sets the value of the [fixed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Event The current object (for fluent API support)
     */
    public function setFixed($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->fixed !== $v) {
            $this->fixed = $v;
            $this->modifiedColumns[] = EventPeer::FIXED;
        }


        return $this;
    } // setFixed()

    /**
     * Set the value of [class_key] column.
     *
     * @param  string $v new value
     * @return Event The current object (for fluent API support)
     */
    public function setClassKey($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->class_key !== $v) {
            $this->class_key = $v;
            $this->modifiedColumns[] = EventPeer::CLASS_KEY;
        }


        return $this;
    } // setClassKey()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->fixed !== false) {
                return false;
            }

        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->fixed = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->class_key = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 4; // 4 = EventPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Event object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = EventPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collDateOptions = null;

            $this->collInvitations = null;

            $this->collNotifications = null;

            $this->collComments = null;

            $this->collMyUsers = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = EventQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                EventPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->myUsersScheduledForDeletion !== null) {
                if (!$this->myUsersScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->myUsersScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    InvitationQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->myUsersScheduledForDeletion = null;
                }

                foreach ($this->getMyUsers() as $myUser) {
                    if ($myUser->isModified()) {
                        $myUser->save($con);
                    }
                }
            } elseif ($this->collMyUsers) {
                foreach ($this->collMyUsers as $myUser) {
                    if ($myUser->isModified()) {
                        $myUser->save($con);
                    }
                }
            }

            if ($this->dateOptionsScheduledForDeletion !== null) {
                if (!$this->dateOptionsScheduledForDeletion->isEmpty()) {
                    DateOptionQuery::create()
                        ->filterByPrimaryKeys($this->dateOptionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->dateOptionsScheduledForDeletion = null;
                }
            }

            if ($this->collDateOptions !== null) {
                foreach ($this->collDateOptions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->invitationsScheduledForDeletion !== null) {
                if (!$this->invitationsScheduledForDeletion->isEmpty()) {
                    InvitationQuery::create()
                        ->filterByPrimaryKeys($this->invitationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->invitationsScheduledForDeletion = null;
                }
            }

            if ($this->collInvitations !== null) {
                foreach ($this->collInvitations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->notificationsScheduledForDeletion !== null) {
                if (!$this->notificationsScheduledForDeletion->isEmpty()) {
                    NotificationQuery::create()
                        ->filterByPrimaryKeys($this->notificationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->notificationsScheduledForDeletion = null;
                }
            }

            if ($this->collNotifications !== null) {
                foreach ($this->collNotifications as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->commentsScheduledForDeletion !== null) {
                if (!$this->commentsScheduledForDeletion->isEmpty()) {
                    CommentQuery::create()
                        ->filterByPrimaryKeys($this->commentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->commentsScheduledForDeletion = null;
                }
            }

            if ($this->collComments !== null) {
                foreach ($this->collComments as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = EventPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EventPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EventPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(EventPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(EventPeer::FIXED)) {
            $modifiedColumns[':p' . $index++]  = '`fixed`';
        }
        if ($this->isColumnModified(EventPeer::CLASS_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`class_key`';
        }

        $sql = sprintf(
            'INSERT INTO `events` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`fixed`':
                        $stmt->bindValue($identifier, (int) $this->fixed, PDO::PARAM_INT);
                        break;
                    case '`class_key`':
                        $stmt->bindValue($identifier, $this->class_key, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = EventPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collDateOptions !== null) {
                    foreach ($this->collDateOptions as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collInvitations !== null) {
                    foreach ($this->collInvitations as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collNotifications !== null) {
                    foreach ($this->collNotifications as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collComments !== null) {
                    foreach ($this->collComments as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = EventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getFixed();
                break;
            case 3:
                return $this->getClassKey();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Event'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Event'][$this->getPrimaryKey()] = true;
        $keys = EventPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getFixed(),
            $keys[3] => $this->getClassKey(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collDateOptions) {
                $result['DateOptions'] = $this->collDateOptions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collInvitations) {
                $result['Invitations'] = $this->collInvitations->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNotifications) {
                $result['Notifications'] = $this->collNotifications->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collComments) {
                $result['Comments'] = $this->collComments->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = EventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setFixed($value);
                break;
            case 3:
                $this->setClassKey($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = EventPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setFixed($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setClassKey($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(EventPeer::DATABASE_NAME);

        if ($this->isColumnModified(EventPeer::ID)) $criteria->add(EventPeer::ID, $this->id);
        if ($this->isColumnModified(EventPeer::NAME)) $criteria->add(EventPeer::NAME, $this->name);
        if ($this->isColumnModified(EventPeer::FIXED)) $criteria->add(EventPeer::FIXED, $this->fixed);
        if ($this->isColumnModified(EventPeer::CLASS_KEY)) $criteria->add(EventPeer::CLASS_KEY, $this->class_key);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(EventPeer::DATABASE_NAME);
        $criteria->add(EventPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Event (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setFixed($this->getFixed());
        $copyObj->setClassKey($this->getClassKey());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getDateOptions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDateOption($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getInvitations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addInvitation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNotifications() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNotification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getComments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addComment($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Event Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return EventPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new EventPeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('DateOption' == $relationName) {
            $this->initDateOptions();
        }
        if ('Invitation' == $relationName) {
            $this->initInvitations();
        }
        if ('Notification' == $relationName) {
            $this->initNotifications();
        }
        if ('Comment' == $relationName) {
            $this->initComments();
        }
    }

    /**
     * Clears out the collDateOptions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Event The current object (for fluent API support)
     * @see        addDateOptions()
     */
    public function clearDateOptions()
    {
        $this->collDateOptions = null; // important to set this to null since that means it is uninitialized
        $this->collDateOptionsPartial = null;

        return $this;
    }

    /**
     * reset is the collDateOptions collection loaded partially
     *
     * @return void
     */
    public function resetPartialDateOptions($v = true)
    {
        $this->collDateOptionsPartial = $v;
    }

    /**
     * Initializes the collDateOptions collection.
     *
     * By default this just sets the collDateOptions collection to an empty array (like clearcollDateOptions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDateOptions($overrideExisting = true)
    {
        if (null !== $this->collDateOptions && !$overrideExisting) {
            return;
        }
        $this->collDateOptions = new PropelObjectCollection();
        $this->collDateOptions->setModel('DateOption');
    }

    /**
     * Gets an array of DateOption objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Event is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|DateOption[] List of DateOption objects
     * @throws PropelException
     */
    public function getDateOptions($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collDateOptionsPartial && !$this->isNew();
        if (null === $this->collDateOptions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDateOptions) {
                // return empty collection
                $this->initDateOptions();
            } else {
                $collDateOptions = DateOptionQuery::create(null, $criteria)
                    ->filterByEvent($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collDateOptionsPartial && count($collDateOptions)) {
                      $this->initDateOptions(false);

                      foreach ($collDateOptions as $obj) {
                        if (false == $this->collDateOptions->contains($obj)) {
                          $this->collDateOptions->append($obj);
                        }
                      }

                      $this->collDateOptionsPartial = true;
                    }

                    $collDateOptions->getInternalIterator()->rewind();

                    return $collDateOptions;
                }

                if ($partial && $this->collDateOptions) {
                    foreach ($this->collDateOptions as $obj) {
                        if ($obj->isNew()) {
                            $collDateOptions[] = $obj;
                        }
                    }
                }

                $this->collDateOptions = $collDateOptions;
                $this->collDateOptionsPartial = false;
            }
        }

        return $this->collDateOptions;
    }

    /**
     * Sets a collection of DateOption objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $dateOptions A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Event The current object (for fluent API support)
     */
    public function setDateOptions(PropelCollection $dateOptions, PropelPDO $con = null)
    {
        $dateOptionsToDelete = $this->getDateOptions(new Criteria(), $con)->diff($dateOptions);


        $this->dateOptionsScheduledForDeletion = $dateOptionsToDelete;

        foreach ($dateOptionsToDelete as $dateOptionRemoved) {
            $dateOptionRemoved->setEvent(null);
        }

        $this->collDateOptions = null;
        foreach ($dateOptions as $dateOption) {
            $this->addDateOption($dateOption);
        }

        $this->collDateOptions = $dateOptions;
        $this->collDateOptionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related DateOption objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related DateOption objects.
     * @throws PropelException
     */
    public function countDateOptions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collDateOptionsPartial && !$this->isNew();
        if (null === $this->collDateOptions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDateOptions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDateOptions());
            }
            $query = DateOptionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEvent($this)
                ->count($con);
        }

        return count($this->collDateOptions);
    }

    /**
     * Method called to associate a BaseDateOption object to this object
     * through the BaseDateOption foreign key attribute.
     *
     * @param    BaseDateOption $l BaseDateOption
     * @return Event The current object (for fluent API support)
     */
    public function addDateOption(BaseDateOption $l)
    {
        if ($this->collDateOptions === null) {
            $this->initDateOptions();
            $this->collDateOptionsPartial = true;
        }

        if (!in_array($l, $this->collDateOptions->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddDateOption($l);

            if ($this->dateOptionsScheduledForDeletion and $this->dateOptionsScheduledForDeletion->contains($l)) {
                $this->dateOptionsScheduledForDeletion->remove($this->dateOptionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	DateOption $dateOption The dateOption object to add.
     */
    protected function doAddDateOption($dateOption)
    {
        $this->collDateOptions[]= $dateOption;
        $dateOption->setEvent($this);
    }

    /**
     * @param	DateOption $dateOption The dateOption object to remove.
     * @return Event The current object (for fluent API support)
     */
    public function removeDateOption($dateOption)
    {
        if ($this->getDateOptions()->contains($dateOption)) {
            $this->collDateOptions->remove($this->collDateOptions->search($dateOption));
            if (null === $this->dateOptionsScheduledForDeletion) {
                $this->dateOptionsScheduledForDeletion = clone $this->collDateOptions;
                $this->dateOptionsScheduledForDeletion->clear();
            }
            $this->dateOptionsScheduledForDeletion[]= clone $dateOption;
            $dateOption->setEvent(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Event is new, it will return
     * an empty collection; or if this Event has previously
     * been saved, it will retrieve related DateOptions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Event.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|DateOption[] List of DateOption objects
     */
    public function getDateOptionsJoinMyUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = DateOptionQuery::create(null, $criteria);
        $query->joinWith('MyUser', $join_behavior);

        return $this->getDateOptions($query, $con);
    }

    /**
     * Clears out the collInvitations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Event The current object (for fluent API support)
     * @see        addInvitations()
     */
    public function clearInvitations()
    {
        $this->collInvitations = null; // important to set this to null since that means it is uninitialized
        $this->collInvitationsPartial = null;

        return $this;
    }

    /**
     * reset is the collInvitations collection loaded partially
     *
     * @return void
     */
    public function resetPartialInvitations($v = true)
    {
        $this->collInvitationsPartial = $v;
    }

    /**
     * Initializes the collInvitations collection.
     *
     * By default this just sets the collInvitations collection to an empty array (like clearcollInvitations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initInvitations($overrideExisting = true)
    {
        if (null !== $this->collInvitations && !$overrideExisting) {
            return;
        }
        $this->collInvitations = new PropelObjectCollection();
        $this->collInvitations->setModel('Invitation');
    }

    /**
     * Gets an array of Invitation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Event is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Invitation[] List of Invitation objects
     * @throws PropelException
     */
    public function getInvitations($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collInvitationsPartial && !$this->isNew();
        if (null === $this->collInvitations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collInvitations) {
                // return empty collection
                $this->initInvitations();
            } else {
                $collInvitations = InvitationQuery::create(null, $criteria)
                    ->filterByEvent($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collInvitationsPartial && count($collInvitations)) {
                      $this->initInvitations(false);

                      foreach ($collInvitations as $obj) {
                        if (false == $this->collInvitations->contains($obj)) {
                          $this->collInvitations->append($obj);
                        }
                      }

                      $this->collInvitationsPartial = true;
                    }

                    $collInvitations->getInternalIterator()->rewind();

                    return $collInvitations;
                }

                if ($partial && $this->collInvitations) {
                    foreach ($this->collInvitations as $obj) {
                        if ($obj->isNew()) {
                            $collInvitations[] = $obj;
                        }
                    }
                }

                $this->collInvitations = $collInvitations;
                $this->collInvitationsPartial = false;
            }
        }

        return $this->collInvitations;
    }

    /**
     * Sets a collection of Invitation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $invitations A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Event The current object (for fluent API support)
     */
    public function setInvitations(PropelCollection $invitations, PropelPDO $con = null)
    {
        $invitationsToDelete = $this->getInvitations(new Criteria(), $con)->diff($invitations);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->invitationsScheduledForDeletion = clone $invitationsToDelete;

        foreach ($invitationsToDelete as $invitationRemoved) {
            $invitationRemoved->setEvent(null);
        }

        $this->collInvitations = null;
        foreach ($invitations as $invitation) {
            $this->addInvitation($invitation);
        }

        $this->collInvitations = $invitations;
        $this->collInvitationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Invitation objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Invitation objects.
     * @throws PropelException
     */
    public function countInvitations(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collInvitationsPartial && !$this->isNew();
        if (null === $this->collInvitations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collInvitations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getInvitations());
            }
            $query = InvitationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEvent($this)
                ->count($con);
        }

        return count($this->collInvitations);
    }

    /**
     * Method called to associate a Invitation object to this object
     * through the Invitation foreign key attribute.
     *
     * @param    Invitation $l Invitation
     * @return Event The current object (for fluent API support)
     */
    public function addInvitation(Invitation $l)
    {
        if ($this->collInvitations === null) {
            $this->initInvitations();
            $this->collInvitationsPartial = true;
        }

        if (!in_array($l, $this->collInvitations->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddInvitation($l);

            if ($this->invitationsScheduledForDeletion and $this->invitationsScheduledForDeletion->contains($l)) {
                $this->invitationsScheduledForDeletion->remove($this->invitationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Invitation $invitation The invitation object to add.
     */
    protected function doAddInvitation($invitation)
    {
        $this->collInvitations[]= $invitation;
        $invitation->setEvent($this);
    }

    /**
     * @param	Invitation $invitation The invitation object to remove.
     * @return Event The current object (for fluent API support)
     */
    public function removeInvitation($invitation)
    {
        if ($this->getInvitations()->contains($invitation)) {
            $this->collInvitations->remove($this->collInvitations->search($invitation));
            if (null === $this->invitationsScheduledForDeletion) {
                $this->invitationsScheduledForDeletion = clone $this->collInvitations;
                $this->invitationsScheduledForDeletion->clear();
            }
            $this->invitationsScheduledForDeletion[]= clone $invitation;
            $invitation->setEvent(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Event is new, it will return
     * an empty collection; or if this Event has previously
     * been saved, it will retrieve related Invitations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Event.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Invitation[] List of Invitation objects
     */
    public function getInvitationsJoinMyUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = InvitationQuery::create(null, $criteria);
        $query->joinWith('MyUser', $join_behavior);

        return $this->getInvitations($query, $con);
    }

    /**
     * Clears out the collNotifications collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Event The current object (for fluent API support)
     * @see        addNotifications()
     */
    public function clearNotifications()
    {
        $this->collNotifications = null; // important to set this to null since that means it is uninitialized
        $this->collNotificationsPartial = null;

        return $this;
    }

    /**
     * reset is the collNotifications collection loaded partially
     *
     * @return void
     */
    public function resetPartialNotifications($v = true)
    {
        $this->collNotificationsPartial = $v;
    }

    /**
     * Initializes the collNotifications collection.
     *
     * By default this just sets the collNotifications collection to an empty array (like clearcollNotifications());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNotifications($overrideExisting = true)
    {
        if (null !== $this->collNotifications && !$overrideExisting) {
            return;
        }
        $this->collNotifications = new PropelObjectCollection();
        $this->collNotifications->setModel('Notification');
    }

    /**
     * Gets an array of Notification objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Event is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Notification[] List of Notification objects
     * @throws PropelException
     */
    public function getNotifications($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNotificationsPartial && !$this->isNew();
        if (null === $this->collNotifications || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNotifications) {
                // return empty collection
                $this->initNotifications();
            } else {
                $collNotifications = NotificationQuery::create(null, $criteria)
                    ->filterByEvent($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNotificationsPartial && count($collNotifications)) {
                      $this->initNotifications(false);

                      foreach ($collNotifications as $obj) {
                        if (false == $this->collNotifications->contains($obj)) {
                          $this->collNotifications->append($obj);
                        }
                      }

                      $this->collNotificationsPartial = true;
                    }

                    $collNotifications->getInternalIterator()->rewind();

                    return $collNotifications;
                }

                if ($partial && $this->collNotifications) {
                    foreach ($this->collNotifications as $obj) {
                        if ($obj->isNew()) {
                            $collNotifications[] = $obj;
                        }
                    }
                }

                $this->collNotifications = $collNotifications;
                $this->collNotificationsPartial = false;
            }
        }

        return $this->collNotifications;
    }

    /**
     * Sets a collection of Notification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $notifications A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Event The current object (for fluent API support)
     */
    public function setNotifications(PropelCollection $notifications, PropelPDO $con = null)
    {
        $notificationsToDelete = $this->getNotifications(new Criteria(), $con)->diff($notifications);


        $this->notificationsScheduledForDeletion = $notificationsToDelete;

        foreach ($notificationsToDelete as $notificationRemoved) {
            $notificationRemoved->setEvent(null);
        }

        $this->collNotifications = null;
        foreach ($notifications as $notification) {
            $this->addNotification($notification);
        }

        $this->collNotifications = $notifications;
        $this->collNotificationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Notification objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Notification objects.
     * @throws PropelException
     */
    public function countNotifications(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNotificationsPartial && !$this->isNew();
        if (null === $this->collNotifications || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNotifications) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNotifications());
            }
            $query = NotificationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEvent($this)
                ->count($con);
        }

        return count($this->collNotifications);
    }

    /**
     * Method called to associate a BaseNotification object to this object
     * through the BaseNotification foreign key attribute.
     *
     * @param    BaseNotification $l BaseNotification
     * @return Event The current object (for fluent API support)
     */
    public function addNotification(BaseNotification $l)
    {
        if ($this->collNotifications === null) {
            $this->initNotifications();
            $this->collNotificationsPartial = true;
        }

        if (!in_array($l, $this->collNotifications->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNotification($l);

            if ($this->notificationsScheduledForDeletion and $this->notificationsScheduledForDeletion->contains($l)) {
                $this->notificationsScheduledForDeletion->remove($this->notificationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Notification $notification The notification object to add.
     */
    protected function doAddNotification($notification)
    {
        $this->collNotifications[]= $notification;
        $notification->setEvent($this);
    }

    /**
     * @param	Notification $notification The notification object to remove.
     * @return Event The current object (for fluent API support)
     */
    public function removeNotification($notification)
    {
        if ($this->getNotifications()->contains($notification)) {
            $this->collNotifications->remove($this->collNotifications->search($notification));
            if (null === $this->notificationsScheduledForDeletion) {
                $this->notificationsScheduledForDeletion = clone $this->collNotifications;
                $this->notificationsScheduledForDeletion->clear();
            }
            $this->notificationsScheduledForDeletion[]= clone $notification;
            $notification->setEvent(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Event is new, it will return
     * an empty collection; or if this Event has previously
     * been saved, it will retrieve related Notifications from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Event.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Notification[] List of Notification objects
     */
    public function getNotificationsJoinDateOption($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NotificationQuery::create(null, $criteria);
        $query->joinWith('DateOption', $join_behavior);

        return $this->getNotifications($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Event is new, it will return
     * an empty collection; or if this Event has previously
     * been saved, it will retrieve related Notifications from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Event.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Notification[] List of Notification objects
     */
    public function getNotificationsJoinMyUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NotificationQuery::create(null, $criteria);
        $query->joinWith('MyUser', $join_behavior);

        return $this->getNotifications($query, $con);
    }

    /**
     * Clears out the collComments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Event The current object (for fluent API support)
     * @see        addComments()
     */
    public function clearComments()
    {
        $this->collComments = null; // important to set this to null since that means it is uninitialized
        $this->collCommentsPartial = null;

        return $this;
    }

    /**
     * reset is the collComments collection loaded partially
     *
     * @return void
     */
    public function resetPartialComments($v = true)
    {
        $this->collCommentsPartial = $v;
    }

    /**
     * Initializes the collComments collection.
     *
     * By default this just sets the collComments collection to an empty array (like clearcollComments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initComments($overrideExisting = true)
    {
        if (null !== $this->collComments && !$overrideExisting) {
            return;
        }
        $this->collComments = new PropelObjectCollection();
        $this->collComments->setModel('Comment');
    }

    /**
     * Gets an array of Comment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Event is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Comment[] List of Comment objects
     * @throws PropelException
     */
    public function getComments($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCommentsPartial && !$this->isNew();
        if (null === $this->collComments || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collComments) {
                // return empty collection
                $this->initComments();
            } else {
                $collComments = CommentQuery::create(null, $criteria)
                    ->filterByEvent($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCommentsPartial && count($collComments)) {
                      $this->initComments(false);

                      foreach ($collComments as $obj) {
                        if (false == $this->collComments->contains($obj)) {
                          $this->collComments->append($obj);
                        }
                      }

                      $this->collCommentsPartial = true;
                    }

                    $collComments->getInternalIterator()->rewind();

                    return $collComments;
                }

                if ($partial && $this->collComments) {
                    foreach ($this->collComments as $obj) {
                        if ($obj->isNew()) {
                            $collComments[] = $obj;
                        }
                    }
                }

                $this->collComments = $collComments;
                $this->collCommentsPartial = false;
            }
        }

        return $this->collComments;
    }

    /**
     * Sets a collection of Comment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $comments A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Event The current object (for fluent API support)
     */
    public function setComments(PropelCollection $comments, PropelPDO $con = null)
    {
        $commentsToDelete = $this->getComments(new Criteria(), $con)->diff($comments);


        $this->commentsScheduledForDeletion = $commentsToDelete;

        foreach ($commentsToDelete as $commentRemoved) {
            $commentRemoved->setEvent(null);
        }

        $this->collComments = null;
        foreach ($comments as $comment) {
            $this->addComment($comment);
        }

        $this->collComments = $comments;
        $this->collCommentsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Comment objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Comment objects.
     * @throws PropelException
     */
    public function countComments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCommentsPartial && !$this->isNew();
        if (null === $this->collComments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collComments) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getComments());
            }
            $query = CommentQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByEvent($this)
                ->count($con);
        }

        return count($this->collComments);
    }

    /**
     * Method called to associate a Comment object to this object
     * through the Comment foreign key attribute.
     *
     * @param    Comment $l Comment
     * @return Event The current object (for fluent API support)
     */
    public function addComment(Comment $l)
    {
        if ($this->collComments === null) {
            $this->initComments();
            $this->collCommentsPartial = true;
        }

        if (!in_array($l, $this->collComments->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddComment($l);

            if ($this->commentsScheduledForDeletion and $this->commentsScheduledForDeletion->contains($l)) {
                $this->commentsScheduledForDeletion->remove($this->commentsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Comment $comment The comment object to add.
     */
    protected function doAddComment($comment)
    {
        $this->collComments[]= $comment;
        $comment->setEvent($this);
    }

    /**
     * @param	Comment $comment The comment object to remove.
     * @return Event The current object (for fluent API support)
     */
    public function removeComment($comment)
    {
        if ($this->getComments()->contains($comment)) {
            $this->collComments->remove($this->collComments->search($comment));
            if (null === $this->commentsScheduledForDeletion) {
                $this->commentsScheduledForDeletion = clone $this->collComments;
                $this->commentsScheduledForDeletion->clear();
            }
            $this->commentsScheduledForDeletion[]= $comment;
            $comment->setEvent(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Event is new, it will return
     * an empty collection; or if this Event has previously
     * been saved, it will retrieve related Comments from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Event.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Comment[] List of Comment objects
     */
    public function getCommentsJoinMyUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CommentQuery::create(null, $criteria);
        $query->joinWith('MyUser', $join_behavior);

        return $this->getComments($query, $con);
    }

    /**
     * Clears out the collMyUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Event The current object (for fluent API support)
     * @see        addMyUsers()
     */
    public function clearMyUsers()
    {
        $this->collMyUsers = null; // important to set this to null since that means it is uninitialized
        $this->collMyUsersPartial = null;

        return $this;
    }

    /**
     * Initializes the collMyUsers collection.
     *
     * By default this just sets the collMyUsers collection to an empty collection (like clearMyUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initMyUsers()
    {
        $this->collMyUsers = new PropelObjectCollection();
        $this->collMyUsers->setModel('MyUser');
    }

    /**
     * Gets a collection of MyUser objects related by a many-to-many relationship
     * to the current object by way of the invitations cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Event is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|MyUser[] List of MyUser objects
     */
    public function getMyUsers($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collMyUsers || null !== $criteria) {
            if ($this->isNew() && null === $this->collMyUsers) {
                // return empty collection
                $this->initMyUsers();
            } else {
                $collMyUsers = MyUserQuery::create(null, $criteria)
                    ->filterByEvent($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collMyUsers;
                }
                $this->collMyUsers = $collMyUsers;
            }
        }

        return $this->collMyUsers;
    }

    /**
     * Sets a collection of MyUser objects related by a many-to-many relationship
     * to the current object by way of the invitations cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $myUsers A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Event The current object (for fluent API support)
     */
    public function setMyUsers(PropelCollection $myUsers, PropelPDO $con = null)
    {
        $this->clearMyUsers();
        $currentMyUsers = $this->getMyUsers(null, $con);

        $this->myUsersScheduledForDeletion = $currentMyUsers->diff($myUsers);

        foreach ($myUsers as $myUser) {
            if (!$currentMyUsers->contains($myUser)) {
                $this->doAddMyUser($myUser);
            }
        }

        $this->collMyUsers = $myUsers;

        return $this;
    }

    /**
     * Gets the number of MyUser objects related by a many-to-many relationship
     * to the current object by way of the invitations cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related MyUser objects
     */
    public function countMyUsers($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collMyUsers || null !== $criteria) {
            if ($this->isNew() && null === $this->collMyUsers) {
                return 0;
            } else {
                $query = MyUserQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByEvent($this)
                    ->count($con);
            }
        } else {
            return count($this->collMyUsers);
        }
    }

    /**
     * Associate a MyUser object to this object
     * through the invitations cross reference table.
     *
     * @param  MyUser $myUser The Invitation object to relate
     * @return Event The current object (for fluent API support)
     */
    public function addMyUser(MyUser $myUser)
    {
        if ($this->collMyUsers === null) {
            $this->initMyUsers();
        }

        if (!$this->collMyUsers->contains($myUser)) { // only add it if the **same** object is not already associated
            $this->doAddMyUser($myUser);
            $this->collMyUsers[] = $myUser;

            if ($this->myUsersScheduledForDeletion and $this->myUsersScheduledForDeletion->contains($myUser)) {
                $this->myUsersScheduledForDeletion->remove($this->myUsersScheduledForDeletion->search($myUser));
            }
        }

        return $this;
    }

    /**
     * @param	MyUser $myUser The myUser object to add.
     */
    protected function doAddMyUser(MyUser $myUser)
    {
        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$myUser->getEvents()->contains($this)) {
            $invitation = new Invitation();
            $invitation->setMyUser($myUser);
            $this->addInvitation($invitation);

            $foreignCollection = $myUser->getEvents();
            $foreignCollection[] = $this;
        }
    }

    /**
     * Remove a MyUser object to this object
     * through the invitations cross reference table.
     *
     * @param MyUser $myUser The Invitation object to relate
     * @return Event The current object (for fluent API support)
     */
    public function removeMyUser(MyUser $myUser)
    {
        if ($this->getMyUsers()->contains($myUser)) {
            $this->collMyUsers->remove($this->collMyUsers->search($myUser));
            if (null === $this->myUsersScheduledForDeletion) {
                $this->myUsersScheduledForDeletion = clone $this->collMyUsers;
                $this->myUsersScheduledForDeletion->clear();
            }
            $this->myUsersScheduledForDeletion[]= $myUser;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->fixed = null;
        $this->class_key = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collDateOptions) {
                foreach ($this->collDateOptions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collInvitations) {
                foreach ($this->collInvitations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNotifications) {
                foreach ($this->collNotifications as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collComments) {
                foreach ($this->collComments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMyUsers) {
                foreach ($this->collMyUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collDateOptions instanceof PropelCollection) {
            $this->collDateOptions->clearIterator();
        }
        $this->collDateOptions = null;
        if ($this->collInvitations instanceof PropelCollection) {
            $this->collInvitations->clearIterator();
        }
        $this->collInvitations = null;
        if ($this->collNotifications instanceof PropelCollection) {
            $this->collNotifications->clearIterator();
        }
        $this->collNotifications = null;
        if ($this->collComments instanceof PropelCollection) {
            $this->collComments->clearIterator();
        }
        $this->collComments = null;
        if ($this->collMyUsers instanceof PropelCollection) {
            $this->collMyUsers->clearIterator();
        }
        $this->collMyUsers = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EventPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
