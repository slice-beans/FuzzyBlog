<?php namespace FuzzyBlog\Services;

use App;
use FuzzyBlog\Validators\ValidationException;

Abstract BaseService implements ServiceInterface { 

	protected $validatorbasepath = "FuzzyBlog\\Validators\\";
	protected $entitybasepath    = "FuzzyBlog\\Entities\\";
	protected $servicefor;

	public function __construct($listener, \Eloquent $entity)
	{
		$this->listener  = $listener;
		$this->validator = App::make($basepath . "Validators\\{$entity}Validator");
	}

	public function create(array $attributes = array())
	{
		try
		{
			$this->validator->validateCreate($attributes);
		}
		catch(ValidationException $e)
		{
			$this->listener->creationFailed($e->getMessage);
		}

		$entitybasepath . $servicefor::create($attributes);
	}

}