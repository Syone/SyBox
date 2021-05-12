<?php
namespace Project\Component\Nav;

use Sy\Bootstrap\Lib\Url;

class Navbar extends \Sy\Component\WebComponent {

	public function __toString() {
		$this->init();
		return parent::__toString();
	}

	private function init() {
		$this->addTranslator(LANG_DIR);
		$this->setTemplateFile(TPL_DIR . '/Component/Nav/Navbar.html');
		$this->setVars([
			'WEB_ROOT' => WEB_ROOT,
			'PROJECT'  => PROJECT,
			'USER_CONNECT_URL' => Url::build('page', 'user-connection'),
		]);
		// $this->setComponent('NAV', $this->menu());
		// $this->setComponent('NAV_RIGHT', $this->menuRight());
	}

	private function menu() {
		$data = [
			'Home'     => ['fa' => 'home fa-fw', 'page' => 'home'],
			'Articles' => ['fa' => 'newspaper fa-fw', 'page' => 'articles'],
			'About' => [
				'fa' => 'question-circle fa-fw',
				'menu' => [
					'About us' => ['fa' => 'users fa-fw', 'page' => 'about-us'],
					'Conditions of use' => ['fa' => 'info-circle fa-fw', 'page' => 'use'],
					'Privacy policy' => ['fa' => 'user-shield fa-fw', 'page' => 'privacy']
				]
			]
		];
		$menu = new \Sy\Bootstrap\Component\Nav\Menu($data);
		$menu->setAttribute('class', "me-auto");
		return $menu;
	}

	private function menuRight() {
		// Connection / User menu
		$service = \Sy\Bootstrap\Service\Container::getInstance();
		$user    = $service->user->getCurrentUser();
		if ($user->isConnected()) {
			$m = [
				'Account settings' => ['fa' => 'cog fa-fw', 'page' => 'user-account'],
				'-',
				'Sign Out' => ['fa' => 'power-off fa-fw', 'url' => Url::build('user', 'signOut')],
			];

			$name = htmlentities(trim($user->firstname . ' ' . $user->lastname), ENT_QUOTES, 'UTF-8');
			$data = [
				'<img class="rounded-circle" src="' . Url::avatar($user->id) . '" alt="' . $name . '" /> ' . $name => [
					'page' => 'user',
					'param' => ['id' => $user->id],
					'class' => 'dropdown-menu-end',
					'menu' => $m
				]
			];
		} else {
			$data = ['Sign In' => ['fa' => 'power-off fa-fw', 'page' => 'user-connection']];
		}

		$menu = new \Sy\Bootstrap\Component\Nav\Menu($data);
		return $menu;
	}

}