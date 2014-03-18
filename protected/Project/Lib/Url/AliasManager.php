<?php
namespace Project\Lib\Url;

class AliasManager {

	private static $alias = array();

	public static function setAliasFile($file) {
		if (file_exists($file)) $data = include($file);
		if (is_array($data)) self::$alias = $data;
	}

	public static function retrieveAlias($path) {
		if (empty(self::$alias[$path])) {
			return null;
		}
		return self::$alias[$path];
	}

	public static function retrievePath($alias) {
		return array_search($alias, self::$alias);
	}

	public static function registerAlias($alias, $path) {
		self::$alias[$path] = $alias;
	}

}