<?php namespace FuzzyBlog\Services;

class CommenterService extends BaseService {
	
	public function populateAuthorable(array $attributes = array())
	{
		if(\Auth::check())
		{
			$attributes['authorable_type'] = '\FuzzyBlog\Entities\User';
			$attributes['authorable_id']   = \Auth::user()->id;
			return $attributes;
		}

		$commenter = $this->create($attributes);

		$attributes['authorable_type'] = '\FuzzyBlog\Entities\Commenter';
		$attributes['authorable_id']   = $commenter->id;
		return $attributes;
	}

}