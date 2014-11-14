<?php namespace Fuzzyblog\Presenters;

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