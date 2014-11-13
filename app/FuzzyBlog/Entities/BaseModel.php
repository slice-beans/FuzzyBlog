<?php namespace FuzzyBlog\Entities;

class BaseModel extends \Eloquent {
	
	public function create( array $attributes = array() )
	{
		$class = get_class($this);
		$path  = "FuzzyBlog\\Validators\\{$class}Validator";

		if(class_exists($path))
		{
			App::make($path)->ValidateCreate($attributes);
		}

		return parent::create($attributes);
	}

}