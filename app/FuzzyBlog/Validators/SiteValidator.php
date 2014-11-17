<?php namespace FuzzyBlog\Validators;

class SiteValidator extends Validator {
	
	protected $updateRules = array(
		'site_name' => 'required',
		'site_title' => 'required',
		'description' => 'required'
	);

}