<?php namespace FuzzyBlog\Services;

use App;

/**
 * sets up a base service layer between controllers and models, responsible for validating data prior to insert / update statements and a place to put domain specific logic - handling file uploads etc.
 * reduces boilerplate by setting conventions for where applicable validators and models should reside, the concrete instance of the service should then follow the naming convention {model}Service, and the validator follow convention {model}Validator
 * this allows us to use some minor reflection to retrieve the name of the model (by stripping 'service' from the instantiated services class name) and then we can instantiate the corresponding model and validator without explicitly passing it by name in each individual service
 * 
 * One thing that's quite ugly that I should address is the need to define the model on each create / update statement rather than just setting the model on the object itself, this is because it doesn't seem possible to call a static method from an object property, whereas you can call a static method from a variable class
 * 
 * @todo throw exceptions if corresponding validator / entity doesn't exist
 * @todo figure out a prettier way to call the models create method rather than having to retieve the name of the model each time
 * @package FuzzyBlog
 **/

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
		
		return $model::create($attributes);
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

	//probably better as a trait then living in the base service - used by /FuzzyBlog/Services/PostService and /FuzzyBlog/Services/CategoryService;
	public function setSlug($slug, $title)
	{
		if(empty($slug))
		{
			return strtolower(str_replace(' ', '-', $title));
		}
		return $slug;	
	}

	//gets the name of the entity the service corresponds to by inspecting itself (naming convention is {model}Service) and returning the name of the class with 'Service' removed
	public function getModel()
	{
		return substr(class_basename(get_class($this)), 0, -7);
	}

}