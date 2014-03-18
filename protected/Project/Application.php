<?php
namespace Project;

use Sy\Component\WebComponent;
use Sy\Component\Html\Page;
use Project\Lib\Url;

class Application extends Page {

	/**
	 * @var WebComponent
	 */
	private $body;

	/**
	 * Application constructor
	 */
	public function __construct() {
		parent::__construct();
		if (URL_REWRITING) {
			Url\AliasManager::setAliasFile(__DIR__ . '/../conf/alias.php');
			Url::addConverter(new Url\AliasConverter());
			Url::addConverter(new Url\ControllerActionConverter());
			Url::analyse();
		}
		$this->body = new WebComponent();
		$this->body->addTranslator(LANG_DIR);
		$this->body->setTemplateFile(TPL_DIR . '/Application/Application.html');
		$this->init();
	}

	/**
	 * Return Application render
	 *
	 * @return string
	 */
	public function __toString() {
		$this->setTitle(Lib\HeadData::getTitle());
		$this->setDescription(Lib\HeadData::getDescription());
		$this->setBody($this->body);
		return parent::__toString();
	}

	/**
	 * Initialize Application
	 */
	private function init() {
		$this->addTranslator(LANG_DIR);

		// Head data
		$this->setFavicon(WEB_ROOT . '/assets/img/favicon.ico');
		$this->setMeta('viewport', 'width=device-width, initial-scale=1.0');
		Lib\HeadData::setTitle('SyBox');
		Lib\HeadData::setDescription('The PHP playground with SyFramework');

		// Bootstrap css
		$this->addCssLink(WEB_ROOT . '/assets/bootstrap/css/bootstrap.min.css');
		$this->addCssLink(WEB_ROOT . '/assets/css/app.css');

		// jQuery library
		$this->addJsLink('https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', self::JS_BOTTOM);

		// Bootstrap js
		$this->addJsLink(WEB_ROOT . '/assets/bootstrap/js/bootstrap.min.js', self::JS_BOTTOM);

		// Application init
		$this->body->setVar('PHP_SELF', WEB_ROOT);
		$this->body->setVar('WEB_ROOT', WEB_ROOT);
		$this->body->setVar('PROJECT', PROJECT);
		$this->initContent();
	}

	/**
	 * Initialize content with the right controller
	 */
	private function initContent() {
		// Check if there is saved code
		$service = \Project\Lib\ServiceContainer::getInstance();
		$code = $service['code']->retrieve(['token' => $this->get(CONTROLLER_TRIGGER)]);
		if (!empty($code)) {
			$text = $code['code'];
			$service['code']->update(['token' => $this->get(CONTROLLER_TRIGGER)], ['updated_at' => date("Y-m-d H:i:s")]);
		} else {
			$text = null;
		}

		// Code editor form
		$codeEditorForm = new \Project\Component\Form\CodeEditor($text);
		$codeEditorForm->setAttribute('id', 'code_editor');
		$codeEditorForm->setAttribute('target', 'code_result');
		$this->body->setComponent('CODE_EDITOR', $codeEditorForm);
	}

}