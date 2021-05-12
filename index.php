<?php
require __DIR__ . '/protected/conf/inc.php';

$env = getenv('ENVIRONMENT');

// Activate debug tools
if ($env === 'dev') {
	$debugger = Sy\Debug\Debugger::getInstance();
	$debugger->enablePhpInfo();
	$debugger->enableWebLog();
	$debugger->enableTimeRecord();
	$debugger->enableFileLog(__DIR__ . '/protected/log/app.log');
	$debugger->enableTagLog(__DIR__ . '/protected/log');
	$debugger->enableQueryLog();
	opcache_reset();
}

$app = new Project\Application();

// Activate the web debug tool bar
if ($env === 'dev') {
	$app->enableDebugBar();
}

echo $app;