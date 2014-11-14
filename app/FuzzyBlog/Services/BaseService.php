<?php namespace FuzzyBlog\Services;

use App;

abstract class BaseService implements ServiceInterface { 

	protected $validatorbasepath = "FuzzyBlog\\Validators\\";
	protected $entitybasepath    = "FuzzyBlog\\Entities\\";
	protected $model;

	public function __construct()
	{
		$this->model = $this->getModel();
		$this->validator = App::make($this->validatorbasepath . $this->model."Validator");
	}

	public function create(array $attributes = array())
	{
		$model = $entitybasepath . $this->model;

		$this->validator->validateCreate($attributes);
		
		$model::create($attributes);
	}

	public function update(array $attributes = array())
	{
		$model = $this->entitybasepath . $this->model;

		$this->validator->validateUpdate($attributes);
		
		$model::update($attributes);
	}

	public function getModel()
	{
		return substr(class_basename(get_class($this)), 0, -7);
	}

}