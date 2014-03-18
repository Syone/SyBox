<?php
namespace Project\Lib;

class ServiceContainer {

	private static $instance;

	private static function construct() {
		$c = new Pimple();
		$c['code'] = $c->share(function ($c) {
			return new \Project\Lib\Crud('code');
		});
		return $c;
	}

	public static function getInstance() {
		if (!isset(self::$instance)) {
			self::$instance = self::construct();
		}
		return self::$instance;
	}

}