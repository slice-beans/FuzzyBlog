<?php namespace FuzzyBlog\Entities;

class Post extends Basemodel {

	protected $adminpresenter = "FuzzyBlog\Presenters\Admin\PostPresenter";

	protected $table = 'posts';

	protected $fillable = array('title', 'author_id', 'status', 'slug', 'thumbnail', 'content', 'snippet', 'post_type', 'category_id', 'parent_id');

	public function category()
	{
		return $this->belongsTo('\FuzzyBlog\Entities\Category', 'category_id', 'id');
	}

	public function parent()
	{
		return $this->belongsTo('\FuzzyBlog\Entities\Post', 'id', 'parent_id');
	}

	public function author()
	{
		return $this->belongsTo('\FuzzyBlog\Entities\User', 'author_id', 'id');
	}

	public function children()
	{
		return $this->hasMany('\FuzzyBlog\Entities\Post', 'id', 'parent_id');
	}
	
}