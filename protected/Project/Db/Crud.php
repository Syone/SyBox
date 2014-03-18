<?php
namespace Project\Db;

use Sy\Db\Sql;
use Project\Db\Sql\Select;

class Crud extends Gate {

	private $table;

	public function __construct($table) {
		parent::__construct();
		$this->table = $table;
	}

	/**
	 * Add a row with specified data.
	 *
	 * @param array $fields Column-value pairs.
	 * @return int The number of affected rows.
	 */
	public function create(array $fields) {
		return $this->insert($this->table, $fields);
	}

	/**
	 * Retrieve a row by primary key.
	 *
	 * @param array $pk Column-value pairs.
	 * @return array
	 */
	public function retrieve(array $pk) {
		return $this->queryOne(new Select([
			'FROM'  => $this->table,
			'WHERE' => $pk,
		]), \PDO::FETCH_ASSOC);
	}

	/**
	 * Return all rows.
	 *
	 * @param array $parameters Select parameters like: FROM, WHERE, LIMIT, OFFSET...
	 * @return \PDOStatement
	 */
	public function retrieveAll(array $parameters = []) {
		$parameters['FROM'] = $this->table;
		return $this->queryAll(new Select($parameters));
	}

	/**
	 * Return a PDOStatement in order to do an iteration.
	 *
	 * @param array $parameters Select parameters like: FROM, WHERE, LIMIT, OFFSET...
	 * @return \PDOStatement
	 */
	public function retrieveStatement(array $parameters = []) {
		$parameters['FROM'] = $this->table;
		return $this->query(new Select($parameters));
	}

	/**
	 * Update a row by primary key.
	 *
	 * @param array $pk Column-value pairs.
	 * @param array $bind Column-value pairs.
	 * @return int The number of affected rows.
	 */
	public function update(array $pk, array $bind) {
		$where = $this->wherePk($pk);
		$s = array_map(function($k) {
			return "`$k` = ?";
		}, array_keys($bind));
		$set = implode(',', $s);
		$sql = new Sql("
			UPDATE $this->table
			SET $set
			WHERE $where
		", array_merge(array_values($bind), array_values($pk)));
		return $this->execute($sql);
	}

	/**
	 * Delete a row by primary key.
	 *
	 * @param array $pk Column-value pairs.
	 * @return int The number of affected rows.
	 */
	public function delete(array $pk) {
		$where = $this->wherePk($pk);
		$sql = new Sql("DELETE FROM $this->table WHERE $where", array_values($pk));
		return $this->execute($sql);
	}

	/**
	 * Replace a row with specified data.
	 *
	 * @param array $fields Column-value pairs.
	 * @return int The number of affected rows.
	 */
	public function change(array $fields) {
		return $this->replace($this->table, $fields);
	}

	/**
	 * Return row count.
	 *
	 * @param mixed $where array or string.
	 * @return int
	 */
	public function count($where = null) {
		$parameters['SELECT'] = 'count(*)';
		$parameters['FROM']   = $this->table;
		$parameters['WHERE']  = $where;
		$sql = new Select($parameters);
		$res = $this->queryOne($sql);
		return $res[0];
	}

	/**
	 * Return columns informations.
	 *
	 * @return array
	 */
	public function getColumns() {
		return $this->queryAll("SHOW FULL COLUMNS FROM $this->table");
	}

	protected function wherePk(array $pk) {
		$w = array_map(function($k) {
			return "`$this->table`.`$k` = ?";
		}, array_keys($pk));
		return implode(' AND ', $w);
	}

}