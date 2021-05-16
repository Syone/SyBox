<?php
namespace Project\Component\Form;

use Project\Service\Container;
use Sy\Bootstrap\Lib\Url;
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
		$code = trim($this->post('code'));
		$title = trim($this->post('title', ''));
		$description = trim($this->post('description', ''));
		if (empty($code)) exit();
		if ($code === '<?php') exit();
		if ($this->post('action') === 'save') {
			// save the code
			$date = date("Y-m-d H:i:s");
			$service = Container::getInstance();
			$service->code->change([
				'title'      => $title,
				'description'=> $description,
				'code'       => $code,
				'ip'         => ip2long($_SERVER['REMOTE_ADDR']),
			], [
				'updated_at' => $date,
			]);

			$id = $service->code->lastInsertId();
			echo '<pre style="color:white">You can share your code using this URL: http://' . $_SERVER['HTTP_HOST'] . Url::build('page', 'home', ['id' => $id]) . '</pre>';
		} else {
			if (!is_dir(TMP_DIR)) mkdir(TMP_DIR);
			$id = uniqid();
			file_put_contents(TMP_DIR . "/$id.php", $code);
			ob_start();
			passthru(sprintf(PHP, TMP_DIR . '/' . $id . '.php'));
			$output = ob_get_contents();
			ob_end_clean();
			$output = htmlentities($output, ENT_QUOTES);
			echo "<pre style=\"color:white\">$output</pre>";
			unlink(TMP_DIR . "/$id.php");
		}
		exit();
	}

}