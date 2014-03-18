<?php
namespace Project\Lib;

class HeadData {

	private static $title = '';

	private static $description = '';

	public static function getTitle() {
		return self::$title;
	}

	public static function setTitle($title) {
		self::$title = $title;
	}

	public static function getDescription() {
		return self::$description;
	}

	public static function setDescription($description) {
		self::$description = $description;
	}

}