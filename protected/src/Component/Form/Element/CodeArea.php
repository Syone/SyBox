<?php
namespace Project\Component\Form\Element;

class CodeArea extends \Sy\Component\Html\Form\Textarea {

	public function __construct() {
		parent::__construct();
		$this->preInit();
	}

	public function __toString() {
		$this->postInit();
		return parent::__toString();
	}

	private function preInit() {
		$this->setTemplateFile(TPL_DIR . '/Component/Form/Element/CodeArea/CodeArea.tpl', 'php');
		$this->addJsLink(ACE_EDITOR . '/ace.js');
		$this->addJsLink(ACE_EDITOR . '/ext-language_tools.min.js');
		$this->addJsLink(ACE_EDITOR . '/theme-tomorrow_night.min.js');
		$this->addJsLink(ACE_EDITOR . '/mode-php.min.js');
		$this->setContent(array("<?php\n"));
	}

	private function postInit() {
		if (is_null($this->getAttribute('id'))) $this->setAttribute('id', uniqid());
		$this->setAttribute('hidden', 'hidden');

		// Code id
		$codeId = uniqid();
		$this->setVar('CODE_ID', $codeId);

		// js code
		$js = new \Sy\Component();
		$js->setTemplateFile(TPL_DIR . '/Component/Form/Element/CodeArea/CodeArea.js');
		$js->setVar('CODE_AREA_ID', $codeId);
		$js->setVar('TEXT_AREA_ID', $this->getAttribute('id'));
		$this->addJsCode($js->__toString());
	}

}