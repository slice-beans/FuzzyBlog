<?php namespace FuzzyBlog\Validators;

class CategoryValidator extends Validator {

	protected $createRules = array(

		'name' => 'required|unique:categories,name',
		'slug'  => 'required|unique:categories,slug'

	);

	public $updateRules = array(
		'name' => 'required',
		'slug'  => 'required'
	);

}

