<?php namespace FuzzyBlog\Presenters;

/**
 * If the adminpresenter and publicpresenter properties are set on the model, we can return a new instance of the presenter by calling $this->adminpresent(), $this->publicpresent() respectively from the mdoel.
 * I opted not to use a singleton approach to the presenters because if iterating over an eloquent collection, the presenter would return values from the initial model throughout the iteration  
 *
 * @package FuzzyBlog
 * 
 **/
trait PresentableTrait {
	
	public function adminpresent()
	{
		if( ! $this->adminpresenter || ! class_exists($this->adminpresenter))
		{
			throw new \FuzzyBlog\Exceptions\PresenterException('Admin presenter was not set on model or presenter does not exist.');
		}

		return new $this->adminpresenter($this);
	}

	public function publicpresent()
	{
		if( ! $this->publicpresenter || ! class_exists($this->publicpresenter))
		{
			throw new \FuzzyBlog\Exceptions\PresenterException('Public presenter was not set on model or presenter does not exist.');
		}

		return new $this->publicpresenter($this);

	}
}