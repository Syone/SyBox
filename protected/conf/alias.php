<?php
return [
	/**
	 * alias => controller,
	 * or
	 * alias => controller/action,
	 * or
	 * alias => controller?key1=value1&key2=value2,
	 * or
	 * alias => controller/action?key1=value1&key2=value2,
	 *
	 * Example:
	 * 'accueil' => 'page/home',
	 * 'articles/categorie-1' => 'page/articles?category=1',
	 */
	'en' => [
		'page/log-in' => 'page/user-connection',
	],
	'fr' => [
		'page/se-connecter' => 'page/user-connection',
	],
	'es' => [
		'page/iniciar-secion' => 'page/user-connection',
	],
	'it' => [
		'page/accesso' => 'page/user-connection',
	],
];
