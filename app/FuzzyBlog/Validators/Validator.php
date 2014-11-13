<?php namespace FuzzyBlog\Validators;

use FuzzyBlog\Exceptions\ValidationException;
use Validator as V;

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