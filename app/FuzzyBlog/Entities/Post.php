<?php namespace FuzzyBlog\Entities;

class Post extends BaseModel {

	protected $adminpresenter = "FuzzyBlog\Presenters\Admin\PostPresenter";

	protected $publicpresenter = "FuzzyBlog\Presenters\PublicPresenters\PostPresenter";

	protected $table = 'posts';

	protected $fillable = array('title', 'author_id', 'status', 'slug', 'thumbnail', 'content', 'snippet', 'post_type', 'category_id', 'parent_id');

	//called on the frontend of the blog, to only retrieve active posts
	public static function allWherePublished()
	{
		return \FuzzyBlog\Entities\Post::where('status', '=', 1)->get();
	}

	public function comments()
	{
		return $this->hasMany('\FuzzyBlog\Entities\Comment');
	}

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
