<?php
namespace Application\Services;

class ValidationException extends \Exception {

	private $errors;

	public function __construct($errors, $message = null) {
		parent::__construct($message);
		$this->errors = $errors;
	}

	public function getErrors() {
		return $this->errors;
	}
}
