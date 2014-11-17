<?php namespace FuzzyBlog\Validators;

class CommentValidator extends Validator {
	
	protected $createRules = array(
		'parent_id' => 'sometimes|exists:comments,id',
		'authorable_type' => 'required|in:\FuzzyBlog\Entities\Commenter,\FuzzyBlog\Entities\User',
		'content' => 'required'
	);

	protected $updateRules = array(
		'parent_id' => 'sometimes|exists:comments,id',
		'authorable_type' => 'required|in:Commenter,User',
		'content' => 'required',
		'status'  => 'required|integer|in:1,2,3'
	);

}