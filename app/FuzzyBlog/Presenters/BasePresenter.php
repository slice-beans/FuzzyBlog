<?php namespace Fuzzyblog\Presenters;

/**
 * basic presenter that binds the presenters corresponding model (passed by the model into the constructor) and calls the presenter method to format output using - defaults back to the model property if a presenter methodd doesn't exist
 *
 * @package FuzzyBlog
 **/
abstract class BasePresenter {

	protected $entity;

	public function __construct($entity)
	{
		$this->entity = $entity;
	}

	public function __get($property)
	{
		if(method_exists($this, $property))
		{
			return $this->{$property}();
		}

		return $this->entity->{$property};
	}

	public function created_at_human()
	{
		return $this->entity->created_at->diffForHumans();
	}

}