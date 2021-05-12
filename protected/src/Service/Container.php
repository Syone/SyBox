<?php
namespace Project\Service;

/**
 * @method static Container getInstance()
 */
class Container extends \Sy\Bootstrap\Service\Container {

	public function __construct() {
		parent::__construct();

		$this->code = function() {
			return new Crud('code');
		};
	}

}