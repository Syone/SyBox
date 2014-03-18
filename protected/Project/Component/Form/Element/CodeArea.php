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
		$this->addCssLink(WEB_ROOT . '/assets/codemirror/lib/codemirror.css');
		$this->addCssLink(WEB_ROOT . '/assets/codemirror/theme/eclipse.css');
		$this->addJsLink(WEB_ROOT . '/assets/codemirror/lib/codemirror.js', self::JS_BOTTOM);
		$this->addJsLink(WEB_ROOT . '/assets/codemirror/mode/htmlmixed/htmlmixed.js', self::JS_BOTTOM);
		$this->addJsLink(WEB_ROOT . '/assets/codemirror/mode/xml/xml.js', self::JS_BOTTOM);
		$this->addJsLink(WEB_ROOT . '/assets/codemirror/mode/javascript/javascript.js', self::JS_BOTTOM);
		$this->addJsLink(WEB_ROOT . '/assets/codemirror/mode/css/css.js', self::JS_BOTTOM);
		$this->addJsLink(WEB_ROOT . '/assets/codemirror/mode/clike/clike.js', self::JS_BOTTOM);
		$this->addJsLink(WEB_ROOT . '/assets/codemirror/mode/php/php.js', self::JS_BOTTOM);
		$this->addJsLink(WEB_ROOT . '/assets/codemirror/addon/edit/matchbrackets.js', self::JS_BOTTOM);
		$this->addJsLink(WEB_ROOT . '/assets/codemirror/addon/edit/closebrackets.js', self::JS_BOTTOM);
		$this->addJsLink(WEB_ROOT . '/assets/codemirror/addon/comment/comment.js', self::JS_BOTTOM);
		$this->setContent(array("<?php\n"));
	}

	private function postInit() {
		if (is_null($this->getAttribute('id'))) $this->setAttribute('id', uniqid());

		// js code
		$js = new \Sy\Component();
		$js->setTemplateFile(TPL_DIR . '/Component/Form/Element/CodeArea/CodeArea.js');
		$js->setVar('CODE_AREA_ID', $this->getAttribute('id'));
		$this->addJsCode($js->__toString(), self::JS_BOTTOM);
	}

}