<?php
namespace Project\Lib\Url;

class AliasConverter implements IConverter {

	public function paramsToUrl(array $params) {
		if (empty($params[CONTROLLER_TRIGGER])) return null;
		if (!empty($params[ACTION_TRIGGER])) {
			$url = AliasManager::retrieveAlias($params[CONTROLLER_TRIGGER] . '/' . $params[ACTION_TRIGGER]);
			unset($params[ACTION_TRIGGER]);
		} else {
			$url = AliasManager::retrieveAlias($params[CONTROLLER_TRIGGER]);
		}
		unset($params[CONTROLLER_TRIGGER]);
		if (is_null($url)) return null;
		return WEB_ROOT . '/' . $url . (empty($params) ? '' : '?' . http_build_query($params));
	}

	public function urlToParams($url) {
		list($uri) = explode('?', $url, 2);
		$alias = substr($uri, strlen(WEB_ROOT) + 1);
		if (empty($alias)) return false;
		$path = AliasManager::retrievePath($alias);
		if (empty($path)) return false;
		$p = explode('/', $path);
		$_REQUEST[CONTROLLER_TRIGGER] = $p[0];
		$_GET[CONTROLLER_TRIGGER] = $p[0];
		if (!empty($p[1])) {
			$_REQUEST[ACTION_TRIGGER] = $p[1];
			$_GET[ACTION_TRIGGER] = $p[1];
		}
		return true;
	}

}