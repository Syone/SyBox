<?php
namespace Project\Db;

use \Sy\Db\Sql;

class Gate extends \Sy\Db\Gate {

	public function __construct() {
		parent::__construct(DSN, USERNAME, PASSWORD, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}

	public function getFields($table) {
		$sql = "SHOW COLUMNS FROM $table";
		$res = $this->queryAll($sql);
		return array_map(function ($a) {
			return $a['Field'];
		}, $res);
	}

	/**
	 * Replace a table row with specified data.
	 * Replace is a MySQL extension to the SQL stantard.
	 *
	 * @param string $table The table name.
	 * @param array $bind Column-value pairs.
	 * @return int The number of affected rows.
	 */
	public function replace($table, array $bind) {
		$columns = array_keys($bind);
		$columns = '`' . implode('`,`', $columns) . '`';
		$values = array_values($bind);
		$v = array_fill(0, count($bind), '?');
		$v = implode(',', $v);
		$sql = new Sql("REPLACE INTO $table ($columns) VALUES ($v)", $values);
		return $this->execute($sql);
	}

}