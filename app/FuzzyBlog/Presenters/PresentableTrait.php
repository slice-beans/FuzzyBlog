<?php namespace FuzzyBlog\Presenters;

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