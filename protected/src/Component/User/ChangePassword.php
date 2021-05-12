<?php
namespace Project\Component\User;

class ChangePassword extends \Sy\Bootstrap\Component\Form {

	public function init() {
		parent::init();

		$this->addCsrfField();

		$f = $this->addFieldset();
		$this->addPassword(
			[
				'name'     => 'old_password',
				'required' => 'required',
				'autocomplete' => 'off',
			],
			[
				'label'     => 'Old password',
				'validator' => [$this, 'oldPasswordValidator']
			],
			$f
		);
		$this->addPassword(
			[
				'name'     => 'new_password',
				'required' => 'required',
				'autocomplete' => 'new-password',
			],
			[
				'label'     => 'New password',
				'validator' => [$this, 'passwordValidator']
			],
			$f
		);
		$this->addPassword(
			[
				'name'     => 'new_password_bis',
				'required' => 'required',
				'autocomplete' => 'new-password',
			],
			[
				'label' => 'Confirm new password',
				'validator' => function($value, $element) {
					$password = $this->post('new_password');
					if (!empty($value) and $value === $password) return true;
					$element->setError('Password error');
					return false;
				}
			]
		);
		$this->addButton('Save', ['type' => 'submit'], ['color' => 'primary', 'icon' => 'fas fa-save']);
	}

	public function oldPasswordValidator($value, $element) {
		$service = \Sy\Bootstrap\Service\Container::getInstance();
		$user = $service->user->getCurrentUser();
		if ($service->user->passwordVerify($value, $user->password)) return true;
		$element->setError('Password error');
		return false;
	}

	public function passwordValidator($value, $element) {
		if (strlen($value) > 40) {
			$element->setError('Password too long');
			return false;
		}
		if (strlen($value) < 6) {
			$element->setError('Password too short');
			return false;
		}
		return true;
	}

	public function submitAction() {
		try {
			$this->validatePost();
			$service = \Sy\Bootstrap\Service\Container::getInstance();
			$user = $service->user->getCurrentUser();
			$service->user->update(['id' => $user->id], ['password' => password_hash($this->post('new_password'), PASSWORD_DEFAULT), 'algo' => 'bcrypt']);
			$service->user->signIn($user->email, $this->post('new_password'));
			$this->setSuccess($this->_('Password changed successfully'));
		} catch (\Sy\Component\Html\Form\Exception $e) {
			$this->logWarning($e);
			if (is_null($this->getOption('error'))) {
				$this->setError($this->_('An error occured'));
			}
		} catch(\Sy\Bootstrap\Service\User\Exception $e) {
			$this->logWarning($e->getMessage());
			$this->setError($this->_('An error occured'));
		}
	}

}