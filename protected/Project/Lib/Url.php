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

	public static function item($id, $slug = null) {
		$params['i'] = $id;
		if (!empty($slug)) $params['slug'] = $slug;
		return self::build('item', null, $params);
	}

	public static function itemPicture($itemId, $typeId = null) {
		if (file_exists(ITEM_PICTURE_DIR . '/' . $itemId)) {
			return ITEM_PICTURE_ROOT . '/' . $itemId;
		} elseif (!is_dir(__DIR__ . '/../../../assets/img/default-item-picture/' . $typeId)) {
			return WEB_ROOT . '/assets/img/default-item-picture/itb';
		} elseif (empty($typeId)) {
			return WEB_ROOT . '/assets/img/default-item-picture/itb';
		} else {
			$files = scandir(__DIR__ . '/../../../assets/img/default-item-picture/' . $typeId);
			$nbImg = count($files) - 2;
			$imgId = $itemId%$nbImg + 1;
			return WEB_ROOT . '/assets/img/default-item-picture/' . $typeId . '/' . $imgId;
		}
	}

	public static function itemBackground($itemId, $typeId = null) {
		if (empty($typeId)) {
			return WEB_ROOT . '/assets/img/default-item-background/itb';
		} elseif (!is_dir(__DIR__ . '/../../../assets/img/default-item-background/' . $typeId)) {
			return WEB_ROOT . '/assets/img/default-item-background/itb';
		} else {
			$files = scandir(__DIR__ . '/../../../assets/img/default-item-background/' . $typeId);
			$nbImg = count($files) - 2;
			$imgId = $itemId%$nbImg + 1;
			return WEB_ROOT . '/assets/img/default-item-background/' . $typeId . '/' . $imgId;
		}
	}

}