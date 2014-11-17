<?php namespace FuzzyBlog\Validators;

class CommenterValidator extends Validator {
	
	protected $updateRules = array(
		'username' => 'required',
		'email'    => 'required|email'
	);

	protected $createRules = array(
		'username' => 'required',
		'email'    => 'required|email'
	);

}