<?php
namespace Project\Component\User;

class DeleteAccount extends \Sy\Bootstrap\Component\Form {

	public function init() {
		parent::init();

		$this->addCsrfField();

		$f = $this->addFieldset();
		$this->addPassword(
			[
				'name'     => 'password',
				'required' => 'required',
				'autocomplete' => 'off',
			],
			[
				'label'     => 'Password',
				'validator' => [$this, 'passwordValidator']
			],
			$f
		);
		$this->addButton('Delete account', [
			'type'    => 'submit',
			'onclick' => "return confirm('" . $this->_('Delete your account?') . "')"
		], ['color' => 'danger', 'icon' => 'fas fa-trash-alt'], $f);
	}

	public function submitAction() {
		try {
			$this->validatePost();
			$service = \Sy\Bootstrap\Service\Container::getInstance();
			$user = $service->user->getCurrentUser();
			$service->user->delete(['id' => $user->id]);
			$service->user->signOut();
			$this->redirect(WEB_ROOT . '/');
		} catch(\Sy\Component\Html\Form\Exception $e) {
			$this->logWarning($e);
			$this->setError($this->_('An error occured'));
			$this->fill($_POST);
		} catch(\Sy\Bootstrap\Service\User\Exception $e) {
			$this->logWarning($e->getMessage());
			$this->setError($this->_('An error occured'));
		}
	}

	public function passwordValidator($value) {
		$service = \Sy\Bootstrap\Service\Container::getInstance();
		$user = $service->user->getCurrentUser();
		return $service->user->passwordVerify($value, $user->password, $user->algo);
	}

}