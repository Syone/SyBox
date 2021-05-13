<?php
namespace Project\Application;

use Project\Service\Container;
use Sy\Bootstrap\Lib\HeadData;
use Sy\Bootstrap\Lib\Url;

class Page extends \Sy\Bootstrap\Application\Page {

	public function home() {
		$title = '';
		$description = '';
		$text = null;

		// Check if there is saved code
		$service = Container::getInstance();
		$id   = $this->get('id');
		$code = $service->code->retrieve(['id' => $id]);

		if (!empty($code)) {
			$text = $code['code'];
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

		$this->__call('home', ['CONTENT' => [
			'TITLE'       => $title,
			'DESCRIPTION' => $description,
			'EDITABLE'    => $empty ? 'true' : 'false',
			'CODE_EDITOR' => $codeEditorForm,
		]]);

		HeadData::setTitle(empty($title) ? 'PHP playground' : $title);
	}

	/**
	 * User settings page
	 */
	public function user_account() {
		$service = \Sy\Bootstrap\Service\Container::getInstance();
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
		$this->__call('user-account', ['CONTENT' => [
			'TITLE'   => $sections[$this->get('s', 'index')],
			'NAV'     => $nav,
			'CONTENT' => new \Project\Component\User\AccountPanel(),
		]]);
	}

	/**
	 * Return navigation menu, can return null
	 *
	 * @return \Sy\Bootstrap\Component\Nav\Menu
	 */
	protected function _menu() {
		return new \Project\Component\Nav\Navbar();
	}

}