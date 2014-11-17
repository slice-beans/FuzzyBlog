<?php namespace FuzzyBlog\Entities;

class Comment extends Basemodel {
	
	protected $table = 'comments';

	protected $adminpresenter = "FuzzyBlog\Presenters\Admin\CommentPresenter";
	protected $publicpresenter = "FuzzyBlog\Presenters\PublicPresenters\CommentPresenter";

	protected $fillable = array('content', 'status', 'parent_id', 'post_id', 'authorable_id', 'authorable_type');

	public function authorable()
	{
		return $this->morphTo();
	}

	public function parent()
	{
		return $this->belongsTo('\FuzzyBlog\Entities\Comment');
	}

	public function replies()
	{
		return $this->hasMany('\FuzzyBlog\Entities\Comment', 'parent_id', 'id');
	}

	public static function countPosts()
	{
		$posts = \DB::table('comments')
                 ->select('post_id', \DB::raw('count(*) as total'))
                 ->groupBy('post_id')
                 ->orderBy('total', 'desc')
                 ->limit(10)
                 ->get();

        return $posts;
	}

	public function post()
	{
		return $this->belongsTo('\FuzzyBlog\Entities\Post');
	}

}