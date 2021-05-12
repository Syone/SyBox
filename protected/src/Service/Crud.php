<?php
namespace Project\Service;

use Project\Db\Container;
use Sy\Bootstrap\Service\Crud as ServiceCrud;

class Crud extends ServiceCrud {

	public function __construct($id) {
		parent::__construct($id);
		$this->setDbContainer(Container::getInstance());
	}

}