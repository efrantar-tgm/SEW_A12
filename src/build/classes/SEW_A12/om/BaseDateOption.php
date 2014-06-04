<?php


/**
 * Base class that represents a row from the 'dateOptions' table.
 *
 *
 *
 * @package    propel.generator.SEW_A12.om
 */
abstract class BaseDateOption extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'DateOptionPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        DateOptionPeer
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
     * The value for the date field.
     * @var        string
     */
    protected $date;

    /**
     * The value for the fixed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $fixed;

    /**
     * The value for the eventid field.
     * @var        int
     */
    protected $eventid;

    /**
     * The value for the class_key field.
     * @var        string
     */
    protected $class_key;

    /**
     * The value for the choices field.
     * @var
     */
    protected $choices;

    /**
     * The unserialized $choices value - i.e. the persisted object.
     * This is necessary to avoid repeated calls to unserialize() at runtime.
     * @var        object
     */
    protected $choices_unserialized;

    /**
     * The value for the username field.
     * @var        string
     */
    protected $username;

    /**
     * @var        Event
     */
    protected $aEvent;

    /**
     * @var        MyUser
     */
    protected $aMyUser;

    /**
     * @var        PropelObjectCollection|Notification[] Collection to store aggregation of Notification objects.
     */
    protected $collNotifications;
    protected $collNotificationsPartial;

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
    protected $notificationsScheduledForDeletion = null;

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
     * Initializes internal state of BaseDateOption object.
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
     * Get the [optionally formatted] temporal [date] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDate($format = 'Y-m-d H:i:s')
    {
        if ($this->date === null) {
            return null;
        }

        if ($this->date === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

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
     * Get the [eventid] column value.
     *
     * @return int
     */
    public function getEventid()
    {

        return $this->eventid;
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
     * Get the [choices] column value.
     *
     * @return
     */
    public function getChoices()
    {
        if (null == $this->choices_unserialized && null !== $this->choices) {
            $this->choices_unserialized = unserialize($this->choices);
        }

        return $this->choices_unserialized;
    }

    /**
     * Get the [username] column value.
     *
     * @return string
     */
    public function getUsername()
    {

        return $this->username;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return DateOption The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = DateOptionPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Sets the value of [date] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return DateOption The current object (for fluent API support)
     */
    public function setDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date !== null || $dt !== null) {
            $currentDateAsString = ($this->date !== null && $tmpDt = new DateTime($this->date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date = $newDateAsString;
                $this->modifiedColumns[] = DateOptionPeer::DATE;
            }
        } // if either are not null


        return $this;
    } // setDate()

    /**
     * Sets the value of the [fixed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return DateOption The current object (for fluent API support)
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
            $this->modifiedColumns[] = DateOptionPeer::FIXED;
        }


        return $this;
    } // setFixed()

    /**
     * Set the value of [eventid] column.
     *
     * @param  int $v new value
     * @return DateOption The current object (for fluent API support)
     */
    public function setEventid($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->eventid !== $v) {
            $this->eventid = $v;
            $this->modifiedColumns[] = DateOptionPeer::EVENTID;
        }

        if ($this->aEvent !== null && $this->aEvent->getId() !== $v) {
            $this->aEvent = null;
        }


        return $this;
    } // setEventid()

    /**
     * Set the value of [class_key] column.
     *
     * @param  string $v new value
     * @return DateOption The current object (for fluent API support)
     */
    public function setClassKey($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->class_key !== $v) {
            $this->class_key = $v;
            $this->modifiedColumns[] = DateOptionPeer::CLASS_KEY;
        }


        return $this;
    } // setClassKey()

    /**
     * Set the value of [choices] column.
     *
     * @param   $v new value
     * @return DateOption The current object (for fluent API support)
     */
    public function setChoices($v)
    {
        if ($this->choices_unserialized !== $v) {
            $this->choices_unserialized = $v;
            $this->choices = serialize($v);
            $this->modifiedColumns[] = DateOptionPeer::CHOICES;
        }


        return $this;
    } // setChoices()

    /**
     * Set the value of [username] column.
     *
     * @param  string $v new value
     * @return DateOption The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[] = DateOptionPeer::USERNAME;
        }

        if ($this->aMyUser !== null && $this->aMyUser->getName() !== $v) {
            $this->aMyUser = null;
        }


        return $this;
    } // setUsername()

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
            $this->date = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->fixed = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->eventid = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->class_key = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->choices = $row[$startcol + 5];
            $this->username = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 7; // 7 = DateOptionPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating DateOption object", $e);
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

        if ($this->aEvent !== null && $this->eventid !== $this->aEvent->getId()) {
            $this->aEvent = null;
        }
        if ($this->aMyUser !== null && $this->username !== $this->aMyUser->getName()) {
            $this->aMyUser = null;
        }
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
            $con = Propel::getConnection(DateOptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = DateOptionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEvent = null;
            $this->aMyUser = null;
            $this->collNotifications = null;

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
            $con = Propel::getConnection(DateOptionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = DateOptionQuery::create()
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
            $con = Propel::getConnection(DateOptionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                DateOptionPeer::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aEvent !== null) {
                if ($this->aEvent->isModified() || $this->aEvent->isNew()) {
                    $affectedRows += $this->aEvent->save($con);
                }
                $this->setEvent($this->aEvent);
            }

            if ($this->aMyUser !== null) {
                if ($this->aMyUser->isModified() || $this->aMyUser->isNew()) {
                    $affectedRows += $this->aMyUser->save($con);
                }
                $this->setMyUser($this->aMyUser);
            }

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

        $this->modifiedColumns[] = DateOptionPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DateOptionPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DateOptionPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(DateOptionPeer::DATE)) {
            $modifiedColumns[':p' . $index++]  = '`date`';
        }
        if ($this->isColumnModified(DateOptionPeer::FIXED)) {
            $modifiedColumns[':p' . $index++]  = '`fixed`';
        }
        if ($this->isColumnModified(DateOptionPeer::EVENTID)) {
            $modifiedColumns[':p' . $index++]  = '`eventId`';
        }
        if ($this->isColumnModified(DateOptionPeer::CLASS_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`class_key`';
        }
        if ($this->isColumnModified(DateOptionPeer::CHOICES)) {
            $modifiedColumns[':p' . $index++]  = '`choices`';
        }
        if ($this->isColumnModified(DateOptionPeer::USERNAME)) {
            $modifiedColumns[':p' . $index++]  = '`userName`';
        }

        $sql = sprintf(
            'INSERT INTO `dateOptions` (%s) VALUES (%s)',
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
                    case '`date`':
                        $stmt->bindValue($identifier, $this->date, PDO::PARAM_STR);
                        break;
                    case '`fixed`':
                        $stmt->bindValue($identifier, (int) $this->fixed, PDO::PARAM_INT);
                        break;
                    case '`eventId`':
                        $stmt->bindValue($identifier, $this->eventid, PDO::PARAM_INT);
                        break;
                    case '`class_key`':
                        $stmt->bindValue($identifier, $this->class_key, PDO::PARAM_STR);
                        break;
                    case '`choices`':
                        $stmt->bindValue($identifier, $this->choices, PDO::PARAM_STR);
                        break;
                    case '`userName`':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
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


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aEvent !== null) {
                if (!$this->aEvent->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aEvent->getValidationFailures());
                }
            }

            if ($this->aMyUser !== null) {
                if (!$this->aMyUser->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aMyUser->getValidationFailures());
                }
            }


            if (($retval = DateOptionPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collNotifications !== null) {
                    foreach ($this->collNotifications as $referrerFK) {
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
        $pos = DateOptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getDate();
                break;
            case 2:
                return $this->getFixed();
                break;
            case 3:
                return $this->getEventid();
                break;
            case 4:
                return $this->getClassKey();
                break;
            case 5:
                return $this->getChoices();
                break;
            case 6:
                return $this->getUsername();
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
        if (isset($alreadyDumpedObjects['DateOption'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['DateOption'][$this->getPrimaryKey()] = true;
        $keys = DateOptionPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getDate(),
            $keys[2] => $this->getFixed(),
            $keys[3] => $this->getEventid(),
            $keys[4] => $this->getClassKey(),
            $keys[5] => $this->getChoices(),
            $keys[6] => $this->getUsername(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aEvent) {
                $result['Event'] = $this->aEvent->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aMyUser) {
                $result['MyUser'] = $this->aMyUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collNotifications) {
                $result['Notifications'] = $this->collNotifications->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = DateOptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setDate($value);
                break;
            case 2:
                $this->setFixed($value);
                break;
            case 3:
                $this->setEventid($value);
                break;
            case 4:
                $this->setClassKey($value);
                break;
            case 5:
                $this->setChoices($value);
                break;
            case 6:
                $this->setUsername($value);
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
        $keys = DateOptionPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setDate($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setFixed($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setEventid($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setClassKey($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setChoices($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setUsername($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(DateOptionPeer::DATABASE_NAME);

        if ($this->isColumnModified(DateOptionPeer::ID)) $criteria->add(DateOptionPeer::ID, $this->id);
        if ($this->isColumnModified(DateOptionPeer::DATE)) $criteria->add(DateOptionPeer::DATE, $this->date);
        if ($this->isColumnModified(DateOptionPeer::FIXED)) $criteria->add(DateOptionPeer::FIXED, $this->fixed);
        if ($this->isColumnModified(DateOptionPeer::EVENTID)) $criteria->add(DateOptionPeer::EVENTID, $this->eventid);
        if ($this->isColumnModified(DateOptionPeer::CLASS_KEY)) $criteria->add(DateOptionPeer::CLASS_KEY, $this->class_key);
        if ($this->isColumnModified(DateOptionPeer::CHOICES)) $criteria->add(DateOptionPeer::CHOICES, $this->choices);
        if ($this->isColumnModified(DateOptionPeer::USERNAME)) $criteria->add(DateOptionPeer::USERNAME, $this->username);

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
        $criteria = new Criteria(DateOptionPeer::DATABASE_NAME);
        $criteria->add(DateOptionPeer::ID, $this->id);

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
     * @param object $copyObj An object of DateOption (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDate($this->getDate());
        $copyObj->setFixed($this->getFixed());
        $copyObj->setEventid($this->getEventid());
        $copyObj->setClassKey($this->getClassKey());
        $copyObj->setChoices($this->getChoices());
        $copyObj->setUsername($this->getUsername());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getNotifications() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNotification($relObj->copy($deepCopy));
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
     * @return DateOption Clone of current object.
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
     * @return DateOptionPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new DateOptionPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Event object.
     *
     * @param                  Event $v
     * @return DateOption The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEvent(Event $v = null)
    {
        if ($v === null) {
            $this->setEventid(NULL);
        } else {
            $this->setEventid($v->getId());
        }

        $this->aEvent = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Event object, it will not be re-added.
        if ($v !== null) {
            $v->addDateOption($this);
        }


        return $this;
    }


    /**
     * Get the associated Event object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Event The associated Event object.
     * @throws PropelException
     */
    public function getEvent(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aEvent === null && ($this->eventid !== null) && $doQuery) {
            $this->aEvent = EventQuery::create()->findPk($this->eventid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEvent->addDateOptions($this);
             */
        }

        return $this->aEvent;
    }

    /**
     * Declares an association between this object and a MyUser object.
     *
     * @param                  MyUser $v
     * @return DateOption The current object (for fluent API support)
     * @throws PropelException
     */
    public function setMyUser(MyUser $v = null)
    {
        if ($v === null) {
            $this->setUsername(NULL);
        } else {
            $this->setUsername($v->getName());
        }

        $this->aMyUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the MyUser object, it will not be re-added.
        if ($v !== null) {
            $v->addDateOption($this);
        }


        return $this;
    }


    /**
     * Get the associated MyUser object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return MyUser The associated MyUser object.
     * @throws PropelException
     */
    public function getMyUser(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aMyUser === null && (($this->username !== "" && $this->username !== null)) && $doQuery) {
            $this->aMyUser = MyUserQuery::create()->findPk($this->username, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMyUser->addDateOptions($this);
             */
        }

        return $this->aMyUser;
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
        if ('Notification' == $relationName) {
            $this->initNotifications();
        }
    }

    /**
     * Clears out the collNotifications collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return DateOption The current object (for fluent API support)
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
     * If this DateOption is new, it will return
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
                    ->filterByDateOption($this)
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
     * @return DateOption The current object (for fluent API support)
     */
    public function setNotifications(PropelCollection $notifications, PropelPDO $con = null)
    {
        $notificationsToDelete = $this->getNotifications(new Criteria(), $con)->diff($notifications);


        $this->notificationsScheduledForDeletion = $notificationsToDelete;

        foreach ($notificationsToDelete as $notificationRemoved) {
            $notificationRemoved->setDateOption(null);
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
                ->filterByDateOption($this)
                ->count($con);
        }

        return count($this->collNotifications);
    }

    /**
     * Method called to associate a BaseNotification object to this object
     * through the BaseNotification foreign key attribute.
     *
     * @param    BaseNotification $l BaseNotification
     * @return DateOption The current object (for fluent API support)
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
        $notification->setDateOption($this);
    }

    /**
     * @param	Notification $notification The notification object to remove.
     * @return DateOption The current object (for fluent API support)
     */
    public function removeNotification($notification)
    {
        if ($this->getNotifications()->contains($notification)) {
            $this->collNotifications->remove($this->collNotifications->search($notification));
            if (null === $this->notificationsScheduledForDeletion) {
                $this->notificationsScheduledForDeletion = clone $this->collNotifications;
                $this->notificationsScheduledForDeletion->clear();
            }
            $this->notificationsScheduledForDeletion[]= $notification;
            $notification->setDateOption(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this DateOption is new, it will return
     * an empty collection; or if this DateOption has previously
     * been saved, it will retrieve related Notifications from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in DateOption.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Notification[] List of Notification objects
     */
    public function getNotificationsJoinEvent($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NotificationQuery::create(null, $criteria);
        $query->joinWith('Event', $join_behavior);

        return $this->getNotifications($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this DateOption is new, it will return
     * an empty collection; or if this DateOption has previously
     * been saved, it will retrieve related Notifications from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in DateOption.
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
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->date = null;
        $this->fixed = null;
        $this->eventid = null;
        $this->class_key = null;
        $this->choices = null;
        $this->choices_unserialized = null;
        $this->username = null;
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
            if ($this->collNotifications) {
                foreach ($this->collNotifications as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aEvent instanceof Persistent) {
              $this->aEvent->clearAllReferences($deep);
            }
            if ($this->aMyUser instanceof Persistent) {
              $this->aMyUser->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collNotifications instanceof PropelCollection) {
            $this->collNotifications->clearIterator();
        }
        $this->collNotifications = null;
        $this->aEvent = null;
        $this->aMyUser = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DateOptionPeer::DEFAULT_STRING_FORMAT);
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
