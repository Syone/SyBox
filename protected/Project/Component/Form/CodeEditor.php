<?php
namespace Project\Component\Form;

use Sy\Component\Html\Form;

class CodeEditor extends Form {

	private $code;

	public function __construct($code = null) {
		$this->code = $code;
		parent::__construct();
	}

	public function init() {
		$this->addTranslator(LANG_DIR);

		$this->setOption('error-class', 'alert alert-error');
		$this->setOption('success-class', 'alert alert-success');

		$codeArea = new \Project\Component\Form\Element\CodeArea();
		$codeArea->setAttribute('name', 'code');

		// add code in code area
		if (!empty($this->code)) {
			$codeArea->setContent([$this->code]);
		}

		$this->addElement($codeArea);
	}

	public function submitAction() {
		header('Content-Type: text/plain');
		$code = trim($this->post('code'));
		if (empty($code)) exit();
		if ($code === '<?php') exit();
		$id = uniqid();
		if ($this->post('action') === 'save') {
			// save the code
			$date = date("Y-m-d H:i:s");
			$service = \Project\Lib\ServiceContainer::getInstance();
			$service['code']->create([
				'token'      => $id,
				'code'       => $code,
				'created_at' => $date,
				'updated_at' => $date,
				'ip'         => ip2long($_SERVER['REMOTE_ADDR']),
			]);

			echo 'http://' . $_SERVER['HTTP_HOST'] . \Project\Lib\Url::build($id);
		} else {
			if (!is_dir(TMP_DIR)) mkdir(TMP_DIR);
			file_put_contents(TMP_DIR . "/$id.php", $code);
			passthru(sprintf(PHP, TMP_DIR . '/' . $id . '.php'));
			unlink(TMP_DIR . "/$id.php");
		}
		exit();
	}

}