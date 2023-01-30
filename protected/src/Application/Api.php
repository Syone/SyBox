<?php

namespace Project\Application;

use Sy\Bootstrap\Lib\Str;

class Api extends \Sy\Bootstrap\Application\Api {

	private $whiteList = [];

	public function security() {
		// White list
		$action = $this->action;
		$method = $this->method;
		if (in_array("$action/$method", $this->whiteList)) return true;
		return parent::security();
	}

	public function dispatch() {
		// Check if a plugin api class exists
		$class = 'Project\\Application\\Api\\' . ucfirst(Str::snakeToCaml($this->action));
		if (class_exists($class)) new $class();

		parent::dispatch();
	}

	public function resultAction() {
		$code = $this->get('code');
		if (is_null($code)) exit;
		if (!is_dir(TMP_DIR)) mkdir(TMP_DIR);
		$id = uniqid();
		file_put_contents(TMP_DIR . "/$id.php", unserialize($code));
		ob_start();
		passthru(sprintf(PHP, TMP_DIR . '/' . $id . '.php'));
		$output = ob_get_contents();
		ob_end_clean();
		$output = htmlentities($output, ENT_QUOTES);
		echo "<pre style=\"color:white\">$output</pre>";
		unlink(TMP_DIR . "/$id.php");
		exit;
	}

}