<?php
namespace Project\Application;

class Page extends \Sy\Bootstrap\Application\Page {

	protected function preInit() {
		// Head data
		$this->setMeta('viewport', 'width=device-width, initial-scale=1');
		$this->setMeta('mobile-web-app-capable', 'yes');
		$this->setMeta('apple-mobile-web-app-capable', 'yes');
		$this->setMeta('X-UA-Compatible', 'IE=edge', true);
		$this->setMeta('application-name', PROJECT);
		$this->setMeta('apple-mobile-web-app-title', PROJECT);

		// Favicon
		$this->addLink(['rel' => 'apple-touch-icon', 'sizes' => '180x180', 'href' => WEB_ROOT . '/assets/img/icons/apple-touch-icon.png']);
		$this->addLink(['rel' => 'icon', 'sizes' => '32x32', 'href' => WEB_ROOT . '/assets/img/icons/favicon-32x32.png']);
		$this->addLink(['rel' => 'icon', 'sizes' => '16x16', 'href' => WEB_ROOT . '/assets/img/icons/favicon-16x16.png']);
		$this->addLink(['rel' => 'manifest', 'href' => WEB_ROOT . '/site.webmanifest']);
		$this->addLink(['rel' => 'mask-icon', 'href' => WEB_ROOT . '/assets/img/icons/safari-pinned-tab.svg', 'color' => '#e95420']);
		$this->setFavicon(WEB_ROOT . '/assets/img/icons/favicon.ico');
		$this->setMeta('msapplication-TileColor', '#e95420');
		$this->setMeta('msapplication-config', WEB_ROOT . '/browserconfig.xml');
		$this->setMeta('theme-color', '#e95420');

		// Application css
		$this->addCssLink(WEB_ROOT . '/assets/css/app.css');

		// Application js
		$this->addJsLink(WEB_ROOT . '/assets/js/app.js');

		$this->setLayoutVars([
			'_NAV' => new \Project\Component\Nav\Navbar(),
		]);
	}

	protected function postInit() {

	}

	public function homeAction() {
		$title = '';
		$description = '';
		$text = null;

		// Check if there is saved code
		$service = \Project\Service\Container::getInstance();
		$id   = $this->get('id');
		$code = $service->code->retrieve(['id' => $id]);

		if (!empty($code)) {
			$text = str_replace('{', '&#123;', $code['code']);
			// Update the updated_at timestamp each time the code is shown
			$service->code->update(['id' => $id], ['updated_at' => date("Y-m-d H:i:s")]);

			// Title and description
			if (!empty($code['title'])) {
				$title = htmlentities($code['title'], ENT_QUOTES, 'UTF-8');
			}
			$description = $code['description'];
		}

		// Title and description editable
		$empty = empty($code['title']) and empty($code['description']);

		// Code editor form
		$codeEditorForm = new \Project\Component\Form\CodeEditor($text);
		$codeEditorForm->setAttribute('id', 'code_editor');
		$codeEditorForm->setAttribute('target', 'code_result');
		$codeEditorForm->addHidden(['name' => 'title', 'maxlength' => '255']);
		$codeEditorForm->addHidden(['name' => 'description', 'maxlength' => '512']);

		$this->setContentVars([
			'TITLE'       => $title,
			'DESCRIPTION' => $description,
			'EDITABLE'    => $empty ? 'true' : 'false',
			'CODE_EDITOR' => $codeEditorForm,
		]);

		if (!empty($title)) {
			\Sy\Bootstrap\Lib\HeadData::setTitle($title);
		}

		if (!empty($description)) {
			\Sy\Bootstrap\Lib\HeadData::setDescription(htmlentities($description, ENT_QUOTES, 'UTF-8'));
		}
	}

	/**
	 * User settings page
	 */
	public function userAccountAction() {
		$service = \Project\Service\Container::getInstance();
		$user = $service->user->getCurrentUser();
		if (!$user->isConnected() or $user->hasRole('blacklisted')) $this->redirect(WEB_ROOT . '/');
		$sections = [
			'index'  => $this->_('Account informations'),
			'change' => $this->_('Change password'),
			'delete' => $this->_('Delete account')
		];
		$nav = new \Sy\Component\Html\Navigation();
		$nav->setAttribute('class', 'nav nav-pills flex-column');
		foreach ($sections as $id => $label) {
			$active = $id == $this->get('s', 'index') ? 'active' : '';
			$i = $nav->addItem($label, Url::build('page', 'user-account', array('s' => $id)), ['class' => "nav-link $active"]);
			$i->setAttribute('class', 'nav-item');
		}
		$this->setContentVars([
			'TITLE'   => $sections[$this->get('s', 'index')],
			'NAV'     => $nav,
			'CONTENT' => new \Project\Component\User\AccountPanel(),
		]);
	}

}