<?php FuzzyBlog\Validators;

class CategoryValidator extends Validator {

	public function $createRules = array(

		'name' => 'required|string',
		'slug'  => 'required|string|unique:posts'

	);

}

