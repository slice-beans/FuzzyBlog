<?php FuzzyBlog\Validators;

class CategoryValidator extends Validator {

	protected $createRules = array(

		'name' => 'required|string',
		'slug'  => 'required|string|unique:posts'

	);

}

