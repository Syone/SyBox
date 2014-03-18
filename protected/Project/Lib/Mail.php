<?php
namespace Project\Lib;

class Mail {

	private $to;
	private $from;
	private $subject;
	private $body;
	private $headers;

	public function __construct($to, $from, $subject, $body) {
		$this->to = $to;
		$this->from = $from;
		$this->subject = $subject;
		$this->body = $body;
	}

	function send() {
		$this->addHeader('From: ' . $this->from . "\r\n");
		$this->addHeader('Reply-To: ' . $this->from . "\r\n");
		$this->addHeader('Return-Path: ' . $this->from . "\r\n");
		if (!mail($this->to, $this->subject, $this->body, $this->headers))
			throw new Mail\Exception;
	}

	function addHeader($header) {
		$this->headers .= $header;
	}

}

namespace Project\Lib\Mail;

class Exception extends \Exception {}