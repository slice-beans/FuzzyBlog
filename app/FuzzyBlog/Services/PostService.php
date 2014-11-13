<?php namespace FuzzyBlog\Services;

use App;
use FuzzyBlog\Validators\ValidationException;

class PostService extends BaseService {
	
	protected $listener;

	public function __construct($listener, FuzzyBlog\Validators\PostValidator $validator)
	{
		$this->listener  = $listener;
		$this->validator = 
	}

	public function create(array $attributes = array())
	{
		try 
		{
			App::make($this->validator)->validateCreate($attributes);
		}
		catch(ValidationException $e)
		{
			return $this->listener->creationFailed()
		}
	}

}