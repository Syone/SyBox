<?php
namespace Project\Lib\Url;

use Project\Service\Container;
use Sy\Bootstrap\Lib\Url\IConverter;

class CodeConverter implements IConverter {

	public function paramsToUrl(array $params) {
		if (empty($params[CONTROLLER_TRIGGER])) return null;
		if ($params[CONTROLLER_TRIGGER] !== 'page') return null;
		unset($params[CONTROLLER_TRIGGER]);

		if (empty($params[ACTION_TRIGGER])) return null;
		if ($params[ACTION_TRIGGER] !== 'home') return null;
		unset($params[ACTION_TRIGGER]);

		if (!empty($params['slug'])) {
			$url = WEB_ROOT . '/' . $params['slug'];
			unset($params['slug']);
			return $url . (empty($params) ? '' : '?' . http_build_query($params));
		}

		if (empty($params['id'])) return null;
		$id = $params['id'];
		unset($params['id']);

		$service = Container::getInstance();
		$code    = $service->code->retrieve(['id' => $id]);
		if (!empty($code['slug'])) {
			$url = WEB_ROOT . '/' . $code['slug'];
			return $url . (empty($params) ? '' : '?' . http_build_query($params));
		}
		return WEB_ROOT . '/' . base_convert($code['id'], 10, 36) . (empty($params) ? '' : '?' . http_build_query($params));
	}

	public function urlToParams($url) {
		list($uri) = explode('?', $url, 2);
		$id = trim(substr($uri, strlen(WEB_ROOT) + 1), '/');
		if (empty($id) or false !== strpos($id, '/')) return false;

		$service = Container::getInstance();
		$code    = $service->code->retrieve(['id' => @base_convert($id, 36, 10)]);
		if (empty($code)) $code = $service->code->retrieve(['slug' => $id]);
		if (empty($code)) return false;

		$_REQUEST[CONTROLLER_TRIGGER] = 'page';
		$_GET[CONTROLLER_TRIGGER] = 'page';
		$_REQUEST[ACTION_TRIGGER] = 'home';
		$_GET[ACTION_TRIGGER] = 'home';
		$_REQUEST['id'] = $code['id'];
		$_GET['id'] = $code['id'];
		return true;
	}

}