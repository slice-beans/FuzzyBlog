<?php namespace FuzzyBlog\Presenters\PublicPresenters;

class CommentPresenter extends \FuzzyBlog\Presenters\BasePresenter {
	
	public function gravatar()
	{
		return '<img src="http://www.gravatar.com/avatar/'. md5( trim( strtolower($this->entity->authorable->email) ) ) .'">';
	}

	public function heading()
	{
		return $this->entity->authorable->username .' wrote';
	}

}