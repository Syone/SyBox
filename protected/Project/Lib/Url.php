<?php
namespace Project\Lib;

class Url {

	private static $converters = array();

	public static function analyse() {
		foreach (self::$converters as $converter) {
			if ($converter->urlToParams($_SERVER['REQUEST_URI'])) return;
		}
	}

	public static function addConverter(Url\IConverter $converter) {
		self::$converters[] = $converter;
	}

	public static function build($controller, $action = null, array $parameters = array()) {
		$params = $parameters;
		$params[CONTROLLER_TRIGGER] = $controller;
		if (!is_null($action)) $params[ACTION_TRIGGER] = $action;
		foreach (self::$converters as $converter) {
			$url = $converter->paramsToUrl($params);
			if (!is_null($url)) return $url;
		}
		return $_SERVER['PHP_SELF'] . (empty($params) ? '' : '?' . http_build_query($params));
	}

}
