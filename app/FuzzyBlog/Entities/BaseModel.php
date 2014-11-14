<?php namespace FuzzyBlog\Entities;

use FuzzyBlog\Presenters\PresentableTrait;

abstract class BaseModel extends \Eloquent {

	use PresentableTrait;

	public function createOrFail( array $attributes = array() )
	{
		$class = get_class($this);
		$path  = "FuzzyBlog\\Validators\\{$class}Validator";

		if(class_exists($path))
		{
			App::make($path)->ValidateCreate($attributes);
		}

		return parent::create($attributes);
	}

	public function getDates()
	{
		return array('created_at', 'modified_at');
	}

}