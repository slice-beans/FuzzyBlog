<?php namespace FuzzyBlog\Services;

use \FuzzyBlog\Services\Traits\SwitchStatusTrait;
use \FuzzyBlog\Services\Traits\Last7DaysTrait;

/**
 * Service layer for \FuzzyBlog\Entities\Comments
 *
 * @package FuzzyBlog
 **/
class CommentService extends BaseService {

	use SwitchStatusTrait;
	use Last7DaysTrait;

	protected $commenter;

	public function __construct(\FuzzyBlog\Services\CommenterService $commenter)
	{
		$this->commenter = $commenter;
		parent::__construct();
	}

	public function setAttributesAndCreate(array $attributes = array(), $postid)
	{
		$attributes['post_id'] = $postid;
		$attributes = $this->commenter->populateAuthorable($attributes);
		$this->create($attributes);
	}

	public function countPosts()
	{
		$model = $this->entitybasepath . $this->model;
		return $model::countPosts();
	}

	public function createReply(array $attributes = array())
	{
		$attributes = $this->commenter->populateAuthorable($attributes);
		$this->create($attributes);
	}

}