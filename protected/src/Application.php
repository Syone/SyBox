<?php
namespace Project;

use Project\Lib\Url\CodeConverter;
use Sy\Bootstrap\Lib\Url;

class Application extends \Sy\Bootstrap\Application {

	protected function initUrlConverter() {
		Url\AliasManager::setAliasFile(__DIR__ . '/../conf/alias.php');
		Url::addConverter(new CodeConverter());
		Url::addConverter(new Url\AliasConverter());
		Url::addConverter(new Url\ControllerActionConverter());
	}

}