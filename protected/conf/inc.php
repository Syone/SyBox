<?php
namespace Project;

require __DIR__ . '/conf.php';
require SY_DIR . '/sy.inc.php';

function autoload($class) {
	if (\file_exists($file = __DIR__ . \DIRECTORY_SEPARATOR . '..' . \DIRECTORY_SEPARATOR .\str_replace('\\', \DIRECTORY_SEPARATOR, $class) . '.php'))
		require $file;
}

spl_autoload_register('Project\\autoload');