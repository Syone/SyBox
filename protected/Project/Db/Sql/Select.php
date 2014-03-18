<?php
namespace Project\Db\Sql;

class Select extends \Sy\Db\Sql {

	private $sql;

	private $params;

	public function __construct(array $parameters) {
		$this->sql = new \Sy\Component();
		$this->sql->setTemplateFile(__DIR__ . '/Select.tpl', 'php');
		$this->buildSql($parameters);
		parent::__construct($this->sql->__toString(), $this->params);
	}

	private function buildSql(array $parameters) {
		$select = empty($parameters['SELECT']) ? '*' : $parameters['SELECT'];
		$this->buildSelect($select);
		if (!empty($parameters['FROM'])) {
			$this->buildFrom($parameters['FROM']);
		}
		if (!empty($parameters['JOIN'])) {
			$this->buildJoin($parameters['JOIN']);
		}
		if (!empty($parameters['WHERE'])) {
			$this->buildWhere($parameters['WHERE']);
		}
		if (!empty($parameters['GROUP BY'])) {
			$this->buildGroupBy($parameters['GROUP BY']);
		}
		if (!empty($parameters['HAVING'])) {
			$this->buildHaving($parameters['HAVING']);
		}
		if (!empty($parameters['ORDER BY'])) {
			$this->buildOrderBy($parameters['ORDER BY']);
		}
		if (!empty($parameters['LIMIT'])) {
			$this->sql->setVar('LIMIT', $parameters['LIMIT']);
			if (!empty($parameters['OFFSET'])) {
				$this->sql->setVar('OFFSET', $parameters['OFFSET']);
			}
		}
	}

	private function buildSelect($select) {
		if (is_array($select)) {
			if ($this->isAssoc($select)) {
				$tmp = [];
				foreach ($select as $k => $v) {
					$tmp[] = "$k AS $v";
				}
				$select = implode(', ', $tmp);
			} else {
				$select = implode(', ', $select);
			}
		}
		$this->sql->setVar('SELECT', $select);
	}

	private function buildFrom($from) {
		if (is_array($from)) {
			if ($this->isAssoc($from)) {
				$tmp = [];
				foreach ($from as $k => $v) {
					$tmp[] = "$k AS $v";
				}
				$from = implode(', ', $tmp);
			} else {
				$from = implode(', ', $from);
			}
		}
		$this->sql->setVar('FROM', $from);
	}

	private function buildJoin($join) {
		$this->sql->setVar('JOIN', $join);
	}

	private function buildWhere($where) {
		if (is_array($where)) {
			if ($this->isAssoc($where)) {
				$w = array_map(function($k) {
					return "$k = ?";
				}, array_keys($where));
				$this->params = array_values($where);
				$where = implode(' AND ', $w);
			}
		}
		$this->sql->setVar('WHERE', $where);
	}

	private function buildGroupBy($groupBy) {
		$this->sql->setVar('GROUP_BY', $groupBy);
	}

	private function buildHaving($having) {
		$this->sql->setVar('HAVING', $having);
	}

	private function buildOrderBy($orderBy) {
		$this->sql->setVar('ORDER_BY', $orderBy);
	}

	private function isAssoc($var) {
        return is_array($var) && array_diff_key($var,array_keys(array_keys($var)));
	}

}