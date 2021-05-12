<?php
namespace Project\Component\User;

class Account extends \Sy\Bootstrap\Component\Form {

	public function init() {
		parent::init();

		$f = $this->addFieldset();

		$service = \Sy\Bootstrap\Service\Container::getInstance();
		$user = $service->user->getCurrentUser();

		$this->addCsrfField();

		// E-mail
		$this->addTextInput([
				'name'      => 'email',
				'value'     => $user->email,
				'required'  => 'required',
				'maxlength' => 64,
				'readonly'  => 'readonly'
			], [
				'label' => $this->_('E-mail'),
				'validator' => [
					'\Sy\Component\Html\Form\email',
					function($value) {
						if (strlen($value) <= 64) return true;
						$this->setError($this->_('E-mail is too long'));
						return false;
					}
				]
			], $f
		);

		// Firstname
		$this->addTextInput([
				'name'      => 'firstname',
				'value'     => $user->firstname,
				'required'  => 'required',
			    'maxlength' => 64
			], [
				'label' => $this->_('Firstname'),
				'validator' => [
					function($value) {
						if (strlen($value) <= 64) return true;
						$this->setError($this->_('Firstname is too long'));
						return false;
					}
				]
			], $f
		);

		// Lastname
		$this->addTextInput([
				'name'      => 'lastname',
				'value'     => $user->lastname,
			    'maxlength' => 64
			], [
				'label' => $this->_('Lastname'),
				'validator' => [
					function($value) {
						if (strlen($value) <= 64) return true;
						$this->setError($this->_('Lastname is too long'));
						return false;
					}
				]
			], $f
		);

		// Description
		$this->addTextarea([
			'name'      => 'description',
			'maxlength' => 500
		], [
			'label' => ucfirst($this->_('description')),
			'validator' => [
				function($value) {
					if (strlen($value) <= 500) return true;
					$this->setError(sprintf($this->_('%d characters max for %s'), 500, $this->_('description')));
					return false;
				}
			]
		], $f)->addText($user->description);

		// Language
		$this->addSelect([
			'name'     => 'language',
			'required' => 'required'
		], [
			'label'    => $this->_('Language'),
			'options'  => LANGS,
			'selected' => $user->language,
			'validator' => [
				function($value) {
					return in_array($value, array_keys(LANGS));
				}
			]
		], $f);

		// Newsletter opt in
//		$this->addCheckbox([
//			'name'  => 'newsletter',
//			'value' => 'yes',
//		], [
//			'label' => 'I want to receive newsletter'
//		], $f->addDiv(['class' => 'form-group']));

		$this->addButton('Save', ['type' => 'submit'], ['color' => 'primary', 'icon' => 'fas fa-save']);
	}

	public function submitAction() {
		try {
			$this->validatePost();
			$service = \Sy\Bootstrap\Service\Container::getInstance();
			$user = $service->user->getCurrentUser();
			$service->user->update(['id' => $user->id], [
				'firstname'   => $this->post('firstname'),
				'lastname'    => $this->post('lastname'),
				'description' => $this->post('description'),
				'language'    => $this->post('language')
			]);
			setcookie('sy_language', $this->post('language'), time() + 60 * 60 * 24 * 365, WEB_ROOT . '/');
			$this->setSuccess($this->_('Change saved'));
		} catch(\Sy\Component\Html\Form\Exception $e) {
			$this->logWarning($e);
			if (is_null($this->getOption('error'))) {
				$this->setError($this->_('Please fill the form correctly'));
			}
			$this->fill($_POST);
		} catch(\Sy\Bootstrap\Service\Crud\DuplicateEntryException $e) {
			$this->logWarning($e->getMessage());
			$this->setError($this->_('User already exists'));
			$this->fill($_POST);
		} catch(\Sy\Bootstrap\Service\Crud\Exception $e) {
			$this->logWarning($e->getMessage());
			$this->setError($this->_('An error occured'));
		}
	}

}