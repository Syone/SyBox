<?php
namespace Project\Component\User;

class AccountPanel extends \Sy\Component\Html\Panel {

	public function __construct() {
		parent::__construct();
		$this->addTranslator(LANG_DIR);
		$this->actionDispatch('s', 'index');
	}

	public function indexAction() {
		$service = \Sy\Bootstrap\Service\Container::getInstance();
		$id = $service->user->getCurrentUser()->id;
		$this->setComponent('NORTH', new \Sy\Bootstrap\Component\Form\Avatar(
			\Sy\Bootstrap\Lib\Url::avatar($id),
			\Sy\Bootstrap\Lib\Url::build('api', 'avatar'),
			100
		));
		$this->setComponent('CENTER', new Account());
	}

	public function changeAction() {
		$this->setComponent('CENTER', new ChangePassword());
	}

	public function deleteAction() {
		$this->setComponent('CENTER', new DeleteAccount());
	}

}