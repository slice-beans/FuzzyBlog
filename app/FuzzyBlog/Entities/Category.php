<?php namespace FuzzyBlog\Entities;

class Category extends BaseModel {

	protected $adminpresenter = "FuzzyBlog\Presenters\Admin\CategoryPresenter";

	protected $table = 'categories';

	protected $fillable = array('name', 'slug');

	//only show live posts
	public function posts()
	{
		return $this->hasMany('\FuzzyBlog\Entities\Post')->where('status', '=', 1);
	}
	
}