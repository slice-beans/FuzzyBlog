<?php namespace FuzzyBlog\Validators;

class UserValidator extends Validator {
	
	protected $createRules = array(
		'email'    => 'required|email|unique:users',
		'username' => 'required|unique:users',
		'password' => 'required'
	);

	protected $updateRules = array(
		'email'    => 'sometimes|required|email|unique:users',
		'password' => 'sometimes|required|confirmed'
	);

}