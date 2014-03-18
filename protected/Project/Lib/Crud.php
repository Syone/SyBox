<?php
namespace Project\Lib;

class Crud extends \Sy\Object {

	/**
	 * @var \Project\Lib\DbContainer
	 */
	private $dbContainer;

	/**
	 * @var string
	 */
	private $id;

	public function __construct($id) {
		$this->id = $id;
	}

	/**
	 * @return \Project\Lib\DbContainer
	 */
	public function getDbContainer() {
		if (!isset($this->dbContainer)) {
			$this->dbContainer = DbContainer::getInstance();
		}
		return $this->dbContainer;
	}

	/**
	 * @param \Project\Lib\DbContainer $dbContainer
	 */
	public function setDbContainer(\Project\Lib\DbContainer $dbContainer) {
		$this->dbContainer = $dbContainer;
	}

	/**
	 * @return \Project\Db\Crud
	 */
	public function getDbCrud() {
		$container = $this->getDbContainer();
		if (!isset($container[$this->id])) {
			$table = 't_' . $this->id;
			$container[$this->id] = function ($container) use ($table) {
				return new \Project\Db\Crud($table);
			};
		}
		return $container[$this->id];
	}

	/**
	 * Add a row with specified data.
	 *
	 * @param array $fields Column-value pairs.
	 * @return int The number of affected rows.
	 * @throws Crud\Exception
	 */
	public function create(array $fields) {
		try {
			return $this->getDbCrud()->create($fields);
		} catch(\Sy\Db\Exception $e) {
			$this->logWarning($e);
			if ($e instanceof \Sy\Db\IntegrityConstraintViolationException) {
				throw new Crud\DuplicateEntryException('Integrity constraint violation');
			} else {
				throw new Crud\Exception('Create error');
			}
		}
	}

	/**
	 * Retrieve a row by primary key.
	 *
	 * @param array $pk Column-value pairs.
	 * @return array
	 */
	public function retrieve(array $pk) {
		try {
			return $this->getDbCrud()->retrieve($pk);
		} catch(\Sy\Db\Exception $e) {
			$this->logWarning($e);
			return array();
		}
	}

	/**
	 * Update a row by primary key.
	 *
	 * @param array $pk Column-value pairs.
	 * @param array $bind Column-value pairs.
	 * @return int The number of affected rows.
	 * @throws Crud\Exception
	 */
	public function update(array $pk, array $bind) {
		try {
			return $this->getDbCrud()->update($pk, $bind);
		} catch(\Sy\Db\Exception $e) {
			$this->logWarning($e);
			throw new Crud\Exception('Update error');
		}
	}

	/**
	 * Delete a row by primary key.
	 *
	 * @param array $pk Column-value pairs.
	 * @return int The number of affected rows.
	 * @throws Crud\Exception
	 */
	public function delete(array $pk) {
		try {
			return $this->getDbCrud()->delete($pk);
		} catch(\Sy\Db\Exception $e) {
			$this->logWarning($e);
			throw new Crud\Exception('Delete error');
		}
	}

	/**
	 * Retrieve many rows.
	 *
	 * @param array $parameters Select parameters like: WHERE, LIMIT, OFFSET...
	 * @throws Crud\Exception
	 */
	public function retrieveAll(array $parameters = []) {
		try {
			return $this->getDbCrud()->retrieveAll($parameters);
		} catch(\Sy\Db\Exception $e) {
			$this->logWarning($e);
			throw new Crud\Exception('retrieve all error');
		}
	}

	/**
	 * Foreach row, apply a function on it.
	 *
	 * @param callback $callback
	 * @param array $parameters Select parameters like: WHERE, LIMIT, OFFSET...
	 */
	public function foreachRow($callback, array $parameters = []) {
		$stmt = $this->getDbCrud()->retrieveStatement($parameters);
		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
			call_user_func($callback, $row);
		}
	}

	/**
	 * Change a row with specified data.
	 *
	 * @param array $fields Column-value pairs.
	 * @return int The number of affected rows.
	 * @throws Crud\Exception
	 */
	public function change(array $fields) {
		try {
			return $this->getDbCrud()->change($fields);
		} catch(\Sy\Db\Exception $e) {
			$this->logWarning($e);
			throw new Crud\Exception('Change error');
		}
	}

	/**
	 * Return row count.
	 *
	 * @param mixed $where array or string.
	 * @return int
	 * @throws Crud\Exception
	 */
	public function count($where = null) {
		try {
			return $this->getDbCrud()->count($where);
		} catch(\Sy\Db\Exception $e) {
			$this->logWarning($e);
			throw new Crud\Exception('Count error');
		}
	}

	/**
	 * Return columns informations.
	 *
	 * @return array
	 * @throws Crud\Exception
	 */
	public function getColumns() {
		try {
			return $this->getDbCrud()->getColumns();
		} catch(\Sy\Db\Exception $e) {
			$this->logWarning($e);
			throw new Crud\Exception('Get columns error');
		}
	}

}

namespace Project\Lib\Crud;

class Exception extends \Exception {}

class DuplicateEntryException extends \Exception {}