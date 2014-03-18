<?php
require __DIR__ . '/protected/conf/inc.php';

// Activate debug tools
$debugger = Sy\Debug\Debugger::getInstance();
$debugger->enablePhpInfo();
$debugger->enableWebLog();
$debugger->enableTimeRecord();
$debugger->enableFileLog(__DIR__ . '/protected/log/app.log');
$debugger->enableTagLog(__DIR__ . '/protected/log');
$debugger->enableQueryLog();

// Activate the web debug tool bar
$app = new Project\Application();
$app->enableDebugBar();
echo $app;