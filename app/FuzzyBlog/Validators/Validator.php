<?php namespace FuzzyBlog\Validators;

use FuzzyBlog\Exceptions\ValidationException;
use Validator as V;

/**
 * base validator, which passes the create create / update rules of the instantiated validator to the validator method and throws a FuzzyBlog\Exceptions\ValidationException if it fails
 *
 * @package default
 * @author 
 **/
abstract class Validator {
	
	public function validate($input, $rules)
	{
		$validation = V::make($input, $rules);

		if($validation->fails()) throw new ValidationException($validation->messages());

		return true;
	}

	public function validateCreate($input)
	{
		return $this->validate($input, $this->createRules);
	}

	public function validateUpdate($input)
	{
		return $this->validate($input, $this->updateRules);
	}

}