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
		parent::dispatch();

		// If no action method found, check if a plugin api class exists
		$c = $this->action;
		if (is_null($c)) return;
		$class = 'Project\\Application\\Api\\' . ucfirst(Str::snakeToCaml($c));
		if (class_exists($class)) new $class();
	}

}