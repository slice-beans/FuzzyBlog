<?php namespace FuzzyBlog\Entities;

use \FuzzyBlog\Presenters\PresentableTrait;

/**
  * All models should extend this, provides dates as carbon instances and sets up the presenter logic, presenter can be included in a model by adding adding the namespace string to the publicpresenter and admin presenter protected properties
  *
  * @package FuzzyBlog
  **/
abstract class BaseModel extends \Eloquent {

	use PresentableTrait;

	/**
	 * provides a way to validate data to be added to the database if circumventing the entity service
	 *
	 * @return Eloquent instance
	 * @author 
	 **/
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