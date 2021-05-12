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
		$this->addCssLink(CODE_MIRROR . '/lib/codemirror.min.css');
		$this->addCssLink(CODE_MIRROR . '/theme/darcula.min.css');
		$this->addJsLink(CODE_MIRROR . '/lib/codemirror.min.js');
		$this->addJsLink(CODE_MIRROR . '/mode/htmlmixed/htmlmixed.min.js');
		$this->addJsLink(CODE_MIRROR . '/mode/xml/xml.min.js');
		$this->addJsLink(CODE_MIRROR . '/mode/javascript/javascript.min.js');
		$this->addJsLink(CODE_MIRROR . '/mode/css/css.min.js');
		$this->addJsLink(CODE_MIRROR . '/mode/clike/clike.min.js');
		$this->addJsLink(CODE_MIRROR . '/mode/php/php.js');
		$this->addJsLink(CODE_MIRROR . '/addon/edit/matchbrackets.min.js');
		$this->addJsLink(CODE_MIRROR . '/addon/edit/closebrackets.min.js');
		$this->addJsLink(CODE_MIRROR . '/addon/comment/comment.min.js');
		$this->setContent(array("<?php\n"));
	}

	private function postInit() {
		if (is_null($this->getAttribute('id'))) $this->setAttribute('id', uniqid());

		// js code
		$js = new \Sy\Component();
		$js->setTemplateFile(TPL_DIR . '/Component/Form/Element/CodeArea/CodeArea.js');
		$js->setVar('CODE_AREA_ID', $this->getAttribute('id'));
		$this->addJsCode($js->__toString());
	}

}