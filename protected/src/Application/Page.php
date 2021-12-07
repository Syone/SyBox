<?php
namespace Project\Application;



class Page extends \Sy\Bootstrap\Application\Page {

	protected function preInit() {
		// Head data
		$this->setMeta('viewport', 'width=device-width, initial-scale=1, shrink-to-fit=no');
		$this->setMeta('mobile-web-app-capable', 'yes');
		$this->setMeta('apple-mobile-web-app-capable', 'yes');
		$this->setMeta('X-UA-Compatible', 'IE=edge', true);
		$this->setMeta('application-name', PROJECT);
		$this->setMeta('apple-mobile-web-app-title', PROJECT);

		// Favicon
		$this->addLink(['rel' => 'apple-touch-icon', 'sizes' => '180x180', 'href' => WEB_ROOT . '/assets/img/icons/apple-touch-icon.png']);
		$this->addLink(['rel' => 'icon', 'sizes'=>'32x32', 'href' => WEB_ROOT . '/assets/img/icons/favicon-32x32.png']);
		$this->addLink(['rel' => 'icon', 'sizes'=>'16x16', 'href' => WEB_ROOT . '/assets/img/icons/favicon-16x16.png']);
		$this->addLink(['rel' => 'manifest', 'href' => WEB_ROOT . '/site.webmanifest']);
		$this->addLink(['rel' => 'mask-icon', 'href' => WEB_ROOT . '/assets/img/icons/safari-pinned-tab.svg', 'color' => '#e95420']);
		$this->setFavicon(WEB_ROOT . '/assets/img/icons/favicon.ico');
		$this->setMeta('msapplication-TileColor', '#e95420');
		$this->setMeta('msapplication-config', WEB_ROOT . '/browserconfig.xml');
		$this->setMeta('theme-color', '#e95420');

		// Application css
		$this->addCssLink(WEB_ROOT . '/assets/css/app.css');

		// Application js
		$this->addJsLink(WEB_ROOT . '/assets/js/app.js');
	}

	protected function postInit() {

	}

}