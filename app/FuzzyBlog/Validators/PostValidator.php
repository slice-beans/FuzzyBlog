<?php FuzzyBlog\Validators;

class PostValidator extends Validator {

	public function $createRules = array(

		'title' => 'required|string|unique:posts',
		'slug'  => 'required|string|unique:posts',
		'thumbnail' => 'mimes:jpeg,bmp,png',
		'content' => 'required',
		'post_type' => 'required|in:html,markdown',
		'category_id' => 'exists:categories,id',
		'parent_id'   => 'exists:posts,id'

	);

}

