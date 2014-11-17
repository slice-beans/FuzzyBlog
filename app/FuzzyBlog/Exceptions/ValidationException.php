<?php namespace FuzzyBlog\Exceptions;

use Exception;

/**
 * Call whenever an update / insert statement fails due to validation reasons - thrown in FuzzyBlog\Validators\Validator and its inheritors
 *
 * @package FuzzyBlog
 **/
class ValidationException extends Exception {
	
	protected $errors;

	public function __construct($errors, $message = '', $code = 0, Exception $previous = null)
	{
		$this->errors = $errors;
		parent::__construct($message, $code, $previous);
	}

	public function getErrors()
	{
		return $this->errors;
	}
}