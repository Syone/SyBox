<?php

namespace Project\Application;

use Sy\Bootstrap\Lib\Str;

class Api extends \Sy\Bootstrap\Application\Api {

	private $whiteList = [];

	public function security() {
		// White list
		$action = $this->action;
		$method = $this->method;
		if (in_array("$action/$method", $this->whiteList)) return true;
		return parent::security();
	}

	public function dispatch() {
		// Check if a plugin api class exists
		$class = 'Project\\Application\\Api\\' . ucfirst(Str::snakeToCaml($this->action));
		if (class_exists($class)) new $class();

		parent::dispatch();
	}

}