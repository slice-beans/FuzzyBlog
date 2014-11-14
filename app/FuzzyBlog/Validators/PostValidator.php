<?php namespace FuzzyBlog\Validators;

class PostValidator extends Validator {

	protected $createRules = array(

		'author_id'   => 'required|exists:users,id',
		'title'       => 'required|unique:posts',
		'slug'        => 'unique:posts',
		'thumbnail'   => 'sometimes|mimes:jpeg,jpg,bmp,png',
		'content'     => 'required',
		'post_type'   => 'required|in:html,markdown',
		'category_id' => 'exists:categories,id',
		'status'      => 'in:1,2'

	);

}

