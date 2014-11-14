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
		$model = $this->entitybasepath . $this->model;

		$this->validator->validateCreate($attributes);
		
		$model::create($attributes);
	}

	public function update(array $attributes = array(), $id)
	{
		$model = $this->entitybasepath . $this->model;
		$this->validator->validateUpdate($attributes);
		
		$obj = $model::find($id);
		foreach($attributes as $col => $val)
		{
			if(in_array($col, $obj->getFillable()))
			$obj->{$col} = $val;
		}
		$obj->save();
	}

	public function setSlug($slug, $title)
	{
		if(empty($slug))
		{
			return strtolower(str_replace(' ', '-', $title));
		}
		return $slug;	
	}

	public function getModel()
	{
		return substr(class_basename(get_class($this)), 0, -7);
	}

}