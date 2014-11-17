<?php namespace FuzzyBlog\Entities;

class Commenter extends BaseModel {
	
	protected $table = 'commenters';

	protected $fillable = array('username', 'email');

	public function comments()
	{
		return $this->morphMany('\FuzzyBlog\Entities\Comment', 'authorable');
	}

}