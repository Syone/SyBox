<?php
namespace Project\Lib;

class DbContainer {

	private static $instance;

	private static function construct() {
		$c = new Pimple();
		return $c;
	}

	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = self::construct();
		}
		return self::$instance;
	}

}